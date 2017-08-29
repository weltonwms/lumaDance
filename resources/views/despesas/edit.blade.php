@extends('layouts.app_interno')

@section('content_interno')
    
        <h3>Editar Despesa</h3>
        {!! Form::model($despesa,['route'=>['despesas.update',$despesa->id],'class'=>'form col-md-8','method'=>'PUT'])!!}
        @include('despesas.form')


        {!! Form::close() !!}


    
@endsection
