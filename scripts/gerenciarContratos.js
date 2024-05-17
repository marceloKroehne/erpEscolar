var valorCurso = 0;
var valorPlano = 0;

$(document).ready(function() {
    $('form')[0].reset();
    iniciarComponentesGerenciarcontrato();
});

function iniciarComponentesGerenciarcontrato(){

    if($("#turma_ins").val() != ""){
        var turma = JSON.parse($("#turma_ins").val()).dados;

        if(parseInt(turma.turmaId) != 0){
            abrirModalcontrato(null);
            $("#input_gerenciar_turma").val(turma.nome);
            $("#turma_id").val(turma.turmaId);
            $("#input_gerenciar_aluno").prop("disabled", false);
            $("#input_gerenciar_vendedor").prop("disabled", false);
            $("#input_gerenciar_situacao_contrato").prop("disabled", false);
            $("#input_gerenciar_tipo_contrato").prop("disabled", false);
            $("#input_gerenciar_plano").prop("disabled", false);
            $("#input_gerenciar_bolsa").prop("disabled", false);
            $("#data_inicio").prop("disabled", false);
            $("#data_fim").prop("disabled", false);
            $("#observacao").prop("disabled", false);
            valorCurso = turma.curso.valor.replace(/\./g, ",").replace(/\-/g, "");
            $("#valor_total").val(valorCurso);
        }
    }
    else{
        $("#input_gerenciar_aluno").prop("disabled", true);
        $("#input_gerenciar_vendedor").prop("disabled", true);
        $("#input_gerenciar_situacao_contrato").prop("disabled", true);
        $("#input_gerenciar_tipo_contrato").prop("disabled", true);
        $("#input_gerenciar_plano").prop("disabled", true);
        $("#input_gerenciar_bolsa").prop("disabled", true);
        $("#data_inicio").prop("disabled", true);
        $("#data_fim").prop("disabled", true);
        $("#observacao").prop("disabled", true);
    }
    
    $("#novo_contrato").on("click", function(){
        abrirModalcontrato(null);
        $("#input_gerenciar_aluno").prop("disabled", true);
        $("#input_gerenciar_vendedor").prop("disabled", true);
        $("#input_gerenciar_situacao_contrato").prop("disabled", true);
        $("#input_gerenciar_tipo_contrato").prop("disabled", true);
        $("#input_gerenciar_plano").prop("disabled", true);
        $("#input_gerenciar_bolsa").prop("disabled", true);
        $("#data_inicio").prop("disabled", true);
        $("#data_fim").prop("disabled", true);
        $("#observacao").prop("disabled", true);
    });

    $("#tabela_contrato tbody td:last-child button").click(function() {
        abrirModalcontrato($(this).parent().data('value'));
    });    

}

function abrirModalcontrato(contrato){
    $("#contrato_id").val(contrato === null ? 0 : contrato.contratoId);
    $("#modal_contrato").modal('show');
    iniciarComponentesModalcontrato(contrato);
}


function iniciarComponentesModalcontrato(contrato){

    $("#data_inicio").datepicker(
        { 
            dateFormat: 'dd/mm/yy',
            language: 'pt-BR',
            onSelect: function(dateText, inst) {
                $(this).val(dateText);
            }
        }
    );

    $("#data_inicio").mask("00/00/0000");

    $("#data_fim").on("click", function(){
        $data = $("#data_inicio").val();
        
        if($data === null || $data === ""){
            alert("Selecione uma data de início!");
            return;
        }
        
        $("#data_fim").datepicker(
            { 
                minDate: $data,
                dateFormat: 'dd/mm/yy',
                language: 'pt-BR',
                onSelect: function(dateText, inst) {
                    $(this).val(dateText);
                }
            }
        );

        $("#data_fim").mask("00/00/0000");

    });


    if(contrato !== null){
        $("#modal_contrato_titulo").text("Contrato: " + contrato.contratoId);
        $("#input_gerenciar_turma").val(contrato.turma.nome);
        $("#input_gerenciar_aluno").val(contrato.aluno.nome);
        $("#input_gerenciar_vendedor").val(contrato.vendedor.nome);
        $("#input_gerenciar_situacao_contrato").val(contrato.situacaoContrato.nome);
        $("#input_gerenciar_tipo_contrato").val(contrato.tipoContrato.nome);
        $("#input_gerenciar_plano").val(contrato.planoCurso.nome);
        $("#input_gerenciar_bolsa").val(contrato.bolsa.nome);
        $("#contrato_id").val(contrato.contratoId);
        $("#bolsa_id").val(contrato.bolsa.bolsaId == null ? 0 : contrato.bolsa.bolsaId);
        $("#plano_curso_id").val(contrato.planoCurso.planoCursoId == null ? 0 : contrato.planoCurso.planoCursoId);
        $("#vendedor_id").val(contrato.vendedor.funcionarioId);
        $("#aluno_id").val(contrato.aluno.alunoId);
        $("#turma_id").val(contrato.turma.turmaId);
        $("#situacao_contrato_id").val(contrato.situacaoContrato.situacaoContratoId);
        $("#tipo_contrato_id").val(contrato.tipoContrato.tipoContratoId);
        $("#data_inicio").val(contrato.dataInicio);
        $("#data_fim").val(contrato.dataFim);
        $("#observacao").val(contrato.observacao);
        $("#input_gerenciar_turma").prop("disabled", true);
        $("#input_gerenciar_aluno").prop("disabled", true);
        $("#input_gerenciar_vendedor").prop("disabled", true);
        $("#input_gerenciar_situacao_contrato").prop("disabled", true);
        $("#input_gerenciar_tipo_contrato").prop("disabled", true);
        $("#input_gerenciar_plano").prop("disabled", true);
        $("#input_gerenciar_bolsa").prop("disabled", true);
        $("#data_inicio").prop("disabled", true);
        $("#data_fim").prop("disabled", true);
        $("#observacao").prop("disabled", true);
        $("#modal_contrato_bt_salvar").prop("disabled", true);

        valorCurso = contrato.turma.curso.valor;
       


        var valor = contrato.turma.curso.valor;
        var desconto = 1;
        if(contrato.planoCurso.planoCursoId != null ){
            valor = contrato.planoCurso.valorTotal;
            valorPlano = contrato.planoCurso.valorTotal;
        }
        if(contrato.bolsa.bolsaId != null){
            desconto = 1 - (contrato.bolsa.percentualDesconto/100);
        }
        
        $("#valor_total").val(valor*desconto);
        $("#valor_total").val( $("#valor_total").val().replace(/\./g, ",").replace(/\-/g, ""));
    }
    else{
        $("#modal_contrato_titulo").text("Novo contrato");
        $("#input_gerenciar_turma").val("");
        $("#input_gerenciar_aluno").val("");
        $("#input_gerenciar_vendedor").val("");
        $("#input_gerenciar_situacao_contrato").val("");
        $("#input_gerenciar_tipo_contrato").val("");
        $("#input_gerenciar_plano").val("");
        $("#input_gerenciar_bolsa").val("");
        $("#data_inicio").val("");
        $("#data_fim").val("");
        $("#observacao").val("");
        $("#contrato_id").val(0);
        $("#bolsa_id").val(0);
        $("#plano_curso_id").val(0);
        $("#vendedor_id").val(0);
        $("#aluno_id").val(0);
        $("#turma_id").val(0);
        $("#situacao_contrato_id").val(0);
        $("#tipo_contrato_id").val(0);
        $("#valor_total").val("");
    }

    $("#modal_contrato_bt_fechar").on("click",function(){
        $("#modal_contrato").modal('hide');
    });

    $("#modal_contrato_bt_cancelar").on("click",function(){
        $("#modal_contrato").modal('hide');
    });

    $("#modal_contrato_bt_deletar").on("click",function(){
        $("#contrato_deletar_id").val( $("#contrato_id").val());
        $("#modal_contrato_form_delet").submit();
    });

    
    $("#modal_contrato_bt_salvar").on("click",function(){
        if (parseInt($("#turma_id").val()) == 0) {
            alert("O campo turma é obrigatório!");
            return;
        }
        else if (parseInt($("#aluno_id").val()) == 0) {
            alert("O campo aluno é obrigatório!");
            return;
        }
        else if (parseInt($("#vendedor_id").val()) == 0) {
            alert("O campo vendedor é obrigatório!");
            return;
        }
        else if (parseInt($("#situacao_contrato_id").val()) == 0) {
            alert("O campo situação de contrato é obrigatório!");
            return;
        }
        else if (parseInt($("#tipo_contrato_id").val()) == 0) {
            alert("O campo tipo de contrato é obrigatório!");
            return;
        }
        else if ($("#data_inicio").val() == "") {
            alert("O campo data de início é obrigatório!");
            return;
        }
        else if ($("#data_fim").val() == "") {
            alert("O campo data de fim é obrigatório!");
            return;
        }
        $("#modal_contrato_form").submit();
    });

    $("#lista_gerenciar_turma option").each(function(){
        $(this).on("click", function(){
            var turmaSele = JSON.parse($(this).val()).dados;
            $("#turma_id").val(turmaSele.turmaId);
            $("#curso_ins_id").val(turmaSele.curso.cursoId);
            $("#turma_ins").val($(this).val());
            $("#form_turma").submit();
        })
    });

    $("#lista_gerenciar_aluno option").each(function(){
        $(this).on("click", function(){
            $("#aluno_id").val(JSON.parse($(this).val()).dados.alunoId);
        })
    });

    $("#lista_gerenciar_vendedor option").each(function(){
        $(this).on("click", function(){
            $("#vendedor_id").val(JSON.parse($(this).val()).dados.funcionarioId);
        })
    });

    $("#lista_gerenciar_situacao_contrato option").each(function(){
        $(this).on("click", function(){
            $("#situacao_contrato_id").val(JSON.parse($(this).val()).dados.situacaoContratoId);
        })
    });

    $("#lista_gerenciar_tipo_contrato option").each(function(){
        $(this).on("click", function(){
            $("#tipo_contrato_id").val(JSON.parse($(this).val()).dados.tipoContratoId);
        })
    });

    $("#lista_gerenciar_plano option").each(function(){
        $(this).on("click", function(){
            var planoCurso = JSON.parse($(this).val()).dados;
            $("#plano_curso_id").val(planoCurso.planoCursoId);
            $("#input_gerenciar_bolsa").val("");
            $("#bolsa_id").val(0);
            valorPlano = planoCurso.valorTotal;
            $("#valor_total").val(valorPlano);
            $("#valor_total").val( $("#valor_total").val().replace(/\./g, ",").replace(/\-/g, ""));
        })
    });

    $("#lista_gerenciar_bolsa option").each(function(){
        $(this).on("click", function(){
            var bolsa = JSON.parse($(this).val()).dados;
            $("#bolsa_id").val(bolsa.bolsaId);
            $("#valor_total").val(
                parseFloat(
                    $("#valor_total").val().replace(/\./g, '').replace(/,/g, '.') == "" ? 
                    0 : 
                    $("#valor_total").val().replace(/\./g, '').replace(/,/g, '.')
                ) 
                * (1 - ( bolsa.percentualDesconto/ 100))
            );

            $("#valor_total").val( $("#valor_total").val().replace(/\./g, ",").replace(/\-/g, ""));
        })
    });

    $("#input_gerenciar_turma").on("click", function(){
        $("#turma_id").val(0);
    });
    
    $("#input_gerenciar_aluno").on("click", function(){
        $("#aluno_id").val(0);
    });

    $("#input_gerenciar_vendedor").on("click", function(){
        $("#vendedor_id").val(0);
    });

    $("#input_gerenciar_situacao_contrato").on("click", function(){
        $("#situacao_contrato_id").val(0);
    });

    $("#input_gerenciar_tipo_contrato").on("click", function(){
        $("#tipo_contrato_id").val(0);
    });

    $("#input_gerenciar_plano").on("click", function(){
        $("#valor_total").val(valorCurso);
        $("#valor_total").val( $("#valor_total").val().replace(/\./g, ",").replace(/\-/g, ""));
        $("#plano_id").val(0);
    });

    $("#input_gerenciar_bolsa").on("click", function(){

        if(parseInt($("#bolsa_id").val()) != 0){
            $("#valor_total").val(parseInt($("#plano_curso_id").val()) != 0 ? valorPlano : valorCurso);
            $("#valor_total").val( $("#valor_total").val().replace(/\./g, ",").replace(/\-/g, ""));
        }
    
        $("#bolsa_id").val(0);
    });

}
