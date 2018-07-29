<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BingoController extends Controller
{

    public function  index(){

        $numeros = array();
        for ($i=1;$i<76;$i++){

                $numeros[] = $i;

        }
        (int) $size_array = count($numeros);
        $numeros = array_chunk($numeros, 9);
        //dd($size_array);
        return view('layouts.index',compact('numeros','size_array'));
    }


    public function verificaGanhador(Request $request){


            return response()->json($request->all());
    }
}
