<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;

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
        $array = range(1,75);
        $numeros = array_chunk($array, 25);
        $sort = [];
        for($i=0;$i< 25;$i++) {
            $sort[] = array_rand($array);
        }

        $array_div = array_chunk($sort, 5);

        $pdf =  PDF::loadView('preview_pdf', compact('array_div','sort', 'numeros'));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('nome-arquivo-pdf-gerado.pdf');

    }

}
