@extends('layouts.dashboard')

@section('title','- principal')

@section("content")
    <div class="container mt-2 mb-5">
        <div class="row bg-info align-items-center">
            <div class="card col-12">
                <div class="card-body">
                   <h6 >Selecione abaixo os números da cartela</h6>
                    <p class="text-success">INFO:<span class="text-secondary"> Cartela deverá conter exatamente 24 números</span><br>
                        <span class="text-secondary">Para remover um número selecinado, click sobre ele</span></p>
                </div>
            </div>
            <div class="col-md-8 offset-md-2">
                <div class="responsive-table">
                    <table class="table" id="table_cad">
                        <thead>
                        </thead>
                        <tbody>
                        @foreach($array_view as $key => $nums)
                        <tr>
                                @if($key == 0)
                                    <th scope="row" class="text-center">B</th>
                                @elseif ($key==1)
                                    <th scope="row" class="text-center">I</th>
                                @elseif ($key==2)
                                    <th scope="row" class="text-center">N</th>
                                @elseif ($key==3)
                                    <th scope="row" class="text-center">G</th>
                                @elseif ($key==4)
                                    <th scope="row" class="text-center">O</th>
                                @endif

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
                        <h6 class="text-center" id="text-num_sel">Números selecionados</h6>
                        <p  id="retorno"></p>
                    </div>
                    <button type="button" class="btn btn-info  btn-sm col-4 offset-md-4 " id="btn_cad">Cadastrar cartela</button>
                </form>
            </div>
        </div>
    </div>
    @include("_includes.modal")<!--carrega modal-->
@endsection