<?php

namespace App\Http\Controllers;
use App\Cartela;
use Illuminate\Http\Request;
use App\classes\CartelaService;
use Illuminate\Support\Facades\DB;
use App\LinhaB;
use App\LinhaI;
use App\LinhaG;
use App\LinhaN;
use App\LinhaO;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;

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

    public function cartelas(){

        $data = DB::table('cartelas')
        ->select(
            'cartelas.id',
            'cartelas.numero_cartela',
            'cartelas.vendida',
            'cartelas.impressa',
            'table_B.*',
            'table_I.*',
            'table_N.*',
            'table_G.*',
            'table_O.*',
        )
        ->join('table_B', 'table_B.id', '=', 'cartelas.table_B_idtable_B')
        ->join('table_I', 'table_I.id', '=', 'cartelas.table_I_idtable_I')
        ->join('table_N', 'table_N.id', '=', 'cartelas.table_N_idtable_N')
        ->join('table_G', 'table_G.id', '=', 'cartelas.table_G_idtable_G')
        ->join('table_O', 'table_O.id', '=', 'cartelas.table_O_idtable_O')
        ->paginate(15);

        $cartelas = array();
        $letraB = array();
        $letraI = array();
        $letraN = array();
        $letraG = array();
        $letraO = array();


        foreach($data as $key => $cartela){
            
           $letraB = [$cartela->b_1, $cartela->b_2,$cartela->b_3,$cartela->b_4,$cartela->b_5];
           $letraI = [$cartela->i_1, $cartela->i_2,$cartela->i_3,$cartela->i_4,$cartela->i_5 ];
           $letraN = [$cartela->n_1, $cartela->n_2,$cartela->n_3,$cartela->n_4];
           $letraG = [$cartela->g_1, $cartela->g_2,$cartela->g_3,$cartela->g_4,$cartela->g_5];
           $letraO = [$cartela->o_1, $cartela->o_2,$cartela->o_3,$cartela->o_4,$cartela->o_5];

           $cartelas[] = array(
               "id" => $cartela->id,
               "numero" => $cartela->numero_cartela,
               "vendida" => $cartela->vendida,
               "impressa" => $cartela->impressa,
               "letraB" => $letraB,
               "letraI" => $letraI,
               "letraN" => $letraN,
               "letraG" => $letraG,
               "letraO" => $letraO,
            );
        }
        

        //dd($cartelas); die();
    
        return view('bingo.cartelas_cadastradas', ['data' => $data, "cartelas" => $cartelas]);
    }

    public function editCart($id){
        $cartela = DB::table('cartelas')
        ->join('table_B', 'table_B.id', '=', 'cartelas.table_B_idtable_B')
        ->join('table_I', 'table_I.id', '=', 'cartelas.table_I_idtable_I')
        ->join('table_N', 'table_N.id', '=', 'cartelas.table_N_idtable_N')
        ->join('table_G', 'table_G.id', '=', 'cartelas.table_G_idtable_G')
        ->join('table_O', 'table_O.id', '=', 'cartelas.table_O_idtable_O')
        ->where('cartelas.id', $id)
        ->first();

        //dd($cartela); die();

        return view('bingo.updateCarts', compact('cartela'));
    }

    public function teste(Request $request, $id){
       $cartela = Cartela::find($id);

       $cartela->vendida = (string)$request->vendida; 
       $cartela->save();

       //update linha B
       $linhaB = LinhaB::find($cartela->table_B_idtable_B);
       $linhaB->b_1 = $request->b1;
       $linhaB->b_2 = $request->b2;
       $linhaB->b_3 = $request->b3;
       $linhaB->b_4 = $request->b4;
       $linhaB->b_5 = $request->b5;
       $linhaB->save();

       //update linha I
       $linhaI = LinhaI::find($cartela->table_I_idtable_I);
       $linhaI->i_1 = $request->i1;
       $linhaI->i_2 = $request->i2;
       $linhaI->i_3 = $request->i3;
       $linhaI->i_4 = $request->i4;
       $linhaI->i_5 = $request->i5;
       $linhaI->save();

       //update linha N
       $linhaN = LinhaN::find($cartela->table_N_idtable_N);
       $linhaN->n_1 = $request->n1;
       $linhaN->n_2 = $request->n2;
       $linhaN->n_3 = $request->n3;
       $linhaN->n_4 = $request->n4;
       $linhaN->save();

       //update linha G
       $linhaG = LinhaG::find($cartela->table_G_idtable_G);
       $linhaG->g_1 = $request->g1;
       $linhaG->g_2 = $request->g2;
       $linhaG->g_3 = $request->g3;
       $linhaG->g_4 = $request->g4;
       $linhaG->g_5 = $request->g5;
       $linhaG->save();

       //update linha O
       $linhaO = LinhaO::find($cartela->table_O_idtable_O);
       $linhaO->o_1 = $request->o1;
       $linhaO->o_2 = $request->o2;
       $linhaO->o_3 = $request->o3;
       $linhaO->o_4 = $request->o4;
       $linhaO->o_5 = $request->o5;
       $linhaO->save();
       

       if($linhaB && $linhaI && $linhaN && $linhaG && $linhaO){
           $request->session()->flash('message',  'Cartela atualizada');
           $request->session()->flash('alert-class', 'alert-success'); 
       }else{
            $request->session()->flash('message',  'Erro ao tentar atualizar a cartela');
            $request->session()->flash('alert-class', 'alert-danger'); 
       }

       return redirect()->route('editCart',[$cartela]);
       
    }


}
