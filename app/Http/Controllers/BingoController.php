<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TabelaBingoAtual;
use Illuminate\Support\Facades\DB;
use Exception;

class BingoController extends Controller
{

    public function  index(){
        
       

        $numeros = array();
        for ($i=1;$i<76;$i++){
            $numeros[] = $i;
        }
        (int) $size_array = count($numeros);
        $numeros = array_chunk($numeros, 9);
        //dd($size_array);
        return view('layouts.index',compact('numeros','size_array'));
    }

   public function dadosView(){


    }
    public function sorteiaNumero(){

        $arr = range(1,75);

        shuffle( $arr );


        //salvar no banco
        try{

            foreach( $arr AS $each ) {
                //echo $each, '<br />';
                unset($arr[$each]);

                $num_banco = DB::table('tabela_bingo_atuals')
                    ->select('numeros')
                    ->where(["numeros" => $each])
                    ->get()->toArray();
                if (count($num_banco) <= 0) {
                    DB::table('tabela_bingo_atuals')->insert([
                        'numeros' => $each
                    ]);
                    return  response()->json($num_banco);

                }
            }


        }catch(Exception $e){
            return response()->json([$e->getMessage()]);

        }

            //$numeros = DB::table('tabela_bingo_atuals')->select("numeros")->get();
            //dd($numeros);
        
        //return $numeros;
        
}


    public function verificaGanhador(Request $request){


            return response()->json($request->all());
    }


}
