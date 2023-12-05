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
        Schema::create('receive_books', function (Blueprint $table) {
            $table->string('recv_id',10)->primary();
            $table->string('emp_id',10);
            $table->foreign('emp_id')->references('emp_id')->on('emps');
            $table->date('add_date');
            $table->tinyInteger('add_type',false)->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receive_books');
    }
};
