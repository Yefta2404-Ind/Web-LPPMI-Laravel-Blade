<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::table('organization_members', function (Blueprint $table) {

        // relasi ke dirinya sendiri (self relation)
        $table->foreignId('parent_id')
              ->nullable()
              ->after('organization_structure_id')
              ->constrained('organization_members')
              ->nullOnDelete();

        // opsional tapi sangat berguna untuk FE
        $table->integer('level')->default(0)->after('parent_id');
    });
}

public function down()
{
    Schema::table('organization_members', function (Blueprint $table) {
        $table->dropForeign(['parent_id']);
        $table->dropColumn(['parent_id', 'level']);
    });
}
};
