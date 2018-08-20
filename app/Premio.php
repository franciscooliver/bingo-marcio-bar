<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Premio extends Model
{
    protected $fillable = ['nome_premio','descricao_premio','data_bingo','hora_inicio'];
}
