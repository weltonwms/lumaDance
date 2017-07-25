@extends('layouts.app_interno')
@section('content_interno')

    
        <h3>Nova Turma</h3>
        {!! Form::open(['route'=>'turmas.store','class'=>'form col-md-8 form-horizontal'])!!}
        @include('turmas.form')


        {!! Form::close() !!}


    
@endsection
