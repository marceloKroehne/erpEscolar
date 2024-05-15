$(document).ready(function() {
    $('form')[0].reset();
    iniciarComponentesGerenciarturno();
});

function iniciarComponentesGerenciarturno(){

    $("#novo_turno").on("click", function(){
        abrirModalturno(null);
    });

    $("#tabela_turno tbody td:last-child button").click(function() {
        abrirModalturno($(this).parent().data('value'));
    });

}

function abrirModalturno(turno){
    $("#turno_id").val(turno === null ? 0 : turno.turnoId);
    $("#modal_turno").modal('show');
    iniciarComponentesModalturno(turno);
}


function iniciarComponentesModalturno(turno){

    if(turno !== null){
        $("#modal_turno_titulo").text("Turno: " + turno.nome);
        $("#modal_turno_input_nome").val(turno.nome);
        $("#turno_id").val(turno.turnoId);
        $("#turno_ativo").prop("checked", turno.ativo);
        $("#turno_ativo").show();
        $("#turno_ativo").parent().show();
    }
    else{
        $("#modal_turno_titulo").text("Novo turno");
        $("#modal_turno_input_nome").val("");
        $("#turno_id").val(0);
        $("#turno_ativo").prop("checked", true);
        $("#turno_ativo").hide();
        $("#turno_ativo").parent().hide();
    }

    $("#modal_turno_bt_fechar").on("click",function(){
        $("#modal_turno").modal('hide');
    });

    $("#modal_turno_bt_cancelar").on("click",function(){
        $("#modal_turno").modal('hide');
    });

    
    $("#modal_turno_bt_salvar").on("click",function(){
        if ($("#modal_turno_input_nome").val() === "") {
            alert("O campo nome é obrigatório!");
            return;
        }
        $("#modal_turno_form").submit();
    });

}
