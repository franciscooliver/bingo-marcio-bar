<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container">
        <a class="navbar-brand text-light" href="#">Márcio bar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-light"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-uppercase text-light" href="{{ route('index') }}">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase text-light" href="{{ route('view_cad_cartela') }}">Cadastrar cartelas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase text-light" href="{{ route('premios') }}">Premiações</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase text-light" href="{{ route('gerarPdf') }}">Gerar cartelas</a>
                </li>
            </ul>
            <ul class="navbar-nav flex-row ml-md-auto d-md-flex">
                <li class="nav-item dropdown">
                    <a class="nav-item nav-link dropdown-toggle mr-md-2 text-light" href="#" id="bd-versions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        OPÇÕES
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
                        <a class="dropdown-item" href="{{ route('popular-tabela') }}">Popular tabela</a>
                        <a class="dropdown-item" href="{{ route('reset-db') }}">Resetar DB</a>
                        <a class="dropdown-item" href="{{ route('view-cad-premios') }}">Cadastrar prêmio</a>
                        <a class="dropdown-item" href="{{ route('reset-table-num-sort') }}">Reset table numbers sort</a>
                        <a class="dropdown-item" href="{{ route('reset-table') }}">Reset tabela de numeros</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
