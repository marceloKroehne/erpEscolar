$(document).ready(function() {
    $('form')[0].reset();
    iniciarComponentesGerenciarcargo();
});

function iniciarComponentesGerenciarcargo(){

    $("#novo_cargo").on("click", function(){
        abrirModalcargo(null);
    });

    $("#tabela_cargo tbody td:last-child button").click(function() {
        abrirModalcargo($(this).parent().data('value'));
    });

}

function abrirModalcargo(cargo){
    $("#cargo_id").val(cargo === null ? 0 : cargo.cargoId);
    $("#modal_cargo").modal('show');
    iniciarComponentesModalcargo(cargo);
}


function iniciarComponentesModalcargo(cargo){

    if(cargo !== null){
        $("#modal_cargo_titulo").text("Cargo: " + cargo.nome);
        $("#cargo_nome").val(cargo.nome);
        $("#cargo_id").val(cargo.cargoId);
        $("#cargo_ativo").prop("checked", cargo.ativo);
        $("#cargo_ativo").show();
        $("#cargo_ativo").parent().show();
    }
    else{
        $("#modal_cargo_titulo").text("Novo cargo");
        $("#cargo_nome").val("");
        $("#cargo_id").val(0);
        $("#cargo_ativo").prop("checked", true);
        $("#cargo_ativo").hide();
        $("#cargo_ativo").parent().hide();
    }

    $("#modal_cargo_bt_fechar").on("click",function(){
        $("#modal_cargo").modal('hide');
    });

    $("#modal_cargo_bt_cancelar").on("click",function(){
        $("#modal_cargo").modal('hide');
    });

    
    $("#modal_cargo_bt_salvar").on("click",function(){
        if ($("#modal_cargo_input_nome").val() === "") {
            alert("O campo nome é obrigatório!");
            return;
        }
        $("#modal_cargo_form").submit();
    });

}
