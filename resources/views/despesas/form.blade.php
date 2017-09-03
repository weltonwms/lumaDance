{!! Html::formGroup('descricao','Descrição',$errors) !!}
{!! Html::formGroup('valor','Valor',$errors,'money') !!}
{!! Html::formGroup('data','Data',$errors,'dateBr') !!}

{!! Form::submit("Salvar",['class'=>'btn btn-primary']) !!}
<a class="btn btn-default" href="{{route('despesas.index')}}">Cancelar</a>