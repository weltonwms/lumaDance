{!! Html::formGroup('nome','Nome',$errors) !!}
{!! Html::formGroup('email','Email',$errors) !!}
{!! Html::formGroup('telefone','Telefone',$errors,'telefone') !!}
{!! Html::formGroup('endereco','Endereço',$errors) !!}
{!! Html::formGroupDate('nascimento','Nascimento',$errors,'dateBr') !!}
{!! Form::submit("Salvar",['class'=>'btn btn-primary']) !!}
<a class="btn btn-default" href="{{route('alunos.index')}}">Cancelar</a>