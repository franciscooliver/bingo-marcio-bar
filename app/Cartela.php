<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cartela extends Model
{
    protected $table = "cartelas";
    protected $fillable = ['idTabela','table_B_idtable_B','table_I_idtable_I','table_N_idtable_N','table_G_idtable_G','table_O_idtable_O',"numero_cartela"];

    public function salvaIdCartela($id_cartela,$numero_cartela){
        DB::table("cartelas")
            ->insert([
                "table_B_idtable_B" =>$id_cartela,
                "table_I_idtable_I"=>$id_cartela,
                "table_N_idtable_N"=>$id_cartela,
                "table_G_idtable_G"=>$id_cartela,
                "table_O_idtable_O"=>$id_cartela,
                "numero_cartela"=>$numero_cartela

            ]);
    }

}
