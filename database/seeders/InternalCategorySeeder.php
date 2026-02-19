<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InternalCategory;
use Illuminate\Support\Str;

class InternalCategorySeeder extends Seeder
{
   public function run(): void
{
    $categories = [
        'Laporan RTM'
    ];

    foreach ($categories as $name) {
        InternalCategory::create([
            'name' => $name,
            'slug' => Str::slug($name),
        ]);
    }
}
}
