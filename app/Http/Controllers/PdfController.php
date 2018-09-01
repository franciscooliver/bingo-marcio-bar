<?php

namespace App\Http\Controllers;

use App\Bingo;
use Barryvdh\DomPDF\Facade as PDF;
use App\classes\CartelaService;

class PdfController extends Controller
{
    public function index(){


        return view('preview_pdf',compact('array_div'));
    }


    public function gerarPdf()
    {

        //cartela n° 1
        $cartelaService = new CartelaService();
        $cartela1 = $cartelaService->gerarCartela();
        $numerocartela1 = $cartelaService->geraNumeroCartela(100, 999);
        $barcode_cart1 =  $cartelaService->gerarBarcode($numerocartela1);


        //cartela n° 2
        if(!empty($cartela1)){
            $cartela2 = $cartelaService->gerarCartela();
            $numerocartela2 = $cartelaService->geraNumeroCartela(100, 999);
            $barcode_cart2 =  $cartelaService->gerarBarcode($numerocartela2);
        }

        $dados_cartelas = [
            'linhas_cart_1' => $cartela1,
            'linhas_cart_2' =>$cartela2,
            'numero_cart_1' =>$numerocartela1,
            'numero_cart_2'=>$numerocartela2,
            'barcode_cart1'=>$barcode_cart1,
            'barcode_cart2'=>$barcode_cart2
        ];

        //dd($dados_cartelas);

        $pdf =  PDF::loadView('preview_pdf', compact('dados_cartelas'));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('cartela'.$numerocartela1.'-'.$numerocartela2.'.pdf');

    }
    /*funcao recebe o valor minimo e maximo e a quantidade de numeros a ser gerados e retorna
    * um array com os numeros randomicos
    */

}
