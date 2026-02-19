<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::table('videos', function (Blueprint $table) {
        $table->foreignId('user_id')->after('id')->constrained()->cascadeOnDelete();
        $table->foreignId('approved_by')->nullable()->after('status')->constrained('users');
        $table->timestamp('approved_at')->nullable()->after('approved_by');
    });
}

public function down()
{
    Schema::table('videos', function (Blueprint $table) {
        $table->dropColumn(['user_id', 'approved_by', 'approved_at']);
    });
}

};
