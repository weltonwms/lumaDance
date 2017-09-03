@extends('layouts.app_interno')
@section('content_interno')

<h4>Relatório de Mensalidades</h4>
<br>
<?php
$dt = [
    'field' => 'inicio_contrato', 'label' => 'Início Contrato >=', 'errors' => $errors,
    'value' => request('inicio_contrato'),
    'atributos' => ['class' => 'dateBr']
];

use App\Helpers\Util;
?>
{!! Form::open(['route'=>'relatorio.mensalidade','id'=>'form-relatorio'])!!}

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
        <label class='control-label'>Tipo Mensalidade</label>
        {!!Form::select('tipo_mensalidade', ['1' => 'Quitada', '-1' => 'Não Quitada'], Request::get('tipo_mensalidade'),
        ['id'=>'tipo_mensalidade','class'=>'form-control']
        )!!}
    </div>
    
    <div class="col-md-4">
        <label class='control-label'>Ordenado Por</label>
        {!!Form::select('ordenado_por', ['vencimento' => 'Vencimento', 'contrato_id' => 'Nº Contrato'], Request::get('ordenado_por'),
        ['id'=>'ordenado_por','class'=>'form-control']
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
    <th>Vencimento</th>
    <th>Valor</th>
    <th>Pago Em</th>
    <th>Status</th>
    <th>Nº Contrato</th>
    <th>Aluno</th>
    <th>Turma</th>
    <th>Professor</th>


</thead>

<tbody>
    @foreach($relatorio->items as $item)
    <tr>
        <td>{{$item->vencimento}}</td>
        <td>{{$item->formated_valor}}</td>
        <td>{{$item->formated_pago_em}}</td>
        <td>{{$item->nome_status}}</td>
        <td>{{$item->contrato->id}}</td>
        <td>{{$item->contrato->aluno->nome}}</td>
        <td>{{$item->contrato->turma->descricao}}</td>
        <td>{{$item->contrato->turma->teacher->nome}}</td>


    </tr>


    @endforeach

</tbody>



</table>
@endsection

