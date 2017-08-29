@extends('layouts.app_interno')

@section('content_interno')
    
        <h3>Editar Produto</h3>
        {!! Form::model($produto,['route'=>['produtos.update',$produto->id],'class'=>'form col-md-8','method'=>'PUT'])!!}
        @include('produtos.form')


        {!! Form::close() !!}


    
@endsection
