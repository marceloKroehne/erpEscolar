$(document).ready(function() {
    $('form')[0].reset();
    iniciarComponentesGerenciarmatriz();
});

function iniciarComponentesGerenciarmatriz(){

    $("#novo_matriz").on("click", function(){
        abrirModalmatriz(null);
    });

    $("#nova_disciplina").on("click", function(){
        abrirModaldisciplina(null);
    });

    $("#tabela_matriz tbody td:last-child button").click(function() {
        abrirModalmatriz($(this).parent().data('value'));
    });

    $("#tabela_disciplina tbody td:last-child button").click(function() {
        abrirModaldisciplina($(this).parent().data('value'));
    });

    $("#lista_gerenciar_matriz option").each(function(){
        $(this).on("click", function(){
            $("#modal_disciplina_id").val(JSON.parse($(this).val()).dados.matrizCurricularId);
        })
    });
}

function abrirModalmatriz(matriz){
    $("#matriz_id").val(matriz === null ? 0 : matriz.matrizCurricularId);
    $("#modal_matriz").modal('show');
    iniciarComponentesModalmatriz(matriz);
}


function abrirModaldisciplina(disciplina){
    $("#disciplina_id").val(disciplina === null ? 0 : disciplina.disciplinaId);
    $("#modal_disciplina").modal('show');
    iniciarComponentesModaldisciplina(disciplina);
}


function iniciarComponentesModalmatriz(matriz){
    
    lista = [];

    if(matriz !== null){
        matriz.disciplinas.forEach(element => {
            lista.push(JSON.parse(element).disciplinaId);
        });

        $("#modal_matriz_titulo").text("Matriz curricular: " + matriz.nome);
        $("#modal_matriz_input_nome").val(matriz.nome);
        $("#matriz_id").val(matriz.matrizCurricularId);
        $("#matriz_ativo").prop("checked", matriz.ativo);
        $("#matriz_ativo").show();
        $("#matriz_ativo").parent().show();
    }
    else{
        $("#modal_matriz_titulo").text("Nova matriz curricular");
        $("#matriz_id").val(0);
        $("#modal_matriz_input_nome").val("");
        $("#matriz_ativo").prop("checked", true);
        $("#matriz_ativo").hide();
        $("#matriz_ativo").parent().hide();
    }

    $("#modal_matriz_bt_fechar").on("click",function(){
        $("#modal_matriz").modal('hide');
    });

    $("#modal_matriz_bt_cancelar").on("click",function(){
        $("#modal_matriz").modal('hide');
    });

    
    $("#modal_matriz_bt_salvar").on("click",function(){
        if ($("#modal_matriz_input_nome").val() === "") {
            alert("O campo nome é obrigatório!");
            return;
        }
        if(lista.length == 0 || lista[0] == 0){
            alert("Insira ao menos 1 disciplina!");
            return;
        }

        $("#modal_matriz_form").submit();
    });
}


function iniciarComponentesModaldisciplina(disciplina){

    if(disciplina !== null){
        $("#modal_disciplina_titulo").text("Disciplina: " + disciplina.nome);
        $("#modal_disciplina_input_nome").val(disciplina.nome);
        $("#disciplina_id").val(disciplina.disciplinaId);
        $("#disciplina_ativo").prop("checked", disciplina.ativo);
        $("#disciplina_ativo").show();
        $("#disciplina_ativo").parent().show();
    }
    else{
        $("#modal_disciplina_titulo").text("Nova disciplina");
        $("#modal_disciplina_input_nome").val("");
        $("#disciplina_id").val(0);
        $("#disciplina_ativo").prop("checked", true);
        $("#disciplina_ativo").hide();
        $("#disciplina_ativo").parent().hide();
    }

    $("#modal_disciplina_bt_fechar").on("click",function(){
        $("#modal_disciplina").modal('hide');
    });

    $("#modal_disciplina_bt_cancelar").on("click",function(){
        $("#modal_disciplina").modal('hide');
    });

    $("#modal_disciplina_bt_salvar").on("click",function(){
        if ($("#modal_disciplina_input_nome").val() === "") {
            alert("O campo nome é obrigatório!");
            return;
        }
        $("#modal_disciplina_form").submit();
    });
}
