$(document).ready(function() {
    $('form')[0].reset();
    iniciarComponentesGerenciartipo_contrato();
});

function iniciarComponentesGerenciartipo_contrato(){

    $("#novo_tipo_contrato").on("click", function(){
        abrirModaltipo_contrato(null);
    });

    $("#tabela_tipo_contrato tbody td:last-child button").click(function() {
        abrirModaltipo_contrato($(this).parent().data('value'));
    });

}

function abrirModaltipo_contrato(tipo_contrato){
    $("#tipo_contrato_id").val(tipo_contrato === null ? 0 : tipo_contrato.tipoContratoId);
    $("#modal_tipo_contrato").modal('show');
    iniciarComponentesModaltipo_contrato(tipo_contrato);
}


function iniciarComponentesModaltipo_contrato(tipo_contrato){

    if(tipo_contrato !== null){
        $("#modal_tipo_contrato_titulo").text("Tipo de contrato: " + tipo_contrato.nome);
        $("#modal_tipo_contrato_input_nome").val(tipo_contrato.nome);
        $("#tipo_contrato_id").val(tipo_contrato.tipoContratoId);
        $("#tipo_contrato_ativo").prop("checked", tipo_contrato.ativo);
        $("#tipo_contrato_ativo").show();
        $("#tipo_contrato_ativo").parent().show();
    }
    else{
        $("#modal_tipo_contrato_titulo").text("Novo tipo de contrato");
        $("#modal_tipo_contrato_input_nome").val("");
        $("#tipo_contrato_id").val(0);
        $("#tipo_contrato_ativo").prop("checked", true);
        $("#tipo_contrato_ativo").hide();
        $("#tipo_contrato_ativo").parent().hide();
    }

    $("#modal_tipo_contrato_bt_fechar").on("click",function(){
        $("#modal_tipo_contrato").modal('hide');
    });

    $("#modal_tipo_contrato_bt_cancelar").on("click",function(){
        $("#modal_tipo_contrato").modal('hide');
    });

    
    $("#modal_tipo_contrato_bt_salvar").on("click",function(){
        if ($("#modal_tipo_contrato_input_nome").val() === "") {
            alert("O campo nome é obrigatório!");
            return;
        }
        $("#modal_tipo_contrato_form").submit();
    });

}
