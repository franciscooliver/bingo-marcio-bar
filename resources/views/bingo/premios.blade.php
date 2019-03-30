@extends('layouts.dashboard')
@section('title','- cadastro de prẽmios')
@section("content")
   <div class="container mt-5">
      <div class="row">
         <div class="col-md-12">
             <h1 class="text-center">Bingo - Márcio bar</h1>
             <div class="row">
                 <div class="col-md-10 offset-md-1 mt-3">
                    @if(isset($descricao_bingo))
                        <h1 class="desc-bingo text-danger text-center">{{ $descricao_bingo }}</h1>
                    @endif
                 </div>
             </div>
             
         </div>
          <div class="col-md-12 mt-5">
              <div class="row text-center">
                  <div class="col-6">
                      <h6 class="text-center">Data: {{ $datadiaria }}</h6>
                  </div>
                  <div class="col-6 ">
                      <h6>Horário: {{ $horario }}</h6>
                  </div>
              </div>
          </div>
      </div>
       <div class="row mt-5">

           @forelse($premios as $key => $premio)
           <div class="col-md-12 col-lg-4 m-md-1 m-lg-0 mt-xs-2">
               <div class="card hvr-grow h-100 w-100" style="width: 18rem;">
                   <div class="card-body">
                        <h3>{{ ($key+1)."° prêmio" }}</h3>
                       <h5 class="card-title">{{ "R$ ".$premio->nome_premio }}</h5>
                       <p>{{ $premio->descricao_premio }}</p>
                   </div>
               </div>
           </div>
           @empty

           <div class="col-md-12">
              <p class="text-center">Nenhum prêmio cadastrado</p>
           </div>

           @endforelse

       </div>
   </div>
@endsection