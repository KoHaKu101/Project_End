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
            //
            $table->string('type_book_id', 10)->nullable()->change();
            $table->string('author', 255)->nullable()->change();
            $table->string('publisher', 255)->nullable()->change();
            $table->string('edition', 10)->nullable()->change();
            $table->string('year', 10)->nullable()->change();
            $table->string('original_page', 10)->nullable()->change();
            $table->string('isbn', 13)->nullable()->change();
            $table->string('level', 10)->nullable()->change();
            $table->timestamp('updated_at')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            //
            $table->string('type_book_id', 10)->nullable()->change();
            $table->string('author', 255)->nullable()->change();
            $table->string('publisher', 255)->nullable()->change();
            $table->string('edition', 10)->nullable()->change();
            $table->string('year', 10)->nullable()->change();
            $table->string('original_page', 10)->nullable()->change();
            $table->string('isbn', 13)->nullable()->change();
            $table->string('level', 10)->nullable()->change();
            $table->timestamp('updated_at')->nullable(false)->change();
        });
    }
};
