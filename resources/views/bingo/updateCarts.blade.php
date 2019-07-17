@extends('layouts.dashboard')

@section('title','- minhas cartelas')

@section("content")
   <div class="container">

        <div class="row mt-4">
            <div class="col-12">
                <h4 class="text-center">Editar cartela {{ $cartela->numero_cartela }}</h4>

                @if(Session::has('message'))
                    {{--  <p class="alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}</p>  --}}

                    <div class="alert {{ Session::get('alert-class') }} alert-dismissible fade show" role="alert">
                        {{ Session::get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                @endif
            </div>
        </div>
               
    <table class="table table-borderless table-dark mt-5">
        <thead>
          <tr>
            <th class="border-bottom-1 py-2">Código</th>
            <th class="border-bottom-1 py-2">Vendida</th>
            <th class="border-bottom-1 py-2">Impressa</th>
            <th class="border-bottom-1 py-2">Letra B</th>   
            <th class="border-bottom-1 py-2">Letra I</th>
            <th class="border-bottom-1 py-2">Letra N</th>
            <th class="border-bottom-1 py-2">Letra G</th>
            <th class="border-bottom-1 py-2">Letra O</th>
            <th class="border-bottom-1 py-2" colspan="2">Ação</th>
          </tr>
        </thead>
        <tbody>
           
            <form action="{{ route('cart.teste', $cartela->id) }}" method="post">
                <input name="_method" type="hidden" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                <tr>  
                    <td>{{ $cartela->numero_cartela }}</td>
                    <td><input type="text" name="vendida" class="form-control" value="{{ $cartela->vendida }}"></td>
                    <td>{{ $cartela->impressa }}</td>
                    <td>
                        <input type="number" name="b1" class="form-control" value="{{ $cartela->b_1}}">
                        <input type="number" name="b2" class="form-control" value="{{ $cartela->b_2}}">
                        <input type="number" name="b3" class="form-control" value="{{ $cartela->b_3}}">
                        <input type="number" name="b4" class="form-control" value="{{ $cartela->b_4}}">
                        <input type="number" name="b5" class="form-control" value="{{ $cartela->b_5}}">
                    </td>
                    <td>
                        <input type="number" name="i1" class="form-control" value="{{ $cartela->i_1}}" >
                        <input type="number" name="i2" class="form-control" value="{{ $cartela->i_2}}" >
                        <input type="number" name="i3" class="form-control" value="{{ $cartela->i_3}}" >
                        <input type="number" name="i4" class="form-control" value="{{ $cartela->i_4}}" >
                        <input type="number" name="i5" class="form-control" value="{{ $cartela->i_5}}" >
                    </td>
                    <td>
                        <input type="number" name="n1" class="form-control" value="{{ $cartela->n_1}}" >
                        <input type="number" name="n2" class="form-control" value="{{ $cartela->n_2}}" >
                        <input type="number" name="n3" class="form-control" value="{{ $cartela->n_3}}" >
                        <input type="number" name="n4" class="form-control" value="{{ $cartela->n_4}}" >
                     
                    </td>
                    <td >
                        <input type="number" name="g1" class="form-control" value="{{ $cartela->g_1}}" >
                        <input type="number" name="g2" class="form-control" value="{{ $cartela->g_2}}" >
                        <input type="number" name="g3" class="form-control" value="{{ $cartela->g_3}}" >
                        <input type="number" name="g4" class="form-control" value="{{ $cartela->g_4}}" >
                        <input type="number" name="g5" class="form-control" value="{{ $cartela->g_5}}" >
                    </td>
                    <td>
                        <input type="number"  name="o1" class="form-control" value="{{ $cartela->o_1}}" >
                        <input type="number"  name="o2" class="form-control" value="{{ $cartela->o_2}}" >
                        <input type="number"  name="o3" class="form-control" value="{{ $cartela->o_3}}" >
                        <input type="number"  name="o4" class="form-control" value="{{ $cartela->o_4}}" >
                        <input type="number"  name="o5" class="form-control" value="{{ $cartela->o_5}}" >
                    </td>
                    <td><button type="submit" class="btn btn-secondary text-white"><span class="lnr lnr-sync"></span></button></td>
                    <td><a href="{{ route('cartelas') }}" class="btn btn-secondary">Voltar</a></td>
                </tr>
            </form>
            
        </tbody>
      </table>

   </div>

@endsection