<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cartela extends Model
{
    protected $table = "cartelas";
    protected $fillable = ['id','numero_cartela','vendida','impressa','barcode','table_B_idtable_B','table_I_idtable_I','table_N_idtable_N','table_G_idtable_G','table_O_idtable_O',"numero_cartela",'cartela_contador'];

    public function linhaB(){
        return $this->belongsTo(LinhaB::class);
    }

    public function linhaI(){
        return $this->belongsTo(LinhaI::class);
    }

    public function linhaN(){
        return $this->belongsTo(LinhaN::class);
    }

    public function linhaG(){
        return $this->belongsTo(LinhaG::class);
    }

    public function linhaO(){
        return $this->belongsTo(LinhaO::class);
    }
    public function salvaColunas($id_b, $id_i, $id_n, $id_g, $id_o, $num_cartela, $barcode = null){

       /* $retorno = $this::create([
            "table_B_idtable_B"=> $id_b,
            "table_I_idtable_I"=> $id_i,
            "table_N_idtable_N"=> $id_n,
            "table_G_idtable_G"=> $id_g,
            "table_O_idtable_O"=> $id_o,
            "numero_cartela"=>"2"
        ]);*/
       $retorno= DB::table('cartelas')//salva na tabela o numero que foi sorteado
        ->insert([
            "table_B_idtable_B"=> $id_b,
            "table_I_idtable_I"=> $id_i,
            "table_N_idtable_N"=> $id_n,
            "table_G_idtable_G"=> $id_g,
            "table_O_idtable_O"=> $id_o,
            "numero_cartela"=>$num_cartela,
            "cartela_contador"=>0,
            "barcode" => $barcode
            ]);

        if($retorno){
            return [
                "status"=>true,
                "retorno_bd"=>$retorno
            ];
        }else{
            return ["status"=>false,"retorno_bd"=>$retorno];
            
        }
    }
    public  function verificaNum($numero_cartela)
    {
        $verifica_num = DB::table('cartelas')
            ->select('numero_cartela')
            ->where(['numero_cartela' => $numero_cartela])->get();
        if(count($verifica_num) <= 0) {
            $status = $this->salvaNumCartela($numero_cartela);
            return $status;
        }
    }

    private  function salvaNumCartela($numero_cartela)
    {
        $salva_num = DB::table('cartelas')
            ->insert([
                "table_B_idtable_B"=> '',
                "table_I_idtable_I"=> '',
                "table_N_idtable_N"=> '',
                "table_G_idtable_G"=> '',
                "table_O_idtable_O"=>'',
                'numero_cartela' => $numero_cartela,
                "cartela_contador"=> "",

            ]);

        if($salva_num):
            return ['status' => true];
        else:
            return ['status' => false];
        endif;
    }
}
