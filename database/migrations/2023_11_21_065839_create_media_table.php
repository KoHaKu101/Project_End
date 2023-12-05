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
        Schema::create('media', function (Blueprint $table) {
            $table->string('media_id',10)->primary();
            $table->string('book_id',10);
            $table->foreign('book_id')->references('book_id')->on('books');
            $table->string('type_media_id',10);
            $table->foreign('type_media_id')->references('type_media_id')->on('type_media');
            $table->string('number',255);
            $table->string('amount_end',10)->nullable();
            $table->string('braille_page',10)->nullable();
            $table->tinyInteger('status', false)->unsigned();
            $table->date('check_date')->nullable();
            $table->string('translator',255)->nullable();
            $table->string('sound_sys',50)->nullable();
            $table->string('source',50)->nullable();
            $table->string('file_location',255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
