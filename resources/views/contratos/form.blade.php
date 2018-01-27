
@section('content-toolbar')
        @if(isset($contrato) && !$contrato->ativo)
        | <span class="text-muted text-danger">Desativado</span> 
        <span class="text-danger glyphicon glyphicon-ban-circle"></span>
        |
        @endif
        {!! Form::submit("Salvar",['class'=>'btn btn-primary']) !!}
         <a class="btn btn-default" id="btn-salvar-fechar" href="#">Salvar e Fechar</a>
         <input type="hidden" name="fechar" value="">
        <a class="btn btn-default" href="{{route('contratos.index')}}">Cancelar</a>
@endsection

@include('layouts.toobar')

<div class="form form-encolhido">
     <?php 
        $vl_vencimento=[
            'field'=>'valor_vencimento','label'=>'Valor Vencimento','errors'=>$errors,
             'value'=>(isset($contrato))  ? $contrato->FormatedValorVencimento : '',
             'atributos'=>['class'=>'money']
         ];
         $vl_entrada=[
            'field'=>'valor_entrada','label'=>'Valor Entrada','errors'=>$errors,
             'value'=>(isset($contrato))  ? $contrato->FormatedValorEntrada : '',
             'atributos'=>['class'=>'money','data-toggle'=>"tooltip", 'title'=>"Utilize na Criação do Contrato para gerar mensalidade proporcional",]
         ];
         $dt_inicio=[
            'field'=>'inicio_contrato','label'=>'Inicio Contrato','errors'=>$errors,
             'value'=>(isset($contrato))  ? $contrato->inicio_contrato : \Carbon\Carbon::now()->format('d\/m\/Y'),
             'atributos'=>['class'=>'dateBr']
         ];
         ?>
    
    <div class="col-md-3">
    {!! Html::formGroupSelect('aluno_id',$alunos,'Aluno',$errors,' meu_chosen') !!}
    </div>
     <div class="col-md-3">
    {!! Html::formGroupSelect('turma_id',$turmas,'Turma',$errors,' meu_chosen') !!}
    </div>
    <div class="col-md-3">
    {!! Html::formGroupNumber('dia_vencimento','Dia Vencimento',$errors,'dia') !!}
    </div>
    <div class="col-md-3">
      {!! Html::formGroupFlex($dt_inicio) !!}
    </div>
    <div class="col-md-3">
       
    {!! Html::formGroupFlex($vl_vencimento) !!}
    </div>
    <div class="col-md-3">
     {!! Html::formGroupFlex($vl_entrada) !!}
    </div>
    <div class="col-md-6">
    {!! Html::formGroup('observacao','Observação',$errors) !!}
    </div>
    
   
    


</div>
<br><br>
<script>
    $('#btn-salvar-fechar').click(function(e){
        e.preventDefault();
        $("input[name=fechar]").val(1);
        $('form').submit();
        $('#btn-salvar-fechar').attr('disabled','disabled')
        $('#btn-salvar-fechar').unbind();
    });
</script>
