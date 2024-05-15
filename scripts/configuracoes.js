document.addEventListener("DOMContentLoaded", function() {
    $("#lb_cargo_id").hide();
    $("#cargo_id").hide();
    $("#lb_pagamento_id").hide();
    $("#pagamento_id").hide();
    $("#lb_agencia").hide();
    $("#agencia").hide();
    $("#lb_numero_conta").hide();
    $("#numero_conta").hide();
    $("#lb_banco").hide();
    $("#input_gerenciar_banco").hide();
    $("#lb_pix").hide();
    $("#pix").hide();
    $("#lb_tipo_pix").hide();
    $("#tipo_pix").hide();
    $("#usuario_status").hide();
    $("#botao_trocar_senha").show();
});
  
function preencherFormulario(empresa_json, usuario_json){

    $("#info_empresa").hide();
    $("#confirmar_senha").css('pointer-events', 'none');
    $("#senha").css('pointer-events', 'none');

    $('#senha').removeAttr('required');
    $('#confirmar_senha').removeAttr('required');

    $('#botao_trocar_senha').click(function() {
        $("#update_senha").val("true");
        $('#senha').attr('required');
        $('#confirmar_senha').attr('required');
        $("#senha").css('pointer-events', 'auto');
        $("#confirmar_senha").css('pointer-events', 'auto');
    });

    var empresa = JSON.parse(empresa_json);
    var usuario = JSON.parse(usuario_json);

    $("html, body").scrollTop(0);

    if(usuario.cargo.permissaoId == 3){
        $("#info_empresa").show();
        //EMPRESA
        $("#nome_razao_social").val(empresa.nomeRazaoSocial);
        $("#empresa_email").val(empresa.empresaEmail);
        $("#cpf_cnpj").val(empresa.empresaCpfCnpj);
        $("#cep").val(empresa.cep);
        $("#logradouro").val(empresa.logradouro);
        $("#numero").val(empresa.numero);
        $("#complemento").val(empresa.complemento);
        $("#bairro").val(empresa.bairro);
        $("#cidade").val(empresa.cidade);
        $("#uf").val(empresa.uf);
        $("#telefone_empresa").val(empresa.empresaTelefone);
        $("#empresa_id").val(empresa.empresaId);

    }

    //REPRESENTANTE

    $("#usuario_nome").val(usuario.nome);
    $("#cpf_usuario").val(usuario.cpf);
    $("#rg_usuario").val(usuario.rg);
    $("#email_usuario").val(usuario.email);
    $("#telefone_usuario").val(usuario.telefone);
    $("#usuario_id").val(usuario.usuarioId);
    $("#funcionario_id").val(usuario.funcionarioId);
    $("#cargo_id").val(usuario.cargo.cargoId);
    $("#cep_usuario").val(usuario.cep);
    $("#logradouro_usuario").val(usuario.logradouro);
    $("#numero_usuario").val(usuario.numero);
    $("#complemento_usuario").val(usuario.complemento);
    $("#bairro_usuario").val(usuario.bairro);
    $("#cidade_usuario").val(usuario.cidade);
    $("#uf_usuario").val(usuario.uf);
    $("#botao_formulario").text("Salvar");

}