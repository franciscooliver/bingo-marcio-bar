<?php


Route::get('/', 'BingoController@index')->name('index');
//Route::post("/verificaganhador","BingoController@verificaGanhador");
Route::get("/sorteiaNumero","BingoController@sorteiaNumero")->name('sorteianumero');
Route::get("/viewcadCartela","BingoController@viewcadCartela")->name('view_cad_cartela');
Route::post("/addCartela","BingoController@addCartela")->name('addcartela');
Route::post("/gerar_cartela","CartelaController@gerarCartelas")->name('gerar-cartela');
Route::get('/premios','PremioController@index')->name('premios');
Route::get('/viewCadPremios','PremioController@viewCadPremios')->name('view-cad-premios');
Route::post('/addPremio','PremioController@addPremio')->name('add-premio');
Route::get("/popularTabela","BingoController@popularTabela")->name('popular-tabela');
Route::get("/restaurarBingo","BingoController@restaurarBingo")->name('restaurar-bingo');
Route::get("/confereCartela","BingoController@confereCartela")->name('confere');


Route::get("/teste","BingoController@teste");
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

Route::get('/reset_table', function()
{
    $reseta_table = \App\Bingo::truncate();

    //exibe mensagem de retorno
    if($reseta_table){
        return redirect()
            ->route('index')
            ->with("reset_table","Successful, reset table");
    }

    return redirect()
        ->route('index')
        ->with("error","Error reset table");

})->name('reset-table');

//teste para gerar PDF
Route::get("/gerarPdf","PdfController@gerarPdf")->name('gerarPdf');
