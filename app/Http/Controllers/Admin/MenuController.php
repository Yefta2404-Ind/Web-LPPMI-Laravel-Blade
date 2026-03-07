<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Page;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('parent')
            ->orderBy('order')
            ->get();

        return view('admin.menus.index', compact('menus'));
    }

public function create()
{
    $pages = Page::where('status', 'published')->get();
    $parents = Menu::whereNull('parent_id')->get();

    return view('admin.menus.create', compact('pages','parents'));
}

public function store(Request $request)
{
    $request->validate([
        'title'   => 'required',
        'page_id' => 'nullable', // tidak wajib karena bisa custom URL
        'url'     => 'nullable',
    ]);

    Menu::create([
        'title'     => $request->title,
        'page_id'   => $request->page_id ?: null,
        'url'       => $request->url,
        'parent_id' => $request->parent_id ?: null,
        'order'     => $request->order ?? 0,
        'is_active' => $request->has('is_active'),
    ]);

    return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan');
}

    public function edit(Menu $menu)
    {
        $parents = Menu::whereNull('parent_id')
            ->where('id', '!=', $menu->id)
            ->get();

        return view('admin.menus.edit', compact('menu', 'parents'));
    }

public function update(Request $request, Menu $menu)
{
    $request->validate([
        'title' => 'required',
    ]);

    $menu->update([
        'title'     => $request->title,
        'page_id'   => $request->page_id ?: null,
        'url'       => $request->url,
        'parent_id' => $request->parent_id ?: null,
        'order'     => $request->order ?? 0,
        'is_active' => $request->has('is_active'),
    ]);

    return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diupdate');
}

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return back()->with('success', 'Menu dihapus');
    }

    public function reorder(Request $request)
{
    foreach ($request->order as $index => $id) {
        Menu::where('id', $id)->update(['order' => $index]);
    }
    return response()->json(['success' => true]);
}
}