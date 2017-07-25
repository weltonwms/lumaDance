$(document).ready(function () {
    $(".confirm").confirm({
        text: "Deseja realmente excluir este Item?",
        title: "  Exclusão de Item",
        confirmButton: " Excluir",
        cancelButton: " Cancelar",
        post: true

    });
    
    $(".confirm-desativar").confirm({
        text: "Deseja realmente desativar Este Contrato?",
        title: "  Exclusão de Item",
        confirmButton: " Desativar",
        cancelButton: " Cancelar",
        post: true,
        method:'put',
        classIconConfirmButton:' glyphicon glyphicon-remove-sign'

    });
    
    $(".confirm-payment").confirm({
        text: "Deseja realmente quitar pagamento com professor?",
        title: "  Pagamento de Professor",
        confirmButton: " Quitar",
        cancelButton: " Cancelar",
        post: true,
        method:'put',
        classIconConfirmButton:' glyphicon glyphicon-ok',
        classConfirmButton:' btn btn-success'

    });
    
    $(".confirm-desfazer-quitar").confirm({
        text: "Deseja realmente desfazer quitação?<br>O registro de Pagamento ao Professor dessa Mensalidade será excluída",
        title: "Desfazer Quitar",
        confirmButton: " Confirmar",
        cancelButton: " Cancelar",
        post: true,
        method:'put',
        classIconConfirmButton:' glyphicon glyphicon-ok',
        classConfirmButton:' btn btn-success'

    });


    $('.date').datepicker({
        format: "dd/mm/yyyy",
        language: "pt-BR",
        todayHighlight: true
    });
    
    $("body").tooltip({
    selector: '[data-toggle="tooltip"]'
    });




    $('.telefone').mask(SPMaskBehavior, spOptions);
    $('.money').mask('000.000.000.000.000,00', {reverse: true});
    $('.date').mask('A0/I0/0000', {'translation': {
            A: {pattern: /[0-3]/},
            I: {pattern: /[0-1]/}
        }
    });
    $('.dia').mask('00');

    $('.time').mask('A0:I0', {'translation': {
            A: {pattern: /[0-2]/},
            I: {pattern: /[0-5]/}
        }
    });
    $('.meu_chosen').chosen({
        allow_single_deselect: true,
        no_results_text: "Oops, Não encontrado!"

    });

}); //fechamento do ready

var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
        spOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };


