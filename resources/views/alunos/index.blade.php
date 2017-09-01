@extends('layouts.app_interno')
@section('content_interno')

 <h4>Listagem de Alunos</h4>
 <hr>
<div class="row">
    <a class="btn btn-primary navbar-right" href="{{route('alunos.create')}}">Novo Aluno</a>
</div>
   
    
    
        <table class="tabela table table-striped" id="tabela">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                      <th>Nascimento</th>
                        <th>Endereço</th>
                    <th>Acões</th>
                </tr>
            </thead>

            <tbody>
                @foreach($alunos as $aluno)
                <tr>
                    <td>{{$aluno->id}}</td>
                    <td>{{$aluno->nome}}</td>
                    <td>{{$aluno->email}}</td>
                    <td>{{$aluno->telefone}}</td>
                    <td>{{$aluno->nascimento}}</td>
                    <td>{{$aluno->endereco}}</td>
                    <td class="col-md-2">
                        <a class='btn btn-default' href="{{url("alunos/$aluno->id/edit")}}">Editar</a>
			<a class='btn btn-danger confirm' href="{{url("alunos/$aluno->id")}}  " data-info="{{$aluno->nome}}">Excluir</a>
                        
                    </td>
                </tr>
                @endforeach


            </tbody>
        </table>





@endsection




