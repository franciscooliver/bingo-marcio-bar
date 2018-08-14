<?php

namespace App\Http\Controllers;

use App\Cartela;
use http\Env\Response;
use Illuminate\Http\Request;
use App\TabelaBingoAtual;
use Illuminate\Support\Facades\DB;
use Exception;
use Dompdf\Dompdf;
use App\LinhaB;
use App\LinhaG;
use App\LinhaI;
use App\LinhaN;
use App\LinhaO;

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

                DB::table('numero_sorteados')//salva na tabela o numero que foi sorteado
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

}

    public function verificaGanhador(Request $request){


            return response()->json($request->all());
    }

    public function viewcadCartela(Request $request){

        $numeros = range(1 ,75);
        $letras = array(['B','I','N','G','O']);
        $array_view = array_chunk($numeros , 15);


        return view('bingo.cadastro_cartelas',compact('array_view','letras'));
    }

    public function addCartela(Request $request){

        $arraysave =  array("numeros" => $request->numeros);
        $id_cartela = $request->input("numero_cart");

        $aray_div = array_chunk($arraysave["numeros"], 5);
        $b = array(
            "numeros"=>$aray_div[0]
        );
        //$i = array("numeros"=>$aray_div[1]);
        //$n = array("numeros"=>$aray_div[2]);
        //$g = array("numeros"=>$aray_div[3]);
       // $o = array("numeros"=>$aray_div[4]);

        $linhaB = new LinhaB();
        $cartela = new Cartela();

        $cartela->salvaIdCartela($id_cartela, 12345);

        $retorno_LB = $linhaB->saveNums($b["numeros"],$id_cartela);


    }

    public function gerarPdf()
    {
        $dompdf = new Dompdf();

        $html = file_get_contents(public_path('exemplo_pdf.php'));

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'landscape');

        $dompdf->render();

        $dompdf->stream();


    }


}
