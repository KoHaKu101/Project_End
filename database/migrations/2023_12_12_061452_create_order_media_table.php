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
        Schema::create('order_media', function (Blueprint $table) {
            $table->string('order_id',10)->primary();
            $table->string('emp_id',10);
            $table->foreign('emp_id')->references('emp_id')->on('emps');
            $table->string('request_id',10);
            $table->foreign('request_id')->references('request_id')->on('request_media');
            $table->date('order_date');
            $table->date('end_date')->nullable();
            $table->tinyInteger('status', false)->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_media');
    }
};
