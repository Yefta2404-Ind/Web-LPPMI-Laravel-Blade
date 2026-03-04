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
        Schema::create('site_settings', function (Blueprint $table) {
    $table->id();

    // IDENTITAS
    $table->string('site_name');
    $table->string('site_subtitle')->nullable();
    $table->string('logo')->nullable();

    // KONTAK TOP BAR
    $table->string('phone')->nullable();
    $table->string('email')->nullable();
    $table->string('address')->nullable();

    // SOSIAL MEDIA
    $table->string('facebook')->nullable();
    $table->string('twitter')->nullable();
    $table->string('instagram')->nullable();
    $table->string('youtube')->nullable();

    // FOOTER
    $table->text('footer_description')->nullable();
    $table->string('footer_address')->nullable();
    $table->string('footer_phone')->nullable();
    $table->string('footer_email')->nullable();
    $table->string('footer_website')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
