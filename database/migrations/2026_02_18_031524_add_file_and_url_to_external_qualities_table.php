<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('external_qualities', function (Blueprint $table) {
    $table->string('file_path')->nullable()->after('section');
    $table->string('external_url')->nullable()->after('file_path');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('external_qualities', function (Blueprint $table) {
            //
        });
    }
};
