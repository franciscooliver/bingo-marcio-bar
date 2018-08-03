@extends('layouts.dashboard')

@section('title','- principal')

@section("content")
    <div class="container mt-2 mb-5">
        <div class="row bg-info">
            <div class="col-md-5 text-center">
                <p class="text-light" id="text-lg">Qtd. números restantes: <span id="restantes" class="text-success bg-light p-1">{{$size_array}}</span></p>
                <p class="text-light" id="text-lg">Qtd. números chamados: <span id="chamados" class="text-info bg-light p-1">0</span></p>
                <div class="card  mb-3 w-100" style="width: 18rem;">
                    <span class="text-center mt-3">Último número chamado</span>
                    <div class="card-body mt-0">
                        <h1 style="font-size: 13rem;" class="text-danger" id="num-sorteado">--</h1>
                    </div>
                </div>
                <button type="submit" class="btn btn-lg btn-block btn-outline-light mb-1 " data-toggle="modal" data-target="#" id="sortear">sortear número</button>
                <button class="btn btn-lg btn-block btn-outline-light mb-3 " id="final">Finalizar bingo</button>
            </div>

            <div class="col-md-1"></div>
            <div class="col-md-6 ">
                <div id="table-responsive">
                    <table class="mt-2">
                        <tbody>
                          {{ csrf_field() }}
                        @foreach($numeros as $nums)
                            <tr class="text-light text-center">
                            @foreach($nums as $numero)

                                <td class="p-1 " ><button type="submit" id="{!! $numero !!}" class="btn btn-light text-secondary ajax" name="{{ $numero }}">{{ $numero}}</button></td>

                            @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                        </tbody>
                    </table>
                    <div class="card  mb-2 w-100" style="width: 18rem;">
                        <span class="text-center mt-0">Últimos números sorteados</span>
                        <div class="card-body mt-0" id="div_nums">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("_includes.modal")<!--carrega modal-->
@endsection