$('#myModal').on('show.bs.modal', function (event) {
    //event.preventDefault();
    var button = $(event.relatedTarget); // Button that triggered the modal

    //$('.modal-body').load(button.data('href'));
    var modal = $(this);
    modal.find('.modal-title').text(button.text());
    //ajax load
    modal.find('.modal-body').load(button.data('href'), function () {
        gatilhoModal();
        logicaVenda();
    });

});





$('button[type=submit]').click(function () {
     
    var validator = $( "#form-venda" ).validate();
    
    if(validator.form()){
    $('#form-venda').submit();
    }
});


function logicaVenda() {

    $('#produto_id').change(function () {
        var valor_venda = $('#produto_id option:selected').attr('data-venda');
        var valor_compra = $('#produto_id option:selected').attr('data-compra');
        escrever_valor(valor_venda, '#valor_venda');
        escrever_valor(valor_compra, '#valor_compra');
        $("#qtd").trigger("change");

    }); // fim do chang
    $("#qtd").blur(function () {

        var qtd = ler_valor(this);
        var valor_venda = ler_valor('#valor_venda');

        if (qtd) {
            if (valor_venda) {
                var total = valor_venda * qtd;
                escrever_valor(total, '#total');
            }

        }

    }); //fim blur qtd

    $("#valor_venda").blur(function () {
        var valor_venda = ler_valor(this);
        var qtd = ler_valor("#qtd");
        if (qtd && valor_venda) {
            var total = valor_venda * qtd;
            escrever_valor(total, '#total');
        }
    });

    $("#total").blur(function () {
        var total = ler_valor(this);
        var qtd = ler_valor("#qtd");
        if (total && qtd) {
            var valor_unitario_venda = total / qtd;
            escrever_valor(valor_unitario_venda, '#valor_venda');
        }
    }); //fim blur total
    
$.validator.setDefaults({ ignore: ":hidden:not(select)" }) ;
$("#form-venda").validate({
        rules: {
            /*data: {required: true},*/
            valor_compra: {required: true},
            valor_venda: {required: true},
            produto_id: {required: true},
            qtd: {required: true}

        },
        messages: {
           // data: {required: 'Digite a Data'},
            valor_compra: {required: 'Digite o valor de Compra'},
            valor_venda: {required: 'Digite o valor da Venda'},
            produto_id: {required: "Selecione o Produto"},
            qtd: {required: "Digite a Qtd."}

        }
    });//fechamento do validate
    
   

} //final logica venda

function escrever_valor(valor, campo) {
    valor = parseFloat(valor);
    valor = valor.toFixed(2);
    var valor_formatado = valor.toString().replace('.', ',');
    $(campo).val(valor_formatado);
}

function ler_valor(campo) {
    var valor = $(campo).val().replace('.', '').replace(',', '.');
    //alert(valor);
    return parseFloat(valor);
}
