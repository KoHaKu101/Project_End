<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('type_books', function($table) {
            $table->dropColumn('name_numberMedia');
        });
    }

    public function down()
    {
        Schema::table('type_books', function($table) {
            $table->string('name_numberMedia');
        });
    }
};
