@extends('layouts.app')
@section('navbar')
    @include('layouts.nav') 
@endsection


@section('content')
<div class="container" style='background-color: #f5f8fa'>
    <hr>
    
    @if(Request::session()->has('mensagem'))
            <div class="alert alert-{{session('mensagem.type')}} alert-dismissable ">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{session('mensagem.conteudo')}}
            </div>

    @endif
         
       @yield('content_interno')
</div>
@endsection