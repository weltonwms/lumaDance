@extends('layouts.app_interno')

@section('content_interno')
    
        <h3>Editar Usuários</h3>
        {!! Form::model($user,['route'=>['users.update',$user->id],'class'=>'form col-md-8','method'=>'PUT'])!!}
        @include('users.form')


        {!! Form::close() !!}


    
@endsection
