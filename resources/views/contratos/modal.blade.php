<!--inicio do modal de adicionar ou alterar Mensalidade-->

<div class="modal fade" id="modal_mensalidade">
    <div class="modal-dialog ">
        <div class="modal-content">


            <input type="hidden" name="id_mensalidade" id="id_mensalidade" value=""/>
             <input type="hidden" name="contrato_id" id="contrato_id" value="{{$contrato->id}}"/>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Adicionar Mensalidade</h4>
            </div>
            <div class="modal-body">

                <div class='row'>

                    <section class="form-horizontal">
                        <div class="form-group">
                            <label for="vencimento" class="col-sm-3 control-label">Vencimento</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control date" name="vencimento" id="vencimento" placeholder="Vencimento">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="valor" class="col-sm-3 control-label">Valor</label>
                            <div class="col-sm-8 input-group">
                                 <span class="input-group-addon">R$</span>
                                 <input type="text" class="form-control money" name="valor" id="valor" placeholder="Valor">
                            </div>
                        </div>
                       

                    </section>
                </div>  

            </div> <!-- /.modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button 
                        id="saveMensalidade"
                        data-originalAction="{{url('mensalidades')}}"
                        data-action=''
                        data-method=''
                        class="btn btn-success">Salvar
                </button>
            </div>


        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
