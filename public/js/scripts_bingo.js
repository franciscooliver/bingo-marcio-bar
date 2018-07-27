$(document).ready( function () {

    console.log($(window).width());
    if($(window).width() <= 360){
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
            .addClass("btn-success","text-center")
            .css({"margin-left":"5px","margin-top":"5px"});


    }

});