<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;
Use Illuminate\Support\Facades\DB;

class LinhaB extends Model
{
    protected  $table = "table_B";

    public $timestamps = false;
    protected $fillable = ['idtable_B','b_1','b_2','b_3','b_4','b_5'];

    public function saveNums($numeros = [], $id_cartela) {

             DB::table('table_B')
                ->insert([
                    "idtable_B"=> $id_cartela,
                    'b_1'=>$numeros[0],
                    'b_2'=>$numeros[1],
                    'b_3'=>$numeros[2],
                    'b_4'=>$numeros[3],
                    'b_5'=>$numeros[4]
                ]);

    }
}
