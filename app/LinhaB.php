<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;
Use App\Cartela;
use PhpParser\Node\Expr\Array_;

class LinhaB extends Model
{
    protected  $table = "table_B";

    public $timestamps = false;
    protected $fillable = ['id','b_1','b_2','b_3','b_4','b_5'];

    public function cartelas() {
        return $this->hasMany(Cartela::class,'table_B_idtable_B');
    }

    public function salvaNumerosLinhaB($data = []) : Array{

            $retorno = $this::create([
                "b_1"=> $data["numeros"][0],
                "b_2"=> $data["numeros"][1],
                "b_3"=> $data["numeros"][2],
                "b_4"=> $data["numeros"][3],
                "b_5"=> $data["numeros"][4]
            ]);

            if($retorno){
                return [
                    "status"=>true,
                    "id_B"=>$retorno->id
                ];
            }else{
                return ["status"=>false];
            }

    }
}
