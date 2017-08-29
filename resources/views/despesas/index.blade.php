@extends('layouts.app_interno')
@section('content_interno')

 <h4>Listagem de Despesas</h4>
 <hr>
<div class="row">
    <a class="btn btn-primary navbar-right" href="{{route('despesas.create')}}">Nova Despesa</a>
</div>
   
    
    
        <table class="tabela table table-striped" id="tabela">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Data</th>
                      
                    <th>Acões</th>
                </tr>
            </thead>

            <tbody>
                @foreach($despesas as $despesa)
                <tr>
                    <td>{{$despesa->id}}</td>
                    <td>{{$despesa->descricao}}</td>
                    <td>R$ {{$despesa->formated_valor}}</td>
                    <td>{{$despesa->data}}</td>
                    
                    <td class="col-md-2">
                        <a class='btn btn-default' href="{{url("despesas/$despesa->id/edit")}}">Editar</a>
			<a class='btn btn-danger confirm' href="{{url("despesas/$despesa->id")}}  " data-info="{{$despesa->descricao}}">Excluir</a>
                        
                    </td>
                </tr>
                @endforeach


            </tbody>
        </table>





@endsection




