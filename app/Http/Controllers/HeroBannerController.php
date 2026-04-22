<?php

namespace App\Http\Controllers;

use App\Models\HeroBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class HeroBannerController extends Controller
{
    public function __construct()
    {
        // Pastikan semua method butuh login
        $this->middleware(['auth', 'role:admin,superadmin']);
    }

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
        // 🔒 Pastikan user login
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'User belum login');
        }

        // ✅ Validasi
        $request->validate([
            'image' => 'required|image|max:2048',
            'title' => 'nullable|string|max:255',
            'link'  => 'nullable|url',
        ]);

        try {
            // 📁 Upload file
            $path = $request->file('image')->store('hero', 'public');

            // 💾 Simpan ke database
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

            return redirect()->route('admin.hero-banners.index')
                ->with('success', 'Banner berhasil ditambahkan');

        } catch (\Exception $e) {

            // 🧹 Hapus file kalau gagal insert
            if (isset($path)) {
                Storage::disk('public')->delete($path);
            }

            // 📝 Log error (penting untuk debugging)
            Log::error('Gagal simpan hero banner: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Gagal menyimpan banner. Silakan coba lagi.')
                ->withInput();
        }
    }

    public function toggleActive(HeroBanner $banner)
    {
        try {
            $banner->update([
                'is_active' => !$banner->is_active
            ]);

            return back()->with('success', 'Status banner diperbarui');

        } catch (\Exception $e) {
            Log::error('Toggle banner error: ' . $e->getMessage());

            return back()->with('error', 'Gagal mengubah status');
        }
    }

    public function updateOrder(Request $request, HeroBanner $banner)
    {
        $request->validate([
            'order' => 'required|integer|min:0'
        ]);

        try {
            $banner->update([
                'order' => $request->order
            ]);

            return back()->with('success', 'Urutan diperbarui');

        } catch (\Exception $e) {
            Log::error('Update order error: ' . $e->getMessage());

            return back()->with('error', 'Gagal update urutan');
        }
    }

    public function destroy(HeroBanner $banner)
    {
        try {
            // 🧹 Hapus file
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }

            $banner->delete();

            return back()->with('success', 'Banner berhasil dihapus');

        } catch (\Exception $e) {
            Log::error('Delete banner error: ' . $e->getMessage());

            return back()->with('error', 'Gagal menghapus banner');
        }
    }
}