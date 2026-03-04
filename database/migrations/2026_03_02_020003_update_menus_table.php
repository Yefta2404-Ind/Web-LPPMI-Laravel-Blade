<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('menus', function (Blueprint $table) {

        if (!Schema::hasColumn('menus', 'page_id')) {
    $table->unsignedBigInteger('page_id')->nullable()->after('title')

              ->constrained()
              ->nullOnDelete();

        $table->dropColumn(['slug','type','route_name']);
 } });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
