$(document).ready(function() {
    $('form')[0].reset();
    iniciarComponentesGerenciarbanco();
});

function iniciarComponentesGerenciarbanco(){

    $("#novo_banco").on("click", function(){
        abrirModalbanco(null);
    });

    $("#nova_conta").on("click", function(){
        abrirModalConta(null);
    });

    $("#tabela_banco tbody td:last-child button").click(function() {
        abrirModalbanco($(this).parent().parent().data('value'));
    });

    $("#tabela_conta tbody td:last-child button").click(function() {
        abrirModalConta($(this).parent().parent().data('value'));
    });

    $("#lista_gerenciar_banco option").each(function(){
        $(this).on("click", function(){
            $("#modal_conta_banco_id").val(JSON.parse($(this).val()).dados.bancoId);
        })
    });

}

function abrirModalbanco(banco){
    $("#banco_id").val(banco === null ? 0 : banco.bancoId);
    $("#modal_banco").modal('show');
    iniciarComponentesModalbanco(banco);
}


function abrirModalConta(conta){
    $("#banco_id").val(conta === null ? 0 : conta.bancoId);
    $("#modal_conta").modal('show');
    iniciarComponentesModalconta(conta);
}


function iniciarComponentesModalbanco(banco){

    if(banco !== null){
        $("#modal_banco_titulo").text("Banco: " + banco.nome);
        $("#modal_banco_input_nome").val(banco.nome);
        $("#modal_banco_input_nr_banco").val(banco.numeroBanco);
        $("#input_exige_ofx").prop("checked", banco.exigeOfx);
        $("#banco_ativo").prop("checked", banco.ativo);
        $("#banco_ativo").show();
        $("#banco_ativo").parent().show();
    }
    else{
        $("#modal_banco_titulo").text("Novo banco");
        $("#modal_banco_input_nome").val("");
        $("#modal_banco_input_nr_banco").val("")
        $("#input_exige_ofx").prop("checked", false);
        $("#banco_ativo").prop("checked", true);
        $("#banco_ativo").hide();
        $("#banco_ativo").parent().hide();
    }

    $("#modal_banco_bt_fechar").on("click",function(){
        $("#modal_banco").modal('hide');
    });

    $("#modal_banco_bt_cancelar").on("click",function(){
        $("#modal_banco").modal('hide');
    });

    
    $("#modal_banco_bt_salvar").on("click",function(){
        if ($("#modal_banco_input_nome").val() === "") {
            alert("O campo nome é obrigatório!");
            return;
        }
        else if ($("#modal_banco_input_nr_banco").val() === "") {
            alert("O campo número do banco é obrigatório!");
            return;
        }
        $("#modal_banco_form").submit();
    });
}


function iniciarComponentesModalconta(conta){

    if(conta !== null){
        $("#modal_conta_titulo").text("Conta: " + conta.numeroConta);
        $("#modal_conta_input_agencia").val(conta.agencia);
        $("#modal_conta_input_nr_conta").val(conta.numeroConta);

        $("#modal_conta_input_agencia_ant").val(conta.agencia);
        $("#modal_conta_input_nr_conta_ant").val(conta.numeroConta);
        $("#modal_conta_banco_id_ant").val(conta.banco.bancoId);

        $("#modal_conta_banco_id").val(conta.banco.bancoId);
        $("#input_gerenciar_banco").val(conta.banco.nome);
        $("#conta_ativo").prop("checked", conta.ativo);
        $("#conta_ativo").show();
        $("#conta_ativo").parent().show();
    }
    else{
        $("#modal_conta_titulo").text("Nova conta");
        $("#modal_conta_input_agencia").val("");
        $("#modal_conta_input_nr_conta").val("");
        $("#modal_conta_banco_id").val(0);
        $("#input_gerenciar_banco").val("");
        $("#modal_conta_input_agencia_ant").val(0);
        $("#modal_conta_input_nr_conta_ant").val(0);
        $("#modal_conta_banco_id_ant").val(0);
        $("#conta_ativo").hide();
        $("#conta_ativo").parent().hide();
    }

    $("#modal_conta_bt_fechar").on("click",function(){
        $("#modal_conta").modal('hide');
    });

    $("#modal_conta_bt_cancelar").on("click",function(){
        $("#modal_conta").modal('hide');
    });

    $("#modal_conta_bt_salvar").on("click",function(){
        if ($("#modal_conta_input_agencia").val() === "") {
            alert("O campo agência é obrigatório!");
            return;
        }
        else if ($("#modal_conta_input_nr_conta").val() === "") {
            alert("O campo número conta é obrigatório!");
            return;
        }
        else if(parseInt($("#modal_conta_banco_id").val()) === 0){
            alert("O campo banco é obrigatório!");
            return;
        }
        $("#modal_conta_form").submit();
    });
}
