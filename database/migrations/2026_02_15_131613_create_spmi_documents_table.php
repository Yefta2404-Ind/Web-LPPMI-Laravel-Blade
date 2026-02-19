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
Schema::create('spmi_documents', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->enum('category', [
        'kebijakan',
        'manual',
        'standar',
        'formulir'
    ]);
    $table->text('description')->nullable();

    $table->string('file_path')->nullable();
    $table->string('external_link')->nullable(); 

    $table->enum('status', ['pending', 'approved', 'rejected'])
          ->default('pending');

    $table->foreignId('created_by')->constrained('users')->onDelete('cascade');

    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('spmi_documents');
    }
};
