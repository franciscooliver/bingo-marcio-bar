@extends('layouts.dashboard')

@section('title','- cadastro de prẽmios')

@section("content")
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-10 offset-md-1 col-sm-12">
                <h1 style="font-size: 6rem;">Márcio bar - bingo</h1>
                <h1>Data: {{ $datadiaria}} - prêmios </h1>

                @if(!empty($premios))
                <div class="card w-100 bg-info">
                    <div class="row m-1 ">
                        @foreach($premios as $premio)
                        <div class="card col-md-4 col-sm-12" style="width: 18rem;">
                            <div class="card-body ">
                                <h5 class="card-title text-info">{{ $premio->nome_premio }}</h5>
                                <h6 class="card-subtitle mb-2 text-black-50">{{ $premio->descricao_premio }}</h6>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection