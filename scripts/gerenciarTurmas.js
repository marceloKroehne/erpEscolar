$(document).ready(function() {
    $('form')[0].reset();
    iniciarComponentesGerenciarturma();
});

function iniciarComponentesGerenciarturma(){

    $("#novo_turma").on("click", function(){
        abrirModalturma(null);
    });

    $("#tabela_turma tbody td:last-child button").click(function() {
        abrirModalturma($(this).parent().data('value'));
    });

}

function abrirModalturma(turma){
    $("#turma_id").val(turma === null ? 0 : turma.turmaId);
    $("#modal_turma").modal('show');
    iniciarComponentesModalturma(turma);
}


function iniciarComponentesModalturma(turma){

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

    $("#max_alunos").mask("0000000");
    $("#min_alunos").mask("0000000");
    $("#meta_alunos").mask("0000000");

    if(turma !== null){
        $("#modal_turma_titulo").text("Turma: " + turma.nome);
        $("#modal_turma_input_nome").val(turma.nome);
        $("#turma_id").val(turma.turmaId);
        $("#turma_ativo").prop("checked", turma.ativo);
        $("#turma_ativo").show();
        $("#turma_ativo").parent().show();

        $("#max_alunos").val(turma.maxAlunos);
        $("#min_alunos").val(turma.minAlunos);
        $("#meta_alunos").val(turma.metaAlunos);

        $("#data_inicio").val(turma.dataInicio);
        $("#data_fim").val(turma.dataFim);

        $("#input_gerenciar_modalidade").val(turma.modalidade.nome);
        $("#modalidade_id").val(turma.modalidade.modalidadeId);
        $("#input_gerenciar_situacao_turma").val(turma.situacaoTurma.nome);
        $("#situacao_turma_id").val(turma.situacaoTurma.situacaoTurmaId);
        $("#input_gerenciar_professor").val(turma.professor.nome);
        $("#professor_id").val(turma.professor.funcionarioId);
        $("#input_gerenciar_turno").val(turma.turno.nome);
        $("#turno_id").val(turma.turno.turnoId);
        $("#input_gerenciar_sala").val(turma.sala.nome);
        $("#sala_id").val(turma.sala.salaId);
        $("#input_gerenciar_curso").val(turma.curso.nome);
        $("#curso_id").val(turma.curso.cursoId);


    }
    else{
        $("#modal_turma_titulo").text("Novo turma");
        $("#modal_turma_input_nome").val("");
        $("#turma_id").val(0);
        $("#turma_ativo").prop("checked", true);
        $("#turma_ativo").hide();
        $("#turma_ativo").parent().hide();

        $("#max_alunos").val("");
        $("#min_alunos").val("");
        $("#meta_alunos").val("");

        $("#data_inicio").val("");
        $("#data_fim").val("");

        $("#input_gerenciar_modalidade").val("");
        $("#modalidade_id").val(0);
        $("#input_gerenciar_situacao_turma").val("");
        $("#situacao_turma_id").val(0);
        $("#input_gerenciar_professor").val("");
        $("#professor_id").val(0);
        $("#input_gerenciar_turno").val("");
        $("#turno_id").val(0);
        $("#input_gerenciar_sala").val("");
        $("#sala_id").val(0);
        $("#input_gerenciar_curso").val("");
        $("#curso_id").val(0);

    }

    $("#modal_turma_bt_fechar").on("click",function(){
        $("#modal_turma").modal('hide');
    });

    $("#modal_turma_bt_cancelar").on("click",function(){
        $("#modal_turma").modal('hide');
    });

    
    $("#modal_turma_bt_salvar").on("click",function(){
        if ($("#modal_turma_input_nome").val() === "") {
            alert("O campo nome é obrigatório!");
            return;
        }
        else if ($("#max_alunos").val() === "") {
            alert("O campo máximo de alunos é obrigatório!");
            return;
        }
        else if ($("#min_alunos").val() === "") {
            alert("O campo mínimo de alunos é obrigatório!");
            return;
        }
        else if ($("#meta_alunos").val() === "") {
            alert("O campo meta de alunos é obrigatório!");
            return;
        }
        else if ($("#data_inicio").val() === "") {
            alert("O campo data de início é obrigatório!");
            return;
        }
        else if ($("#data_fim").val() === "") {
            alert("O campo data final é obrigatório!");
            return;
        }
        else if (parseInt($("#modalidade_id").val()) === 0) {
            alert("O campo modalidade é obrigatório!");
            return;
        }
        else if (parseInt($("#curso_id").val()) === 0) {
            alert("O campo curso é obrigatório!");
            return;
        }
        else if (parseInt($("#sala_id").val()) === 0) {
            alert("O campo sala é obrigatório!");
            return;
        }
        else if (parseInt($("#professor_id").val()) === 0) {
            alert("O campo professor é obrigatório!");
            return;
        }
        else if (parseInt($("#situacao_turma_id").val()) === 0) {
            alert("O campo situação é obrigatório!");
            return;
        }
        else if (parseInt($("#turno_id").val()) === 0) {
            alert("O campo turno é obrigatório!");
            return;
        }

        $("#modal_turma_form").submit();
    });

    $("#lista_gerenciar_professor option").each(function(){
        $(this).on("click", function(){
            $("#professor_id").val(JSON.parse($(this).val()).dados.funcionarioId);
        })
    });

    $("#lista_gerenciar_modalidade option").each(function(){
        $(this).on("click", function(){
            $("#modalidade_id").val(JSON.parse($(this).val()).dados.modalidadeId);
        })
    });

    $("#lista_gerenciar_sala option").each(function(){
        $(this).on("click", function(){
            $("#sala_id").val(JSON.parse($(this).val()).dados.salaId);
        })
    });

    $("#lista_gerenciar_turno option").each(function(){
        $(this).on("click", function(){
            $("#turno_id").val(JSON.parse($(this).val()).dados.turnoId);
        })
    });

    $("#lista_gerenciar_curso option").each(function(){
        $(this).on("click", function(){
            $("#curso_id").val(JSON.parse($(this).val()).dados.cursoId);
        })
    });

    $("#lista_gerenciar_situacao_turma option").each(function(){
        $(this).on("click", function(){
            $("#situacao_turma_id").val(JSON.parse($(this).val()).dados.situacaoTurmaId);
        })
    });

}
