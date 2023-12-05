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
        Schema::create('receive_book_descs', function (Blueprint $table) {

            $table->string('recd_id',10)->primary();
            $table->string('recv_id',10);
            $table->foreign('recv_id')->references('recv_id')->on('receive_books');
            $table->string('book_id',10)->nullable();
            $table->foreign('book_id')->references('book_id')->on('books');
            $table->text('desc')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receive_book_descs');
    }
};
