$(document).ready(function() {
  iniciarComponentesCadastroUsuario();
});

function iniciarComponentesCadastroUsuario(){

  $("#lista_gerenciar_banco option").each(function(){
    $(this).on("click", function(){
        $("#banco_id").val(JSON.parse($(this).val()).dados.bancoId);
      })
  });

  $('#cep_usuario').mask('00000-000');
  
  $('#cep_usuario').on('keyup', function(){
    var cep = $(this).val().replace('-', '');
    if(cep.length == 8){
      $.getJSON('https://viacep.com.br/ws/'+ cep +'/json/', function(data){
        if(data.erro){
          alert('CEP não encontrado');
        }else{
          $('#logradouro_usuario').val(data.logradouro);
          $('#bairro_usuario').val(data.bairro);
          $('#cidade_usuario').val(data.localidade);
          $('#uf_usuario').val(data.uf);
        }
      });
    }
  });

  $("#info_empresa  :input").prop("disabled", true);
  $("#info_empresa").hide();
  $("#usuario_status").hide();
  $("#titulo_empresa").hide();
  $("#titulo_usuario").text("Novo usuário")
  $("#botao_formulario").text("Cadastrar usuário")
  $('#telefone_usuario').mask('(00) 00000-0000');  

  $("#lista_gerenciar_usuario option").on("click", function(){

    var usuario = JSON.parse(JSON.parse($(this).val()).dados);

    $("#usuario_status").show();

    if(usuario.ativo === 1){
      $("#ativo").prop("checked", true);
    }
    else if(usuario.ativo === 0){
        $("#inativo").prop("checked", true);
    }

    $("#titulo_usuario").text("Editar usuário");
    $("#usuario_nome").val(usuario.nome);
    $("#cpf_usuario").val(usuario.cpf);
    $("#rg_usuario").val(usuario.rg);
    $("#email_usuario").val(usuario.email);
    $("#telefone_usuario").val(usuario.telefone);
    $("#usuario_id").val(usuario.usuarioId);
    $("#cargo_professor").prop("checked",usuario.professor);
    $("#cargo_atendente").prop("checked",usuario.atendente);


    $("#cep_usuario").val(usuario.cep);
    $("#logradouro_usuario").val(usuario.logradouro);
    $("#numero_usuario").val(usuario.numero);
    $("#complemento_usuario").val(usuario.complemento);
    $("#bairro_usuario").val(usuario.bairro);
    $("#cidade_usuario").val(usuario.cidade);
    $("#uf_usuario").val(usuario.uf);

    if(usuario.funcionarioId != null){
      $("#funcionario_id").val(usuario.funcionarioId);
      $("#cargo_id").val(usuario.cargo.cargoId);
      $("#pagamento_id").val(usuario.mensalista == null ? usuario.horista.tipoPagamentoId : usuario.mensalista.tipoPagamentoId);
      $("#banco_id").val(usuario.conta.bancoId);
      $("#agencia").val(usuario.conta.agencia);
      $("#numero_conta").val(usuario.conta.numeroConta);
      $("#pix").val(usuario.pix.chave);
      $("#tipo_pix").val(usuario.pix.tipoChave);
    }
    else if(usuario.alunoId != null){
      $("#aluno_id").val(usuario.alunoId);
      $("#matricula_aluno").val(usuario.matricula);
    }

    $("#botao_formulario").text("Salvar usuário");
    $("#botao_trocar_senha").show();
    trocarSenha();
  });

  $("#botao_novo_usuario").on("click", function(){
    $("#botao_trocar_senha").hide();

    $("#banco_id").val(0);
    $("#cargo_id").val(0);
    $("#agencia").val("");
    $("#numero_conta").val("");
    $("#pagamento_id").val(0);
    $("#pix").val("");
    $("#tipo_pix").val(0);
    $("#cargo_professor").prop("checked",false);
    $("#cargo_atendente").prop("checked",false);

    $("#aluno_id").val(0);
    $("#matricula_aluno").val("");
    
    $("#titulo_usuario").text("Novo usuário")
    $("#botao_formulario").text("Cadastrar usuário")
    $("#update_senha").val("true");
    $('#senha').attr('required');
    $('#confirmar_senha').attr('required');
    $("#senha").css('pointer-events', 'auto');
    $("#confirmar_senha").css('pointer-events', 'auto');
    $("#usuario_nome").val("");
    $("#cpf_usuario").val("");
    $("#rg_usuario").val("");
    $("#email_usuario").val("");
    $("#telefone_usuario").val("");
    $("#usuario_id").val(0);
    $("#funcionario_id").val(0);
    $("#cep_usuario").val("");
    $("#logradouro_usuario").val("");
    $("#numero_usuario").val("");
    $("#complemento_usuario").val("");
    $("#bairro_usuario").val("");
    $("#cidade_usuario").val("");
    $("#uf_usuario").val("");

  });

    

}

function trocarSenha(){

  $("#update_senha").val("false");
  $("#confirmar_senha").css('pointer-events', 'none');
  $("#senha").css('pointer-events', 'none');
  $('#senha').removeAttr('required');
  $('#confirmar_senha').removeAttr('required');
  $("#botao_trocar_senha").show();

  $('#botao_trocar_senha').click(function() {
    $("#update_senha").val("true");
    $('#senha').attr('required');
    $('#confirmar_senha').attr('required');
    $("#senha").css('pointer-events', 'auto');
    $("#confirmar_senha").css('pointer-events', 'auto');
  });

}


