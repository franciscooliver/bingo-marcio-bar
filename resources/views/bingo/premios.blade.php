@extends('layouts.dashboard')
@section('title','- cadastro de prẽmios')
@section("content")
   <div class="container mt-5">
      <div class="row">
         <div class="col-md-12">
             <h1 class="text-center">Bingo - Márcio bar</h1>
         </div>
          <div class="col-md-12 mt-2">
              <div class="row text-center">
                  <div class="col-6">
                      <h6 class="text-center">Data: {{ $datadiaria }}</h6>
                  </div>
                  <div class="col-6 text-center">
                      <h6>Horário: {{ $horario }}</h6>
                  </div>
              </div>
          </div>
      </div>
       <div class="row mt-5">
           @foreach($premios as $premio)
           <div class="col-md-12 col-lg-4 m-md-1 m-lg-0 mt-xs-2">
               <div class="card hvr-grow h-100 w-100" style="width: 18rem;">
                   <div class="card-body ">
                       <h5 class="card-title">{{ $premio->nome_premio }}</h5>
                       <p>{{ $premio->descricao_premio }}</p>
                   </div>
               </div>
           </div>
           @endforeach
       </div>
   </div>
@endsection