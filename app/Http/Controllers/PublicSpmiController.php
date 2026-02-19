<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpmiDocument;
use App\Models\SpmiCategory;

class PublicSpmiController extends Controller
{
        public function index()
{
    $categories = SpmiCategory::with(['documents' => function ($query) {
        $query->where('status', 'approved')
              ->latest();
    }])->get();

    return view('public.dokumen-penjamin', compact('categories'));
}

}
