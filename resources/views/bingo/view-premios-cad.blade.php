@extends('layouts.dashboard')

@section('title','- cadastro de prêmios')

@section("content")
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-4 text-center mt-5">
                <img src="{{ asset('img/bingo.jpg') }}">
            </div>
            <div class="col-md-6 offset-md-1">
                <form method="post" action="{{ route('add-premio') }}">
                    {{ csrf_field() }}
                    @include('_includes.alerts')
                    <div class="form-group">
                        <label for="nome_premio">Nome do prêmio</label>
                        <input type="text" class="form-control" id="nome_premio" aria-describedby="emailHelp" name="nome_premio" placeholder="Digite o prêmio">
                    </div>

                    <div class="form-group">
                        <label for="desc_premio">Descrição do prêmio</label>
                        <textarea class="form-control" name="descricao_premio" id="desc_premio" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="data_bingo">Data do bingo</label>
                        <input type="date" class="form-control" name="data_bingo" id="data_bingo" placeholder="Password">
                    </div>

                    <div class="form-group">
                        <label for="hora_inicio">Hora de início</label>
                        <input type="time" class="form-control" name="hora_inicio" id="hora_inicio" placeholder="Password">
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar prêmio</button>
                </form>
            </div>
        </div>
    </div>
@endsection