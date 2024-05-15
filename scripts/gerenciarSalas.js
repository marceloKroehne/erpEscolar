$(document).ready(function() {
    $('form')[0].reset();
    iniciarComponentesGerenciarsala();
});

function iniciarComponentesGerenciarsala(){

    $("#novo_sala").on("click", function(){
        abrirModalsala(null);
    });

    $("#tabela_sala tbody td:last-child button").click(function() {
        abrirModalsala($(this).parent().data('value'));
    });

}

function abrirModalsala(sala){
    $("#sala_id").val(sala === null ? 0 : sala.salaId);
    $("#modal_sala").modal('show');
    iniciarComponentesModalsala(sala);
}


function iniciarComponentesModalsala(sala){

    if(sala !== null){
        $("#modal_sala_titulo").text("Sala: " + sala.nome);
        $("#modal_sala_input_nome").val(sala.nome);
        $("#sala_id").val(sala.salaId);
        $("#sala_ativo").prop("checked", sala.ativo);
        $("#sala_ativo").show();
        $("#sala_ativo").parent().show();
    }
    else{
        $("#modal_sala_titulo").text("Nova sala");
        $("#modal_sala_input_nome").val("");
        $("#sala_id").val(0);
        $("#sala_ativo").prop("checked", true);
        $("#sala_ativo").hide();
        $("#sala_ativo").parent().hide();
    }

    $("#modal_sala_bt_fechar").on("click",function(){
        $("#modal_sala").modal('hide');
    });

    $("#modal_sala_bt_cancelar").on("click",function(){
        $("#modal_sala").modal('hide');
    });

    
    $("#modal_sala_bt_salvar").on("click",function(){
        if ($("#modal_sala_input_nome").val() === "") {
            alert("O campo nome é obrigatório!");
            return;
        }
        $("#modal_sala_form").submit();
    });

}
