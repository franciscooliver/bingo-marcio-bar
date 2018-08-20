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
            <div class="col-md-8">
                <div class="responsive-table">
                    <table class="table" id="table_cad">
                        <tbody>
                        @foreach($array_view as $key => $nums)
                        <tr>
                                @if($key == 0)
                                    <th scope="row" class="text-center text-light">B</th>
                                @elseif ($key==1)
                                    <th scope="row" class="text-center text-light">I</th>
                                @elseif ($key==2)
                                    <th scope="row" class="text-center text-light">N</th>
                                @elseif ($key==3)
                                    <th scope="row" class="text-center text-light">G</th>
                                @elseif ($key==4)
                                    <th scope="row" class="text-center text-light">O</th>
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

            <div class="col-md-4">
                <table class="table table-striped table-dark ml-1">
                    <tbody>
                    <tr id="linhaB">

                    </tr>
                    <tr>
                        <td  id="b_1" class="border-bottom border-right"></td>
                        <td  id="b_2" class="border-bottom border-right"></td>
                        <td  id="b_3" class="border-bottom border-right"></td>
                        <td  id="b_4" class="border-bottom border-right"></td>
                        <td  id="b_5" class="border-bottom"></td>
                    </tr>
                    <tr>

                        <td id="i_1" class="border-bottom border-right"></td>
                        <td  id="i_2" class="border-bottom border-right"> </td>
                        <td id="i_3" class="border-bottom border-right"></td>
                        <td id="i_4" class="border-bottom border-right"></td>
                        <td id="i_5"class="border-bottom "></td>
                    </tr>
                    <tr>
                        <td id="n_1" class="border-bottom border-right"></td>
                        <td id="n_2" class="border-bottom border-right"> </td>
                        <td class="border-bottom border-right text-center">IMG</td>
                        <td id="n_3" class="border-bottom border-right"></td>
                        <td id="n_4"class="border-bottom "></td>
                    </tr>
                    <tr>

                        <td id="g_1" class="border-bottom border-right"></td>
                        <td id="g_2" class="border-bottom border-right"> </td>
                        <td id="g_3" class="border-bottom border-right"></td>
                        <td id="g_4" class="border-bottom border-right"></td>
                        <td id="g_5"class="border-bottom "></td>
                    </tr>

                    <tr>

                        <td id="o_1" class="border-bottom border-right"></td>
                        <td id="o_2" class="border-bottom border-right"> </td>
                        <td id="o_3" class="border-bottom border-right"></td>
                        <td id="o_4" class="border-bottom border-right"></td>
                        <td id="o_5"class="border-bottom "></td>
                    </tr>
                    </tbody>
                </table>

            </div>

            <div class="card col-12">
                <form >
                    {{ csrf_field() }}
                    <div class="card-body" id="card_nums_selecionados">
                        <div class="col-md-3 ml-0 col-xs-12">
                            <input type="text" placeholder="Digite o identificador" class="form-control" name="numero_cart">

                        </div>
                        <h6 class="text-center" id="text-num_sel">Números selecionados</h6>
                        <p id="retorno_success" class="text-success"></p>
                        <p id="retorno_error" class="text-danger"></p>

                    </div>

                    <button type="button" class="btn btn-info  btn-sm col-4 offset-md-4 " id="btn_cad">Cadastrar cartela</button>
                </form>
            </div>
        </div>
    </div>
    @include("_includes.modal")<!--carrega modal-->
@endsection