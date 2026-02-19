<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Agenda;
use App\Models\Category;
use App\Models\Video;
use App\Models\HeroBanner;
use App\Models\Survey;

class NewsController extends Controller
{
    public function index()
{
    $news = News::where('status', 'approved')
        ->latest()
        ->paginate(5);

    return view('news.index', compact('news'));
}


public function create()
{
    $categories = Category::all();
    return view('news.create', compact('categories'));
}


public function store(Request $request)
{
    // 1️⃣ VALIDASI DULU
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // 2️⃣ UPLOAD GAMBAR
    $path = null;
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('news', 'public');
    }

    // 3️⃣ SIMPAN DATA
    News::create([
        'title' => $request->title,
        'content' => $request->content,
        'user_id' => auth()->id(),
        'status' => 'pending',
        'image' => $path,
        'category_id' => $request->category_id, // ✅ INI YANG BENAR
    ]);

    return redirect()->route('staff.news.create')
    ->with('success', 'Berita berhasil dikirim & menunggu persetujuan admin');

}

public function show(News $news)
{
    // hanya boleh lihat berita approved
    if ($news->status !== 'approved') {
        abort(403);
    }

    return view('news.show', compact('news'));
}

public function publicHome()
{
    $news = News::approved()->latest()->take(5)->get();
    $agendas = Agenda::approved()->latest()->take(10)->get();

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
        'activeSurvey',
    ));
}
public function showPublic(News $news)
{
    // Pastikan hanya berita approved
    abort_if($news->status !== 'approved', 404);

    // Ambil berita lain (selain yang sedang dibuka)
    $recentNews = News::where('status', 'approved')
        ->where('id', '!=', $news->id)
        ->latest()
        ->take(5)
        ->get();

    return view('public.show', compact('news', 'recentNews'));
}



public function pending()
{
$news = News::where('status', 'pending')->get();
return view('news.pending', compact('news'));
}


public function approve(News $news)
{
$news->update(['status' => 'approved']);
return back();
}


public function reject(News $news)
{
$news->update(['status' => 'rejected']);
return back();
}

public function adminDashboard()
{
    // Pending
    $pendingNews   = News::where('status', 'pending')->latest()->get();
    $pendingAgenda = Agenda::where('status', 'pending')->latest()->get();
    $pendingVideos = Video::where('status', 'pending')->latest()->get();

    // Statistik
    $approvedCount =
        News::where('status', 'approved')->count()
        + Agenda::where('status', 'approved')->count()
        + Video::where('status', 'approved')->count();

    $rejectedCount =
        News::where('status', 'rejected')->count()
        + Agenda::where('status', 'rejected')->count()
        + Video::where('status', 'rejected')->count();

    return view('admin.dashboard', compact(
        'pendingNews',
        'pendingAgenda',
        'pendingVideos',
        'approvedCount',
        'rejectedCount'
    ));
}

public function edit(News $news)
{
    // staff hanya boleh edit miliknya & belum approved
    if (
        auth()->user()->role === 'staff' &&
        ($news->user_id !== auth()->id() || $news->status === 'approved')
    ) {
        abort(403);
    }

    return view('news.edit', compact('news'));
}

public function update(Request $request, News $news)
{
    // validasi role
    if (
        auth()->user()->role === 'staff' &&
        ($news->user_id !== auth()->id() || $news->status === 'approved')
    ) {
        abort(403);
    }


    $data = $request->only('title','content');

    // optional update image
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('news', 'public');
    }

    $news->update($data);

    return redirect()->route('dashboard');
}

public function staffIndex()
{
    $news = News::where('user_id', auth()->id())
                ->latest()
                ->paginate(10);

    return view('news.index', compact('news'));
}



public function destroy(News $news)
{
    // staff hanya boleh hapus miliknya & belum approved
    if (
        auth()->user()->role === 'staff' &&
        ($news->user_id !== auth()->id() || $news->status === 'approved')
    ) {
        abort(403);
    }

    $news->delete();

    return redirect()->route('dashboard');
}

public function publicIndex(Request $request)
{
    $query = News::where('status', 'approved')->latest();

    if ($request->filled('category')) {
        $query->whereHas('category', function ($q) use ($request) {
            $q->where('slug', $request->category);
        });
    }

    $news = $query->paginate(9);

    $categories = Category::withCount([
        'news' => fn ($q) => $q->where('status', 'approved')
    ])->get();

    return view('public.news.index', compact('news', 'categories'));
}



}
