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
        Schema::create('organization_structures', function (Blueprint $table) {
$table->id();
$table->string('name'); // Nama lengkap
$table->string('position'); // Jabatan
$table->string('photo')->nullable();
$table->integer('order')->default(0); // Urutan tampilan
$table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
$table->unsignedBigInteger('user_id');
$table->timestamps();


$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_structures');
    }
};
