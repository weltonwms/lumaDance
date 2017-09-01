@extends('layouts.app_interno')

@section('content_interno')
    
        <h3>Editar Aluno</h3>
        {!! Form::model($aluno,['route'=>['alunos.update',$aluno->id],'class'=>'form col-md-8','method'=>'PUT'])!!}
        @include('alunos.form')


        {!! Form::close() !!}


    
@endsection
