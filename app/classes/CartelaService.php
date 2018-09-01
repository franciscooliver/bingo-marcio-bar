<?php
/**
 * Created by PhpStorm.
 * User: fran_oliver
 * Date: 01/09/18
 * Time: 14:57
 */

namespace App\classes;

 use Milon\Barcode\DNS1D;

class CartelaService implements CartelaInterface
{


    public function gerarCartela(): Array
    {
        // TODO: Implement gerarCartela() method.
        //arrays temporarios
        $array_linhaB = $this->gerarLinha(1,15,5);
        $array_linhaI = $this->gerarLinha(16,30,5);
        $array_linhaN = $this->gerarLinha(31,45,5);
        $array_linhaG = $this->gerarLinha(46,60,5);
        $array_linhaO = $this->gerarLinha(61,75,5);

        $B = array($array_linhaB[0],$array_linhaI[0],$array_linhaN[0],$array_linhaG[0],$array_linhaO[0]);
        $I = array($array_linhaB[1],$array_linhaI[1],$array_linhaN[1],$array_linhaG[1],$array_linhaO[1]);
        $N = array($array_linhaB[2],$array_linhaI[2],$array_linhaN[2],$array_linhaG[2],$array_linhaO[2]);
        $G = array($array_linhaB[3],$array_linhaI[3],$array_linhaN[3],$array_linhaG[3],$array_linhaO[3]);
        $O = array($array_linhaB[4],$array_linhaI[4],$array_linhaN[4],$array_linhaG[4],$array_linhaO[4]);

        $N[2] ='--';

        $linhasCart = [
            'linha1' => $B,
            'linha2' => $I,
            'linha3' => $N,
            'linha4' => $G,
            'linha5' => $O
        ];

        return $linhasCart;

    }

    public function gerarLinha($min, $max, $count): Array
    {
        // TODO: Implement gerarLinha() method.
        $nums = range($min, $max);
        //embaralha os valores
        shuffle($nums);

        //array que seŕá retornado com os números
        $response = array();
        for($i=0; $i < $count;$i++){
            array_push($response, $nums[$i]);
        }

        return $response;
    }

    public function geraNumeroCartela($start, $end): String
    {
        // TODO: Implement geraNumeroCartela() method.

        $numero = '0'.mt_rand(100, 999);
        return $numero;
    }

    public function gerarBarcode($numero_cartela): String
    {
        // TODO: Implement gerarBarcode() method.
        $barcode = DNS1D::getBarcodePNG("$numero_cartela", "C39");

        return $barcode;
    }
}