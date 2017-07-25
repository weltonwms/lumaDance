@extends('layouts.app_interno')
@section('content_interno')

 <h4>Listagem de Contratos</h4>
 <hr>
<div class="row-fluid">
    
    <span class='text-primary text-right'>Contratos</span>&nbsp;&nbsp;
    
    
    
       
    {!!Form::select('status', ['1' => 'Ativos', '0' => 'Inativos'], Request::get('st'),
        ['id'=>'select-status', 'class'=>'','data-url'=>route('contratos.index')]
    )!!}
    
    
    
        <a class="btn btn-primary pull-right" href="{{route('contratos.create')}}">Novo Contrato</a>
    
</div>
   
    
    
        <table class="tabela table table-striped" id="tabela">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Aluno</th>
                    <th>Turma</th>
                    <th>Ativo</th>
                      <th>Dt Início</th>
                        
                    <th>Acões</th>
                </tr>
            </thead>

            <tbody>
                @foreach($contratos as $contrato)
                <tr>
                    <td>{{$contrato->id}}</td>
                    <td>{{$contrato->aluno->nome}}</td>
                    <td>T{{$contrato->turma->id}}</td>
                    <td>{{$contrato->nome_ativo}}</td>
                    <td>{{$contrato->inicio_contrato}}</td>
                    
                    <td class="col-md-3">
                        <a class='btn btn-default' 
                           data-toggle="tooltip" title="Editar"
                           href="{{url("contratos/$contrato->id/edit")}}">
                            <span class="glyphicon glyphicon-pencil"> </span>
                        </a>
                        <a class='btn btn-default confirm-desativar' 
                           data-toggle="tooltip" title="Desativar" data-method="put" 
                           data-info="Contrato Nr: {{$contrato->id}}, Aluno: {{$contrato->aluno->nome}}"
                           href="{{url("contratos/$contrato->id/desativar")}}">
                            <span class="glyphicon glyphicon-remove-sign text-danger"></span>
                        </a>
			<a class='btn btn-danger confirm' 
                           data-toggle="tooltip" title="Excluir"
                           href="{{url("contratos/$contrato->id")}}" 
                           data-info="Contrato Nr: {{$contrato->id}}, Aluno: {{$contrato->aluno->nome}}"
                           > <span class="glyphicon glyphicon-trash"></span>
                        </a>
                        
                    </td>
                </tr>
                @endforeach


            </tbody>
        </table>

 <script>
      $("#select-status").change(function(e){
       window.location.href = this.dataset.url+'?st='+this.value;
    });

</script>

@endsection




