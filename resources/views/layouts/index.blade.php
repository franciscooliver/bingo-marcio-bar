@extends('layouts.dashboard')

@section('title','- principal')

@section("content")
    @include('_includes.alerts')
    <div class="container mt-2 mb-5">
        <div class="row bg-info">
            <div class="col-md-5 text-center">
                <p class="text-light" id="text-lg">Qtd. números restantes: <span id="restantes" class="text-success bg-light p-1">{{$size_array}}</span></p>
                <p class="text-light" id="text-lg">Qtd. números chamados: <span id="chamados" class="text-info bg-light p-1">0</span></p>
                <div class="card  mb-3 w-100" style="width: 18rem;">
                    <span class="text-center mt-3">Último número chamado</span>
                    <div class="card-body mt-0">
                        <span id="letra" style="font-size: 5rem;" class="text-center mt-0"></span><h1 style="font-size: 13rem;" class="text-danger" id="num-sorteado">--</h1>
                    </div>
                </div>

                <div class="card  mb-2 w-100" style="width: 18rem;">
                    <span class="text-center mt-0">Últimos números sorteados</span>

                    <div class="card-body mt-0" id="div_nums">
                        <!--aqui serão exibidos os últimos 10 números sorteados-->
                    </div>
                </div>
            </div>
            <div class="col-md-7 ">
                <div class="responsive-table">
                    <table class="mt-0">
                        <tbody>
                          {{ csrf_field() }}

                        @foreach($numeros as $nums)
                            <tr class="text-light text-center">
                            @foreach($nums as $numero)
                                @if($numero <= 15)
                                    <td class="p-1 "><button type="submit" id="{!! $numero !!}" class="btn btn-light text-secondary ajax" name="{{ $numero }}">{{ "B ".$numero}}</button></td>
                                    @endif
                                @if($numero >= 16 && $numero <= 30)
                                    <td class="p-1 "><button type="submit" id="{!! $numero !!}" class="btn btn-light text-secondary ajax" name="{{ $numero }}">{{ "I ".$numero}}</button></td>
                                @endif
                                @if($numero >= 31 && $numero <= 45)
                                    <td class="p-1 "><button type="submit" id="{!! $numero !!}" class="btn btn-light text-secondary ajax" name="{{ $numero }}">{{ "N ".$numero}}</button></td>
                                @endif
                                @if($numero >= 46 && $numero <= 60)
                                    <td class="p-1 "><button type="submit" id="{!! $numero !!}" class="btn btn-light text-secondary ajax" name="{{ $numero }}">{{ "G ".$numero}}</button></td>
                                @endif
                                @if($numero >= 61 && $numero <= 75)
                                    <td class="p-1 "><button type="submit" id="{!! $numero !!}" class="btn btn-light text-secondary ajax" name="{{ $numero }}">{{ "O ".$numero}}</button></td>
                                @endif
                            @endforeach
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <div class="card  mb-2 w-100 mt-2"  style="width: 18rem;">
                        <span class="text-center mt-0">Possível(s) ganhador(s) <small id="qtd"></small></span>

                        <div class="card-body mt-0" id="div_cartelas"><!--onde serao inseridos os numeros das cartelas-->
                            <p class="info_cartela" style="font-size: 2.2rem;">N°: <span class="text-dark number-cart" style="padding: 5px"></span></p>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-lg btn-block btn-outline-light mb-1 " data-toggle="modal" data-target="#" id="sortear">Sortear número</button>
                </div>
            </div>
        </div>
    </div>

@endsection