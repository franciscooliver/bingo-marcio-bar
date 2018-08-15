<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cartela extends Model
{
    protected $table = "cartelas";
    protected $fillable = ['idTabela','table_B_idtable_B','table_I_idtable_I','table_N_idtable_N','table_G_idtable_G','table_O_idtable_O',"numero_cartela"];


    public function linhaB(){
        return $this->belongsTo(LinhaB::class);
    }

    public function linhaI(){
        return $this->belongsTo(LinhaI::class);
    }

    public function linhaN(){
        return $this->belongsTo(LinhaN::class);
    }

    public function linhaG(){
        return $this->belongsTo(LinhaG::class);
    }

    public function linhaO(){
        return $this->belongsTo(LinhaO::class);
    }

}
