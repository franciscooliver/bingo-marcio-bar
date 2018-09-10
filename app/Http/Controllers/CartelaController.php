<?php

namespace App\Http\Controllers;
use App\Cartela;
use Illuminate\Http\Request;
use App\classes\CartelaService;
class CartelaController extends Controller
{
    public function gerarCartelas(Request $request){
        $num_verify = null;
    	$qtd = $request->qtd;
        $cartelaService = new CartelaService();
        $array_numeros_cartelas = $cartelaService->geraNumeroCartela(100, 999);
        $count = Cartela::all()->count();
    	for ($i= 0; $i < $qtd; $i++){
            //cartela n° 1
            $cartela1 = $cartelaService->gerarCartela();
            $numerocartela = "0".$array_numeros_cartelas[$count];
            $barcode_cart =  $cartelaService->gerarBarcode($numerocartela);
            $dados_cartela = array(
                'linhas' => $cartela1,
                'numero_cartela' => $numerocartela,
                'barcode' => $barcode_cart
            );
                $cartelaService->salvarCartelasGeradas($dados_cartela);
                $count += 1;
        }
    	if($count >= $qtd){
    		
    	    $retorno = array(
                'mensagem' => "Sucesso, ".$qtd." cartelas geradas",
                'classe' => "text-success"
            );
            return response()->json($retorno);
        }else {
            $retorno = array(
                'mensagem' => "Erro ao tentar gerar cartelas, tente novamente",
                'classe' => "text-danger"
            );
            return response()->json($retorno);
        }
    }
}
