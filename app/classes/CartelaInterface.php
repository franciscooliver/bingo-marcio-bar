<?php
/**
 * Created by PhpStorm.
 * User: fran_oliver
 * Date: 01/09/18
 * Time: 14:27
 */

namespace App\classes;


interface CartelaInterface
{
    public function gerarCartela();//assinatura do metodo que gera os numeros da cartela
    public function gerarLinha($min, $mas, $count);//assinatura do metodo que gera cada linha da cartela
    public function geraNumeroCartela($start, $end);//assinatura do metodo que gera o número identificador de cada cartela
    public function gerarBarcode($numero_cartela);//assinatura do metodo que gera o barcode correspondente ao numero da cartela
}