<?php

namespace App\Http\Controllers;

use App\Bingo;
use App\Cartela;
use Barryvdh\DomPDF\Facade as PDF;
use App\classes\CartelaService;
use http\Env\Response;
use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{
    public function index(){
        return view('preview_pdf',compact('array_div'));
    }

    public function gerarPdf()
    {
        //$cartelas = Cartela::all()

        $tabela = DB::table('cartelas')
            ->join('table_B','table_B.id', '=', 'cartelas.table_B_idtable_B')
            ->join('table_I','table_I.id', '=', 'cartelas.table_I_idtable_I')
            ->join('table_N','table_N.id', '=', 'cartelas.table_N_idtable_N')
            ->join('table_G','table_G.id', '=', 'cartelas.table_G_idtable_G')
            ->join('table_O','table_O.id', '=', 'cartelas.table_O_idtable_O')
            ->select('cartelas.numero_cartela', 'cartelas.barcode','cartelas.id', 'table_B.b_1', 'table_I.i_1','table_N.n_1','table_G.g_1','table_O.o_1',
                'table_B.b_2','table_I.i_2','table_N.n_2','table_G.g_2','table_O.o_2','table_B.b_3','table_I.i_3','table_G.g_3','table_O.o_3','table_B.b_4','table_I.i_4','table_N.n_3','table_G.g_4','table_O.o_4','table_B.b_5','table_I.i_5','table_N.n_4','table_G.g_5','table_O.o_5')
            ->where('impressa', 'N')
            ->first();
            $numero_cartela = $tabela->numero_cartela;
            $barcode = $tabela->barcode;
            //echo json_encode($tabela_print);
                $linhaB_pdf = array($tabela->b_1,$tabela->i_1, $tabela->n_1,$tabela->g_1,$tabela->o_1);
                $linhaI_pdf = array($tabela->b_2,$tabela->i_2,$tabela->n_2,$tabela->g_2,$tabela->o_2);
                $linhaN_pdf = array($tabela->b_3,$tabela->i_3,$tabela->g_3,$tabela->o_3);
                $linhaN_pdf = array($tabela->b_3,$tabela->i_3,$tabela->g_3,$tabela->o_3);
                $linhaG_pdf = array($tabela->b_4,$tabela->i_4,$tabela->n_3,$tabela->g_4,$tabela->o_4);
                $linhaO_pdf = array($tabela->b_5,$tabela->i_5,$tabela->n_4,$tabela->g_5,$tabela->o_5);
                $linhas = array($linhaB_pdf, $linhaI_pdf, $linhaN_pdf,$linhaG_pdf,$linhaO_pdf);

        $dados_cartelas = [
            'linhas' => $linhas,
            'numero_cart' => $numero_cartela,
            'barcode'=> $barcode,
        ];

        $pdf =  PDF::loadView('pdf_5cartelas', compact('dados_cartelas'));
        $pdf->setPaper('a4', 'portrait');

        DB::table('cartelas')
            ->where('id',$tabela->id)
            ->update(['impressa'=>"S"]);

        return $pdf->stream('cartela'.$numero_cartela.'.pdf');
       //dd(Cartela::find($idCartela));
    }
}
