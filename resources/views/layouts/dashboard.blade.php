<!doctype html>
<html lang="pt-br">
    <head>

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--css bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">

        <!--local import-->
        <script src="http://code.responsivevoice.org/responsivevoice.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="{{ asset('js/scripts_bingo.js') }}"></script>
        <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
        <link rel="stylesheet" href="{{ asset('css/hover.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
        <link href="{{asset('css/css_bingo.css')}}" rel="stylesheet" type="text/css">
        <title>Márcio bar @yield('title')</title>

    </head>
    <body>
        @include('_includes.nav')

        @yield('content')


        @include('_includes.footer')
            <!--modais-->
        @include("_includes.modal_confere_cartela")
        @include("_includes.modal_gerar_cartelas")
    <!--javascript e jquery--><!--jquery versao completa-->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

    </body>
</html>