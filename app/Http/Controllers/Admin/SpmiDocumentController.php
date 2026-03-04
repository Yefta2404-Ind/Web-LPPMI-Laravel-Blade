<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpmiDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SpmiDocumentController extends Controller
{

public function index(Request $request)
{
    $status = $request->status;
    $search = $request->search;

    $query = SpmiDocument::with(['category', 'creator'])
        ->when($status, function ($query) use ($status) {
            $query->where('status', $status);
        })
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('creator', function ($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%");
                  });
            });
        })
        ->latest();

    /** @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $documents */
    $documents = $query->paginate(10);

    $documents = $documents->appends($request->query());

    return view('admin.spmi.index', compact('documents'));
}
    
public function approve($id)
{
    DB::transaction(function () use ($id) {

        // Lock dokumen supaya tidak race condition
        $document = SpmiDocument::where('id', $id)
            ->lockForUpdate()
            ->firstOrFail();

        // Reject semua dokumen lain di kategori yang sama
        SpmiDocument::where('category_id', $document->category_id)
            ->where('id', '!=', $document->id)
            ->where('status', 'approved')
            ->update([
                'status' => 'rejected'
            ]);

        // Approve dokumen ini
        $document->update([
            'status' => 'approved'
        ]);
    });

    return back()->with('success', 
        'Dokumen berhasil di-approve dan dokumen sebelumnya otomatis dinonaktifkan.'
    );
}

    public function reject($id)
{
    $document = SpmiDocument::findOrFail($id);

    $document->update([
        'status' => 'rejected'
    ]);

    return back()->with('success', 'Dokumen berhasil di-reject.');
}
}

