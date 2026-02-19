<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | STAFF
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $videos = Video::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('videos.index', compact('videos'));
    }

    public function create()
    {
        return view('videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url'   => 'required|url',
        ]);

        Video::create([
            'title'        => $request->title,
            'url'          => $request->url,
            'user_id'      => auth()->id(),
            'status'       => 'pending',
            'is_featured'  => 0,
            'is_published' => 0,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Video berhasil dikirim & menunggu persetujuan');
    }

    /*
    |--------------------------------------------------------------------------
    | PUBLIC
    |--------------------------------------------------------------------------
    */

    public function publicIndex()
    {
        $videos = Video::where('status', 'approved')
            ->where('is_published', 1)
            ->latest()
            ->paginate(9);

        return view('videos.public', compact('videos'));
    }

    public function show(Video $video)
    {
        if (
            $video->status !== 'approved' ||
            !$video->is_published
        ) {
            abort(404);
        }

        return view('videos.show', compact('video'));
    }

    public function adminIndex(Request $request)
{
    $videos = Video::query();

    // FILTER FEATURED
    if ($request->featured === 'active') {
        $videos->where('is_featured', 1)
               ->where('is_published', 1);
    }

    if ($request->featured === 'inactive') {
        $videos->where('is_featured', 1)
               ->where('is_published', 0);
    }

    if ($request->featured === 'all_featured') {
        $videos->where('is_featured', 1);
    }

    $videos = $videos->latest()->paginate(10);

    return view('admin.videos.index', compact('videos'));
}


    public function pending()
    {
        $videos = Video::where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.videos.pending', compact('videos'));
    }

    public function approve(Video $video)
    {
        $this->authorizeAdmin();

        $video->update([
            'status' => 'approved'
        ]);

        return back()->with('success', 'Video disetujui');
    }

    public function reject(Video $video)
    {
        $this->authorizeAdmin();

        $video->update([
            'status' => 'rejected',
            'is_published' => 0,
            'is_featured' => 0
        ]);

        return back()->with('success', 'Video ditolak');
    }

    public function unfeature(Video $video)
{
    $video->update(['featured' => false]);
    return back()->with('success', 'Video removed from featured.');
}

public function togglePublish(Video $video)
{
    $this->authorizeAdmin();

    if ($video->status !== 'approved') {
        return back()->with('error', 'Video belum disetujui');
    }

    $video->update([
        'is_published' => $video->is_published == 1 ? 0 : 1
    ]);

    return back()->with('success', 'Status publish diubah');
}


    /*
    |--------------------------------------------------------------------------
    | HELPER
    |--------------------------------------------------------------------------
    */

    private function authorizeAdmin()
    {
        if (!in_array(auth()->user()->role, ['admin', 'superadmin'])) {
            abort(403);
        }
    }

    public function setFeatured(Video $video)
{
    $this->authorizeAdmin();

    // matikan featured video lain (opsional tapi recommended)
    Video::where('is_featured', 1)->update(['is_featured' => 0]);

    $video->update([
        'is_featured' => 1
    ]);

    return back()->with('success', 'Video dijadikan featured');
}

}
