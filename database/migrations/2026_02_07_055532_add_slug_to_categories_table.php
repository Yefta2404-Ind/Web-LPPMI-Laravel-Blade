<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration {
    public function up()
    {
        // 1️⃣ Tambah kolom slug jika belum ada
        Schema::table('categories', function (Blueprint $table) {
            if (!Schema::hasColumn('categories', 'slug')) {
                $table->string('slug')->nullable()->after('name');
            }
        });

        // 2️⃣ Isi slug dari name (hanya yang masih NULL)
        DB::table('categories')
            ->whereNull('slug')
            ->get()
            ->each(function ($category) {
                DB::table('categories')
                    ->where('id', $category->id)
                    ->update([
                        'slug' => Str::slug($category->name)
                    ]);
            });

        // 3️⃣ Baru kasih UNIQUE (aman karena sudah terisi)
        Schema::table('categories', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            if (Schema::hasColumn('categories', 'slug')) {
                $table->dropUnique(['slug']);
                $table->dropColumn('slug');
            }
        });
    }
};
