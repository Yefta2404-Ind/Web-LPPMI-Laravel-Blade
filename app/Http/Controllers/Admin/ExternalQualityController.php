<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExternalQuality;
use Illuminate\Http\Request;

class ExternalQualityController extends Controller
{
    public function index()
    {
        $data = ExternalQuality::latest()->get();

        return view('admin.mutu-eksternal.index', compact('data'));
    }

    public function approve(Request $request, $id)
{
    $request->validate([
        'section' => 'required|string'
    ]);

    $data = ExternalQuality::findOrFail($id);

    $data->update([
        'section' => $request->section,
        'status' => 'approved',
        'rejection_note' => null
    ]);

    return back()->with('success', 'Data berhasil disetujui.');
}

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_note' => 'required|string'
        ]);

        $data = ExternalQuality::findOrFail($id);

        $data->update([
            'status' => 'rejected',
            'rejection_note' => $request->rejection_note
        ]);

        return back()->with('success', 'Data ditolak.');
    }
}
