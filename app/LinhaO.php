<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LinhaO extends Model
{
    protected $table = "table_O";
    protected $fillable = ['idtable_O','o_1','o_2','o_3','o_4','b_5'];

    public function saveNums($numeros = []) {
        for($i=0;$i<count($numeros);$i++){
            DB::table('linhas_o')
                ->insert([
                    'numero'=>$numeros[$i]
                ]);
        }
    }
}
