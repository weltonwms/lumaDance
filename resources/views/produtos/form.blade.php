<?php
$vl_compra=[
            'field'=>'valor_compra','label'=>'Valor Un. Compra','errors'=>$errors,
             'value'=>(isset($produto))  ? $produto->valor_compra : '',
             'atributos'=>['class'=>'money']
         ];
$vl_venda=[
            'field'=>'valor_venda','label'=>'Valor Un. Venda','errors'=>$errors,
             'value'=>(isset($produto))  ? $produto->valor_venda : '',
             'atributos'=>['class'=>'money']
         ];

?>


{!! Html::formGroup('descricao','Descrição',$errors) !!}
{!! Html::formGroupFlex($vl_compra) !!}
{!! Html::formGroupFlex($vl_venda) !!}
{!! Html::formGroup('estoque','Qtd Estoque',$errors) !!}
{!! Form::submit("Salvar",['class'=>'btn btn-primary']) !!}
<a class="btn btn-default" href="{{route('produtos.index')}}">Cancelar</a>