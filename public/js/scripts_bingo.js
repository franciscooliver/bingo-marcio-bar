$(document).ready( function () {


//tela index
    if($(window).width() <= 800){
        $(".responsive-table").addClass("table-responsive");
    }
    $("#info_cartela").hide();
    /*$(".btn-light").click(function () {
        fundoBotao(this);
        //imprimeNumsSorteados(this);
        //retorna o valor do botao clicado
        var valor =  $(this).attr("name");
        //console.log(valor);
        $("#num-sorteado").html(valor)
        controlaRestantes();
        //alert(pegarPreco);
        var chamados =  parseInt($("#chamados").html());
        controlaChamados(chamados);
    })*/

    //esconde letra numero
    $("#letra").hide();
    //pegar os valores da td
     $("#sortear").click(function () {

        var dataNumero;
        var nums_chamados = [];
        $.ajax({
            type: 'GET',
            url: "sorteiaNumero",
            dataType:'json',
            success: function(data)
            {

                dataNumero = data.numero_sorteado;

                //data igual a 0, a tabela do banco está zerada
                if(data.length != 0){


                    var numero_selecinado;
                    var array = $("table tr td .ajax").toArray();
                    var array_nums_chamds = $("table tr td .btn-danger").toArray();
    
                    for(var i = 0; i < array_nums_chamds.length;i++){
                        nums_chamados.push($(array_nums_chamds[i]).html());
                    }
    
                    numero_selecinado = $(array[dataNumero -1 ]).attr("id"); //recupera o valor do elemento dentro da table de acordo com o índice =>(número vindo do server)
                    //console.log(numero_selecinado);
                    if(dataNumero != "" && dataNumero == numero_selecinado){//verifica se o número sorteado é igual ao valor do indice selecionado

                       fundoBotao($("table tr td .btn-light").filter(function( index ) { /*filtra o elemento de acordo com o indice selecionado
                                                                                          e aplica a classe btn-danger */
                          return $( this ).attr( "id" ) === numero_selecinado;
                       }));
    
                        var chamados =  parseInt($("tr td .btn-danger").length);//retorna o qtd de numeros chamados (classe btn-danger é adicionada sempre que um número é sorteado)


                        //exibe a letra da sequencia da qual o numero sorteado pertence
                        if(dataNumero >=1 && dataNumero <= 15)
                            $("#letra").show().html("B");
                            $("#num-sorteado").html(dataNumero);
                        if(dataNumero >=16 && dataNumero <= 30)
                            $("#letra").show().html("I");
                            $("#num-sorteado").html(dataNumero);
                        if(dataNumero >=31 && dataNumero <= 45)
                            $("#letra").show().html("N");
                            $("#num-sorteado").html(dataNumero);
                        if(dataNumero >=46 && dataNumero <= 60)
                            $("#letra").show().html("G");
                            $("#num-sorteado").html(dataNumero);
                        if(dataNumero >=61 && dataNumero <= 75)
                            $("#letra").show().html("O");
                            $("#num-sorteado").html(dataNumero);
    
                        controlaChamados(chamados);
                        controlaRestantes(chamados);
                        //imprime a sequencia de numeros sorteados (os oito últimos)
                        imprimeNumsSorteados($("#"+numero_selecinado));

                        //console.log(data.ganhadores.length);

                            $("#info_cartela").show();
                            var dataN = [];
                            var numero;
                        for (var i = 0; i < data.ganhadores.length; i++) {
                                dataN.push(data.ganhadores[i].numero_cartela);

                        }
                        setaValorCartelas(dataN,data.cont_cartela);

                    }
                }else{
                    alert('Acabou o bingo');
                }

            },

            error:function(jqXHR, textStatus, errorThrown){
                alert('Erro ao sortear número');
                chamados = (chamados) -1;
                console.log(errorThrown);
            }
        });

    });

     function setaValorCartelas(num_cartelas, cont_cartela) {

         $("#div_cartelas .info_cartela .number-cart").html("");//remove a div que contem os numeros

         //console.log(array_elementos)
         for(var a=0;a < num_cartelas.length; a++){

             $(".number-cart").append(num_cartelas[a]+", ");//adiciona a div com os numeros
         }

         $("#qtd").html("("+num_cartelas.length+")")//seta quantidade de possíveis ganhadores
             .css({"font-size":"1rem"});
         //console.log(num_cartelas)

         if(cont_cartela == 24)
             alert("Ganhador(s): "+num_cartelas)
     }


    //tela cad cartelas

    $(document).on("click",".num_cartela", function (event) {
        event.preventDefault()

        valida_selecao_numeros(this);//chama a funcao de validacao

    });
    function valida_selecao_numeros(elemento){//funcao responsável por validar a sequencia de numeros selecionados
        var array_numeros_selecinados = $("form #card_nums_selecionados .btn-success").toArray();
        var arraylinhaB = [];//array para os numeros linha B
        var arraylinhaI = [];//array para os numeros linha I
        var arraylinhaN = [];//array para os numeros linha N
        var arraylinhaG = [];//array para os numeros linha G
        var arraylinhaO = [];//array para os numeros linha O

        var numero = $(elemento).attr('name');
        //alert(button);
        //var array_elementos = $('#card_nums_selecionados .btn-light').toArray();

        if ( numero >= 1 && numero <= 15) {//verifica se numero selecionado está no intervalo entre 1 - 15

            if(array_numeros_selecinados.length >= 5){//verifica se já foram selecionados todos os números da linha B

                alert("Você já escolheu o máximo de números para a linha B \n" +
                    "Por favor vá para a próxima linha")
                $(elemento).removeClass("btn-danger")

            }else{


                fundoBotao(elemento);
                clonaBotaoClicado($(elemento).attr('name',numero));
                var array_danger = $("#table_cad tr td .btn-danger").toArray();
                var ids_B = ["b_1","b_2","b_3","b_4","b_5"];

                for (var i=0; i< array_danger.length; i++){
                    arraylinhaB.push($(array_danger[i]).html());

                   arraylinhaB = arraylinhaB.sort(sortfunction)
                    populaCartela(ids_B, arraylinhaB);
                }

            }


        }else if(numero > 15 && array_numeros_selecinados.length < 5){
            alert("Número não permitido na sequência de B")
        }

        //validacao linha I
        if(numero >= 16 && numero <= 30 && array_numeros_selecinados.length >= 5){


            if(array_numeros_selecinados.length >= 10){//verifica se já foram selecionados todos os números da linha B

                alert("Você já escolheu o máximo de números para a linha I \n" +
                    "Por favor vá para a próxima linha")
                $(elemento).removeClass("btn-danger")

            }else{
                fundoBotao(elemento);
                clonaBotaoClicado($(elemento).attr('name',numero));
                var array_danger = $("#table_cad tr td .btn-danger").toArray();
                var ids_I = ["i_1","i_2","i_3","i_4","i_5"];

                for (var i=5; i< array_danger.length; i++){
                    arraylinhaI.push($(array_danger[i]).html());
                    arraylinhaI = arraylinhaI.sort(sortfunction)
                    populaCartela(ids_I, arraylinhaI)

                }

            }

        }else{
            if(array_numeros_selecinados.length >= 5 && array_numeros_selecinados.length < 10 && numero > 30){
                alert("Numero fora da sequência de I")
            }
        }

        //validação linha N
        if(numero >= 31 && numero <= 45 && array_numeros_selecinados.length >= 10){


            if(array_numeros_selecinados.length >= 14){//verifica se já foram selecionados todos os números da linha B

                alert("Você já escolheu o máximo de números para a linha N \n" +
                    "Por favor vá para a próxima linha")
                $(elemento).removeClass("btn-danger")

            }else{

                fundoBotao(elemento);
                clonaBotaoClicado($(elemento).attr('name',numero));
                var array_danger = $("#table_cad tr td .btn-danger").toArray();
                var ids_N = ["n_1","n_2","n_3","n_4"];

                for (var i=10; i< array_danger.length; i++){
                    arraylinhaN.push($(array_danger[i]).html());
                    arraylinhaN = arraylinhaN.sort(sortfunction)//ordena array
                    populaCartela(ids_N, arraylinhaN)

                }

            }

        }else{
            if(array_numeros_selecinados.length >= 10 && array_numeros_selecinados.length < 14 && numero > 45){
                alert("Numero fora da sequência de N")
            }
        }

        //valida linha G
        if(numero >= 46 && numero <= 60 && array_numeros_selecinados.length >= 14){


            if(array_numeros_selecinados.length >= 19){//verifica se já foram selecionados todos os números da linha B

                alert("Você já escolheu o máximo de números para a linha G \n" +
                    "Por favor vá para a próxima linha")


            }else{

                fundoBotao(elemento);
                clonaBotaoClicado($(elemento).attr('name',numero));
                var array_danger = $("#table_cad tr td .btn-danger").toArray();
                var ids_G = ["g_1","g_2","g_3","g_4","g_5"];

                for (var i=14; i< array_danger.length; i++){
                    arraylinhaG.push($(array_danger[i]).html());
                    arraylinhaG = arraylinhaG.sort(sortfunction)
                    populaCartela(ids_G, arraylinhaG);
                }
                //console.log(array_linhaG)


            }

        }else{
            if(array_numeros_selecinados.length >= 14 && array_numeros_selecinados.length < 19 && numero > 60){
                alert("Número fora da sequência de G")
            }
        }

        //valida linha O
        if(numero >= 61 && numero <= 75 && array_numeros_selecinados.length >= 19){

            if(array_numeros_selecinados.length >= 24){//verifica se já foram selecionados todos os números da linha B

                alert("Você já selecionou o todos os números para essa cartela\n" +
                    "Verifique os números selecionados e clique em (Cadastrar cartela)")
                $(elemento).removeClass("btn-danger")

            }else{

                fundoBotao(elemento);
                clonaBotaoClicado($(elemento).attr('name',numero));
                var array_danger = $("#table_cad tr td .btn-danger").toArray();
                var ids_O = ["o_1","o_2","o_3","o_4","o_5"];

                for (var i=19; i< array_danger.length; i++){
                    arraylinhaO.push($(array_danger[i]).html());
                    populaCartela(ids_O, arraylinhaO);
                }
            }

        }

    }


    function sortfunction(a, b){
        return (a - b) //faz com que o array seja ordenado numericamente e de ordem crescente.
    }


    function populaCartela(ids, numeros){
      for (var i=0; i< ids.length; i++){
          $("#"+ids[i]).html(numeros[i]);
          $("#"+ids[i]).addClass('limpa')
      }

    }

    $(document).on("click", "#btn_cad", function (event) {
        event.preventDefault();

        var array_elementos_selecionados = $("form #card_nums_selecionados .btn-success").toArray();
        var numeros_cartela = []

        for(var i=0; i< array_elementos_selecionados.length;i++){
            numeros_cartela.push($(array_elementos_selecionados[i]).html());

        }

        if(numeros_cartela.length != 24 ){//verifica se  a quantidade de números é diferente de 24
            alert("A cartela deverá conter exatamente 24 números!!!\n" +
                "Quantidade de números selecionados: ( "+numeros_cartela.length+" )")
        }else{
            numeros_cartela.sort(sortfunction)
            console.log(numeros_cartela)
            enviaDadosBackEnd(numeros_cartela);
            $(".col-md-4 table tr .limpa").html("")

        }
        //console.log(array_elementos_selecionados);

    });


    function clonaBotaoClicado(button) {
        $(button)
            .clone()
            .appendTo($('#card_nums_selecionados'))
            .removeClass("btn-danger")
            .removeClass('num_cartela')
            .addClass("btn btn-success","text-center",'btn-lg')
            .css({"margin-left":"5px","margin-top":"5px","display":"none"})

    }

    function enviaDadosBackEnd(array_numeros) {
        $.ajax({
            url: 'addCartela',
            type: 'POST',
            dataType:'json',
            data:{
                '_token': $('input[name=_token]').val(),
                'numeros':array_numeros,
                'numero_cart': $('input[name=numero_cart]').val()
        },
            success:function (data) {
                console.log(data.mensagem);
                if(data.retorno_bd.status){
                    $("#retorno_success").html(data.mensagem);
                }else {
                    $("#retorno_error").html("Erro ao cadastrar cartela");
                }

            }
        });
    }

    //fim tela cad cartelas


    function fundoBotao( elemento) {
        $(elemento).removeClass("btn-light");
        $(elemento).addClass("btn-danger");
        $(".text-secondary").removeClass("text-secondary");
        $(elemento).addClass("text-light");
        $(elemento).unbind("click");

        //$(elemento).css({'color':'#fff'});


    }

    function controlaRestantes(chamados) {
        //retorna valor de numeros restantes
        restantes = 75 - chamados;

        $("#restantes").html(restantes);
    }

    function controlaChamados(chamados) {
        var chamados = chamados;

       $("#chamados").html(chamados);
    }

    //$(this).slideDown("slow");
    
    function imprimeNumsSorteados(elemento) {
        var numero = elemento.html();

        $(elemento)
            .clone()
            .appendTo($('#div_nums'))
            .removeClass("btn-danger")
            .addClass("btn-success","text-center",'btn-lg')
            .css({"margin-left":"5px","margin-top":"5px"})
            .attr("type","button")

        var tam_div = $("#div_nums .btn-success").length;
        //console.log(tam_div)

        //remove o primeiro botao da div sempre que o tamanho dela for maior que 8
        if(tam_div > 10){
            $("#div_nums .btn-success:first").remove();
        }

    }

    $("#restaurarBingo").click(function () {
      //  alert("Teste btn bingo");
        var numeroBackup;
        var nums_chamados = [];
        $.ajax({
            type: 'GET',
            url: "restaurarBingo",
            dataType:'json',
            success: function(data)
            {

                numeroBackup = data;
                console.log(numeroBackup[0].numero);
                //data igual a 0, a tabela do banco está zerada
                if(data.length != 0){
                    console.log("teste");

                    var numero_selecinado;
                    var array = $("table tr td .ajax").toArray();
                    var array_nums_chamds = $("table tr td .btn-danger").toArray();
    
                    for(var i = 0; i < array_nums_chamds.length;i++){
                        nums_chamados.push($(array_nums_chamds[i]).html());
                    }
    
                     //console.log(numero_selecinado);
                    for(var n =0; n < numeroBackup.length;n++){
                    if(numeroBackup[n].numero == numero_selecinado[n]){//verifica se o número sorteado é igual ao valor do indice selecionado
                        console.log("teste2");
                        numero_selecinado = $(array[numeroBackup[n].numero ]).attr("id"); //recupera o valor do elemento dentro da table de acordo com o índice =>(número vindo do server)
                 
                        fundoBotao($("table tr td .btn-light").filter(function( index ) { /*filtra o elemento de acordo com o indice selecionado
                            e aplica a classe btn-danger */
                          return $( this ).attr( "id" ) === numero_selecinado;
                        }));
                      }
                           
                      }
                }else{
                    alert('Impossivel recuperar o Bingo');
                }

            } 
    });
});
});

