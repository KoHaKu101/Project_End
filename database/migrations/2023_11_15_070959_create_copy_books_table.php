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
        Schema::create('copy_books', function (Blueprint $table) {
            $table->string('copy_id', 10)->primary();
            $table->string('book_id', 10);
            $table->foreign('book_id')->references('book_id')->on('books');
            $table->unsignedSmallInteger('amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copy_books');
    }
};
