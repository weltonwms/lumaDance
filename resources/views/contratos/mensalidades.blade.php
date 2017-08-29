<br><br><br><br>
<a class='btn btn-success pull-right' id='btn_add_mensalidade'>
    Nova <span class="glyphicon glyphicon-plus"></span>
</a>

<label class="text-primary">Mensalidades</label>


<?php
$st = Request::get('st');
echo Form::select('status', ['0' => 'Abertas', '1' => 'Quitadas'], $st, ['id' => 'select-status', 'data-url' => route('contratos.edit', $contrato->id)]
);
?>


<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Nr</th>
            <th>Vencimento</th>
            <th>Valor</th>
            <th>Pago em</th>
            <th>Status</th>
            <th>Ação</th>
        </tr>

    </thead>
    <tbody>
<?php $key = 0 ?>
        @foreach($contrato->getMensalidades($st) as $mensalidade)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$mensalidade->vencimento}}</td>
            <td>R$ {{$mensalidade->formatedValor}}</td>
            <td>{{$mensalidade->formated_pago_em}}</td>
            <td>
                {{$mensalidade->nome_status}}
                @if($mensalidade->quitada==1)
                <a href="{{url("mensalidades/desquitar/$mensalidade->id")}}" 
                   class="confirm-desfazer-quitar"
                   data-toggle="tooltip" title="Desafazer Quitar"> 
                    <span class="glyphicon glyphicon-arrow-left"></span>
                </a>
                @endif
            </td>
            <td
                data-valor="{{$mensalidade->formatedValor}}"
                data-vencimento="{{$mensalidade->vencimento}}"
                data-id="{{$mensalidade->id}}"
                >

                @if($mensalidade->quitada!=1)
                @if($mensalidade->id)
                <a href="#" data-toggle="tooltip" title="Editar"
                   class="btn_editar_mensalidade">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
                |

                <a class='confirm text-danger' 
                   data-toggle="tooltip" title="Excluir"
                   href="{{url("mensalidades/$mensalidade->id")}}"
                   ><span class="glyphicon glyphicon-remove"></span></a>
                |
                @endif

                <a href="#" data-toggle="tooltip" title="Quitar"
                   class="btn_quitar_mensalidade text-success">
                    <span class="glyphicon glyphicon-usd"></span>
                </a>
                @endif  





            </td>
        </tr>
<?php $key++ ?>
        @endforeach

    </tbody>
</table>
@include('contratos.modal')
@include('contratos.quitacao')
<script>
    $("#btn_add_mensalidade").click(function () {
        $("#saveMensalidade").attr('data-method', 'post');
        var originalAction = $("#saveMensalidade").attr('data-originalAction');
        $("#saveMensalidade").attr('data-action', originalAction);
        $("#id_mensalidade").val('');
        $("#valor").val('');
        $("#vencimento").val('');
        $("#modal_mensalidade").modal('show');

    });


    $(".btn_editar_mensalidade").click(function (e) {
        e.preventDefault();
        var id = this.parentNode.dataset.id;
        var valor = this.parentNode.dataset.valor;
        var vencimento = this.parentNode.dataset.vencimento;
        var originalAction = $("#saveMensalidade").attr('data-originalAction');
        $("#saveMensalidade").attr('data-action', originalAction + '/' + id);
        $("#saveMensalidade").attr('data-method', 'put');
        $("#id_mensalidade").val(id);
        $("#valor").val(valor);
        $("#vencimento").val(vencimento);
        $("#modal_mensalidade").modal('show');

    });

    $(".btn_quitar_mensalidade").click(function (e) {
        e.preventDefault();
        var id = this.parentNode.dataset.id;
        var valor = this.parentNode.dataset.valor;
        var vencimento = this.parentNode.dataset.vencimento;
        //alert('id'+id+' valor '+valor+' vencimento'+vencimento);

        $("#vencimento_previsto").html(vencimento);
        $("#quit_valor").html(valor);
        $("#id_mensalidade").val(id);
        $("#valor").val(valor);
        $("#vencimento").val(vencimento);
        $("#modal_quitacao").modal('show');

    });

    $('#saveMensalidade').click(function (e) {
        e.preventDefault();

        $('input[name=_method]').val(this.dataset.method);
        $('form').attr('action', this.dataset.action);
        if (validaMensalidades()) {
            $('form').submit();
        }
    });

    $('#saveQuitar').click(function (e) {
        e.preventDefault();

        $('input[name=_method]').val(this.dataset.method);
        $('form').attr('action', this.dataset.action);
        if (validaQuitar()) {
            $('form').submit();
        }
    });

    $("#select-status").change(function (e) {
        window.location.href = this.dataset.url + '?st=' + this.value;
    });

    function validaMensalidades() {
        removeMensagem('.mensagem-erro');
        var valor = $('input[name=valor]').val().trim();
        var vencimento = $('input[name=vencimento]').val().trim();
        var retorno = true;
        if (valor == '') {
            enviaMensagem('input[name=valor]', 'O Campo Valor é obrigatório');
            retorno = false;
        } else {
            removeMensagem('input[name=valor] + .mensagem-erro');
        }
        if (vencimento == '') {
            enviaMensagem('input[name=vencimento]', 'O Campo Vencimento é obrigatório');
            retorno = false;
        } else {
            removeMensagem('input[name=vencimento] + .mensagem-erro');
        }
        return retorno;
    }

    function validaQuitar() {
        removeMensagem('.mensagem-erro');
        var pago_em = $('input[name=pago_em]').val().trim();


        var retorno = true;
        if (pago_em == '') {
            enviaMensagem('input[name=pago_em]', 'Data de pagamento é obrigatório');
            retorno = false;
        } else {
            removeMensagem('input[name=pago_em] + .mensagem-erro');
        }
        return retorno;
    }

    function enviaMensagem(elemento, mensagem) {
        var texto = '<span class="help-block mensagem-erro text-danger"><strong>' + mensagem + '</strong></span>';
        $(elemento).after(texto);
    }
    function removeMensagem(elemento) {
        $(elemento).remove();
    }

</script>

