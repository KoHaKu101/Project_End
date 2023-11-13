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
        Schema::create('emps', function (Blueprint $table) {
            $table->string('emp_id',10)->primaryKey();
            $table->string('username',20)->unique();
            $table->string('password');
            $table->string('f_name',255);
            $table->string('l_name',255);
            $table->char('gender',1);
            $table->char('national',2);
            $table->date('birthday');
            $table->Integer('age')->length(3);
            $table->string('id_card',13);
            $table->string('tel',10);
            $table->TinyInteger('status')->length(1);
            $table->text('address');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emps');
    }
};
