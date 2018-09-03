<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTableI extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_I', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("i_1");
            $table->integer("i_2");
            $table->integer("i_3");
            $table->integer("i_4");
            $table->integer("i_5");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_I');
    }
}
