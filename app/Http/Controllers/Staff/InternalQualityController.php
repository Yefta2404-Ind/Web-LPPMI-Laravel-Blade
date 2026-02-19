<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InternalQuality;
use App\Models\InternalCategory;

class InternalQualityController extends Controller
{
   public function index(Request $request)
{
    $query = InternalQuality::with(['category','user']);

    if ($request->status) {
        $query->where('status', $request->status);
    }

    $data = $query->latest()->get();

    return view('admin.mutu-internal.index', compact('data'));
}


public function create()
{
    $categories = InternalCategory::all();

    return view('staff.mutu-internal.create', compact('categories'));
}

public function store(Request $request)
{
    $request->validate([
        'category_id' => 'required|exists:internal_categories,id',
        'year'        => 'required|digits:4',
        'file'        => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        'external_url'=> 'nullable|url'
    ]);

    $filePath = null;

    if ($request->hasFile('file')) {
        $filePath = $request->file('file')
                            ->store('mutu-internal','public');
    }

    InternalQuality::create([
        'category_id' => $request->category_id,
        'year'        => $request->year,
        'file_path'   => $filePath,
        'external_url'=> $request->external_url,
        'status'      => 'pending',
        'user_id'     => auth()->id(),
    ]);

    return redirect()
            ->route('staff.mutu-internal.index')
            ->with('success','Data berhasil dikirim dan menunggu persetujuan.');
}

public function edit(InternalQuality $mutu_internal)
{
    if ($mutu_internal->user_id !== auth()->id()) {
        abort(403);
    }

    $categories = InternalCategory::all();

    return view('staff.mutu-internal.edit', 
        compact('mutu_internal','categories'));
}


public function update(Request $request, InternalQuality $mutu_internal)
{
    if ($mutu_internal->user_id !== auth()->id()) {
        abort(403);
    }

    $request->validate([
        'category_id' => 'required|exists:internal_categories,id',
        'year'        => 'required|digits:4',
        'file'        => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        'external_url'=> 'nullable|url'
    ]);

    if ($request->hasFile('file')) {
        $filePath = $request->file('file')
                            ->store('mutu-internal','public');

        $mutu_internal->file_path = $filePath;
    }

    $mutu_internal->update([
        'category_id' => $request->category_id,
        'year'        => $request->year,
        'external_url'=> $request->external_url,
        'status'      => 'pending' // reset approval
    ]);

    return redirect()
            ->route('staff.mutu-internal.index')
            ->with('success','Data berhasil diperbarui dan menunggu persetujuan.');
}

public function destroy(InternalQuality $mutu_internal)
{
    if ($mutu_internal->user_id !== auth()->id()) {
        abort(403);
    }

    $mutu_internal->delete();

    return back()->with('success','Data berhasil dihapus.');
}


}
