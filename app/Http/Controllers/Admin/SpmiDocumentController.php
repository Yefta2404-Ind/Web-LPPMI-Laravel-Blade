<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpmiDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpmiDocumentController extends Controller
{
    public function index(Request $request)
{
    $status = $request->status;

    $documents = SpmiDocument::with('category')
        ->when($status, function ($query) use ($status) {
            $query->where('status', $status);
        })
        ->latest()
        ->get();

    return view('admin.spmi.index', compact('documents'));
}



    
public function approve($id)
{
    DB::transaction(function () use ($id) {

        $document = SpmiDocument::findOrFail($id);

        // Nonaktifkan approved lama di kategori yang sama
        SpmiDocument::where('category_id', $document->category_id)
            ->where('status', 'approved')
            ->update(['status' => 'rejected']);

        // Approve dokumen baru
        $document->update([
            'status' => 'approved'
        ]);
    });

    return back()->with('success', 'Dokumen berhasil di-approve.');
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

