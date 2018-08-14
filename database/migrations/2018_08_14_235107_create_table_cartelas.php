<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCartelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartelas', function (Blueprint $table) {
            $table->increments('idCartela');
            $table->string("numero_cartela", 45);
            $table->integer("table_B_idtable_B")->unsigned();
            $table->foreign("table_B_idtable_B")->references('id_table_B')->on('table_B');
            $table->integer("table_I_idtable_I")->unsigned();
            $table->foreign("table_I_idtable_I")->references('id_table_I')->on('table_I');
            $table->integer("table_N_idtable_N")->unsigned();
            $table->foreign("table_N_idtable_N")->references('id_table_N')->on('table_N');
            $table->integer("table_G_idtable_G")->unsigned();
            $table->foreign("table_G_idtable_G")->references('id_table_G')->on('table_G');
            $table->integer("table_O_idtable_O")->unsigned();
            $table->foreign("table_O_idtable_O")->references('id_table_O')->on('table_O');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cartelas');
    }
}
