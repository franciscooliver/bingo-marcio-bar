<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTableG extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_G', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("g_1");
            $table->integer("g_2");
            $table->integer("g_3");
            $table->integer("g_4");
            $table->integer("g_5");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_G');
    }
}
