@extends('layouts.dashboard')

@section('title','- principal')

@section("content")
    <div class="container mt-2 mb-5">
        <div class="row bg-info">
            <div class="col-md-4 text-center">
                <p class="text-light" id="text-lg">Números restantes: -20-</p>
                <div class="card  mb-3 w-100" style="width: 18rem;">
                    <div class="card-body">
                        <h1 style="font-size: 13rem;" class="text-danger" id="num-sorteado">01</h1>
                    </div>
                </div>
                <button type="submit" class="btn btn-lg btn-block btn-outline-light mb-1" id="sorteio">Guardar número</button>
                <button class="btn btn-lg btn-block btn-outline-light mb-3" id="final">Finalizar bingo</button>
            </div>

            <div class="col-md-2"></div>
            <div class="col-md-5 ">
                <div id="table-responsive">
                    <table class="mt-2">
                        <tbody>
                        @foreach($numeros as $nums)
                            <tr class="text-light text-center">
                            @foreach($nums as $numero)

                                <td class="p-1"><button class="btn btn-light text-secondary" name="{{ $numero }}">{{ $numero}}</button></td>

                            @endforeach
                            </tr>
                        @endforeach

                        </tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection