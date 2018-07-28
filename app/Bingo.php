<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bingo extends Model
{
    protected $table = "bingos";

    protected $fillable = [
        "id",
        "numeros"
    ];
}
