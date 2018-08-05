@extends('layouts.dashboard')

@section('title','- principal')

@section("content")
    <div class="container mt-2 mb-5">
        <div class="row bg-info align-items-center">
            <div class="card col-12">
                <div class="card-body">
                   <h6 >Clique nos números para cadastrar uma cartela</h6>
                    <p class="text-success">INFO:<span class="text-secondary"> Cartela deverá conter exatamente 24 números</span></p>
                </div>
            </div>
            <div class="col-md-8 offset-md-2">
                <div class="responsive-table">
                    <table class="table" id="table_cad">
                        <thead>
                        </thead>
                        <tbody>
                        @foreach($array_view as $nums)
                        <tr>
                            @foreach($nums as $num)
                                <td class="p-0 ml-0"><a class="btn btn-light ml-1 num_cartela" name="{{ $num }}">{{ $num }}</a></td>
                            @endforeach
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card col-12">
                <form >
                    {{ csrf_field() }}
                    <div class="card-body" id="card_nums_selecionados">
                        <h6 class="text-center">Números selecionados</h6>
                        <p  id="retorno"></p>
                    </div>
                    <button type="button" class="btn btn-info  btn-sm col-4 offset-md-4 " id="btn_cad">Cadastrar cartela</button>
                </form>
            </div>
        </div>
    </div>
    @include("_includes.modal")<!--carrega modal-->
@endsection