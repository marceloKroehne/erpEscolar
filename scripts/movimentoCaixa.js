$(document).ready(function() {

    iniciarComponentesMovimento();

    $("#data_movimento_ini").datepicker(
        {
            dateFormat: 'dd/mm/yy',
            language: 'pt-BR',
            onSelect: function(dateText, inst) {
                $(this).val(dateText);
            }
        }
    );

    $("#data_movimento_ini").mask("00/00/0000");

    $("#data_movimento_fim").on("click", function(){
        $data = $("#data_movimento_ini").val();
        
        if($data === null || $data === ""){
            alert("Selecione uma data de início!");
            return;
        }
        
        $("#data_movimento_fim").datepicker(
            { 
                minDate: $data,
                dateFormat: 'dd/mm/yy',
                language: 'pt-BR',
                onSelect: function(dateText, inst) {
                    $(this).val(dateText);
                }
            }
        );

        $("#data_movimento_fim").mask("00/00/0000");

    });

});

function isValidKey(key) {
    return /^[0-9\/\b]+$/.test(key);
}

function iniciarComponentesMovimento(){

    $("#novo_movimento").on("click", function(){
        $("#lista_movimentos").val("");
        $("#posicao_lista").val(0);
        abrirModalmovimento(null);
    });

    $("#tabela_movimento tbody td:last-child button").click(function() {
        $("#lista_movimentos").val("");
        $("#posicao_lista").val(0);
        abrirModalmovimento($(this).parent().parent().data('value'));
    });

    $("#lista_subcontas option").each(function(){
        $(this).on("click", function(){
            var dados = JSON.parse($(this).val()).dados;
            var subconta = JSON.parse(dados);
            $("#subconta_entrada_id").val(subconta.subcontaId);
        })
    });

    $("#lista_subcontas_saida option").each(function(){
        $(this).on("click", function(){
            var dados = JSON.parse($(this).val()).dados;
            var subconta = JSON.parse(dados);
            $("#subconta_saida_id").val(subconta.subcontaId);

            $("#parcela_quitar").mask("000000000");

            if(subconta.grupoConta.recebimentoVendas == 1){
                $("#parcela_quitar").show();
                $("#lb_parcela_quitar").show();
            }
            else{
                $("#parcela_quitar").hide();
                $("#lb_parcela_quitar").hide();
            }
        })
    });

    $("#filtro_lista_subcontas option").each(function(){
        $(this).on("click", function(){
            var dados = JSON.parse($(this).val()).dados;
            var subconta = JSON.parse(dados);
            $("#filtro_subconta").val(JSON.stringify(subconta));
        })
    });

    var filtroSubconta = JSON.parse($("#filtro_subconta").val());
    
    if(filtroSubconta !== null){
        $("#filtro_input_subcontas").val(filtroSubconta.nome);
    }
    
    $("#filtro_movimento_botao").on("click",function(){

        if($("#filtro_input_subcontas").val() === null || $("#filtro_input_subcontas").val() === ""){
            $("#filtro_subconta").val("");
        }

        $("#filtro_movimento_form").submit();

    });

    var listaMovimentos = JSON.parse($("#lista_movimentos").val());
    var posicao = parseInt($("#posicao_lista").val());
    if(listaMovimentos !== null && posicao <= listaMovimentos.length){
        abrirModalmovimento(JSON.parse(listaMovimentos[posicao]));
    }

}

function abrirModalmovimento(movimento){
    $("#tipo_movimento_id").val(movimento === null ? 0 : movimento.movimentoId);
    $("#modal_movimento").modal('show');
    iniciarComponentesModalmovimento(movimento);
}


function iniciarComponentesModalmovimento(movimento){

 
    $("#modal_movimento_data").datepicker(
        { 
            dateFormat: 'dd/mm/yy',
            language: 'pt-BR',
            onSelect: function(dateText, inst) {
                $(this).val(dateText);
            }
        }
    );
    
    $("#modal_movimento_data").mask("00/00/0000");

    $("#modal_movimento_valor").mask('000.000.000.000,00', {reverse: true});

    $("#lista_contas option").each(function(){
        $(this).on("click", function(){

            var dados = JSON.parse($(this).val()).dados;
            var conta = JSON.parse(dados);

            $("#agencia").val(conta.agencia);
            $("#numero_conta").val(conta.numeroConta);
            $("#banco_id").val(conta.banco.bancoId);

            if((movimento === null || movimento.numeroMovimento === null) && conta.banco.exigeOfx){
                $("#aviso").html("Esta conta permite o lançamento de movimentos apenas por importação de OFX!");
                $("#aviso").show();
                $("#modal_movimento_bt_salvar").prop('disabled', true);
            }
            else{
                $("#aviso").html("");
                $("#aviso").hide();
                $("#modal_movimento_bt_salvar").prop('disabled', false);
            }
        })
    });

    $("#lista_docs option").each(function(){
        $(this).on("click", function(){
            var dados = JSON.parse($(this).val()).dados;
            var doc = JSON.parse(dados);

            $("#tipo_documento_id").val(doc.tipoDocumentoId);
        })
    });


    if(movimento !== null){
        
        $("#modal_movimento_data").val(movimento.dataLancamento);
        $("#input_subcontas").val(movimento.subcontaEntrada.subcontaId == null ? "" : movimento.subcontaEntrada.nome);
        $("#input_subcontas_saida").val(movimento.subcontaSaida.subcontaId == null ? "" : movimento.subcontaSaida.nome);
        $("#input_docs").val(movimento.tipoDocumento == null ? "" : movimento.tipoDocumento.nome);
        $("#modal_movimento_historico").val(movimento.historico);
        $("#modal_movimento_nr_documento").val(movimento.numeroDocumento);
        $("#modal_movimento_valor").val(movimento.valor.replace(/\./g, ",").replace(/\-/g, ""));
        $("#modal_movimento_obs").val(movimento.observacao);

        if(movimento.parcelaId != null){
            $("#parcela_quitar").val(movimento.parcelaId);
        }
        $("#movimento_id").val(movimento.movimentoId);
        $("#subconta_entrada_id").val(movimento.subcontaEntrada == null ? 0 : movimento.subcontaEntrada.subcontaId);
        $("#subconta_saida_id").val(movimento.subcontaSaida== null ? 0 : movimento.subcontaSaida.subcontaId);
        $("#numero_movimento").val(movimento.numeroMovimento);

        if(movimento.numeroMovimento !== null){
            $("#input_contas").prop("disabled", true);
        }
        else{
            $("#input_contas").prop("disabled", false);
        }

        if(movimento.importacaoOfx && movimento.subcontaEntrada.conta.banco.bancoId == null && movimento.subcontaSaida.conta.banco.bancoId == null){
            var conta = movimento.subcontaEntrada.conta.banco.numeroBanco == null ? movimento.subcontaSaida.conta : movimento.subcontaEntrada.conta;
            $("#modal_movimento_bt_salvar").prop('disabled', true);
            $("#aviso").show();
            $("#aviso").html("A conta do banco: " + conta.banco.numeroBanco + " - Ag: " + conta.agencia + " N°: " + conta.numeroConta + "<br> não está cadastrada!")
        }
        else{
            if(movimento.duplicado){
                $("#aviso").show();
                $("#aviso").html("Este movimento já foi importado e não será salvo novamente");
                $("#modal_movimento_bt_salvar").text("Continuar");
            }
            else{
                $("#aviso").hide();
            }
            $("#modal_movimento_bt_salvar").text("Salvar");
            $("#modal_movimento_bt_salvar").prop('disabled', false);
           
        }

        $("#tipo_documento_id").val(movimento.tipoDocumento == null ? 0 : movimento.tipoDocumento.tipoDocumentoId);

        if(movimento.movimentoId === 0){
            $("#modal_movimento_titulo").text("Novo movimento importação ");
            $("#modal_movimento_bt_deletar").hide();
        }
        else{
            $("#modal_movimento_titulo").text("Movimento: " + movimento.movimentoId);
            $("#modal_movimento_bt_deletar").show();
        }

        if(movimento.duplicado){
            $("#modal_movimento_bt_deletar").hide();
        }


    }
    else{
        $("#input_contas").prop("disabled", false);
        $("#modal_movimento_titulo").text("Novo movimento");
        $("#modal_movimento_data").val($("#data_hoje").val());
        $("#input_subcontas").val("");
        $("#input_subcontas_saida").val("");
        $("#input_contas").val("");
        $("#input_docs").val("");
        $("#modal_movimento_historico").val("");
        $("#modal_movimento_nr_documento").val("");
        $("#modal_movimento_valor").val("");
        $("#modal_movimento_obs").val("");
        $("#numero_movimento").val("");
        $("#parcela_quitar").hide();
        $("#parcela_quitar").val("");
        $("#lb_parcela_quitar").hide();

        $("#movimento_id").val(0);
        $("#subconta_entrada_id").val(0);
        $("#subconta_saida_id").val(0);
        $("#tipo_documento_id").val(0);
        $("#modal_movimento_bt_deletar").hide();
        $("#aviso").html("");
        $("#aviso").hide();
    }

    $("#modal_movimento_bt_fechar").on("click",function(){
        $("#lista_movimentos").val("");
        $("#posicao_lista").val(0);
        $("#modal_movimento").modal('hide');
    });

    $("#modal_movimento_bt_cancelar").on("click",function(){
        $("#lista_movimentos").val("");
        $("#posicao_lista").val(0);
        $("#modal_movimento").modal('hide');
    });

    $("#modal_movimento_bt_deletar").on("click",function(){

        $("#deletar_movimento_id").val(movimento.movimentoId);
        $("#modal_movimento_form_delet").submit();

    });
    
    $("#modal_movimento_bt_salvar").on("click",function(){
        
        if ($("#modal_movimento_data").val() === "") {
            alert("O campo data é obrigatório!");
            return;
        }
        else if ($("#input_subcontas").val() === "") {
            alert("O campo subconta de entrada é obrigatório!");
            return;
        }
        else if ($("#input_subcontas_saida").val() === "") {
            alert("O campo subconta de saída é obrigatório!");
            return;
        }
        else if ($("#input_contas").val() === "") {
            alert("O campo conta é obrigatório!");
            return;
        }
        else if ($("#modal_movimento_historico").val() === "") {
            alert("O campo histórico é obrigatório!");
            return;
        }
        else if ($("#modal_movimento_valor").val() === "") {
            alert("O campo valor é obrigatório!");
            return;
        }

        $("#modal_movimento_form").submit();

    });

}