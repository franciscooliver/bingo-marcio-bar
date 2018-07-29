$(document).ready( function () {
    //array com os numeros ja sorteados
    var dataNumero = [];
        //pegar os valores da td
        $(document).on("click",".ajax", function () {
            //pega o valor do id da td
            var numero = this.id ;
           
            $.ajax({
                headers: {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                },
                type: 'POST',
                url: '/salvarJogo',
                data: {
                   'numero':numero
                },
                success: function(data){
                    //retornar um array com objetos com todos os numeros salvo no banco
                    alert("Retorno teste: "+data);
                    dataNumero = data;
                },
                error: function (request, status, erro) {
                    alert("Problema ocorrido: " + status + "\nDescição: " + erro);
                    
                }
            });
  
            // divId.
        /* var col ="#"+divId+"_div";

            //focar em ema div e  rolar ela
            $('html, body').animate({
            scrollTop:$( col).offset().top
                },1000);*/

        });
    console.log($(window).width());
    if($(window).width() <= 640){
        $("div#table-responsive").addClass(".table-responsive");
    }

    $(".btn-light").click(function () {
        fundoBotao(this);
        imprimeNumsSorteados(this);
        //retorna o valor do botao clicado
        var valor =  $(this).attr("name");
        //console.log(valor);
        $("#num-sorteado").html(valor)
        controlaRestantes();
        //alert(pegarPreco);
        var chamados =  parseInt($("#chamados").html());
        controlaChamados(chamados);
    })

    function fundoBotao( elemento) {
        $(elemento).removeClass("btn-light");
        $(elemento).addClass("btn-danger");
        $(".text-secondary").removeClass("text-secondary");
        $(this).removeClass("text-light");
        $(elemento).unbind("click");


    }

    function controlaRestantes() {
        //retorna valor de numeros restantes
        var pegarPreco = parseInt($("#restantes").html());

        pegarPreco = (pegarPreco) -1;
        $("#restantes").html(pegarPreco);
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

    

    $(document).on("click","#envia_numeros", function () {
        //var teste = [12,45,48,68];
        
        //alert(dataNumero['numeros']);
        for(var i = 0;i<dataNumero.length;i++){
            console.log(dataNumero[i].numeros);

        }

       /* $.ajax({
            type: 'POST',
            url: 'verificaganhador',
            data: {
                '_token': $('input[name=_token]').val(),
               'numeros':teste
            },
            success: function(data){
                alert("Retorno teste: "+data.numeros);
            },
        */})

});