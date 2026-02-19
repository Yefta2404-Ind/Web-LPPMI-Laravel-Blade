<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InternalCategory;

class InternalQualityController extends Controller
{
        public function index()
    {
        $categories = InternalCategory::with([
            'qualities' => function ($query) {
                $query->where('status','approved')
                      ->orderBy('year','desc');
            }
        ])->get();

        return view('public.mutu-internal', compact('categories'));
    }
}
