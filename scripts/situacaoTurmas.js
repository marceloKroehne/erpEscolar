$(document).ready(function() {
    $('form')[0].reset();
    iniciarComponentesGerenciarsituacao_turma();
});

function iniciarComponentesGerenciarsituacao_turma(){

    $("#novo_situacao_turma").on("click", function(){
        abrirModalsituacao_turma(null);
    });

    $("#tabela_situacao_turma tbody td:last-child button").click(function() {
        abrirModalsituacao_turma($(this).parent().data('value'));
    });

}

function abrirModalsituacao_turma(situacao_turma){
    $("#situacao_turma_id").val(situacao_turma === null ? 0 : situacao_turma.situacaoTurmaId);
    $("#modal_situacao_turma").modal('show');
    iniciarComponentesModalsituacao_turma(situacao_turma);
}


function iniciarComponentesModalsituacao_turma(situacao_turma){

    if(situacao_turma !== null){
        $("#modal_situacao_turma_titulo").text("Situação de turma: " + situacao_turma.nome);
        $("#modal_situacao_turma_input_nome").val(situacao_turma.nome);
        $("#situacao_turma_id").val(situacao_turma.situacaoTurmaId);
        $("#situacao_turma_ativo").prop("checked", situacao_turma.ativo);
        $("#situacao_turma_ativo").show();
        $("#situacao_turma_ativo").parent().show();
    }
    else{
        $("#modal_situacao_turma_titulo").text("Nova situação de turma");
        $("#modal_situacao_turma_input_nome").val("");
        $("#situacao_turma_id").val(0);
        $("#situacao_turma_ativo").prop("checked", true);
        $("#situacao_turma_ativo").hide();
        $("#situacao_turma_ativo").parent().hide();
    }

    $("#modal_situacao_turma_bt_fechar").on("click",function(){
        $("#modal_situacao_turma").modal('hide');
    });

    $("#modal_situacao_turma_bt_cancelar").on("click",function(){
        $("#modal_situacao_turma").modal('hide');
    });

    
    $("#modal_situacao_turma_bt_salvar").on("click",function(){
        if ($("#modal_situacao_turma_input_nome").val() === "") {
            alert("O campo nome é obrigatório!");
            return;
        }
        $("#modal_situacao_turma_form").submit();
    });

}
