$(document).ready(function() {
    $('form')[0].reset();
    iniciarComponentesGerenciardocumento();
});

function iniciarComponentesGerenciardocumento(){

    $("#novo_documento").on("click", function(){
        abrirModaldocumento(null);
    });

    $("#tabela_documento tbody td:last-child button").click(function() {
        abrirModaldocumento($(this).parent().data('value'));
    });

}

function abrirModaldocumento(documento){
    $("#tipo_documento_id").val(documento === null ? 0 : documento.documentoId);
    $("#modal_doc").modal('show');
    iniciarComponentesModaldocumento(documento);
}


function iniciarComponentesModaldocumento(documento){

    if(documento !== null){
        $("#modal_doc_titulo").text("documento: " + documento.nome);
        $("#modal_doc_input_nome").val(documento.nome);
        $("#tipo_documento_id").val(documento.tipoDocumentoId);
        $("#doc_ativo").prop("checked", documento.ativo);
        $("#doc_ativo").show();
        $("#doc_ativo").parent().show();
    }
    else{
        $("#modal_doc_titulo").text("Novo documento");
        $("#modal_doc_input_nome").val("");
        $("#tipo_documento_id").val(0);
        $("#doc_ativo").prop("checked", true);
        $("#doc_ativo").hide();
        $("#doc_ativo").parent().hide();
    }

    $("#modal_doc_bt_fechar").on("click",function(){
        $("#modal_doc").modal('hide');
    });

    $("#modal_doc_bt_cancelar").on("click",function(){
        $("#modal_doc").modal('hide');
    });

    
    $("#modal_doc_bt_salvar").on("click",function(){
        if ($("#modal_doc_input_nome").val() === "") {
            alert("O campo nome é obrigatório!");
            return;
        }
        $("#modal_doc_form").submit();
    });

}
