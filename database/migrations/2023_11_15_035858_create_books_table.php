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
        Schema::create('books', function (Blueprint $table) {
            $table->string('book_id',10)->primary();
            $table->string('type_book_id',10);
            $table->foreign('type_book_id')->references('type_book_id')->on('type_books');
            $table->string('name',255);
            $table->string('author',255);
            $table->string('publisher',255);
            $table->string('edition',10);
            $table->string('year',10);
            $table->string('original_page',10);
            $table->string('isbn',13)->unique();
            $table->string('level',10)->nullable();
            $table->timestamps();

        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
