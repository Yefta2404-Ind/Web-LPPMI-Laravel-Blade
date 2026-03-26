<?php

namespace App\Http\Controllers;
use App\Models\HeroBanner;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class HeroBannerController extends Controller
{
    public function index()
    {
        $banners = HeroBanner::orderBy('order')->paginate(10);
        return view('admin.hero.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.hero.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
            'title' => 'nullable|string|max:255',
            'link'  => 'nullable|url',
        ]);

        $path = $request->file('image')->store('hero', 'public');

        HeroBanner::create([
            'title'       => $request->title,
            'image'       => $path,
            'link'        => $request->link,
            'created_by'  => auth()->id(),
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'status'      => 'approved',
            'is_active'   => 0,
            'order'       => (HeroBanner::max('order') ?? 0) + 1,
        ]);

        return redirect()->route('admin.hero.index')
                         ->with('success', 'Banner berhasil ditambahkan');
    }

    public function toggleActive(HeroBanner $banner)
    {
        $banner->update(['is_active' => !$banner->is_active]);
        return back();
    }

    public function updateOrder(Request $request, HeroBanner $banner)
    {
        $request->validate(['order' => 'required|integer|min:0']);
        $banner->update(['order' => $request->order]);
        return back();
    }

    public function destroy(HeroBanner $banner)
    {
        Storage::disk('public')->delete($banner->image);
        $banner->delete();
        return back()->with('success', 'Banner berhasil dihapus');
    }
}