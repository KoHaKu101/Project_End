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
        Schema::create('request_users', function (Blueprint $table) {
            $table->string('requesters_id',10)->primary();
            $table->string('f_name',255);
            $table->string('l_name',255);
            $table->char('gender',1)->nullable();
            $table->date('birthday')->nullable();
            $table->Integer('age')->length(3)->nullable();
            $table->string('id_card',13)->nullable();
            $table->string('tel',10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_users');
    }
};
