@extends('layouts.app_interno')
@section('content_interno')

<h4>Listagem de Usuários</h4>
<hr>
<div class="row">
    <a class="btn btn-primary navbar-right" href="{{route('users.create')}}">Novo Usuário</a>
</div>



<table class="tabela table table-striped" id="tabela">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Perfil</th>
            <th>Ações</th>
        </tr>
    </thead>

    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->nome_perfil}}</td>

            <td class="col-md-2">
                <a class='btn btn-default' href="{{url("users/$user->id/edit")}}">Editar</a>
                <a class='btn btn-danger confirm' href="{{url("users/$user->id")}}  " data-info="{{$user->name}}">Excluir</a>

            </td>
        </tr>
        @endforeach


    </tbody>
</table>





@endsection




