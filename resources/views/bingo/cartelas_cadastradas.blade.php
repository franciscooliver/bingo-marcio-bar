@extends('layouts.dashboard')

@section('title','- minhas cartelas')

@section("content")
   <div class="container">
     <div class="row mt-4">
       <div class="col-12">
         <h4 class="text-center">Minhas cartelas</h4>
       </div>
      </div>
      
    <table class="table table-borderless table-dark mt-5">
        <thead>
          <tr>
            <th>Código</th>
            <th>Vendida</th>
            <th>Impressa</th>
            <th>Letra B</th>   
            <th>Letra I</th>
            <th>Letra N</th>
            <th>Letra G</th>
            <th>Letra O</th>
            <th colspan="2">Ação</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($cartelas as $key => $cartela )
                <tr>  
                    
                    <td>{{ $cartela['numero'] }}</td>
                    <td>{{ $cartela['vendida'] }}</td>
                    <td>{{ $cartela['impressa'] }}</td>
                    <td>
                      {{  
                        $cartela['letraB'][0].' '.$cartela['letraB'][1].' '.$cartela['letraB'][2].' '. $cartela['letraB'][3].' '.
                        $cartela['letraB'][4]
                      }}
                    </td>
                    <td>
                        {{  
                          $cartela['letraI'][0].' '.$cartela['letraI'][1].' '.$cartela['letraI'][2].' '. $cartela['letraI'][3].' '.
                          $cartela['letraI'][4]
                        }}
                    </td>
                    <td>
                        {{  
                          $cartela['letraN'][0].' '.$cartela['letraN'][1].' '.$cartela['letraN'][2].' '. $cartela['letraN'][3]
                        }}
                    </td>
                    <td>
                        {{  
                          $cartela['letraG'][0].' '.$cartela['letraG'][1].' '.$cartela['letraG'][2].' '. $cartela['letraG'][3].' '.
                          $cartela['letraG'][4]
                        }}
                    </td>
                    <td>
                        {{  
                          $cartela['letraO'][0].' '.$cartela['letraO'][1].' '.$cartela['letraO'][2].' '. $cartela['letraO'][3].' '.
                          $cartela['letraO'][4]
                        }}
                    </td>
                    <td><a href="{{ route('editCart', $cartela['id'] ) }}"><span class="lnr lnr-pencil text-white"></span></a></td>
                    <td><a href="#"><span class="lnr lnr-trash"></span></a></td>
                </tr>
            @endforeach
            
        </tbody>
      </table>

      {{ $data->links() }}
      
   </div>

@endsection