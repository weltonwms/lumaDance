@extends('layouts.app_interno')
@section('content_interno')

    
<div class="col-md-6 col-md-offset-3">
<div class="panel panel-default">
    <div class="panel-heading"><h4 class="text-center">Mudar sua Senha</h4></div>
    {{ Form::open(array('url' => 'users/changePassword')) }}
   
{!! Html::formGroupPassword('password','Entre com a Nova Senha:',$errors) !!}
    {!! Html::formGroupPassword('password_confirmation','Confirme a Nova Senha:',$errors) !!}

    

    <div class="form-group">
        <div class="text-center">
            {!! Form::submit('Mudar Senha', ['class' => 'btn btn-primary ']) !!}
        </div>
        
    </div>                  
    {!! Form::close() !!}

</div>
    
    </div>
  @endsection
