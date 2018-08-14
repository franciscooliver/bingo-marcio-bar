<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LinhaN extends Model
{
    protected $table = "table_N";
    protected $fillable = ['idtable_B','n_1','n_2','n_3','n_4'];

    public function saveNums($numeros = []) {
        for($i=0;$i<count($numeros);$i++){
            DB::table('linhas_n')
                ->insert([
                    'numero'=>$numeros[$i]
                ]);
        }
    }
}

