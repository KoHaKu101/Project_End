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
        //
        Schema::table('media', function (Blueprint $table) {
            $table->string('time_hour',10)->after('sound_sys')->nullable();
            $table->string('time_minute',10)->after('time_hour')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('media', function (Blueprint $table) {
            $table->dropColumn('time_hour');
            $table->dropColumn('time_minute');

        });
    }
};
