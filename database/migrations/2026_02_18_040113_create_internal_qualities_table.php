<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('internal_qualities', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')
              ->constrained('internal_categories')
              ->cascadeOnDelete();

        $table->year('year');
        $table->string('file_path')->nullable();
        $table->string('external_url')->nullable();
        $table->enum('status', ['pending','approved','rejected'])
              ->default('pending');

        $table->foreignId('user_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internal_qualities');
    }
};
