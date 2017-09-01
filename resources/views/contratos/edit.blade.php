
@extends('layouts.app_interno')
 @section('title-toolbar','Editar Contrato')
@section('content_interno')
   
       
        {!! Form::model($contrato,['route'=>['contratos.update',$contrato->id],'class'=>'form ','method'=>'PUT'])!!}
        @include('contratos.form')
        @include('contratos.mensalidades')

        {!! Form::close() !!}


    
@endsection


