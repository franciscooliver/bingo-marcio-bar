<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container">
        <a class="navbar-brand text-light hvr-bounce-in" href="#">Márcio bingos</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-light"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-uppercase text-light hvr-underline-from-center" href="{{ route('index') }}">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase text-light hvr-underline-from-center" href="{{ route('view_cad_cartela') }}">Cadastrar cartelas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase text-light hvr-underline-from-center" href="{{ route('premios') }}">Premiações</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase text-light hvr-underline-from-center" href="{{ route('gerarPdf') }}" target="_blank">Imprimir cartelas</a>
                </li>
            </ul>
            <ul class="navbar-nav flex-row ml-md-auto d-md-flex">
                <li class="nav-item dropdown">
                    <a class="nav-item nav-link dropdown-toggle mr-md-2 text-light" href="#" id="bd-versions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        OPÇÕES
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
                        <a class="dropdown-item hvr-grow" href="#" id="btn_gerar_cart"  data-target="#modal_qtd" data-target="#modal_qtd">Gerar cartelas</a>
                        <a class="dropdown-item hvr-grow" id="btn_conferir"  href="#" data-toggle="modal" data-target="#modal">Conferir cartela</a>
                        <a class="dropdown-item hvr-grow" href="{{ route('view-cad-premios') }}">Cadastrar prêmio</a>
                        <a class="dropdown-item hvr-grow" href="{{ route('popular-tabela') }}" id="pop-table">Popular tabela</a>
                        <a class="dropdown-item hvr-grow" href="{{ route('reset-db') }}" id="reset-db">Resetar DB</a>
                        <a class="dropdown-item hvr-grow" href="{{ route('reset-table-num-sort') }}">Reset table numbers sort</a>
                        <a class="dropdown-item hvr-grow" href="{{ route('reset-table') }}">Reset table bingo</a>
                        <a class="dropdown-item hvr-grow" id="restaurarBingo"  href="#">Restaurar Bingo</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>


<script>
 $('#pop-table').click(function(){
     $("#preloader").show();
 })

 $('#reset-db').click(function(){
     $("#preloader").show();
 })
</script>
