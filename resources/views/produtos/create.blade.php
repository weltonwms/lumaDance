@extends('layouts.app_interno')
@section('content_interno')

    
        <h3>Novo Produto</h3>
        {!! Form::open(['route'=>'produtos.store','class'=>'form col-md-8 form-horizontal'])!!}
        @include('produtos.form')


        {!! Form::close() !!}


    
@endsection
