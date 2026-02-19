<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('agendas', function (Blueprint $table) {
            if (!Schema::hasColumn('agendas', 'time')) {
                $table->time('time')->nullable();
            }

            if (!Schema::hasColumn('agendas', 'location')) {
                $table->string('location')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('agendas', function (Blueprint $table) {
            if (Schema::hasColumn('agendas', 'time')) {
                $table->dropColumn('time');
            }

            if (Schema::hasColumn('agendas', 'location')) {
                $table->dropColumn('location');
            }
        });
    }
};
