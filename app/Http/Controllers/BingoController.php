<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BingoController extends Controller
{

    public function  index(){

        $numeros = array();
        for ($i=1;$i<101;$i++){

                $numeros[] = $i;

        }
        $numeros = array_chunk($numeros, 10);

        return view('layouts.index',compact('numeros'));
    }

    public function dadosView(){


    }
}
