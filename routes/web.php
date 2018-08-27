<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\BingoController;
use App\bingo;
use Illuminate\Support\Facades\DB;

Route::get('/', 'BingoController@index')->name('index');
//Route::post("/verificaganhador","BingoController@verificaGanhador");
Route::get("/sorteiaNumero","BingoController@sorteiaNumero")->name('sorteianumero');
Route::get("/viewcadCartela","BingoController@viewcadCartela")->name('view_cad_cartela');
Route::post("/addCartela","BingoController@addCartela")->name('addcartela');
Route::get('/premios','PremioController@index')->name('premios');
Route::get('/viewCadPremios','PremioController@viewCadPremios')->name('view-cad-premios');
Route::post('/addPremio','PremioController@addPremio')->name('add-premio');

Route::get("/popularTabela","BingoController@popularTabela")->name('popular-tabela');


//reseta todo o banco de dados
Route::get('/resetaDB', function()
{
    $reseta_bd = Artisan::call('migrate:refresh');

    //exibe mensagem de retorno
    if($reseta_bd === 0){
        return redirect()
        ->route('index')
        ->with("reset_db","Banco de dados resetado");
    }

    return redirect()
        ->route('index')
        ->with("error","Erro ao resetar o banco de dados");

})->name('reset-db');

Route::get('/reset-numerosSort_table', function()
{
    $reseta_table = \App\NumeroSorteado::truncate();

    //exibe mensagem de retorno
    if($reseta_table){
        return redirect()
            ->route('index')
            ->with("reset_table","Successful, reset table");
    }

    return redirect()
        ->route('index')
        ->with("error","Erro ao resetar tabela");

})->name('reset-table-num-sort');

//teste para gerar PDF
Route::get("/gerarPdf","BingoController@gerarPdf")->name('gerarPdf');
Route::get("/returnpdf", function (){
    return view('exemplo_pdf');
})->name('returnpdf');
