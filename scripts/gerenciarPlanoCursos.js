$(document).ready(function() {
    $('form')[0].reset();
    iniciarComponentesGerenciarcurso();
});

function iniciarComponentesGerenciarcurso(){

    $("#novo_plano_curso").on("click", function(){
        abrirModalplano_curso(null);
    });

    $("#tabela_plano_curso tbody td:last-child button").click(function() {
        abrirModalplano_curso($(this).parent().data('value'));
    });

}

function abrirModalplano_curso(planoCurso){
    $("#plano_curso_id").val(planoCurso === null ? 0 : planoCurso.planoCursoId);
    $("#modal_plano_curso").modal('show');
    iniciarComponentesModalplano_curso(planoCurso);
}


function iniciarComponentesModalplano_curso(planoCurso){

    $("#numero_parcelas").mask('000');
    $("#valor_parcela").mask('000.000.000.000,00', {reverse: true});
    $("#valor_total").mask('000.000.000.000,00', {reverse: true});

    $("#numero_parcelas").on("input",function(){
        $("#valor_total").val(
            parseFloat(
                $("#valor_parcela").val().replace(/\./g, '').replace(/,/g, '.') == "" ? 
                0 : 
                $("#valor_parcela").val().replace(/\./g, '').replace(/,/g, '.')
            ) * 
            parseFloat(
                $("#numero_parcelas").val().replace(/\./g, '').replace(/,/g, '.') == "" ? 
                0 : 
                $("#numero_parcelas").val().replace(/\./g, '').replace(/,/g, '.') 
            )
        );
    });

    $("#valor_parcela").on("input",function(){
        $("#valor_total").val(
            parseFloat(
                $("#valor_parcela").val().replace(/\./g, '').replace(/,/g, '.') == "" ? 
                0 : 
                $("#valor_parcela").val().replace(/\./g, '').replace(/,/g, '.')
            ) * 
            parseFloat(
                $("#numero_parcelas").val().replace(/\./g, '').replace(/,/g, '.') == "" ? 
                0 : 
                $("#numero_parcelas").val().replace(/\./g, '').replace(/,/g, '.') 
            )
        );
    });

    $("#valor_total").on("input",function(){
        $("#valor_parcela").val(
            parseFloat(
                $("#valor_total").val().replace(/\./g, '').replace(/,/g, '.') == "" ? 
                0 : 
                $("#valor_total").val().replace(/\./g, '').replace(/,/g, '.')
            ) /
            parseFloat(
                $("#numero_parcelas").val().replace(/\./g, '').replace(/,/g, '.') == "" ? 
                0 : 
                $("#numero_parcelas").val().replace(/\./g, '').replace(/,/g, '.') 
            )
        );
    });

    if(planoCurso !== null){
        $("#modal_plano_curso_titulo").text("Plano de curso: " + planoCurso.nome);
        $("#modal_plano_curso_input_nome").val(planoCurso.nome);
        $("#numero_parcelas").val(planoCurso.numeroParcelas);
        $("#valor_parcela").val(planoCurso.valorParcela.replace(/\./g, ",").replace(/\-/g, ""));
        $("#valor_total").val(planoCurso.valorTotal.replace(/\./g, ",").replace(/\-/g, ""));
        $("#curso_id").val(planoCurso.curso.cursoId);
        $("#input_gerenciar_curso").val(planoCurso.curso.nome)
        $("#plano_curso_id").val(planoCurso.planoCursoId);
        $("#plano_curso_ativo").prop("checked", planoCurso.ativo);
        $("#aut_sup").prop("checked", planoCurso.necessitaAutSup);
        $("#plano_curso_ativo").show();
        $("#plano_curso_ativo").parent().show();
    }
    else{
        $("#modal_plano_curso_titulo").text("Novo plano de curso");
        $("#modal_plano_curso_input_nome").val("");
        $("#curso_id").val(0);
        $("#input_gerenciar_curso").val("");
        $("#numero_parcelas").val("");
        $("#valor_parcela").val("");
        $("#valor_total").val("");
        $("#plano_curso_id").val(0);
        $("#aut_sup").prop("checked", false);
        $("#plano_curso_ativo").prop("checked", true);
        $("#plano_curso_ativo").hide();
        $("#plano_curso_ativo").parent().hide();
    }

    $("#modal_plano_curso_bt_fechar").on("click",function(){
        $("#modal_plano_curso").modal('hide');
    });

    $("#modal_plano_curso_bt_cancelar").on("click",function(){
        $("#modal_plano_curso").modal('hide');
    });

    $("#lista_gerenciar_curso option").each(function(){
        $(this).on("click", function(){
            $("#curso_id").val(JSON.parse($(this).val()).dados.cursoId);
        })
    });

    $("#modal_plano_curso_bt_salvar").on("click",function(){
        if ($("#modal_plano_curso_input_nome").val() === "") {
            alert("O campo nome é obrigatório!");
            return;
        }
        else if ($("#numero_parcelas").val() === "") {
            alert("O campo numero de parcelas é obrigatório!");
            return;
        }
        else if (parseInt($("#curso_id").val()) === 0) {
            alert("Selecione o curso da parcela!");
            return;
        }
        else if ($("#valor_parcela").val() === "") {
            alert("O campo valor da parcela é obrigatório!");
            return;
        }
        else if ($("#valor_total").val() === "") {
            alert("O campo valor total é obrigatório!");
            return;
        }


        $("#modal_plano_curso_form").submit();
    });
}
