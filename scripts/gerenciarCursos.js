$(document).ready(function() {
    $('form')[0].reset();
    iniciarComponentesGerenciarcurso();
});

function iniciarComponentesGerenciarcurso(){

    $("#novo_curso").on("click", function(){
        abrirModalcurso(null);
    });

    $("#nova_bolsa").on("click", function(){
        abrirModalbolsa(null);
    });

    $("#tabela_curso tbody td:last-child button").click(function() {
        abrirModalcurso($(this).parent().data('value'));
    });

    $("#tabela_bolsa tbody td:last-child button").click(function() {
        abrirModalbolsa($(this).parent().data('value'));
    });

}

function abrirModalcurso(curso){
    $("#curso_id").val(curso === null ? 0 : curso.cursoId);
    $("#modal_curso").modal('show');
    iniciarComponentesModalcurso(curso);
}


function abrirModalbolsa(bolsa){
    $("#bolsa_id").val(bolsa === null ? 0 : bolsa.bolsaId);
    $("#modal_bolsa").modal('show');
    iniciarComponentesModalbolsa(bolsa);
}


function iniciarComponentesModalcurso(curso){
    
    $("#valor").mask('000.000.000.000,00', {reverse: true});
    $("#numero_aulas").mask('000.000');
    $("#carga_horaria").mask('000.000');
    lista = [];

    if(curso !== null){
        curso.bolsas.forEach(element => {
            lista.push(JSON.parse(element).bolsaId);
        });

        $("#modal_curso_titulo").text("Curso: " + curso.nome);
        $("#modal_curso_input_nome").val(curso.nome);

        $("#curso_id").val(curso.cursoId);
        $("#matriz_id").val(curso.matriz.matrizCurricularId);
        $("#coordenador_id").val(curso.coordenador.funcionarioId);
        $("#tipo_curso_id").val(curso.tipoCurso.tipoCursoId);

        $("#input_gerenciar_matriz").val(curso.matriz.nome);
        $("#input_gerenciar_coordenador").val(curso.coordenador.nome);
        $("#input_gerenciar_tipo_curso").val(curso.tipoCurso.nome);

        $("#numero_aulas").val(curso.numeroAulas);
        $("#carga_horaria").val(curso.cargaHoraria);
        $("#valor").val(curso.valor);

        $("#curso_ativo").prop("checked", curso.ativo);
        $("#curso_ativo").show();
        $("#curso_ativo").parent().show();
    }
    else{
        $("#modal_curso_titulo").text("Novo curso");
        $("#curso_id").val(0);
        $("#matriz_id").val(0);
        $("#coordenador_id").val(0);
        $("#tipo_curso_id").val(0);
        $("#numero_aulas").val("");
        $("#carga_horaria").val("");
        $("#valor").val("");

        $("#input_gerenciar_matriz").val("");
        $("#input_gerenciar_coordenador").val("");
        $("#input_gerenciar_tipo_curso").val("");
        $("#modal_curso_input_nome").val("");
        $("#curso_ativo").prop("checked", true);
        $("#curso_ativo").hide();
        $("#curso_ativo").parent().hide();
    }

    $("#modal_curso_bt_fechar").on("click",function(){
        $("#modal_curso").modal('hide');
    });

    $("#modal_curso_bt_cancelar").on("click",function(){
        $("#modal_curso").modal('hide');
    });

    
    $("#modal_curso_bt_salvar").on("click",function(){
        if ($("#modal_curso_input_nome").val() === "") {
            alert("O campo nome é obrigatório!");
            return;
        }
        else if($("#valor").val() == ""){
            alert("O campo valor é obrigatório!");
            return;
        }
        else if($("#numero_aulas").val() == ""){
            alert("O campo número de aulas é obrigatório!");
            return;
        }
        else if($("#carga_horaria").val() == ""){
            alert("O campo carga horária é obrigatório!");
            return;
        }
        else if($("#matriz_id").val() == "0"){
            alert("Selecione uma matriz curricular!");
            return;
        }
        else if($("#tipo_curso_id").val() == "0"){
            alert("Selecione um tipo de curso!");
            return;
        }
        else if($("#coordenador_id").val() == "0"){
            alert("Selecione um coordenador!");
            return;
        }


        $("#modal_curso_form").submit();
    });

    $("#lista_gerenciar_matriz option").each(function(){
        $(this).on("click", function(){
            $("#matriz_id").val(JSON.parse($(this).val()).dados.matrizCurricularId);
        })
    });

    $("#lista_gerenciar_tipo_curso option").each(function(){
        $(this).on("click", function(){
            $("#tipo_curso_id").val(JSON.parse($(this).val()).dados.tipoCursoId);
        })
    });

    $("#lista_gerenciar_coordenador option").each(function(){
        $(this).on("click", function(){
            $("#coordenador_id").val(JSON.parse($(this).val()).dados.funcionarioId);
        })
    });
}


function iniciarComponentesModalbolsa(bolsa){

    $("#percentual_desconto").mask('000');

    if(bolsa !== null){
        $("#modal_bolsa_titulo").text("Bolsa: " + bolsa.nome);
        $("#modal_bolsa_input_nome").val(bolsa.nome);
        $("#percentual_desconto").val(bolsa.percentualDesconto);
        $("#bolsa_id").val(bolsa.bolsaId);
        $("#bolsa_ativo").prop("checked", bolsa.ativo);
        $("#aut_sup").prop("checked", bolsa.necessitaAutSup);
        $("#bolsa_ativo").show();
        $("#bolsa_ativo").parent().show();
    }
    else{
        $("#modal_bolsa_titulo").text("Nova bolsa");
        $("#modal_bolsa_input_nome").val("");
        $("#percentual_desconto").val("");
        $("#bolsa_id").val(0);
        $("#aut_sup").prop("checked", false);
        $("#bolsa_ativo").prop("checked", true);
        $("#bolsa_ativo").hide();
        $("#bolsa_ativo").parent().hide();
    }

    $("#modal_bolsa_bt_fechar").on("click",function(){
        $("#modal_bolsa").modal('hide');
    });

    $("#modal_bolsa_bt_cancelar").on("click",function(){
        $("#modal_bolsa").modal('hide');
    });

    $("#modal_bolsa_bt_salvar").on("click",function(){
        if ($("#modal_bolsa_input_nome").val() === "") {
            alert("O campo nome é obrigatório!");
            return;
        }
        else if($("#percentual_desconto").val() == ""){
            alert("O campo percentual de desconto é obrigatório!");
            return;
        }
        else if(($("#percentual_desconto").val()) > 100){
            alert("O campo percentual de desconto não deve ser maior que 100%!");
            return;
        }

        $("#modal_bolsa_form").submit();
    });
}
