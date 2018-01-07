@extends('layouts.app_interno')
@section('content_interno')

<h4>Listagem de Vendas</h4>
<hr>
<div class="row-fluid">
    <button class="btn btn-primary pull-right" 
            data-href="{{route('vendas.create')}}"
            data-toggle="modal" data-target="#myModal">Nova Venda
    </button>
</div>

<form class="form-inline">
  <div class="form-group">
    <label for="search"><span class="glyphicon glyphicon-search"></span></label>
    <input type="text" value="{{request('search')}}" class="form-control" name="search" id="search" placeholder="Pesquisar">
  </div>
 
  <button type="submit" class="btn btn-default">Buscar</button>
</form>

<table class="table table-striped" id="">
    <thead>
        <tr>
            <th>ID</th>
            <th>Data</th>
            
            <th>Produto</th>
            <th>Valor Un. Compra</th>
            <th>Valor Un. Venda</th>
            <th>Qtd</th>
            <th>Acões</th>
        </tr>
    </thead>

    <tbody>
        @foreach($vendas as $venda)
        <tr>
            <td>{{$venda->id}}</td>
            <td>{{$venda->data->format('d\/m\/Y')}}</td>
            
            <td>{{$venda->produto->descricao}}</td>
            <td>R$ {{$venda->formated_valor_compra}}</td>
            <td> R$ {{$venda->formated_valor_venda}}</td>
            <td>{{$venda->qtd}}</td>
            <td class="col-md-2">
                <button data-toggle="modal" data-target="#myModal"
			class='btn btn-default' data-href="{{url("vendas/$venda->id/edit")}}">Editar
		</button>
                <a class='btn btn-danger confirm' href="{{url("vendas/$venda->id")}}  " data-info="{{$venda->descricao}}">Excluir</a>

            </td>
        </tr>
        @endforeach


    </tbody>
</table>
{{ $vendas->appends(['search' => request('search')])->links() }}

@include('vendas.modal')


@endsection

@push('scripts')
<script src="{{ asset('plugins/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/vendas.js') }}"></script>
@endpush




