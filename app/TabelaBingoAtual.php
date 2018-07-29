<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TabelaBingoAtual extends Model
{
    //
    protected $table = "tabela_bingo_atuals";
    protected $fillable = [
        "numeros"
    ];
}
