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

        /*$dompdf = new Dompdf();

        $html = file_get_contents(public_path('preview_pdf.blade.php'));

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'landscape');

        $dompdf->render();

        $dompdf->stream();*/

        //$numeros = Bingo::all();

        $numerocartela = mt_rand(100, 999);
        $numerocartela = '0'.$numerocartela;
        $barcode =  DNS1D::getBarcodePNG("$numerocartela", "C39") ;
        $array = range(1,75);
        $numeros = array_chunk($array, 25);
        $sort = [];
        for($i=0;$i< 25;$i++) {
            $sort[] = array_rand($array);
        }

        $array_div = array_chunk($sort, 5);

        $pdf =  PDF::loadView('preview_pdf', compact('array_div','sort', 'numeros','numerocartela','barcode'));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('cartela'.$numerocartela.'.pdf');

    }

}
