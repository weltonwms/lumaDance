@extends('layouts.app_interno')
@section('content_interno')

 <h4>Listagem de Produtos</h4>
 <hr>
<div class="row">
    <a class="btn btn-primary navbar-right" href="{{route('produtos.create')}}">Novo Produto</a>
</div>
   
    
    
        <table class="tabela table table-striped" id="tabela">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Valor Un. Compra</th>
                     <th>Valor Un. Venda</th>
                     <th>Qtd Estoque</th>
                    <th>Acões</th>
                </tr>
            </thead>

            <tbody>
                @foreach($produtos as $produto)
                <tr>
                    <td>{{$produto->id}}</td>
                    <td>{{$produto->descricao}}</td>
                    <td>R$ {{$produto->formated_valor_compra}}</td>
                    <td> R$ {{$produto->formated_valor_venda}}</td>
                     <td>{{$produto->estoque}}</td>
                    <td class="col-md-2">
                        <a class='btn btn-default' href="{{url("produtos/$produto->id/edit")}}">Editar</a>
			<a class='btn btn-danger confirm' href="{{url("produtos/$produto->id")}}  " data-info="{{$produto->descricao}}">Excluir</a>
                        
                    </td>
                </tr>
                @endforeach


            </tbody>
        </table>





@endsection




