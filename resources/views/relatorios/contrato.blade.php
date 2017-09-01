@extends('layouts.app_interno')
@section('content_interno')

<h4>Relatório de Contratos</h4>
<br>
<?php

$dt = [
    'field' => 'inicio_contrato', 'label' => 'Início Contrato >=', 'errors' => $errors,
    'value' => request('inicio_contrato'),
    'atributos' => ['class' => 'dateBr']
];

use App\Helpers\Util;
?>
{!! Form::open(['route'=>'relatorio.contrato','id'=>'form-relatorio'])!!}

<div class="row">
    <div class="col-md-4">
        {!! Form::listMultiple(['aluno_id[]'=>'Aluno'],$alunos,request('aluno_id'),['class'=>'meu_chosen','data-placeholder'=>'-Todos-']) !!}
    </div>
    
     <div class="col-md-4">
        {!! Form::listMultiple(['teacher_id[]'=>'Professor'],$teachers,request('teacher_id'),['class'=>'meu_chosen','data-placeholder'=>'-Todos-']) !!}
    </div>
    
     <div class="col-md-4">
        {!! Form::listMultiple(['turma_id[]'=>'Turma'],$turmas,request('turma_id'),['class'=>'meu_chosen','data-placeholder'=>'-Todas-']) !!}
    </div>
   
    <div class="col-md-4">
        {!! Html::formGroupFlex($dt) !!}
    </div>
    
    <div class="col-md-4">
        <label class='control-label'>Ativo</label>
        {!!Form::select('ativo', ['1' => 'Ativo', '-1' => 'Inativo'], Request::get('ativo'),
        ['id'=>'select-status','class'=>'form-control']
    )!!}
    </div>
   
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label"><span class="glyphicon glyphicon-play"></span></label>
        <button type="submit" class="btn  btn-primary form-control">Consultar</button>
        </div>

    </div>
</div>



{!! Form::close() !!}
@if($relatorio->items)
<span class="text-primary"><b>Mostrando {{$relatorio->items->count()}} Registro(s)</b></span>

@endif

<table class="table table-striped table-bordered">
    <thead>
    <th>Início Contrato</th>
     <th>Aluno</th>
    <th>Professor</th>
    <th>Turma</th>
    <th>Ativo</th>
    
</thead>

<tbody>
    @foreach($relatorio->items as $item)
    <tr>
        <td>{{$item->inicio_contrato}}</td>
        <td>{{$item->aluno->nome}}</td>
        <td>{{$item->turma->teacher->nome}}</td>
        <td>{{$item->turma->descricao}}</td>
        <td>{{$item->nome_ativo}}</td>
        
    </tr>


    @endforeach

</tbody>



</table>
@endsection
