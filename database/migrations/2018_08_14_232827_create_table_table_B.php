<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTableB extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_B', function (Blueprint $table) {
            $table->increments('id_table_B');
            $table->integer("b_1");
            $table->integer("b_2");
            $table->integer("b_3");
            $table->integer("b_4");
            $table->integer("b_5");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_B');
    }
}
