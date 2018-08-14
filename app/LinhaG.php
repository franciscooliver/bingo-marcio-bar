<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LinhaG extends Model
{
    protected $table = "table_G";

    protected $fillable = ['idtable_G','g_1','g_2','g_3','g_4','b_5'];

    public function saveNums($numeros = []) {
        for($i=0;$i<count($numeros);$i++){
            DB::table('linhas_g')
                ->insert([
                    'numero'=>$numeros[$i]
                ]);
        }
    }
}
