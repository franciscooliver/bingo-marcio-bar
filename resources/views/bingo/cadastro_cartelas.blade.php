@extends('layouts.dashboard')

@section('title','- principal')

@section("content")
    <div class="container mt-2 mb-5">
        <div class="row bg-secondary align-items-center">
            <div class="col-md-6 offset-md-3">
                <div id="table-responsive">
                    <table class="mt-2 w-100">
                        <tbody>
                        {{ csrf_field() }}
                        @foreach($array_view as $nums)
                            <tr class="text-light text-center">
                                @foreach($nums as $numero)

                                    <td class="p-1 " ><button type="submit" id="{!! $numero !!}" class="btn btn-light text-secondary" name="{{ $numero }}">{{ $numero}}</button></td>

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
    @include("_includes.modal")<!--carrega modal-->
@endsection