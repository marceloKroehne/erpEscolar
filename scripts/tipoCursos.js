$(document).ready(function() {
    $('form')[0].reset();
    iniciarComponentesGerenciartipo_curso();
});

function iniciarComponentesGerenciartipo_curso(){

    $("#novo_tipo_curso").on("click", function(){
        abrirModaltipo_curso(null);
    });

    $("#tabela_tipo_curso tbody td:last-child button").click(function() {
        abrirModaltipo_curso($(this).parent().data('value'));
    });

}

function abrirModaltipo_curso(tipo_curso){
    $("#tipo_curso_id").val(tipo_curso === null ? 0 : tipo_curso.tipoCursoId);
    $("#modal_tipo_curso").modal('show');
    iniciarComponentesModaltipo_curso(tipo_curso);
}


function iniciarComponentesModaltipo_curso(tipo_curso){

    if(tipo_curso !== null){
        $("#modal_tipo_curso_titulo").text("Tipo de curso: " + tipo_curso.nome);
        $("#modal_tipo_curso_input_nome").val(tipo_curso.nome);
        $("#tipo_curso_id").val(tipo_curso.tipoCursoId);
        $("#tipo_curso_ativo").prop("checked", tipo_curso.ativo);
        $("#tipo_curso_ativo").show();
        $("#tipo_curso_ativo").parent().show();
    }
    else{
        $("#modal_tipo_curso_titulo").text("Novo tipo de curso");
        $("#modal_tipo_curso_input_nome").val("");
        $("#tipo_curso_id").val(0);
        $("#tipo_curso_ativo").prop("checked", true);
        $("#tipo_curso_ativo").hide();
        $("#tipo_curso_ativo").parent().hide();
    }

    $("#modal_tipo_curso_bt_fechar").on("click",function(){
        $("#modal_tipo_curso").modal('hide');
    });

    $("#modal_tipo_curso_bt_cancelar").on("click",function(){
        $("#modal_tipo_curso").modal('hide');
    });

    
    $("#modal_tipo_curso_bt_salvar").on("click",function(){
        if ($("#modal_tipo_curso_input_nome").val() === "") {
            alert("O campo nome é obrigatório!");
            return;
        }
        $("#modal_tipo_curso_form").submit();
    });

}
