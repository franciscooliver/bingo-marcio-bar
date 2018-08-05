<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NumeroSorteado extends Model
{
    protected $table = 'numero_sorteados';
    protected $fillable = [
        'numero'
    ];
}
