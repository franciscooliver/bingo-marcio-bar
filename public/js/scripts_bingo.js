$(document).ready( function () {


    if($(window).width() <= 640){
        $("#table-responsive").addClass("table-responsive");
    }

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

    //array com os numeros ja sorteados

    //pegar os valores da td
    $(document).on("click","#sortear", function () {
        var dataNumero;
        var nums_chamados = [];
        $.ajax({
            type: 'GET',
            url: "sorteiaNumero",
            success: function(data)
            {
                dataNumero = data;
                //console.log(dataNumero);
                var numero_selecinado;
                var array = $("table tr td .ajax").toArray();
                var array_nums_chamds = $("table tr td .btn-danger").toArray();

                for(var i = 0; i < array_nums_chamds.length;i++){
                    nums_chamados.push($(array_nums_chamds[i]).html());
                }

                numero_selecinado = $(array[dataNumero-1]).html(); //recupera o valor do elemento dentro da table de acordo com o índice =>(número vindo do server)
                //console.log(dataNumero);
                //console.log(numero_selecinado);
                if(dataNumero === numero_selecinado && dataNumero != "" && $.inArray(dataNumero, nums_chamados) === -1){//verifica se o número sorteado é igual ao valor do indice selecionado

                    fundoBotao($("table tr td .btn-light").filter(function( index ) { /*filtra o elemento de acordo com o indice selecionado
                                                                                      e aplica a classe btn-danger */
                        return $( this ).attr( "id" ) === numero_selecinado;
                    }));

                    var chamados =  parseInt($("tr td .btn-danger").length);//retorna o qtd de numeros chamados (classe btn-danger é adicionada sempre que um número é sorteado)

                    $("#num-sorteado").html(dataNumero);

                    controlaChamados(chamados);
                    controlaRestantes(chamados);
                    //imprime a sequencia de numeros sorteados (os oito últimos)
                    imprimeNumsSorteados($("#"+numero_selecinado));

                }

            },

            error:function(jqXHR, textStatus, errorThrown){
                alert('Erro ao sortear número');
                chamados = (chamados) -1;
                console.log(errorThrown);
            }
        });


    });

    function fundoBotao( elemento) {
        $(elemento).removeClass("btn-light");
        $(elemento).addClass("btn-danger");
        $(".text-secondary").removeClass("text-secondary");
        $(this).removeClass("text-light");
        $(elemento).unbind("click");


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

        $(elemento)
            .clone()
            .appendTo($('#div_nums'))
            .removeClass("btn-danger")
            .addClass("btn-success","text-center",'btn-lg')
            .css({"margin-left":"5px","margin-top":"5px"})
            .attr("type","button");

        var tam_div = $("#div_nums .btn-success").length;
        //console.log(tam_div)

        //remove o primeiro botao da div sempre que o tamanho dela for maior que 8
        if(tam_div > 8){
            $("#div_nums .btn-success:first").remove();
        }
        
    }
    $("#verifica").click(function () {

        var tam_div_clonada = parseInt($("tbody tr td .btn-danger").clone().length);
        var controleDeNumeros = null;
        //console.log(controleDeNumeros)

        if(tam_div_clonada < 5){
            alert("Necessário selecionar no mínimo 5 números para comparação")
            //$("#modal-body").append("<h6 class='text-secondary'>Selecione mais números</h6>")

            $("#verifica").attr("data-target","#m");
        }else{
            //$(this).attr("data-target","#modal");
            if(parseInt($("#form .btn-danger").length) === 0){//se nao tiver nenhum elemento na div
                $("#verifica").attr("data-target","#modal");
                //clona os elementos selecionados
                $("td .btn-danger")
                    .clone()
                    .appendTo($('#form'))//coloca o elementos selecionados no modal
                    .css({"margin-left":"5px","margin-top":"5px"});//aplica um css ao elemento clonado

                $('#modal').modal('show');//exibe modal
                controleDeNumeros += $("#form .btn-danger").length;//seta variavel com a quantidade de numeros selecionados
            }else {
                if(controleDeNumeros != 0){//se a quantidade de numeros for diferente de zero remove
                    $("#form .btn-danger").remove();//adiciona novamente com a quantidade atualizada
                    $("td .btn-danger").
                        clone()
                        .appendTo($('#form'))
                        .css({"margin-left":"5px","margin-top":"5px"});
                }
                $('#modal').modal('show');
            }
        }

        //alert()

    })


});