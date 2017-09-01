@extends('layouts.app_interno')
@section('content_interno')

<h4>Pagamentos de Professores</h4>
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

<table class="tabela table table-striped" id="tabela">
    <thead>
        <tr>

            <th>Valor</th>
            <th>Professor</th>
            <th>Contrato</th>
            <th>Dt Pgt Aluno</th>
             <th>Aluno</th>
            <th>Pago ao Professor</th>
            <th>Acões</th>
        </tr>
    </thead>

    <tbody>
        @foreach($payments as $payment)
        <tr>
            <td>{{$payment->formated_valor}}</td>
            <td>{{$payment->teacher->nome}}</td>
            <td>{{$payment->mensalidade->contrato->id}}</td>
            <td>{{$payment->mensalidade->formated_pago_em}}</td>
             <td>{{$payment->mensalidade->contrato->aluno->nome}}</td>
            <td>{{$payment->formated_pago}}</td>
            <td>
                @if($payment->pago!=1)
                <a href="{{url("teachers/payments/$payment->id")}}" 
                   data-info="{{$payment->teacher->nome}}"
                   data-toggle="tooltip" title="Quitar Pagamento com Professor"
                   class="confirm-payment text-success">
                    <span class="glyphicon glyphicon-usd"></span>
                </a>
                @endif
            </td>

        </tr>
        @endforeach


    </tbody>
</table>





@endsection




