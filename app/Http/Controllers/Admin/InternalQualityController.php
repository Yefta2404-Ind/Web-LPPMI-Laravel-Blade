<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InternalQuality;

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


    public function approve($id)
    {
        InternalQuality::where('id',$id)
            ->update(['status' => 'approved']);

        return back()->with('success','Data berhasil disetujui.');
    }

    public function reject($id)
    {
        InternalQuality::where('id',$id)
            ->update(['status' => 'rejected']);

        return back()->with('success','Data berhasil ditolak.');
    }

    public function destroy($id)
    {
        InternalQuality::where('id',$id)->delete();

        return back()->with('success','Data berhasil dihapus.');
    }
}
