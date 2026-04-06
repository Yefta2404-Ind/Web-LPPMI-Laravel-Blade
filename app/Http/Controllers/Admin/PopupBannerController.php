<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PopupBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PopupBannerController extends Controller
{
    public function index()
    {
        $popup = PopupBanner::orderByDesc('id')->first();
        return view('admin.popup.index', compact('popup'));
    }

public function store(Request $request)
{
    $request->validate([
        'image' => 'required|image|max:2048',
    ]);

    // 🔥 Ambil semua popup lama
    $oldPopups = PopupBanner::all();

    foreach ($oldPopups as $popup) {
        if ($popup->image_path && Storage::disk('public')->exists($popup->image_path)) {
            Storage::disk('public')->delete($popup->image_path);
        }
    }

    // 🔥 Hapus semua data
    PopupBanner::truncate();

    // 🔥 Upload baru
    $path = $request->file('image')->store('popup', 'public');

    PopupBanner::create([
        'image_path' => $path,
        'is_active'  => true,
    ]);

    return back()->with('success', 'Pop-up diperbarui!');
}

    public function toggleActive()
    {
        $popup = PopupBanner::orderByDesc('id')->first();

        if (!$popup) {
            return back()->with('error', 'Tidak ada data popup.');
        }

        $popup->update([
            'is_active' => !$popup->is_active
        ]);

        return back()->with('success', 'Status pop-up berhasil diubah.');
    }

    
}