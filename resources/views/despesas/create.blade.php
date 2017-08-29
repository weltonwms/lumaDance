@extends('layouts.app_interno')
@section('content_interno')

    
        <h3>Nova Despesa</h3>
        {!! Form::open(['route'=>'despesas.store','class'=>'form col-md-8 form-horizontal'])!!}
        @include('despesas.form')


        {!! Form::close() !!}


    
@endsection
