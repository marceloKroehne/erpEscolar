$(document).ready(function() {
    $('form')[0].reset();
    iniciarComponentesGerenciarsituacao_contrato();
});

function iniciarComponentesGerenciarsituacao_contrato(){

    $("#novo_situacao_contrato").on("click", function(){
        abrirModalsituacao_contrato(null);
    });

    $("#tabela_situacao_contrato tbody td:last-child button").click(function() {
        abrirModalsituacao_contrato($(this).parent().data('value'));
    });

}

function abrirModalsituacao_contrato(situacao_contrato){
    $("#situacao_contrato_id").val(situacao_contrato === null ? 0 : situacao_contrato.situacaoContratoId);
    $("#modal_situacao_contrato").modal('show');
    iniciarComponentesModalsituacao_contrato(situacao_contrato);
}


function iniciarComponentesModalsituacao_contrato(situacao_contrato){

    if(situacao_contrato !== null){
        $("#modal_situacao_contrato_titulo").text("Situação de contrato: " + situacao_contrato.nome);
        $("#modal_situacao_contrato_input_nome").val(situacao_contrato.nome);
        $("#situacao_contrato_id").val(situacao_contrato.situacaoContratoId);
        $("#situacao_contrato_ativo").prop("checked", situacao_contrato.ativo);
        $("#situacao_contrato_ativo").show();
        $("#situacao_contrato_ativo").parent().show();
    }
    else{
        $("#modal_situacao_contrato_titulo").text("Nova situação de contrato");
        $("#modal_situacao_contrato_input_nome").val("");
        $("#situacao_contrato_id").val(0);
        $("#situacao_contrato_ativo").prop("checked", true);
        $("#situacao_contrato_ativo").hide();
        $("#situacao_contrato_ativo").parent().hide();
    }

    $("#modal_situacao_contrato_bt_fechar").on("click",function(){
        $("#modal_situacao_contrato").modal('hide');
    });

    $("#modal_situacao_contrato_bt_cancelar").on("click",function(){
        $("#modal_situacao_contrato").modal('hide');
    });

    
    $("#modal_situacao_contrato_bt_salvar").on("click",function(){
        if ($("#modal_situacao_contrato_input_nome").val() === "") {
            alert("O campo nome é obrigatório!");
            return;
        }
        $("#modal_situacao_contrato_form").submit();
    });

}
