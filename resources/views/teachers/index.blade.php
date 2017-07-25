@extends('layouts.app_interno')
@section('content_interno')

 <h4>Listagem de Professores</h4>
 <hr>
<div class="row">
    <a class="btn btn-primary navbar-right" href="{{route('teachers.create')}}">Novo Professor</a>
</div>
   
    
    
        <table class="tabela table table-striped" id="tabela">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Percentual</th>
                    <th>Acões</th>
                </tr>
            </thead>

            <tbody>
                @foreach($teachers as $teacher)
                <tr>
                    <td>{{$teacher->id}}</td>
                    <td>{{$teacher->nome}}</td>
                    <td>{{$teacher->email}}</td>
                    <td>{{$teacher->telefone}}</td>
                    <td>{{$teacher->percentual}}</td>
                   
                    <td class="col-md-2">
                        <a class='btn btn-default' href="{{url("teachers/$teacher->id/edit")}}">Editar</a>
			<a class='btn btn-danger confirm' href="{{url("teachers/$teacher->id")}}  " data-info="{{$teacher->nome}}">Excluir</a>
                        
                    </td>
                </tr>
                @endforeach


            </tbody>
        </table>





@endsection




