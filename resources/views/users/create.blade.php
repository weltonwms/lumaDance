@extends('layouts.app_interno')
@section('content_interno')

    
        <h3>Novo Usuário</h3>
        {!! Form::open(['route'=>'users.store','class'=>'form col-md-8 form-horizontal'])!!}
        @include('users.form')


        {!! Form::close() !!}


    
@endsection
