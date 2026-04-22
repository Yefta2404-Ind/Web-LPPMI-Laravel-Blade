<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Agenda;
use App\Models\Category;
use App\Models\Video;
use App\Models\HeroBanner;
use App\Models\Survey;
use App\Models\NewsImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('images')
            ->where('status', 'approved')
            ->latest()
            ->paginate(5);

        return view('news.index', compact('news'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('news.create', compact('categories'));
    }

    public function adminDashboard()
{
    $pendingNews = News::where('status', 'pending')->latest()->get();
    $approvedNews = News::where('status', 'approved')->latest()->get();

    $pendingAgenda = Agenda::where('status', 'pending')->latest()->get();
    $approvedAgenda = Agenda::where('status', 'approved')->latest()->get();

    $pendingVideos = Video::where('status', 'pending')->latest()->get();
    $approvedVideos = Video::where('status', 'approved')->latest()->get();

    return view('admin.dashboard', compact(
        'pendingNews',
        'approvedNews',
        'pendingAgenda',
        'approvedAgenda',
        'pendingVideos',
        'approvedVideos'
    ));
}

public function approve(News $news)
{
    if (!in_array(auth()->user()->role, ['admin', 'superadmin'])) {
        abort(403);
    }

    $news->update(['status' => 'approved']);

    return back()->with('success', 'Berita berhasil di-approve');
}

public function reject(News $news)
{
    if (!in_array(auth()->user()->role, ['admin', 'superadmin'])) {
        abort(403);
    }

    $news->update(['status' => 'rejected']);

    return back()->with('success', 'Berita ditolak');
}
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $news = News::create([
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => auth()->id(),
                'status' => 'pending',
                'category_id' => $request->category_id,
            ]);

            $thumbnail = null;

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $file) {
                    $path = $file->store('news', 'public');

                    if ($index === 0) {
                        $thumbnail = $path;
                    }

                    $news->images()->create([
                        'path' => $path
                    ]);
                }

                $news->update([
                    'image' => $thumbnail
                ]);
            }

            DB::commit();

            return redirect()->route('staff.news.create')
                ->with('success', 'Berita berhasil dikirim & menunggu persetujuan admin');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal upload, coba lagi');
        }
    }

    public function show(News $news)
    {
        abort_if($news->status !== 'approved', 403);

        $news->load('images');

        return view('news.show', compact('news'));
    }

public function publicHome()
{
    $news = News::with('images')
        ->where('status', 'approved')
        ->where('created_at', '>=', now()->subMonth())
        ->latest()
        ->take(4)
        ->get();

    $agendas = Agenda::where('status', 'approved')
        ->where('date', '>=', now()->subDays(3)->toDateString())
        ->orderBy('date', 'asc')
        ->take(10)
        ->get();

    $featuredVideo = Video::where('is_featured', 1)
        ->where('status', 'approved')
        ->where('is_published', 1)
        ->first();

    $heroBanners = HeroBanner::active()->get();
    $activeSurvey = Survey::where('status', 'approved')->latest()->first();

    return view('public.home', compact(
        'heroBanners',
        'news',
        'agendas',
        'featuredVideo',
        'activeSurvey'
    ));
}

public function showPublic(News $news)
{
    abort_if($news->status !== 'approved', 404);

    $news->load('images');

    $recentNews = News::where('status', 'approved')
        ->where('id', '!=', $news->id)
        ->latest()
        ->take(5)
        ->get();

    // Tambahkan categories untuk sidebar
    $categories = Category::withCount([
        'news' => fn($q) => $q->where('status', 'approved')
    ])->get();

    return view('public.news.show', compact('news', 'recentNews', 'categories'));
}
    public function uploadImage(Request $request)
{
    // 1. Validasi file
    $request->validate([
        'file' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    // 2. Simpan ke storage/public/news
    $path = $request->file('file')->store('news', 'public');

    // 3. Return JSON sesuai format TinyMCE
    return response()->json([
        'location' => asset('storage/' . $path)
    ]);
}

    public function edit(News $news)
    {
        if (
            auth()->user()->role === 'staff' &&
            ($news->user_id !== auth()->id() || $news->status !== 'pending')
        ) {
            abort(403);
        }

        $news->load('images');
        $categories = Category::all();

        return view('news.edit', compact('news', 'categories'));
    }

    public function update(Request $request, News $news)
    {
        if (
            auth()->user()->role === 'staff' &&
            ($news->user_id !== auth()->id() || $news->status !== 'pending')
        ) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $news->update($request->only('title', 'content', 'category_id'));

            $thumbnail = $news->image;

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $path = $file->store('news', 'public');

                    if (!$thumbnail) {
                        $thumbnail = $path;
                    }

                    $news->images()->create([
                        'path' => $path
                    ]);
                }

                $news->update([
                    'image' => $thumbnail
                ]);
            }

            DB::commit();

            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal update');
        }
    }

public function destroy(News $news)
{
    $user = auth()->user();

    // admin bebas
    if (in_array($user->role, ['admin', 'superadmin'])) {
        // lanjut
    }
    // staff hanya pending & miliknya
    elseif ($user->role === 'staff') {
        if ($news->user_id !== $user->id || $news->status !== 'pending') {
            abort(403);
        }
    } else {
        abort(403);
    }

    foreach ($news->images as $img) {
        Storage::disk('public')->delete($img->path);
        $img->delete();
    }

    $news->delete();

    return back()->with('success', 'Berita berhasil dihapus');
}

    public function deleteImage($id)
    {
        $image = NewsImage::findOrFail($id);

        if (
            auth()->user()->role === 'staff' &&
            optional($image->news)->user_id !== auth()->id()
        ) {
            abort(403);
        }

        Storage::disk('public')->delete($image->path);
        $image->delete();

        return back();
    }

public function staffIndex(Request $request)
{
    $query = News::where('user_id', auth()->id())->latest();

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $news = $query->paginate(10);

    return view('news.index', compact('news'));
}

    public function publicIndex(Request $request)
    {
        $query = News::with('images')
            ->where('status', 'approved')
            ->latest();

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $news = $query->paginate(5);

        $categories = Category::withCount([
            'news' => fn ($q) => $q->where('status', 'approved')
        ])->get();

        return view('public.news.index', compact('news', 'categories'));
    }


    public function adminIndex(Request $request)
{
    $query = News::with(['category', 'user'])->latest();

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $news = $query->paginate(10);

    return view('admin.news.index', compact('news'));
}
}