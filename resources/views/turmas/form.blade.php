{!! Html::formGroup('descricao','Descrição',$errors) !!}

<?php
$lista_dias = ['0' => 'domingo', '1' => 'segunda', '2' => 'terça', '3' => 'quarta', 'quinta', 'sexta', 'sábado'];
?>


<div class="form-group {{ $errors->has('horario_inicio') ? ' has-error' : '' }}">
    {!! Form::label('horario_inicio', 'Início da aula') !!}
    {!! Form::time('horario_inicio',null, ['class' => 'form-control time']) !!}
    @if ($errors->has('horario_inicio'))
    <span class="help-block">
        <strong>{{ $errors->first('horario_inicio') }}</strong>
    </span>
    @endif
</div>

<div class="form-group {{ $errors->has('horario_termino') ? ' has-error' : '' }}">
    {!! Form::label('horario_termino', 'Término da aula') !!}
    {!! Form::time('horario_termino',null, ['class' => 'form-control time']) !!}
    @if ($errors->has('horario_termino'))
    <span class="help-block">
        <strong>{{ $errors->first('horario_termino') }}</strong>
    </span>
    @endif
</div>

<div class="form-group {{ $errors->has('dias_semana') ? ' has-error' : '' }}">
    {!! Form::label('dias_semana', 'Dias da Semana') !!}
    {!! Form::select('dias_semana[]', $lista_dias, null, ['class' => 'form-control meu_chosen','multiple'=>'multiple','data-placeholder'=>"-Selecione-"]) !!}
    @if ($errors->has('dias_semana'))
    <span class="help-block">
        <strong>{{ $errors->first('dias_semana') }}</strong>
    </span>
    @endif
</div>

<div class="form-group">
    {!! Form::label('teacher_id', 'Professor') !!}
    {!! Form::select('teacher_id', $teachers, null, ['class' => 'form-control', 'placeholder' => 'Selecione um Professor...']) !!}
</div>

{!! Form::submit("Salvar",['class'=>'btn btn-primary']) !!}
<a class="btn btn-default" href="{{route('turmas.index')}}">Cancelar</a>