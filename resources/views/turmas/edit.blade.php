@extends('layouts.app_interno')

@section('content_interno')
    
        <h3>Editar Turma</h3>
        {!! Form::model($turma,['route'=>['turmas.update',$turma->id],'class'=>'form col-md-8','method'=>'PUT'])!!}
        @include('turmas.form')


        {!! Form::close() !!}


    
@endsection
