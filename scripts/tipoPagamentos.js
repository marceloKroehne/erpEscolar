$(document).ready(function() {
    $('form')[0].reset();
    iniciarComponentesGerenciarpagamento();
});

function iniciarComponentesGerenciarpagamento(){

    $("#novo_pagamento").on("click", function(){
        abrirModalpagamento(null);
    });

    $("#tabela_pagamento tbody td:last-child button").click(function() {
        abrirModalpagamento($(this).parent().data('value'));
    });

}

function abrirModalpagamento(pagamento){
    $("#tipo_pagamento_id").val(pagamento === null ? 0 : pagamento.tipoPagamentoId);
    $("#modal_pag").modal('show');
    iniciarComponentesModalpagamento(pagamento);
}


function iniciarComponentesModalpagamento(pagamento){

    $("#valor_salario").mask('000.000.000.000,00', {reverse: true});
    $("#valor_hora").mask('000.000.000.000,00', {reverse: true});
    $("#percentual_inss").mask('00,00', {reverse: true});

    $("#tipo_pagamento_selecionado").change(function(){
        trocarTipoPagamentoSelecionado();
    });

    if(pagamento !== null){
        $("#modal_pag_titulo").text("pagamento: " + pagamento.nome);
        $("#modal_pag_input_nome").val(pagamento.nome);
        $("#tipo_pagamento_id").val(pagamento.tipoPagamentoId);
        $("#tipo_pagamento_selecionado").val(pagamento.valorSalario != null ? 0 : 1);
        $("#valor_salario").val(pagamento.valorSalario == null ? "" : pagamento.valorSalario.replace(/\./g, ",").replace(/\-/g, ""));
        $("#percentual_inss").val(pagamento.percentualInss == null ? "" : pagamento.percentualInss.replace(/\./g, ",").replace(/\-/g, ""));
        $("#valor_hora").val(pagamento.valorHora == null ? "" : pagamento.valorHora.replace(/\./g, ",").replace(/\-/g, ""));
        $("#pag_ativo").prop("checked", pagamento.ativo);
        $("#pag_ativo").show();
        $("#pag_ativo").parent().show();
        
    }
    else{
        $("#modal_pag_titulo").text("Novo pagamento");
        $("#modal_pag_input_nome").val("");
        $("#valor_salario").val("");
        $("#percentual_inss").val("");
        $("#valor_hora").val("");
        $("#tipo_pagamento_id").val(0);
        $("#tipo_pagamento_selecionado").val(0);
        $("#pag_ativo").prop("checked", true);
        $("#pag_ativo").hide();
        $("#pag_ativo").parent().hide();
    }

    trocarTipoPagamentoSelecionado();

    $("#modal_pag_bt_fechar").on("click",function(){
        $("#modal_pag").modal('hide');
    });

    $("#modal_pag_bt_cancelar").on("click",function(){
        $("#modal_pag").modal('hide');
    });

    
    $("#modal_pag_bt_salvar").on("click",function(){
        if ($("#modal_pag_input_nome").val() === "") {
            alert("O campo nome é obrigatório!");
            return;
        }
        else if($("#tipo_pagamento_selecionado").val() === '0'){
            if($("#valor_salario").val() === "" || $("#percentual_inss").val() === ""){
                alert("Os campos valor salário e percentual INSS são obrigatórios!");
                return;
            }
        }
        else if($("#tipo_pagamento_selecionado").val() === '1'){
            if($("#valor_hora").val() === ""){
                alert("O campo valor hora é obrigatório!");
                return;
            }
        }
        $("#modal_pag_form").submit();
    });

}

function trocarTipoPagamentoSelecionado(){
    if($("#tipo_pagamento_selecionado").val() === '0'){
        $("#valor_salario").show();
        $("#percentual_inss").show();
        $("#valor_hora").hide();

        $("#valor_hora").val(null);

        $("#valor_salario").parent().show();
        $("#percentual_inss").parent().show();
        $("#valor_hora").parent().hide()
    }
    else{
        $("#valor_salario").hide();
        $("#percentual_inss").hide();
        $("#valor_hora").show();

        $("#valor_salario").val(null);
        $("#percentual_inss").val(null);

        $("#valor_salario").parent().hide();
        $("#percentual_inss").parent().hide();
        $("#valor_hora").parent().show();
    }
}
