<?php
namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\ExternalQuality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExternalQualityController extends Controller
{
    public function index()
    {
        $data = ExternalQuality::where('user_id', Auth::id())
                    ->latest()
                    ->get();

        return view('staff.mutu-eksternal.index', compact('data'));
    }

    public function create()
    {
        return view('staff.mutu-eksternal.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'file' => 'nullable|mimes:pdf,doc,docx|max:2048',
        'external_url' => 'nullable|url'
    ]);

    $filePath = null;

    if ($request->hasFile('file')) {
        $filePath = $request->file('file')
            ->store('mutu-eksternal', 'public');
    }

    ExternalQuality::create([
        'title' => $request->title,
        'description' => $request->description,
        'file_path' => $filePath,
        'external_url' => $request->external_url,
        'status' => 'pending',
        'user_id' => auth()->id()
    ]);

    return redirect()->route('staff.mutu-eksternal.index')
            ->with('success', 'Data berhasil dikirim dan menunggu approval.');
}


    public function edit($id)
    {
        $data = ExternalQuality::where('user_id', Auth::id())
                    ->findOrFail($id);

        if ($data->status === 'approved') {
            abort(403, 'Data sudah disetujui dan tidak dapat diedit.');
        }

        return view('staff.mutu-eksternal.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = ExternalQuality::where('user_id', Auth::id())
                    ->findOrFail($id);

        if ($data->status === 'approved') {
            abort(403);
        }

        $data->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'pending' // reset jadi pending setelah edit
        ]);

        return redirect()
            ->route('staff.mutu-eksternal.index')
            ->with('success', 'Perubahan dikirim ulang untuk approval.');
    }

    public function destroy($id)
    {
        $data = ExternalQuality::where('user_id', Auth::id())
                    ->findOrFail($id);

        $data->delete();

        return back()->with('success', 'Data berhasil dihapus.');
    }
}
