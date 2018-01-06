<?php $lista_perfis=[''=>'-Selecione-',1=>'Administrador',2=>'Secretaria']?>
{!! Html::formGroup('name','Nome',$errors) !!}
{!! Html::formGroup('email','Email',$errors) !!}
{!! Html::formGroupPassword('password','Senha',$errors) !!}
<div class="form-group {{ $errors->has('perfil') ? ' has-error' : '' }}">
    {!! Form::label('perfil', 'Perfil') !!}
    {!! Form::select('perfil', $lista_perfis, null, ['class' => 'form-control']) !!}
    @if ($errors->has('perfil'))
    <span class="help-block">
        <strong>{{ $errors->first('perfil') }}</strong>
    </span>
    @endif
</div>
{!! Form::submit("Salvar",['class'=>'btn btn-primary']) !!}
<a class="btn btn-default" href="{{route('users.index')}}">Cancelar</a>