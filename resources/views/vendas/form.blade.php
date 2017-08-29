<?php
$vl_compra=[
            'field'=>'valor_compra','label'=>'Valor Un. Compra','errors'=>$errors,
             'value'=>(isset($venda))  ? $venda->valor_compra : '',
             'atributos'=>['class'=>'money']
         ];
$vl_venda=[
            'field'=>'valor_venda','label'=>'Valor Un. Venda','errors'=>$errors,
             'value'=>(isset($venda))  ? $venda->valor_venda : '',
             'atributos'=>['class'=>'money']
         ];
$dt=[
            'field'=>'data','label'=>'Data','errors'=>$errors,
             'value'=>(isset($venda))  ? $venda->data->format('d/m/Y') : \Carbon\Carbon::now()->format('d\/m\/Y'),
             'atributos'=>['class'=>'dateBr']
         ];

?>

<div class="row">
    <div class="form-encolhido">
    <div class="col-md-4">
        {!! Html::formGroupFlex($dt) !!}
    </div>
    
    <div class="col-md-4">
        {!! Html::formGroup('observacao','Observação',$errors) !!}
    </div>
   <div class="col-md-4">
        {!! Html::formGroupSelect('produto_id',$produtos,'Produto',$errors,' meu_chosen',$datasetsprodutos) !!}
    </div>
    <div class="col-md-2">
        {!! Html::formGroupFlex($vl_compra) !!}
    </div>
    <div class="col-md-2">
        {!! Html::formGroupFlex($vl_venda) !!}
    </div>
    <div class="col-md-2 ">
        {!! Html::formGroup('qtd','Qtd',$errors) !!}
    </div>
    <div class="col-md-2">
         <div class="form-group  "><label for="total" class="control-label">Total</label>
             <input class=" form-control money" name="total" type="text" id="total">
         </div>
    </div>
        </div>
</div>









