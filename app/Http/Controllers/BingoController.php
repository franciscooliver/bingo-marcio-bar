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
        for ($i=1;$i<101;$i++){

                $numeros[] = $i;

        }
        (int) $size_array = count($numeros);
        $numeros = array_chunk($numeros, 10);
        //dd($size_array);
        return view('layouts.index',compact('numeros','size_array'));
    }

    public function dadosView(){


    }
    public function salvarJogo(Request $request){
        //Objeto data
        $data = array();
        //pegar a variavel pelo post
          $dados = (int)isset($_POST['numero'])? $_POST['numero']:"";
       
          //salvar no banco
         try{
        $tabelaJogo = DB::table('tabela_bingo_atuals')->insert([
            'numeros' =>$dados
       ]);
       if($tabelaJogo){
       //buscar no banco
        $numeros = DB::table('tabela_bingo_atuals')
        ->select('numeros')
        ->get()->toArray();

       // $data = json_encode($numeros);
       /* for($i = 0; $i<sizeof($numeros);$i++){
            $data[$i]= array("numero"=>$numeros[$i]->numeros);

        }*/
        
        return $numeros;
        
       }
       
       
    }catch(Exception $e){
        return response()->json([$e->getMessage()]);
    
    }
    
}
    public function verificaGanhador(Request $request){


            return response()->json($request->all());
    }


}
