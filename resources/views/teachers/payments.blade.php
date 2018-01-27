@extends('layouts.app_interno')

@section('title-toolbar','Pagamentos de Professores')
@section('content-toolbar')
<btn class=" btn btn-default">Total R$ {{number_format($payments->sum('valor'),2,',','.')}}</btn>
@if(request('st')!='1')
<button class="btn btn-success" id='btn-quitar'> <span class="glyphicon glyphicon-usd"></span> Quitar com Professor</button>
@else
<button class="btn btn-primary" id='btn-desquitar'> <span class="glyphicon glyphicon-arrow-left"></span> Desfazer Quitação </button>
@endif
@endsection

@section('content_interno')
@include('layouts.toobar')
<hr>

<form class="form-inline">
  <div class="form-group">
    <label for="st">Status</label>
    <?php $attr=['class'=>'form-control input-sm','onchange'=>'this.form.submit()']?>
    {!!Form::select('st', ['0' => 'Em Aberto', '1' => 'Quitado'], null,$attr )!!}
  </div>
  <div class="form-group">
   <label for="select-status">Professor</label>
    <?php 
    $list_teachers=  $teachers->prepend('--Todos--','');
    $attr2=['class'=>'form-control input-sm','onchange'=>'this.form.submit()']
            
    ?>
    {!!Form::select('teacher', $list_teachers, null,$attr2 )!!}
  </div>
  
</form>
<?php
$rota=request('st')!='1'?'payments.quitar':'payments.desquitar';
?>

{!! Form::open(['route'=>$rota,'name'=>'payments-form', 'method'=>'PUT'])!!}
<table class="tabela table table-striped" id="tabela">
    <thead>
        <tr>
            <th class="nosort"><input class=" check_all" type="checkbox" name=""></th>
            <th>Valor</th>
            <th>Professor</th>
            <th>Contrato</th>
            <th>Dt Pgt Aluno</th>
             <th>Aluno</th>
            <th>Pago ao Professor</th>
           
        </tr>
    </thead>

    <tbody>
        @foreach($payments as $payment)
        <tr>
            <td><input type="checkbox" class="checados" name="quit[]" value="{{$payment->id}}"/></td>
            <td>{{$payment->formated_valor}}</td>
            <td>{{$payment->teacher->nome}}</td>
            <td>{{$payment->mensalidade->contrato->id}}</td>
            <td>{{$payment->mensalidade->formated_pago_em}}</td>
             <td>{{$payment->mensalidade->contrato->aluno->nome}}</td>
            <td>{{$payment->formated_pago}}</td>
            

        </tr>
        @endforeach


    </tbody>
</table>
</form>

@endsection




@push('scripts')
<script>
    $('#btn-quitar, #btn-desquitar').click(function(){
       $('form[name=payments-form]').submit();
    });
</script>
@endpush


