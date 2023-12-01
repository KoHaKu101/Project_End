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
        Schema::create('copy_book_outs', function (Blueprint $table) {
            $table->string('copyout_id', 10)->primary();
            $table->string('copy_id', 10);
            $table->foreign('copy_id')->references('copy_id')->on('copy_books');
            $table->string('emp_id', 10);
            $table->foreign('emp_id')->references('emp_id')->on('emps');
            $table->unsignedSmallInteger('amount')->nullable();
            $table->unsignedSmallInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copy_book_outs');
    }
};
