<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gerar cartelas</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <style>
        *{font-family: 'Roboto', sans-serif; font-size: 100%;}
      header{
          padding: 0;
          margin: 0;
      }
        /*HEADER*/
        h1{font-size: 3rem; text-align: center; margin-top: -5%;}
        header h4{font-size: 1.5rem; margin-top: -30px; text-align: center;}
        h6{font-size: 1rem; text-align: center; margin-top: -30px;}
        hr{margin-top: -30px; border: 1px #000 dotted; width: 100%;}
        small{float: start; margin-top: -3%; margin-left: -5%;}
        img{margin-top: 2.3%; margin-left: -5%;}
        /*DESCRICAO PREMIOS*/

        #dados-premios .premio-01{font-size: 20px; border: none; text-align: left; padding: 0; width: 24%; margin-bottom: 0px;}
        #dados-premios .premio-02{font-size: 20px; border: none; text-align: left; padding: 2px 0; width: 24%;}
        #dados-premios .premio-03{font-size: 20px; border: none; text-align: left;  padding: 0;}

        /*TABLE*/
        table tr th{border: 0px; text-align: center; font-size: 2rem; width: 20%; padding-top: 0px;}
        table tr td{border: 1px solid #1e88e5;text-align: center; font-size: 1.5rem;}
        table tr th:nth-child(1){border-left: 1px solid #1e88e5; border-top: 1px solid #1e88e5; }
        table tr th:nth-child(2){border-top: 1px solid #1e88e5; margin-top: 0;}
        table tr th:nth-child(3){border-top: 1px solid #1e88e5; }
        table tr th:nth-child(4){border-top: 1px solid #1e88e5; }
        table tr th:nth-child(5){border-top: 1px solid #1e88e5;border-right: 1px solid #1e88e5; }


    </style>
</head>
<body>
<?php
    $cont = 0;
    $cont2 = 0;
    $cont3 = 0;
    $cont4 = 0;
    $cont5 = 0;
    $cont6 = 0;
?>
    <small id="small-2">Cartela: {{ $dados_cartelas["numero_cart_1"] }}</small>
    <img src="data:image/png;base64,{{ $dados_cartelas["barcode_cart1"] }}" alt="barcode" id="barcode-2">

   <header>
       <h1>BINGO</h1>
       <h4>Dia 6 de setembro a partir das 19:00 hrs</h4>
       <h6>Residência da Kaytinha</h6>
       <hr>
   </header>
            <table id="dados-premios" width="100%">
                <tr>
                    <th class="premio-01">1° prêmio</th>
                    <th class="premio-02">2° prêmio</th>
                    <th class="premio-03">3° prêmio</th>
                </tr>
                <tr>
                    <th class="premio-01">Uma caixa de cerveja</th>
                    <th class="premio-02">Uma caixa de cerveja e um frango assado</th>
                    <th class="premio-03">Surpresa</th>
                </tr>
            </table>
            <table width="30%" border="1" cellspacing="0" cellpadding="5" align="center" style="border-collapse: collapse; margin-top: 1%;">
                <thead>
                <tr>
                    <th>B</th>
                    <th>I</th>
                    <th>N</th>
                    <th>G</th>
                    <th>O</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dados_cartelas["linhas_cart_1"] as $nums)
                    <tr class="bordered">
                        @foreach($nums as $key => $n)
                            <?php
                             $cont++;
                              if ($cont == 13)
                                echo '<td class="text-center bordered"><img src="https://cdn4.iconfinder.com/data/icons/geomicons/32/672342-circle-16.png"
                                    style="text-align: center; margin-top: -0.5px;"></td>';
                            ?>
                            <td class="text-center bordered">{{ $n }}</td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>


   <table width="30%"  border="1" cellspacing="0" cellpadding="5" align="left" style="border: thin; border-style: solid; margin-top: -55%">
       <thead>
       <tr>
           <th>B</th>
           <th>I</th>
           <th>N</th>
           <th>G</th>
           <th>O</th>
       </tr>
       </thead>
       <tbody>
       @foreach($dados_cartelas["linhas_cart_1"] as $nums)
           <tr class="bordered">
               @foreach($nums as $key => $n)
                   <?php
                   $cont2++;
                   if ($cont2 == 13)
                       echo '<td class="text-center bordered"><img src="https://cdn4.iconfinder.com/data/icons/geomicons/32/672342-circle-16.png"
                                    style="text-align: center; margin-top: -0.5px;"></td>';
                   ?>
                   <td class="text-center bordered">{{ $n }}</td>

               @endforeach
           </tr>
       @endforeach
       </tbody>
   </table>

   <table width="30%"  border="1" cellspacing="0" cellpadding="5" align="right" style="border: thin; border-style: solid;">
       <thead>
       <tr>
           <th>B</th>
           <th>I</th>
           <th>N</th>
           <th>G</th>
           <th>O</th>
       </tr>
       </thead>
       <tbody>
       @foreach($dados_cartelas["linhas_cart_1"] as $nums)
           <tr class="bordered">
               @foreach($nums as $key => $n)
                   <?php
                   $cont3++;
                   if ($cont3 == 13)
                       echo '<td class="text-center bordered"><img src="https://cdn4.iconfinder.com/data/icons/geomicons/32/672342-circle-16.png"
                                    style="text-align: center; margin-top: -0.5px;"></td>';
                   ?>
                   <td class="text-center bordered">{{ $n }}</td>

               @endforeach
           </tr>
       @endforeach
       </tbody>
   </table>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <!--cartela 2-->
    <hr>
    <section style="margin-top: 5%;">
        <small>Cartela: {{ $dados_cartelas["numero_cart_2"] }}</small>
        <img src="data:image/png;base64,{{ $dados_cartelas["barcode_cart2"] }}" alt="barcode" id="barcode-2" style="margin-top: 4.5%;">

        <h1 style="margin-top: -10%;">BINGO</h1>
        <h4 style="text-align: center; margin-top: -5%; font-size: 1.5rem;">Dia 6 de setembro a partir das 19:00 hrs</h4>
        <h6>Residência da Kaytinha</h6>
        <hr>

        <table id="dados-premios" width="100%">
            <tr>
                <th class="premio-01">1° prêmio</th>
                <th class="premio-02">2° prêmio</th>
                <th class="premio-03">3° prêmio</th>
            </tr>
            <tr>
                <th class="premio-01">Uma caixa de cerveja</th>
                <th class="premio-02">Uma caixa de cerveja e um frango assado</th>
                <th class="premio-03">Surpresa</th>
            </tr>
        </table>
        <table width="30%" border="1" cellspacing="0" cellpadding="5" align="center" style="border-collapse: collapse; margin-top: 0%;">
            <thead>
            <tr>
                <th>B</th>
                <th>I</th>
                <th>N</th>
                <th>G</th>
                <th>O</th>
            </tr>
            </thead>
            <tbody>
            @foreach($dados_cartelas["linhas_cart_2"] as $nums)
                <tr class="bordered">
                    @foreach($nums as $key => $n)
                        <?php
                        $cont4++;
                        if ($cont4 == 13)
                            echo '<td class="text-center bordered"><img src="https://cdn4.iconfinder.com/data/icons/geomicons/32/672342-circle-16.png"
                                    style="text-align: center; margin-top: -0.5px;"></td>';
                        ?>
                        <td class="text-center bordered">{{ $n }}</td>

                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>


        <table width="30%"  border="1" cellspacing="0" cellpadding="5" align="left" style="border: thin; border-style: solid; margin-top: -55%">
            <thead>
            <tr>
                <th>B</th>
                <th>I</th>
                <th>N</th>
                <th>G</th>
                <th>O</th>
            </tr>
            </thead>
            <tbody>
            @foreach($dados_cartelas["linhas_cart_2"] as $nums)
                <tr class="bordered">
                    @foreach($nums as $key => $n)
                        <?php
                        $cont5++;
                        if ($cont5 == 13)
                            echo '<td class="text-center bordered"><img src="https://cdn4.iconfinder.com/data/icons/geomicons/32/672342-circle-16.png"
                                    style="text-align: center; margin-top: -0.5px;"></td>';
                        ?>
                        <td class="text-center bordered">{{ $n }}</td>

                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>

        <table width="30%"  border="1" cellspacing="0" cellpadding="5" align="right" style="border: thin; border-style: solid;">
            <thead>
            <tr>
                <th>B</th>
                <th>I</th>
                <th>N</th>
                <th>G</th>
                <th>O</th>
            </tr>
            </thead>
            <tbody>
            @foreach($dados_cartelas["linhas_cart_2"] as $nums)
                <tr class="bordered">
                    @foreach($nums as $key => $n)
                        <?php
                        $cont6++;
                        if ($cont6 == 13)
                            echo '<td class="text-center bordered"><img src="https://cdn4.iconfinder.com/data/icons/geomicons/32/672342-circle-16.png"
                                    style="text-align: center; margin-top: -0.5px;"></td>';
                        ?>
                        <td class="text-center bordered">{{ $n }}</td>

                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>

    </section>

</body>
</html>