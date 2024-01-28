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
        Schema::table('type_media', function (Blueprint $table) {
            $table->string('head_number_media', 255)->nullable()->after('type_media_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('type_media', function (Blueprint $table) {
            $table->dropColumn('head_number_media');
        });
    }
};
