<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bingo extends Model
{
    protected $table = "tabela_bingo_atuals";

    protected $fillable = [
        "id",
        "numeros"
    ];
}
