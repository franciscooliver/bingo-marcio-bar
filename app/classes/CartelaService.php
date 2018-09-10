<?php
/**
 * Created by PhpStorm.
 * User: fran_oliver
 * Date: 01/09/18
 * Time: 14:57
 */

namespace App\classes;
use App\Cartela;
 use App\LinhaB;
 use App\LinhaG;
 use App\LinhaI;
 use App\LinhaN;
 use App\LinhaO;
 use Milon\Barcode\DNS1D;
use phpDocumentor\Reflection\Types\Array_;

class CartelaService implements CartelaInterface
{


    public function gerarCartela(): Array
    {
        // TODO: Implement gerarCartela() method.

        //arrays temporarios
        $array_linhaB = $this->gerarLinha(1,15,5);
        $array_linhaI = $this->gerarLinha(16,30,5);
        $array_linhaN = $this->gerarLinha(31,45,4);
        $array_linhaG = $this->gerarLinha(46,60,5);
        $array_linhaO = $this->gerarLinha(61,75,5);

        //montando a cartela
        $B = array($array_linhaB[0],$array_linhaI[0],$array_linhaN[0],$array_linhaG[0],$array_linhaO[0]);
        $I = array($array_linhaB[1],$array_linhaI[1],$array_linhaN[1],$array_linhaG[1],$array_linhaO[1]);
        $N = array($array_linhaB[2],$array_linhaI[2],$array_linhaG[2],$array_linhaO[2]);
        $G = array($array_linhaB[3],$array_linhaI[3],$array_linhaN[2],$array_linhaG[3],$array_linhaO[3]);
        $O = array($array_linhaB[4],$array_linhaI[4],$array_linhaN[3],$array_linhaG[4],$array_linhaO[4]);

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

    public function geraNumeroCartela($start , $end): Array
    {
        // TODO: Implement geraNumeroCartela() method.
        $numeros = range($start, $end );
        $numero_cart = [];
        for($i=0; $i < count($numeros);$i++){
            $numero_cart[$i]  = $numeros[$i];
        }
        return $numero_cart;
    }

    public function gerarBarcode($numero_cartela): String
    {
        // TODO: Implement gerarBarcode() method.
        $barcode = DNS1D::getBarcodePNG("$numero_cartela", "C39");
        return $barcode;
    }

    public function salvarCartelasGeradas($data ): Array
    {
        // TODO: Implement salvarCartelasGeradas() method.
        $array_linhaB = array($data['linhas']['linha1'][0],$data['linhas']['linha2'][0],$data['linhas']['linha3'][0],$data['linhas']['linha4'][0],$data['linhas']['linha5'][0]);

        $array_linhaI = array($data['linhas']['linha1'][1],$data['linhas']['linha2'][1],$data['linhas']['linha3'][1],$data['linhas']['linha4'][1],$data['linhas']['linha5'][1]);

        $array_linhaN = array($data['linhas']['linha1'][2],$data['linhas']['linha2'][2],$data['linhas']['linha4'][2],$data['linhas']['linha5'][2]);

        $array_linhaG = array($data['linhas']['linha1'][3],$data['linhas']['linha2'][3],$data['linhas']['linha3'][2],$data['linhas']['linha4'][3], $data['linhas']['linha5'][3]);

        $array_linhaO = array($data['linhas']['linha1'][4],$data['linhas']['linha2'][4],$data['linhas']['linha3'][3],$data['linhas']['linha4'][4], $data['linhas']['linha5'][4]);

        $tableB = [
            'numeros' => $array_linhaB
        ];
        $tableI = [
            'numeros' => $array_linhaI
        ];
        $tableN = [
            'numeros' => $array_linhaN
        ];
        $tableG = [
        'numeros' => $array_linhaG
    ];
        $tableO = [
            'numeros' => $array_linhaO
        ];
        //salva numeros linha B
        $linhaB = new LinhaB();
        $retorno_linhaB = $linhaB->salvaNumerosLinhaB($tableB);
        //salva numeros linha I
        if($retorno_linhaB['status']):
            $linhaI = new LinhaI();
            $retorno_linhaI = $linhaI->salvaNumerosLinhaI($tableI);
            if($retorno_linhaI['status']):
               $linhaN = new LinhaN();
               $retorno_linhaN = $linhaN->salvaNumerosLinhaN($tableN);
               if($retorno_linhaN['status']):
                   $linhaG = new LinhaG();
                   $retorno_linhaG = $linhaG->salvaNumerosLinhaG($tableG);
                   if($retorno_linhaG['status']):
                       $linhaO = new LinhaO();
                       $retorno_linhaO = $linhaO->salvaNumerosLinhaO($tableO);
                       if ($retorno_linhaO['status']) {
                           //quando chama essa função para salvar os id na cartela não retorna nada
                           $cartela = new Cartela();
                           $retorno_cartela = $cartela->salvaColunas(
                               $retorno_linhaB['id_B'],//retorna o id das colunas cadastradas
                               $retorno_linhaI['id_I'],
                               $retorno_linhaN['id_N'],
                               $retorno_linhaG['id_G'],
                               $retorno_linhaO['id_O'],
                               $data['numero_cartela'],
                               $data['barcode']
                           );
                       }
                       if ($retorno_cartela['status']){
                           return ["mensagem"=>"Sucesso ao cadastrar cartela"];
                       }
                   endif;
               endif;
            endif;
        endif;
        return ['mensagem' => "Não foi possível salvar essa cartela"];
    }
}
