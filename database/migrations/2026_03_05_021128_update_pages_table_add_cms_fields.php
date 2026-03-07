<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('featured_image')->nullable()->after('content');
            $table->string('meta_title')->nullable()->after('featured_image');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->enum('status', ['draft', 'published'])
                  ->default('draft')
                  ->after('meta_description');

            $table->dropColumn('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->boolean('is_active')->default(true);

            $table->dropColumn([
                'featured_image',
                'meta_title',
                'meta_description',
                'status'
            ]);
        });
    }
};