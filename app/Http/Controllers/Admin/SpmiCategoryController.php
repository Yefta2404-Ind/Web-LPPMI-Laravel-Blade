<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpmiCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SpmiCategoryController extends Controller
{
    public function index()
    {
        $categories = SpmiCategory::latest()->get();
        return view('admin.spmi_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.spmi_categories.create');
    }



public function store(Request $request)
{
    $request->validate([
        'name' => 'required|unique:spmi_categories,name'
    ]);

    SpmiCategory::create([
        'name' => $request->name,
        'slug' => Str::slug($request->name)
    ]);

    return redirect()
        ->route('admin.spmi-categories.index')
        ->with('success','Kategori berhasil ditambahkan.');
}


    public function edit(SpmiCategory $spmi_category)
    {
        return view('admin.spmi_categories.edit', compact('spmi_category'));
    }

    public function update(Request $request, SpmiCategory $spmi_category)
    {
        $request->validate([
            'name' => 'required|unique:spmi_categories,name,'.$spmi_category->id
        ]);

        $spmi_category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('admin.spmi_categories.index')
            ->with('success','Kategori berhasil diupdate.');
    }

    public function destroy(SpmiCategory $spmi_category)
    {
        $spmi_category->delete();

        return back()->with('success','Kategori berhasil dihapus.');
    }
}

