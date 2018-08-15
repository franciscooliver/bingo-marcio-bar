<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cartela;

class LinhaI extends Model
{
    protected $table = "table_I";
    protected $fillable = ['id_table_I','i_1','i_2','i_3','i_4','i_5'];
    public $timestamps = false;

    public function cartelas() {
        return $this->hasMany(Cartela::class);
    }

    public function salvaNumerosLinhaI($data = []) : Array{

            $retorno = $this::create([
                "i_1"=> $data["numeros"][0],
                "i_2"=> $data["numeros"][1],
                "i_3"=> $data["numeros"][2],
                "i_4"=> $data["numeros"][3],
                "i_5"=> $data["numeros"][4]
            ]);


        if($retorno){
            return ["status"=>true];
        }else{
            return ["status"=>false];
        }


    }
}
