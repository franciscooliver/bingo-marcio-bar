<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LinhaI extends Model
{
    protected $table = "table_I";
    protected $fillable = ['idtable_I','i_1','i_2','i_3','i_4','i_5'];

    public function saveNums($numeros = []) {
        for($i=0;$i<count($numeros);$i++){
            DB::table('linhas_i')
                ->insert([
                    'numero'=>$numeros[$i]
                ]);
        }
    }
}
