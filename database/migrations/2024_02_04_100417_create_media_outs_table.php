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
        Schema::create('media_out', function (Blueprint $table) {
            $table->string('md_out_id',10)->primary();
            $table->string('request_id',10);
            $table->foreign('request_id')->references('request_id')->on('request_media');
            $table->string('emp_id',10);
            $table->foreign('emp_id')->references('emp_id')->on('emps');
            $table->date('md_out_date');
            $table->tinyInteger('status', false)->unsigned();
            $table->text('desc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_out');
    }
};
