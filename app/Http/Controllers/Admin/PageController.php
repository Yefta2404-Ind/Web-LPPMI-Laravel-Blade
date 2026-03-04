<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;

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

public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'content' => 'nullable',
    ]);

    Page::create([
        'title' => $request->title,
        'slug' => Str::slug($request->title),
        'content' => $request->content,
        'is_active' => $request->has('is_active'),
    ]);

    return redirect()->route('admin.pages.index');
}

public function edit(Page $page)
{
    return view('admin.pages.edit', compact('page'));
}

public function update(Request $request, Page $page)
{
    $page->update([
        'title' => $request->title,
        'slug' => Str::slug($request->title),
        'content' => $request->content,
        'is_active' => $request->is_active ?? false,
    ]);

    return redirect()->route('admin.pages.index');
}

public function destroy(Page $page)
{
    $page->delete();
    return back();
}
}
