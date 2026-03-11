<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{

    public function index()
    {
        $pages = Page::latest()->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    private function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $count = Page::where('slug', 'LIKE', "{$slug}%")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'nullable',
            'featured_image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')
                ->store('pages', 'public');
        }

        Page::create([
            'title' => $request->title,
            'slug' => $this->generateUniqueSlug($request->title),
            'content' => $request->content,
            'featured_image' => $imagePath,
            'status' => $request->has('status') ? 'published' : 'draft',
        ]);

        return redirect()->route('admin.pages.index');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title'          => 'required',
            'content'        => 'nullable',
            'featured_image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $page->featured_image;

        if ($request->hasFile('featured_image')) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('featured_image')->store('pages', 'public');
        }

        $page->update([
            'title'          => $request->title,
            'slug'           => $this->generateUniqueSlugForUpdate($request->title, $page->id),
            'content'        => $request->content,
            'featured_image' => $imagePath,
            'status'         => $request->has('status') ? 'published' : 'draft',
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil diupdate');
    }

    private function generateUniqueSlugForUpdate($title, $id)
    {
        $slug  = Str::slug($title);
        $count = Page::where('slug', 'LIKE', "{$slug}%")->where('id', '!=', $id)->count();
        return $count ? "{$slug}-{$count}" : $slug;
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return back();
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|max:2048'
        ]);

        $path = $request->file('upload')->store('pages', 'public');

        return response()->json([
            'location' => asset('storage/' . $path)
        ]);
    }

    public function toggleStatus(Page $page)
    {
        $page->status = $page->status === 'published' ? 'draft' : 'published';
        $page->save();

        return back()->with('success', 'Status halaman berhasil diubah');
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'upload' => 'required|mimes:pdf,doc,docx,xlsx,pptx|max:5120'
        ]);

        $path = $request->file('upload')->store('pages/files', 'public');

        return response()->json([
            'url' => asset('storage/' . $path)
        ]);
    }

    /**
     * Tampilkan halaman publik beserta sidebar berita terkini.
     */
public function show(Page $page)
{
    abort_if($page->status !== 'published', 404);

    $latestNews = News::where('status','approved')
        ->orderBy('created_at','desc')
        ->limit(5)
        ->get();

    return view('public.page', compact('page','latestNews'));
}
}