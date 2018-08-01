<?php

namespace App\Http\Controllers;

use http\Env\Response;
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

            //$nums_array = range(1, 75);

        //salvar no banco
        try{

                $num_banco = DB::table('tabela_bingo_atuals')
                    ->select('numeros')
                    ->get()->toArray();

                shuffle($num_banco);
                $num_sorteado = array_rand($num_banco);


               DB::table("tabela_bingo_atuals")
                ->select("numeros")
                ->where([
                    'numeros'=>$num_sorteado
                ])->delete();


                return  $num_sorteado;



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
