@extends('layouts.app_interno')
@section('content_interno')

<h4>Relatório Geral</h4>
<br>
<?php
$dt_inicio = [
    'field' => 'periodo_inicial', 'label' => 'Período Inicial', 'errors' => $errors,
    'value' => request('periodo_inicial'),
    'atributos' => ['class' => 'dateBr']
];
$dt_final = [
    'field' => 'periodo_final', 'label' => 'Período Final', 'errors' => $errors,
    'value' => request('periodo_final'),
    'atributos' => ['class' => 'dateBr']
];

use App\Helpers\Util;
?>
{!! Form::open(['route'=>'relatorio.geral','id'=>'form-relatorio'])!!}

<div class="row">
    <div class="col-md-3">
        {!! Html::formGroupFlex($dt_inicio) !!}
    </div>
    <div class="col-md-3">
        {!! Html::formGroupFlex($dt_final) !!}
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label"><span class="glyphicon glyphicon-play"></span></label>
            <button type="submit" class="btn  btn-primary form-control">Consultar</button>
        </div>

    </div>
    <div class="col-md-4">

    </div>
</div>
{!! Form::close() !!}


<div class="row">
    <div class="col-md-9">
        <div class="pull-right">
            <button class="btn btn-success">Total Crédito: R$: {{$relatorio->moneyToBr('totalCredito')}}</button>
            <button class="btn btn-danger">Total Débito: R$:{{$relatorio->moneyToBr('totalDebito')}}</button>
            <button class="btn">Total Lucro: R$:{{$relatorio->moneyToBr('totalLucro')}}</button>
        </div>
    </div>
</div>
<br>
<div class="col-md-6">
    <div class="panel panel-success">
        <!-- Default panel contents -->
        <div class="panel-heading">
            Mensalidades Quitadas
           
               
        </div>
        
            <!-- Table -->
           
            <table class="table">
                <thead>
                    <tr>
                        <th>Vencimento</th>
                        <th>Valor</th>
                        <th>Pago em</th>
                        <th>Contrato</th>
                    </tr>
                </thead>

                <tbody>
                    
                    @foreach($relatorio->mensalidades as $mensalidade)
                    <tr>
                        <td>{{$mensalidade->vencimento}}</td>
                        <td>{{$mensalidade->formated_valor}}</td>
                        <td>{{$mensalidade->formated_pago_em}}</td>
                        <td>C{{$mensalidade->contrato->id}} (Al: {{$mensalidade->contrato->aluno->nome}})</td>
                    </tr>
                    @endforeach
                     
                    <tr class="active">

                        <td colspan="3" class="text-center"><b>Total Quitadas</b></td>
                        <td class="info">R$ {{$relatorio->moneyToBr('totalMensalidades')}}</td>
                    </tr>

                </tbody>
        </div>
        </table>
            
   
</div>
</div> <!--fim col-md-->


<div class="col-md-6">
    <div class="panel panel-success">
        <!-- Default panel contents -->
        <div class="panel-heading">Vendas</div>

        <!-- Table -->
        <table class="table">
            <thead>
                <tr class="">
                    <th>Data</th>
                    <th>Produto</th>
                    <th>Total Venda</th>
                    <th>Lucro</th>
                </tr>
            </thead>

            <tbody>
                @foreach($relatorio->vendas as $venda)
                <tr class="">
                    <td>{{$venda->data->format('d\/m\/Y')}}</td>
                    <td>{{$venda->produto->descricao}}</td>
                    <td>{{$venda->moneyToBr('total_venda')}}</td>
                    <td>{{$venda->moneyToBr('lucro')}}</td>
                </tr>
                @endforeach
                <tr class="active">

                    <td colspan="3" class="text-center"><b>Total Lucro Vendas</b></td>
                    <td class="info">R$ {{$relatorio->moneyToBr('totalLucroVendas')}}</td>
                </tr>

            </tbody>
        </table>
    </div>
</div>


<div class="col-md-6">
    <div class="panel panel-danger">
        <!-- Default panel contents -->
        <div class="panel-heading">Pagamentos Professor</div>

        <!-- Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>Dt Pg</th>
                    <th>Valor</th>
                    <th>Contrato</th>
                </tr>
            </thead>

            <tbody>
                @foreach($relatorio->pagamentos as $pagamento)
                <tr>
                    <td>{{$pagamento->mensalidade->formated_pago_em}}</td>
                    <td>{{$pagamento->formated_valor}}</td>
                    <td>C{{$pagamento->mensalidade->contrato->id}} (Prof: {{$pagamento->teacher->nome}} )</td>
                </tr>
                @endforeach
                <tr class="active">

                    <td colspan="3" class="text-center"><b>Total Pagamentos</b></td>
                    <td class="info">R$ {{$relatorio->moneyToBr('totalPagamentos')}}</td>
                </tr>

            </tbody>
        </table>
    </div>
</div>


<div class="col-md-6">
    <div class="panel panel-danger">
        <!-- Default panel contents -->
        <div class="panel-heading">Despesas</div>

        <!-- Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                </tr>
            </thead>

            <tbody>
                @foreach($relatorio->despesas as $despesa)
                <tr>
                    <td>{{$despesa->data}}</td>
                    <td>{{$despesa->descricao}}</td>
                    <td>{{$despesa->formated_valor}}</td>
                </tr>
                @endforeach
                <tr class="active">

                    <td colspan="3" class="text-center"><b>Total Despesas </b></td>
                    <td class="info">R$ {{$relatorio->moneyToBr('totalDespesas')}}</td>
                </tr>

            </tbody>
        </table>
    </div>
</div>



@endsection
