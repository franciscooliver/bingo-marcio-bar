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

        $nums_chamados = array();
        $array_tabela = array();
        $num_sorteado = null;
        $numerosBanco = array();
        //salvar no banco
        try{

            $num_banco = DB::table('tabela_bingo_atuals')
                ->select('numeros')
                ->get()->toArray();

            //$count = count( $num_banco);
            //pegar o objeto e transformar em um array
            foreach($num_banco as $key=>$num){
                 $numerosBanco[$num->numeros] = $num->numeros;
                
            }

            if (!empty($numerosBanco)) {
                //sortear um numero aleatorio no array
                $num_sorteado = array_rand($numerosBanco);

                shuffle($numerosBanco);

                DB::table('numero_sorteados')
                    ->insert([
                        'numero'=>$num_sorteado
                ]);

                //deletar o numero sorteado da tabela no banco
               DB::table("tabela_bingo_atuals")
               ->select("numeros")
               ->where([
                   'numeros'=>$num_sorteado
               ])->delete();
               
                return  $num_sorteado;

             } else {

                return 0;
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

    public function viewcadCartela(Request $request){

        $numeros = range(1 ,75);
        $array_view = array_chunk($numeros , 15);


        return view('bingo.cadastro_cartelas',compact('array_view'));
    }

    public function addCartela(Request $request){

        if(!empty($request->numero)){
            return response()->json(['data'=>true]);
        }else{
            return response()->json(['data'=>false]);
        }


    }


}
