<?php

namespace App\Http\Controllers;
use App\Models\HeroBanner;

use Illuminate\Http\Request;

class HeroBannerController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'image' => 'required|image|max:2048',
        'title' => 'nullable|string|max:255',
        'link'  => 'nullable|url',
    ]);

    $path = $request->file('image')->store('hero', 'public');

    HeroBanner::create([
        'title'      => $request->title,
        'image'      => $path,
        'link'       => $request->link,
        'created_by' => auth()->id(),
        'status'     => 'pending',
        'is_active'  => 0, // KUNCI
        'order'      => 0,
    ]);

    return back()->with('success','Banner dikirim, menunggu approval admin');
}

public function pending()
{
     $banners = HeroBanner::where('status', 'pending')
                ->orderBy('created_at', 'desc')
                ->paginate(10);

    return view('admin.hero.pending', compact('banners'));
}


public function approve(HeroBanner $banner)
{
    if ($banner->status !== 'pending') {
        return back();
    }

    $banner->update([
        'status'      => 'approved',
        'approved_by' => auth()->id(),
        'approved_at' => now(),
        'is_active'   => 0, // belum tampil
    ]);

    return back()->with('success','Banner di-approve');
}

public function reject(HeroBanner $banner)
{
    if ($banner->status !== 'pending') {
        return back();
    }

    $banner->update([
        'status'      => 'rejected',
        'approved_by' => auth()->id(),
        'approved_at' => now(),
        'is_active'   => 0,
    ]);

    return back()->with('success','Banner ditolak');
}

public function approved()
{
    $banners = HeroBanner::where('status','approved')
                ->orderBy('order')
                ->get();

    return view('admin.hero.approved', compact('banners'));
}


public function toggleActive(HeroBanner $banner)
{
    if ($banner->status !== 'approved') {
        return back()->with('error','Banner belum di-approve');
    }

    $banner->update([
        'is_active' => ! $banner->is_active
    ]);

    return back();
}



public function updateOrder(Request $request, HeroBanner $banner)
{
    $request->validate([
        'order' => 'required|integer|min:0'
    ]);

    $banner->update([
        'order' => $request->order
    ]);

    return back();
}


public function create()
{
    return view('staff.hero.create');
}


}
