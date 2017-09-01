{!! Html::formGroup('nome','Nome',$errors) !!}
{!! Html::formGroup('email','Email',$errors) !!}
{!! Html::formGroup('telefone','Telefone',$errors,'telefone') !!}
{!! Html::formGroup('percentual','Percentual',$errors) !!}

{!! Form::submit("Salvar",['class'=>'btn btn-primary']) !!}
<a class="btn btn-default" href="{{route('teachers.index')}}">Cancelar</a>