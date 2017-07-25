@extends('layouts.app_interno')
@section('content_interno')

    
        <h3>Novo Professor</h3>
        {!! Form::open(['route'=>'teachers.store','class'=>'form col-md-8 form-horizontal'])!!}
        @include('teachers.form')


        {!! Form::close() !!}


    
@endsection
