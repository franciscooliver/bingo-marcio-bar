<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTableN extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_N', function (Blueprint $table) {
            $table->increments('id_table_N');
            $table->integer("n_1");
            $table->integer("n_2");
            $table->integer("n_3");
            $table->integer("n_4");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_N');
    }
}
