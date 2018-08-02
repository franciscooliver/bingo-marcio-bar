$(document).ready( function () {

    console.log($(window).width());
    if($(window).width() <= 640){
        $("div#table-responsive").addClass(".table-responsive");
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
    var dataNumero = [];
    //pegar os valores da td
    $(document).on("click","#sortear", function () {

        $("")

        $.ajax({
            type: 'GET',
            url: "sorteiaNumero",
            dataType:"json",
            success: function(data)
            {
                dataNumero = data;
                console.log("Numero sorteado ="+dataNumero);

                for(var i=1 ;i< $("table tr td").length;i++){
                    var numero_selecinado = $("table tr td .btn-light").eq(i).attr("name");

                    if (dataNumero == numero_selecinado){
                        console.log("numero selecionado ="+numero_selecinado);
                        //o erro esta aqui nessa função ele ta passando com um numero a mais
                        //porém se deixar o -1 resolve
                       fundoBotao($("table tr td .btn-light").eq(numero_selecinado-1));
                    }
                }


            },
            error:function(jqXHR, textStatus, errorThrown){
                alert('Erro ao sortear número');
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

    function controlaRestantes() {
        //retorna valor de numeros restantes
        var restantes = parseInt($("#restantes").html());

        restantes = (restantes) -1;
        $("#restantes").html(restantes);
    }

    function controlaChamados(chamados) {
        var chamados = chamados;

        chamados = (chamados) + 1;

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