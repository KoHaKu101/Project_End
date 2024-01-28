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
        Schema::table('books', function (Blueprint $table) {
            $table->string('img_book', 255)->nullable()->after('level');
            $table->string('language',255)->nullable()->after('img_book');
            $table->text('abstract')->nullable()->after('language');
            $table->text('synopsis')->nullable()->after('abstract');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('img_book');
            $table->dropColumn('language');
            $table->dropColumn('abstract');
            $table->dropColumn('synopsis');
        });
    }
};
