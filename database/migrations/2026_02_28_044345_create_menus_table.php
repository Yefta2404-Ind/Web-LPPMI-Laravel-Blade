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
        Schema::create('menus', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('slug')->nullable();
    
    // type tujuan
    $table->enum('type', ['page', 'route', 'url'])->default('page');

    $table->string('url')->nullable();        // kalau external link
    $table->string('route_name')->nullable(); // kalau ke route khusus

    $table->foreignId('parent_id')->nullable()->constrained('menus')->onDelete('cascade');

    $table->integer('order')->default(0);
    $table->boolean('is_active')->default(true);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
