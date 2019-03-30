<?php

namespace App\Http\Controllers;

use App\Premio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PremioController extends Controller
{
    public function index(){
        date_default_timezone_set('America/Sao_Paulo');
        $datadiaria = date('d/m/Y');
        $data_comparativa = date('Y-m-d');
        

        $premios = DB::table('premios')
            ->select("desc_bingo","nome_premio","descricao_premio","hora_inicio")
            ->where([
                "data_bingo" => $data_comparativa
            ])->get();


            if(count($premios) > 0):
                $horario = $premios[0]->hora_inicio;
                $horario = date("H:i", strtotime($horario));
                $descricao_bingo = $premios[0]->desc_bingo;
            else:
                $horario = "";
            endif;

        return view('bingo.premios',compact('premios','datadiaria','horario','descricao_bingo'));
    }

    public function viewCadPremios(){
        return view('bingo.view-premios-cad');
    }

    public function addPremio(Request $request){
        $dadosPremio = $request->all();
        
        $premio = Premio::create($dadosPremio);

        if($premio){
            return redirect()
                            ->route('view-cad-premios')
                            ->with("success","Êxito, prêmio cadastrado com sucesso");
        }else{
            return redirect()
                ->route('view-cad-premios')
                ->with("error","Erro ao cadastrar prêmio");
        }
    }
}
