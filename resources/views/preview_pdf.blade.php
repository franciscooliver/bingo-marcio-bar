<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Certificado Digital</title>
    <style>
      header{
          padding: 0;
          margin: 0;
      }
        h1{font-size: 3rem; text-align: center;}
        h4{font-size: 2.2rem; margin-top: -30px; text-align: center;}
        h6{font-size: 1.5rem; text-align: center; margin-top: -30px;}
        /*DESCRICAO PREMIOS*/

        #dados-premios .premio-01{font-size: 20px; border: none; text-align: left; padding: 5px 0; width: 22%;}
        #dados-premios .premio-02{font-size: 20px; border: none; text-align: left; padding: 5px 0;}
        #dados-premios .premio-03{font-size: 20px; border: none; text-align: left;}
        /*TABLE*/

        table tr th{border: 0px; text-align: center; font-size: 2rem; width: 20%;}
        table tr td{border: 1px solid #1e88e5;text-align: center; font-size: 1.5rem;}
        table tr th:nth-child(1){border-left: 1px solid #1e88e5; border-top: 1px solid #1e88e5; }
        table tr th:nth-child(2){border-top: 1px solid #1e88e5; }
        table tr th:nth-child(3){border-top: 1px solid #1e88e5; }
        table tr th:nth-child(4){border-top: 1px solid #1e88e5; }
        table tr th:nth-child(5){border-top: 1px solid #1e88e5;border-right: 1px solid #1e88e5; }

    </style>
</head>
<body>

   <header>
       <h1>BINGO</h1>
       <h4>Dia 6 de setembro a partir das 19:00 hrs</h4>
       <h6>Residência da kaytinha</h6>
       <hr>
   </header>
            <table id="dados-premios" width="100%">
                <tr>
                    <th class="premio-01">1° prêmio</th>
                    <th class="premio-02">2° prêmio</th>
                    <th class="premio-03">3° prêmio</th>
                </tr>
                <tr>
                    <th class="premio-01">1 caixa de cerveja</th>
                    <th class="premio-02">1 caixa de cerveja e um frango assado</th>
                    <th class="premio-03">1 caixa de cerveja</th>
                </tr>
            </table>
            <table width="30%" class="bordasimples" border="1" cellspacing="0" cellpadding="5" align="center" style="border-collapse: collapse;">
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
                @foreach($array_div as $num)
                    <tr class="bordered">
                        @foreach($num as $n)
                            <td class="text-center">{{ $n }}</td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>


   <table width="30%" class="bordasimples" border="1" cellspacing="0" cellpadding="5" align="left" style="border: thin; border-style: solid; margin-top: -25%">
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
       @foreach($array_div as $num)
           <tr class="bordered">
               @foreach($num as $n)
                   <td class="text-center bordered">{{ $n }}</td>
               @endforeach
           </tr>
       @endforeach
       </tbody>
   </table>

   <table width="30%" class="bordasimples" border="1" cellspacing="0" cellpadding="5" align="right" style="border: thin; border-style: solid;">
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
       @foreach($array_div as $num)
           <tr class="bordered">
               @foreach($num as $n)
                   <td class="text-center bordered">{{ $n }}</td>
               @endforeach
           </tr>
       @endforeach
       </tbody>
   </table>
</body>
</html>