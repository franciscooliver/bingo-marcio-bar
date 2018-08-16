<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cartela;

class LinhaO extends Model
{
    protected $table = "table_O";
    protected $fillable = ['id_table_O','o_1','o_2','o_3','o_4','o_5'];
    public $timestamps = false;

    public function cartelas() {
        return $this->hasMany(Cartela::class);
    }

    public function salvaNumerosLinhaO($data = []) : Array{

        $retorno = $this::create([
            "o_1"=> $data["numeros"][0],
            "o_2"=> $data["numeros"][1],
            "o_3"=> $data["numeros"][2],
            "o_4"=> $data["numeros"][3],
            "o_5"=> $data["numeros"][4]
        ]);

        if($retorno){
            return [
                "status"=>true,
                "id_O"=>$retorno->id
            ];
        }else{
            return ["status"=>false];
        }

    }
}
