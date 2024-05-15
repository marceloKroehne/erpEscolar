$(document).ready(function() {
    $('form')[0].reset();
    iniciarComponentesGerenciargrupo();
});

function iniciarComponentesGerenciargrupo(){

    $("#novo_grupo").on("click", function(){
        abrirModalGrp(null);
    });

    $("#nova_subconta").on("click", function(){
        abrirModalSub(null);
    });

    $("#tabela_grp tbody td:last-child button").click(function() {
        abrirModalGrp($(this).parent().data('value'));
    });

    $("#tabela_sub tbody td:last-child button").click(function() {
        abrirModalSub($(this).parent().parent().data('value'));
    });

    $("#lista_gerenciar_grupo option").each(function(){
        $(this).on("click", function(){
            $("#modal_sub_grupo_id").val(JSON.parse($(this).val()).dados.grupoContaId);
        })
    });
}

function abrirModalGrp(grupo){
    $("#grupo_conta_id").val(grupo === null ? 0 : grupo.grupoContaId);
    $("#modal_grp").modal('show');
    iniciarComponentesModalGrp(grupo);
}


function abrirModalSub(subconta){
    $("#subconta_id").val(subconta === null ? 0 : subconta.subcontaId);
    $("#modal_sub").modal('show');
    iniciarComponentesModalSub(subconta);
}


function iniciarComponentesModalGrp(grupo){

    if(grupo !== null){
        $("#modal_grp_titulo").text("Grupo de contas: " + grupo.nome);
        $("#modal_grp_input_nome").val(grupo.nome);
        $("#grupo_ativo").prop("checked", grupo.ativo);
        $("#grupo_ativo").show();
        $("#grupo_ativo").parent().show();
    }
    else{
        $("#modal_grp_titulo").text("Novo grupo de contas");
        $("#modal_grp_input_nome").val("");
        $("#grupo_ativo").prop("checked", true);
        $("#grupo_ativo").hide();
        $("#grupo_ativo").parent().hide();
    }

    $("#modal_grp_bt_fechar").on("click",function(){
        $("#modal_grp").modal('hide');
    });

    $("#modal_grp_bt_cancelar").on("click",function(){
        $("#modal_grp").modal('hide');
    });

    
    $("#modal_grp_bt_salvar").on("click",function(){
        if ($("#modal_grp_input_nome").val() === "") {
            alert("O campo nome é obrigatório!");
            return;
        }
        $("#modal_grp_form").submit();
    });
}


function iniciarComponentesModalSub(subconta){

    if(subconta !== null){
        $("#modal_sub_titulo").text("Subconta: " + subconta.nome);
        $("#modal_sub_input_nome").val(subconta.nome);
        $("#modal_sub_select_tipo_id").val(subconta.tipo);
        $("#modal_sub_grupo_id").val(subconta.grupoConta.grupoContaId);
        $("#input_gerenciar_grupo").val(subconta.grupoConta.nome);
        $("#subconta_ativo").prop("checked", subconta.ativo);
        $("#subconta_ativo").show();
        $("#subconta_ativo").parent().show();
    }
    else{
        $("#modal_sub_titulo").text("Nova subconta");
        $("#modal_sub_input_nome").val("");
        $("#modal_sub_select_tipo_id").val(0);
        $("#modal_sub_grupo_id").val(0);
        $("#input_gerenciar_grupo").val("");
        $("#subconta_ativo").prop("checked", true);
        $("#subconta_ativo").hide();
        $("#subconta_ativo").parent().hide();
    }

    $("#modal_sub_bt_fechar").on("click",function(){
        $("#modal_sub").modal('hide');
    });

    $("#modal_sub_bt_cancelar").on("click",function(){
        $("#modal_sub").modal('hide');
    });

    $("#modal_sub_bt_salvar").on("click",function(){
        if ($("#modal_sub_input_nome").val() === "") {
            alert("O campo nome é obrigatório!");
            return;
        }
        else if(parseInt($("#modal_sub_grupo_id").val()) === 0){
            alert("O campo grupo de contas é obrigatório!");
            return;
        }
        $("#modal_sub_form").submit();
    });
}
