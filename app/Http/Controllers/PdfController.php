<?php

namespace App\Http\Controllers;

use App\Bingo;
use Barryvdh\DomPDF\Facade as PDF;
use Milon\Barcode\DNS1D;

class PdfController extends Controller
{
    public function index(){


        return view('preview_pdf',compact('array_div'));
    }


    public function gerarPdf()
    {
        //arrays temporarios
        $array_linhaB = $this->geraLinha(1,15,5);
        $array_linhaI = $this->geraLinha(16,30,5);
        $array_linhaN = $this->geraLinha(31,45,5);
        $array_linhaG = $this->geraLinha(46,60,5);
        $array_linhaO = $this->geraLinha(61,75,5);

        $B = array($array_linhaB[0],$array_linhaI[0],$array_linhaN[0],$array_linhaG[0],$array_linhaO[0]);
        $I = array($array_linhaB[1],$array_linhaI[1],$array_linhaN[1],$array_linhaG[1],$array_linhaO[1]);
        $N = array($array_linhaB[2],$array_linhaI[2],$array_linhaN[2],$array_linhaG[2],$array_linhaO[2]);
        $G = array($array_linhaB[3],$array_linhaI[3],$array_linhaN[3],$array_linhaG[3],$array_linhaO[3]);
        $O = array($array_linhaB[4],$array_linhaI[4],$array_linhaN[4],$array_linhaG[4],$array_linhaO[4]);

        $N[2] ='--';
        //echo json_encode($N);
        //die();

        $linhasCart1 = [
            'linha1' => $B,
            'linha2' => $I,
            'linha3' => $N,
            'linha4' => $G,
            'linha5' => $O
        ];

        //echo json_encode($linhas);
        //die();
        //numero da cartela e barcode correspondente
        $numerocartela1 = mt_rand(100, 999);
        $numerocartela2 = mt_rand(100,999);
        $numerocartela1 = '0'.$numerocartela1;
        $numerocartela2 = '0'.$numerocartela2;
        $barcode_cart1 =  DNS1D::getBarcodePNG("$numerocartela1", "C39");
        $barcode_cart2 =  DNS1D::getBarcodePNG("$numerocartela2", "C39");

        $dados_cartelas = [
            'linhas_cart_1' => $linhasCart1,
            'numero_cart_1' =>$numerocartela1,
            'numero_cart_2' =>$numerocartela2,
            'barcode_cart1'=>$barcode_cart1,
            'barcode_cart1'=>$barcode_cart1
        ];


        $pdf =  PDF::loadView('preview_pdf', compact('dados_cartelas'));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('cartela'.$numerocartela1.'-'.$numerocartela2.'.pdf');

    }
    /*funcao recebe o valor minimo e maximo e a quantidade de numeros a ser gerados e retorna
    * um array com os numeros randomicos
    */
    public function geraLinha($min,$max,$count): Array{
        $nums = range($min, $max);
        //embaralha os valores
        shuffle($nums);

        //array que seŕá retornado com os números
        $response = array();
        for($i=0; $i < $count;$i++){
            array_push($response, $nums[$i]);
        }

        return $response;
    }

}
