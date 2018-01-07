@extends('layouts.app_interno')
@section('content_interno')

 <h4>Listagem de Turmas</h4>
 <hr>
<div class="row-fluid">
   
    <a class="btn btn-primary pull-right" href="{{route('turmas.create')}}">Nova Turma</a>
     <a class="btn btn-default pull-right" href="{{route('turmas.grade')}}">Grade</a>
</div>
   
    
    
        <table class="tabela table table-striped" id="tabela">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Horário Início</th>
                    <th>Horário Término</th>
                    <th>Professor</th>
                      <th>Dias Semana</th>
                        
                    <th>Acões</th>
                </tr>
            </thead>

            <tbody>
                @foreach($turmas as $turma)
                <tr>
                    <td>{{$turma->id}}</td>
                    <td>{{$turma->descricao}}</td>
                    <td>{{$turma->horario_inicio}}</td>
                    <td>{{$turma->horario_termino}}</td>
                    <td>{{$turma->teacher?$turma->teacher->nome:''}}</td>
                    <td>{{$turma->nomes_dias_semana}}</td>
                  
                    <td class="col-md-2">
                        <a class='btn btn-default' href="{{url("turmas/$turma->id/edit")}}">Editar</a>
			<a class='btn btn-danger confirm' href="{{url("turmas/$turma->id")}}  " data-info="{{$turma->descricao}}">Excluir</a>
                        
                    </td>
                </tr>
                @endforeach


            </tbody>
        </table>





@endsection




