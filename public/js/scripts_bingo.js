$(document).ready( function () {

    if($(window).width() <= 900){
        $(".responsive-table").addClass("table-responsive");
    }

    $("#info_cartela").hide();
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
    
                    for(var i = 0; i < array_nums_chamds.length; i++){
                        nums_chamados.push($(array_nums_chamds[i]).html());
                    }

                    numero_selecinado = $(array[dataNumero -1 ]).attr("id"); //recupera o valor do elemento dentro da table de acordo com o índice =>(número vindo do server)
                    //console.log(numero_selecinado);
                    if(dataNumero != "" && dataNumero == numero_selecinado) {//verifica se o número sorteado é igual ao valor do indice selecionado
                       fundoBotao($("table tr td .btn-light").filter(function( index ) { /*filtra o elemento de acordo com o indice selecionado
                                                                                          e aplica a classe btn-danger */
                          return $( this ).attr( "id" ) === numero_selecinado;
                       }));

                        var chamados = parseInt($("tr td .btn-danger").length);//retorna o qtd de numeros chamados (classe btn-danger é adicionada sempre que um número é sorteado)
                        setLetraNumSorteado(dataNumero);
                        controlaChamados(chamados);
                        controlaRestantes(chamados);

                        //imprime a sequencia de numeros sorteados (os oito últimos)
                        imprimeNumsSorteados($("#"+numero_selecinado));

                        //console.log(data.ganhadores.length);

                        $("#info_cartela").show();
                        var dataN = [];
                        for (var i = 0; i < data.ganhadores.length; i++) {
                                dataN.push(data.ganhadores[i].numero_cartela);
                        }
                        console.log(dataN);
                        setaValorCartelas(dataN,dataNumero,data.cont_cartela);
                    }

                }else{
                    alert('Sem numeros para sortear');
                }
            },
            error:function(jqXHR, textStatus, errorThrown){
                alert('Erro ao sortear número');
                chamados = (chamados) -1;
                console.log(errorThrown);
            }
        });
    });

     
    //adicionar a letra ao numero sorteado
    function setLetraNumSorteado(dataNumero){
            //exibe a letra da sequencia da qual o numero sorteado pertence
            if (dataNumero >= 1 && dataNumero <= 15) {
                $("#letra").show().html("B");
                $("#num-sorteado").html(dataNumero);
            }
            if (dataNumero >= 16 && dataNumero <= 30) {
                $("#letra").show().html("I");
                $("#num-sorteado").html(dataNumero);

            }

            if (dataNumero >= 31 && dataNumero <= 45) {

                $("#letra").show().html("N");
                $("#num-sorteado").html(dataNumero);

            }

            if(dataNumero >=46 && dataNumero <= 60) {
                $("#letra").show().html("G");
                $("#num-sorteado").html(dataNumero);
            }

            if(dataNumero >=61 && dataNumero <= 75) {
                $("#letra").show().html("O");
                $("#num-sorteado").html(dataNumero);
            }

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
        $(elemento).addClass("animated rollIn delay-0.5s");
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
 
//Acão do btn que restaura os dados do bingo
    $("#restaurarBingo").click(function () {
      //  alert("Teste btn bingo");
        var numeroBackup;
        var nums_chamados = [];
        var ultimo_numero_sorteado;
        $.ajax({
            type: 'GET',
            url: "restaurarBingo",
            dataType:'json',
            success: function(data)
            {

                numeroBackup = data.numero_sorteado;
               // console.log(numeroBackup[0].numero);
                
                if(numeroBackup.length != 0){
                    
                    var numero_selecinado;
                    var array = $("table tr td .ajax").toArray();
                    var array_nums_chamds = $("table tr td .btn-danger").toArray();
    
                    for(var i = 0; i < array_nums_chamds.length;i++){
                        nums_chamados.push($(array_nums_chamds[i]).html());
                    }
                     //console.log(numero_selecinado);
                    for(var n =0; n < numeroBackup.length;n++){
                    numero_selecinado = $(array[numeroBackup[n].numero -1 ]).attr("id"); //recupera o valor do elemento dentro da table de acordo com o índice =>(número vindo do server)
                    
                        if(numeroBackup[n].numero == numero_selecinado){//verifica se o número sorteado é igual ao valor do indice selecionado
                            
                        
                            fundoBotao($("table tr td .btn-light").filter(function( index ) { /*filtra o elemento de acordo com o indice selecionado
                                e aplica a classe btn-danger */
                            return $( this ).attr( "id" ) === numero_selecinado;
                            }));
                        }
                         //imprime a sequencia de numeros sorteados (os oito últimos)
                         imprimeNumsSorteados($("#"+numero_selecinado));
                            
                      }
                      //exibir numeros restantes
                      controlaRestantes(numeroBackup.length);
                      //exibir a qdt de numeros chamados
                      controlaChamados(numeroBackup.length);
                      //seta o ultimo numero chamado
                      ultimo_numero_sorteado = numeroBackup[numeroBackup.length -1].numero;
                      //restaura a letra do ultimo numero sorteado
                      setLetraNumSorteado(ultimo_numero_sorteado);
                    //  alert(ultimo_numero_sorteado)
                      $("#num-sorteado").html(ultimo_numero_sorteado);
                     
                      var dataN = [];
                      var numero;
                      
                    for (var i = 0; i < data.ganhadores.length; i++) {
                            dataN.push(data.ganhadores[i].numero_cartela);

                    }
                    //setaValorCartelas(dataN,numeroBackup,data.cont_cartela);

                }else{
                    alert('Impossivel recuperar o Bingo');
                }

            } 
    });
});

    function setaValorCartelas(num_cartelas, num_chamado, cont_cartela) {

        $("#div_cartelas .info_cartela .number-cart").html("");//remove a div que contem os numeros

        console.log(cont_cartela < 10)
        if(cont_cartela < 10 ){
            
                $(".number-cart").append("<span style='font-size:1rem;'>A PARTIR DE 10 PONTOS, O NÚMEROS DAS CARTELAS SERÃO EXIBIDOS AQUI.<br> PONTOS: "+cont_cartela+" PONTOS<b><span/>"); 

        }else if(cont_cartela >=10 ){
            //for(var a=0;a < num_cartelas.length; a++){

                $(".number-cart").append(num_cartelas.join(', '));//adiciona a div com os numeros
            //}
        }

        //$(".number-cart").append("<span style='font-size:1.2rem;' class='text-danger'>Não possui cartelas cadastradas no sistema<span/>"); 


        $("#qtd").html("("+num_cartelas.length+")")//seta quantidade de possíveis ganhadores
            .css({"font-size":"1rem"});
        //console.log(num_cartelas)

    
        //exibe os ganhadores
        if(cont_cartela == 24)
            alert("Ganhador(s): "+num_cartelas+"\n"
            +"Número da sorte: "+num_chamado)

    }

    $(document).on("click", "#btn_conferir", function (event) {
        event.preventDefault()

        retornaNumerosSorteados();
    })

    $(document).on("click", "#btn_gerar_cart", function(){
        $("#modal_qtd").modal();
    });

    function retornaNumerosSorteados() {
        $.ajax({
            url:'confereCartela',
            type:'GET',
            dataType:'json',
            success:function (data) {

                for (var i=0;i< data.length;i++){
                    console.log(data[i].numero)
                }
                
                setaModal(data)
                $('#modal').modal();

            },
            error:function(jqXHR, textStatus, errorThrown) {
                alert('Erro ao retornar numeros de conferência');
                console.log(errorThrown);
            }
        })
    }

    function setaModal(data) {
        var numerosB = [];
        var numerosI = [];
        var numerosN = [];
        var numerosG = [];
        var numerosO = [];
        

        for (var i=0;i< data.length;i++){


            if(parseInt(data[i].numero) <= 15){

                numerosB.push( data[i].numero )
                numerosB.sort(sortfunction);
                $("#numerosB").html("( "+numerosB.join(" - ")+" )")
            }

            if(data[i].numero >= 16 && data[i].numero <= 30){
                numerosI.push(data[i].numero)
                numerosI.sort(sortfunction);
                $("#numerosI").html("( "+numerosI.join(" - ")+" )")
            }

            if(data[i].numero >= 31 && data[i].numero <= 45){
                numerosN.push(data[i].numero)
                 numerosN.sort(sortfunction);
                $("#numerosN").html("( "+numerosN.join(" - ")+" )")
            }


            if(data[i].numero >= 46 && data[i].numero <= 60){
                numerosG.push(data[i].numero)
                 numerosG.sort(sortfunction);
                $("#numerosG").html("( "+numerosG.join(" - ")+" )")
            }

            if(data[i].numero >= 61 && data[i].numero <= 75){
                numerosO.push(data[i].numero)
                 numerosO.sort(sortfunction);
                $("#numerosO").html("( "+numerosO.join(" - ")+" )")
            }


        }

        if(data.length == 0) {
            $("#modal-body h4").hide()
            $("#modal-body p:first").html("Nenhum numero sorteado até o momento").addClass("text-danger")
        }

    }
    $(document).on("click", "#btn_gerar_cart", function(){

        $("#modal_qtd").modal();
    });
    $("#btn_enviar").click( function () {
        $('#msg-retorno').html("Aguarde gerando cartelas...")
            .removeClass()
            .addClass('text-secondary')
             enviaQtd()
    })


function enviaQtd() {
   $.ajax({
       url: "gerar_cartela",
       type:"POST",
       dataType:"json",
       data:{
           '_token': $('input[name=_token]').val(),
           'qtd': $('input[name=qtd]').val()
       },
       success: function (data) {
               $('#msg-retorno')
                   .html(data.mensagem)
                   .removeClass('text-secondary')
                   .addClass(data.classe)
       }
   });
}
});

