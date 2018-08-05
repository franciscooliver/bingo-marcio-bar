<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container">
        <a class="navbar-brand text-light" href="#">Márcio bar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-uppercase text-light" href="{{ route('index') }}">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase text-light" href="{{ route('cadcartela') }}">Cadastrar cartelas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase text-light" href="#">Premiações</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase text-light" href="#">Gerar cartelas</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
