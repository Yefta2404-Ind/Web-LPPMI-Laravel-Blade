<?php
namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\SpmiDocument;
use Illuminate\Http\Request;
use App\Models\SpmiCategory;

class SpmiDocumentController extends Controller
{
    public function create()
    {

        $categories = SpmiCategory::all();
        return view('staff.spmi.create', compact('categories'));
    }

   public function store(Request $request)
{
    $request->validate([
        'documents' => 'required|array',
        'documents.*' => 'array',
        'documents.*.*' => 'file|mimes:pdf,doc,docx|max:5120',
        'descriptions' => 'nullable|array'
    ]);

    foreach ($request->documents as $categoryId => $files) {

        if (!$files) continue;

        $description = $request->descriptions[$categoryId] ?? null;

        foreach ($files as $file) {

            $filePath = $file->store('spmi_documents', 'public');

            SpmiDocument::create([
                'title' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                'category_id' => $categoryId,
                'description' => $description,
                'file_path' => $filePath,
                'created_by' => auth()->id(),
                'status' => 'pending'
            ]);
        }
    }

    return back()->with('success','Semua dokumen berhasil dikirim.');
}


}
