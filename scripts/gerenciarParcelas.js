$(document).ready(function() {
    $('form')[0].reset();
    iniciarComponentesGerenciarparcela();
});

function iniciarComponentesGerenciarparcela(){

    $("#novo_parcela").on("click", function(){
        if($("#contrato").val() == ""){
            alert("Selecione um contrato!");
            return;
        }
        abrirModalparcela(null);
    });

    $("#tabela_parcela tbody td:last-child button").click(function() {
        abrirModalparcela($(this).parent().data('value'));
    });

    $("#input_gerenciar_contrato").on("click", function(){
        $("#contrato").val("");
    });

    $("#input_gerenciar_conta").on("click", function(){
        $("#filtro_conta").val("");
    });
    $("#input_gerenciar_subconta").on("click", function(){
        $("#filtro_subconta").val("");
    });

    $("#lista_gerenciar_contrato option").each(function(){
        $(this).on("click", function(){
            $("#contrato").val(JSON.stringify(JSON.parse($(this).val()).dados));
            $("#form_pesq_contrato").submit();
        })
    });

    $("#lista_gerenciar_conta option").each(function(){
        $(this).on("click", function(){
            var dados = JSON.parse($(this).val()).dados;
            $("#filtro_conta").val(JSON.stringify(dados));
        })
    });

    $("#lista_gerenciar_subconta option").each(function(){
        $(this).on("click", function(){
            var dados = JSON.parse($(this).val()).dados;
            $("#filtro_subconta").val(JSON.stringify(dados));
        })
    });


    if($("#contrato").val() != ""){
        var contratoSel = JSON.parse($("#contrato").val());
        $("#input_gerenciar_contrato").val("Nº:" + contratoSel.contratoId + " / Turma : "+ contratoSel.turma.nome + " - Aluno: " + contratoSel.aluno.nome);
    }

}

function abrirModalparcela(parcela){
    $("#parcela_id").val(parcela === null ? 0 : parcela.parcelaId);
    $("#modal_parcela").modal('show');
    iniciarComponentesModalparcela(parcela);
}


function iniciarComponentesModalparcela(parcela){

    $("#valor").mask('000.000.000.000,00', {reverse: true});
    $("#data_pagamento").mask("00/00/0000");

    $("#data_pagamento").datepicker(
        { 
            dateFormat: 'dd/mm/yy',
            language: 'pt-BR',
            onSelect: function(dateText, inst) {
                $(this).val(dateText);
            }
        }
    );

    $("#data_pagamento").hide();
    $("#lb_data_pagamento").hide();
    $("#input_gerenciar_conta").hide();
    $("#input_gerenciar_subconta").hide();
    $("#lb_conta").hide();
    $("#lb_subconta").hide();

    $("#quitar").on("click", function(){
        $("#data_pagamento").val("");
        $("#filtro_subconta").val("");
        $("#filtro_conta").val("");
        $("#input_gerenciar_conta").val("");
        $("#input_gerenciar_subonta").val("");

        if($("#quitar").prop("checked")){
            $("#data_pagamento").show();
            $("#lb_data_pagamento").show();
            $("#input_gerenciar_conta").show();
            $("#input_gerenciar_subconta").show();
            $("#lb_conta").show();
            $("#lb_subconta").show();
        }
        else{
            $("#data_pagamento").hide();
            $("#lb_data_pagamento").hide();
            $("#lb_conta").hide();
            $("#lb_subconta").hide();
            $("#input_gerenciar_conta").hide();
            $("#input_gerenciar_subconta").hide();
        }
    });

    if(parcela !== null){
        $("#modal_parcela_bt_deletar").show();
        $("#modal_parcela_titulo").text("Parcela: " + parcela.nome);
        $("#modal_parcela_input_nome").val(parcela.nome);
        $("#parcela_id").val(parcela.parcelaId);
        $("#valor").val(parcela.valor);
        $("#valor").val($("#valor").val().replace(/\./g, ",").replace(/\-/g, ""));
        $("#data_pagamento").val(parcela.dataPagamento);
        if(parcela.conta.agencia != null){
            var conta = parcela.conta;
            $("#filtro_conta").val(JSON.stringify(conta));
            $("#input_gerenciar_conta").val(conta.banco.nome + " - Ag:" + conta.agencia  + " N°: " + conta.numeroConta);
            $("#input_gerenciar_conta").show();
            $("#lb_conta").show();
  
        }
        else{
            $("#filtro_conta").val("");
            $("#lb_conta").hide();
            $("#input_gerenciar_conta").hide();

        }
        if(parcela.subconta.subcontaId != null){
            $("#filtro_subconta").val(JSON.stringify(parcela.subconta));  
            $("#input_gerenciar_subconta").val(parcela.subconta.nome);
            $("#input_gerenciar_subconta").show();
            $("#lb_subconta").show();
        }
        else{
            $("#filtro_subconta").val("");
            $("#lb_subconta").hide();
            $("#input_gerenciar_subconta").hide();
        }
     
        if(parcela.movimento.movimentoId != null){
            $("#modal_parcela_input_nome").prop("disabled", true);
            $("#parcela_id").prop("disabled", true);
            $("#valor").prop("disabled", true);
            $("#data_pagamento").prop("disabled", true);
            $("#input_gerenciar_conta").prop("disabled", true);
            $("#input_gerenciar_subconta").prop("disabled", true);
            $("#modal_parcela_bt_salvar").prop("disabled", true);
            $("#data_pagamento").show();
            $("#lb_data_pagamento").show();
            $("#quitar").prop("checked", true);
            $("#quitar").prop("disabled", true);
            $("#modal_parcela_bt_deletar").hide();
        }else{
            $("#modal_parcela_input_nome").prop("disabled", false);
            $("#parcela_id").prop("disabled", false);
            $("#valor").prop("disabled", false);
            $("#data_pagamento").prop("disabled", false);
            $("#input_gerenciar_conta").prop("disabled", false);
            $("#input_gerenciar_subconta").prop("disabled", false);
            $("#modal_parcela_bt_salvar").prop("disabled", false);
            $("#quitar").prop("checked", false);
            $("#quitar").prop("disabled", false);
            $("#modal_parcela_bt_deletar").show();
        }
        if(parcela.statusPagamento == 1){
            $("#quitar").prop("checked", true);
            $("#data_pagamento").show();
            $("#lb_data_pagamento").show();
        }

    }
    else{
        $("#modal_parcela_titulo").text("Nova parcela");
        $("#modal_parcela_input_nome").val("");
        $("#valor").val("");
        $("#parcela_id").val(0);
        $("#data_pagamento").val("");
        $("#modal_parcela_bt_deletar").hide();
    }

    $("#modal_parcela_bt_fechar").on("click",function(){
        $("#modal_parcela").modal('hide');
    });

    $("#modal_parcela_bt_cancelar").on("click",function(){
        $("#modal_parcela").modal('hide');
    });

    $("#modal_parcela_bt_deletar").on("click",function(){
        $("#parcela_deletar_id").val( $("#parcela_id").val());
        $("#modal_parcela_form_delet").submit();
    });

    
    $("#modal_parcela_bt_salvar").on("click",function(){
        if ($("#modal_parcela_input_nome").val() === "") {
            alert("O campo nome é obrigatório!");
            return;
        }
        else if($("#quitar").prop("checked")){
            if($("#data_pagamento").val() == ""){
                alert("O campo data de pagamento é obrigatório!");
                return;
            }
            else if ($("#filtro_subcontas").val() === "") {
                alert("O campo subconta é obrigatório!");
                return;
            }
            else if ($("#filtro_contas").val() === "") {
                alert("O campo conta é obrigatório!");
                return;
            }
        }
        $("#modal_parcela_form").submit();
    });

}
