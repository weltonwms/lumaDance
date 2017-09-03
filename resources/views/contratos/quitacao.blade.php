<!--inicio do modal de Quitação-->

<div class="modal fade" id="modal_quitacao">
    <div class="modal-dialog ">
        <div class="modal-content">
            <section class="form-horizontal">

            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Quitar Mensalidade</h4>
            </div>
            <div class="modal-body">

            

                    <h5 class="text-center"><strong>Deseja Realmente Quitar Esta Mensalidade?</strong></h5>
                    
                    <table class='table table-condensed table-responsive table-user-information'>
                        <tr>
                            <td width="20%"><span class='text-primary'><strong>Cod Contrato</strong></span></td>
                             <td>{{$contrato->id}}</td>
                             <td> </td>
                             <td><span class='text-primary'><strong>Início Contrato</strong></span></td>
                            <td>{{$contrato->inicio_contrato}}</td>
                             
                        </tr>
                        <tr>
                            <td><span class='text-primary'><strong>Devedor</strong></span></td>
                             <td >{{$contrato->aluno->nome}}</td>
                             <td> </td>
                             <td><span class='text-primary'><strong>Cod Devedor</strong></span></td>
                             <td >{{$contrato->aluno->id}}</td>
                             
                        </tr>
                         <tr>
                            
                             
                             <td><span class='text-primary'><strong>Vencimento</strong></span></td>
                             <td colspan="4" id='vencimento_previsto'> </td>
                            
                        </tr>
                    </table>
                    
                   
                    <hr>
                    <div class="form-group">
                        <label class="control-label col-md-3">Valor</label>
                        <div class="col-md-6">
                            
                               
                            <p class="form-control-static">  R$ <span id="quit_valor"></span></p>
                           
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-3">Data Pagamento</label>
                        <div class="col-md-6">
                            <input  type="text"
                                   value="<?php echo date('d/m/Y');?>"
                                   class="form-control dateBr" name='pago_em' placeholder="Dt Pagamento">
                        </div>
                    </div>
                

            </div> <!-- /.modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button id='saveQuitar'
                        data-action='{{url('mensalidades/quitar')}}'
                        data-method='post'
                        class="btn btn-success  saveMensalidade">
                    Confirmar
                </button>
            </div>

            </section>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
