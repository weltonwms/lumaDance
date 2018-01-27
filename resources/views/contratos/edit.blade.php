
@extends('layouts.app_interno')
@section('title-toolbar','Editar Contrato')
@section('content_interno')

@if ($errors->has('contrato_id'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>{{ $errors->first('contrato_id') }}</strong>
</div>
@endif

{!! Form::model($contrato,['route'=>['contratos.update',$contrato->id],'class'=>'form ','method'=>'PUT'])!!}
@include('contratos.form')
@include('contratos.mensalidades')

{!! Form::close() !!}

@endsection


