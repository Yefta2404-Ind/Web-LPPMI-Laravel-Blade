<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InternalCategory;

class InternalCategoryController extends Controller
{
    public function index()
    {
        $categories = InternalCategory::latest()->get();
        return view('admin.internal_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.internal_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        InternalCategory::create([
            'name' => $request->name
        ]);

        return redirect()->route('admin.internal_categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(InternalCategory $internal_category)
    {
        return view('admin.internal_categories.edit', compact('internal_category'));
    }

    public function update(Request $request, InternalCategory $internal_category)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $internal_category->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.internal_categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(InternalCategory $internal_category)
    {
        $internal_category->delete();

        return redirect()->route('admin.internal_categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
