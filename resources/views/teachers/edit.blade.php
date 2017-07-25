@extends('layouts.app_interno')

@section('content_interno')
    
        <h3>Editar Professor</h3>
        {!! Form::model($teacher,['route'=>['teachers.update',$teacher->id],'class'=>'form col-md-8','method'=>'PUT'])!!}
        @include('teachers.form')


        {!! Form::close() !!}


    
@endsection
