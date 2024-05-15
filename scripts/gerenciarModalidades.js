$(document).ready(function() {
    $('form')[0].reset();
    iniciarComponentesGerenciarmodalidade();
});

function iniciarComponentesGerenciarmodalidade(){

    $("#novo_modalidade").on("click", function(){
        abrirModalmodalidade(null);
    });

    $("#tabela_modalidade tbody td:last-child button").click(function() {
        abrirModalmodalidade($(this).parent().data('value'));
    });

}

function abrirModalmodalidade(modalidade){
    $("#modalidade_id").val(modalidade === null ? 0 : modalidade.modalidadeId);
    $("#modal_modalidade").modal('show');
    iniciarComponentesModalmodalidade(modalidade);
}


function iniciarComponentesModalmodalidade(modalidade){

    if(modalidade !== null){
        $("#modal_modalidade_titulo").text("Modalidade: " + modalidade.nome);
        $("#modal_modalidade_input_nome").val(modalidade.nome);
        $("#modalidade_id").val(modalidade.modalidadeId);
        $("#modalidade_ativo").prop("checked", modalidade.ativo);
        $("#modalidade_ativo").show();
        $("#modalidade_ativo").parent().show();
    }
    else{
        $("#modal_modalidade_titulo").text("Nova modalidade");
        $("#modal_modalidade_input_nome").val("");
        $("#modalidade_id").val(0);
        $("#modalidade_ativo").prop("checked", true);
        $("#modalidade_ativo").hide();
        $("#modalidade_ativo").parent().hide();
    }

    $("#modal_modalidade_bt_fechar").on("click",function(){
        $("#modal_modalidade").modal('hide');
    });

    $("#modal_modalidade_bt_cancelar").on("click",function(){
        $("#modal_modalidade").modal('hide');
    });

    
    $("#modal_modalidade_bt_salvar").on("click",function(){
        if ($("#modal_modalidade_input_nome").val() === "") {
            alert("O campo nome é obrigatório!");
            return;
        }
        $("#modal_modalidade_form").submit();
    });

}
