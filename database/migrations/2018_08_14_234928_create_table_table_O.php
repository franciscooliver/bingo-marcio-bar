<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTableO extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_O', function (Blueprint $table) {
            $table->increments('id_table_O');
            $table->integer("o_1");
            $table->integer("o_2");
            $table->integer("o_3");
            $table->integer("o_4");
            $table->integer("o_5");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_O');
    }
}
