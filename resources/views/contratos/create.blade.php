@extends('layouts.app_interno')
@section('title-toolbar','Novo Contrato')
@section('content_interno')

    
        
        {!! Form::open(['route'=>'contratos.store','class'=>'form'])!!}
        @include('contratos.form')


        {!! Form::close() !!}


    
@endsection
