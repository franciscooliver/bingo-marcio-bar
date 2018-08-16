<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cartela;

class LinhaN extends Model
{
    protected $table = "table_N";
    protected $fillable = ['id_table_N','n_1','n_2','n_3','n_4'];
    public $timestamps = false;

    public function cartelas() {
        return $this->hasMany(Cartela::class);
    }

    public function salvaNumerosLinhaN($data = []) : Array{

        $retorno = $this::create([
            "n_1"=> $data["numeros"][0],
            "n_2"=> $data["numeros"][1],
            "n_3"=> $data["numeros"][2],
            "n_4"=> $data["numeros"][3],
        ]);

        if($retorno){
            return [
                "status"=>true,
                "id_N"=>$retorno->id
                ];
        }else{
            return ["status"=>false];
        }

    }
}

