<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('hero_banners', function (Blueprint $table) {
    $table->id();
    $table->string('title')->nullable();
    $table->string('image'); // path image
    $table->string('link')->nullable(); // optional CTA
    $table->integer('order')->default(0); // urutan carousel
    $table->boolean('is_active')->default(false); // tampil / tidak
    $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
    $table->unsignedBigInteger('created_by');
    $table->unsignedBigInteger('approved_by')->nullable();
    $table->timestamp('approved_at')->nullable();
    $table->timestamps();
});

    }

    
    public function down(): void
    {
        Schema::dropIfExists('hero_banners');
    }
};
