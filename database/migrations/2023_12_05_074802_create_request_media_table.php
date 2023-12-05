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
        Schema::create('request_media', function (Blueprint $table) {
            $table->string('request_id',10)->primary();
            $table->string('emp_id',10);
            $table->foreign('emp_id')->references('emp_id')->on('emps');
            $table->string('type_media_id',10);
            $table->foreign('type_media_id')->references('type_media_id')->on('type_media');
            $table->string('requesters_id',10);
            $table->foreign('requesters_id')->references('requesters_id')->on('request_users');
            $table->string('book_id',10);
            $table->foreign('book_id')->references('book_id')->on('books');
            $table->date('request_date');
            $table->tinyInteger('status', false)->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_media');
    }
};
