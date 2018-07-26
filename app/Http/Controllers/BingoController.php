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
        (int) $size_array = count($numeros);
        $numeros = array_chunk($numeros, 10);
        //dd($size_array);
        return view('layouts.index',compact('numeros','size_array'));
    }

    public function dadosView(){


    }
}
