$(document).ready(function(){
  iniciarComponentes();
});

function iniciarComponentes(){
  $('#telefone_empresa').mask('(00) 00000-0000');
  $('#telefone_usuario').mask('(00) 00000-0000');
  $('#cep').mask('00000-000');
  
  
   
  $('#cep').on('keyup', function(){
    var cep = $(this).val().replace('-', '');
    if(cep.length == 8){
      $.getJSON('https://viacep.com.br/ws/'+ cep +'/json/', function(data){
        if(data.erro){
          alert('CEP não encontrado');
        }else{
          $('#logradouro').val(data.logradouro);
          $('#bairro').val(data.bairro);
          $('#cidade').val(data.localidade);
          $('#uf').val(data.uf);
        }
      });
    }
  });
  
  $("#lb_cargo_id").hide();
  $("#cargo_id").hide();
  $("#lb_pagamento_id").hide();
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
  $("#pagamento_id").hide();
  $("#usuario_status").hide();
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
  
}
