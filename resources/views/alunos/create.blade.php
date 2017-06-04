@extends('layouts.app_interno')
@section('content_interno')

    
        <h3>Novo Aluno</h3>
        {!! Form::open(['route'=>'alunos.store','class'=>'form col-md-8 form-horizontal'])!!}
        @include('alunos.form')


        {!! Form::close() !!}


    
@endsection
