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
               
            //verificar se alguma tabela tem o numero sorteado
            //pegando a cartela que tem o numero chamado OK
            $resultCartela =  DB::table('cartelas')
            ->select('cartelas.numero_cartela')
            ->join('table_B','table_B.id_table_B', '=', 'cartelas.table_B_idtable_B')
            ->join('table_I','table_I.id_table_I', '=', 'cartelas.table_I_idtable_I')
            ->join('table_N','table_N.id_table_N', '=', 'cartelas.table_N_idtable_N')
            ->join('table_G','table_G.id_table_G', '=', 'cartelas.table_G_idtable_G')
            ->join('table_O','table_O.id_table_O', '=', 'cartelas.table_O_idtable_O')
            ->where('table_B.b_1', '=',$num_sorteado )->orWhere('table_B.b_2', '=',$num_sorteado)->orWhere('table_B.b_3', '=',$num_sorteado)->orWhere('table_B.b_4', '=',$num_sorteado)->orWhere('table_B.b_5', '=',$num_sorteado)
            ->orWhere('table_I.i_1', '=', $num_sorteado)->orWhere('table_I.i_2', '=',$num_sorteado)->orWhere('table_I.i_3', '=',$num_sorteado)->orWhere('table_I.i_4', '=',$num_sorteado)->orWhere('table_I.i_5', '=',$num_sorteado)
            ->orWhere('table_N.n_1', '=', $num_sorteado)->orWhere('table_N.n_2', '=',$num_sorteado)->orWhere('table_N.n_3', '=',$num_sorteado)->orWhere('table_N.n_4', '=',$num_sorteado)
            ->orWhere('table_G.g_1', '=', $num_sorteado)->orWhere('table_G.g_2', '=',$num_sorteado)->orWhere('table_G.g_3', '=',$num_sorteado)->orWhere('table_G.g_4', '=',$num_sorteado)->orWhere('table_G.g_5', '=',$num_sorteado)
            ->orWhere('table_O.o_1', '=', $num_sorteado)->orWhere('table_O.o_2', '=',$num_sorteado)->orWhere('table_O.o_3', '=',$num_sorteado)->orWhere('table_O.o_4', '=',$num_sorteado)->orWhere('table_O.o_5', '=',$num_sorteado)
            ->get()->toArray();
           
            
            //for que percorre todas as cartelas que tem o numero sorteado
            foreach($resultCartela  as $key=>$num){
                ////pegar o valor do contador
                $cartelaAtualContador =  DB::table("cartelas")
                ->select("cartela_contador")
                ->where(
                    'numero_cartela',$num->numero_cartela
                )->get();

               //salvar mais um no contador de cada cartela
                DB::table('cartelas')
                ->where('numero_cartela',$num->numero_cartela)
                ->update(['cartela_contador'=>$cartelaAtualContador[0]->cartela_contador+1]);
             
               
           }
                
              //codigo que traz a cartela ganhadora
                //pegar o contador maior 
                $contCartela =  DB::table('cartelas')->max('cartela_contador');
                //buscar as cartelas que mais pontuaram no bingo
                $cartelaGanhadora = DB::table('cartelas')
                ->select('cartelas.numero_cartela')
                ->where('cartela_contador', $contCartela)->get()->toArray();

                //retorno para teste
                //ResultCartela retorna as cartelas que contem o numero sorteado
                //cartelaMaior retorna um objeto das cartela que mais marcaram ,consequentemente a cartela ganhadora
                $arrayName = array('numero_sorteado'=>$num_sorteado);//'ganhadores'=>$cartelaGanhadora
            //retorno para teste verificar no console do navegador
           //return  $arrayName;
           return $num_sorteado;
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

        $novo_array = array_chunk($array_merge,5);//divide o novo array em dois novos arrays com 5 numeros cada

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
                    $retorno_linhaO['id_O'],
                    $num_cartela
                    );
                        if ($retorno_cartela['status'] === true){
                           
                            return response()->json(["retorno_bd"=>$retorno_cartela,"mensagem"=>"Sucesso ao cadastrar cartela"]);

                        }
                    
                    }
                
                  
                       
                }   
            }
        }

    }
    public function popularTabela(){
        $seed = new \DatabaseSeeder();
        $operacao = $seed->run();

        //zerar o contador das cartelas
        $contador = DB::table('cartelas')
        ->update(['cartela_contador'=>0]);

    
        return redirect()
        ->route('index')
        ->with("success_generate","Números gerados , Contador das cartelas zerados");

       // ->with("success_generate","Números gerados , Quantidades de cartelas pronta para o bingo = "+$contador);

       

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
