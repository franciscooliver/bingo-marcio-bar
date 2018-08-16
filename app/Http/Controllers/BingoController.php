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

        $arraysave =  array("numeros"=>$request->numeros);
        $num_cartela = $request->input("numero_cart");

        $aray_div = array_chunk($arraysave["numeros"], 5);//divide array de numeros em 5
        //cria um array com 5 numeros para a linha B
        $table_B = array(
            "numeros" => $aray_div[0]
        );


        //cria um array com 5 numeros para a linha I
        $table_I = array(
            "numeros" => $aray_div[1]
        );

        $remove_numero = array_pop($aray_div[2]);//remove numero do final do array
        $array_merge = array_merge($aray_div[3], $aray_div[4]);//junta os dois arrays restantes
        array_unshift($array_merge, $remove_numero);//adiciona numero no inicio do array criado

        $novo_array = array_chunk($array_merge,5);

        $novoArray_div = [
            "linhaG"=>$novo_array[0],
            "linhaO"=>$novo_array[1]
        ];

        //cria um array com 4 numeros para a linha N
        $table_N = array(
            "numeros" => $aray_div[2]
        );

        //cria um array com 5 numeros para a linha G
        $table_G = array(
            "numeros" => $novoArray_div["linhaG"]
        );

        //cria um array com 5 numeros para a linha O
        $table_O = array(
            "numeros" => $novoArray_div["linhaO"]
        );

        //salva a sequencia B no banco
        $linhaB = new LinhaB();
        $retorno_linhaB = $linhaB->salvaNumerosLinhaB($table_B);
      
        //salva a sequencia I no banco
        $linnhaI = new LinhaI();
        $retorno_linhaI = $linnhaI->salvaNumerosLinhaI($table_I);

        if($retorno_linhaI['status'] === true){
            $linhaN = new LinhaN();
            $retorno_linhaN = $linhaN->salvaNumerosLinhaN($table_N);

            if($retorno_linhaN['status'] === true){
                $linhaG = new LinhaG();
                $retorno_linhaG = $linhaG->salvaNumerosLinhaG($table_G);

                if ($retorno_linhaG['status'] === true){

                    $linhaO = new LinhaO();
                    $retorno_linhaO = $linhaO->salvaNumerosLinhaO($table_O);
                    if ($retorno_linhaO['status'] === true){
                    //quando chama essa função para salvar os id na cartela não retorna nada
                    $cartela = new Cartela();
                    $retorno_cartela = $cartela->salvaColunas(  
                    $retorno_linhaB['id_B'],//retorna o id das colunas cadastradas
                    $retorno_linhaI['id_I'],
                    $retorno_linhaN['id_N'],
                    $retorno_linhaG['id_G'],
                    $retorno_linhaO['id_O']
                    );
                        if ($retorno_cartela['status'] === true){
                           
                            return response()->json(["retorno_bd"=>$retorno_cartela,"mensagem"=>"Sucesso ao cadastrar cartela"]);

                        }
                    
                    }
                
                  
                       
                }   
            }
        }

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
