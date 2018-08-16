<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cartela;

class LinhaG extends Model
{
    protected $table = "table_G";

    protected $fillable = ['id_table_G','g_1','g_2','g_3','g_4','g_5'];

    public $timestamps = false;

    public function cartelas() {
        return $this->hasMany(Cartela::class);
    }

    public function salvaNumerosLinhaG($data = []) : Array{

        $retorno = $this::create([
            "g_1"=> $data["numeros"][0],
            "g_2"=> $data["numeros"][1],
            "g_3"=> $data["numeros"][2],
            "g_4"=> $data["numeros"][3],
            "g_5"=> $data["numeros"][4]
        ]);

        if($retorno){
            return [
                "status"=>true,
                "id_G"=>$retorno->id
        ];
        }else{
            return ["status"=>false];
        }

    }
}
