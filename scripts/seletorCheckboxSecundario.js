
$(document).ready(function() {
    listaSecundario = [];
    listaCheckboxGlobalSecundario  = [];
    iniciarSeletorCheckboxSecundario ();
});

function iniciarSeletorCheckboxSecundario () {
    var inputPesquisaCheckboxSecundario = $("#input_checkbox_secundario");
    var listaCheckboxSecundario = $("#datalist_checkbox_secundario input");

    inputPesquisaCheckboxSecundario.on("focus", function() {

        $(this).css("borderRadius", "5px 5px 0 0");
        var datalistPesquisaSecundario = $("#datalist_checkbox_secundario");
        datalistPesquisaSecundario.show();
        showOptions($("#input_checkbox_secundario"), datalistPesquisaSecundario);
        atualizarCheckboxesSecundario();

    });


    inputPesquisaCheckboxSecundario.on('blur', function() {
        $(window).on('click', function eventoClickCheckboxSecundario(event){
            if( !( $(event.target).is($("#datalist_checkbox_secundario")) || $(event.target).is($("#datalist_checkbox_secundario input")) || $(event.target).is($("#datalist_checkbox_secundario label"))  || $(event.target).is($("#input_checkbox_secundario")) ) ){
                hideOptionsInput($("#datalist_checkbox_secundario"));
                $(window).off('click', eventoClickCheckboxSecundario);
            }
           
        });
        
    });

    listaCheckboxSecundario.each(function(){
        listaCheckboxGlobalSecundario.push($(this).clone());
    });

    listaCheckboxSecundario.each(
        function(){
            $(this).on("click", function() {
                
                if($(this).is($("#todos_checkbox_secundario"))){
                    $("#datalist_checkbox_secundario input").prop("checked", $(this).prop("checked"));
                    listaCheckboxSecundario.each(function(){
                        atualizarListaSecundario($(this), $(this).prop("checked"));
                    });
                }
                else{
                    if(!($(this).prop("checked"))){
                        $("#todos_checkbox_secundario").prop("checked", false);
                        atualizarListaSecundario($("#todos_checkbox_secundario"), false);
                    }

                    atualizarListaSecundario($(this), $(this).prop("checked"));
                }

                
            });
        }
    );

    const $datalistCheckboxCopiaSecundario = $("#datalist_checkbox_secundario label").clone(true);

    inputPesquisaCheckboxSecundario.on("input", function() {

        const textoDigitadoCheckboxSecundario = $("#input_checkbox_secundario").val().toLowerCase();
        const $datalistCheckboxSecundario = $("#datalist_checkbox_secundario");

        $datalistCheckboxSecundario.empty();

        $datalistCheckboxCopiaSecundario.each(function(){
            var parametro = JSON.parse($(this).find("input").val());
            if(parametro.label.toLowerCase().includes(textoDigitadoCheckboxSecundario)){
                
                var $novoCheckboxSecundario = $(this).clone(true);
                $datalistCheckboxSecundario.append($novoCheckboxSecundario);
                marcarCheckboxSecundario($novoCheckboxSecundario.find("input"));
                
            }

            marcarCheckboxSecundario($(this).find("input"));
        });

    });
}

function marcarCheckboxSecundario($checkbox){
    $novoCheckboxSecundario = $checkbox;
    $novoCheckboxSecundario.prop("checked", false);
    listaSecundario.forEach(function(item){
        if(JSON.parse($novoCheckboxSecundario.val()).id === item){
            $novoCheckboxSecundario.prop("checked", true);
        }
    });

}

function atualizarListaSecundario($checkbox, marcado){
    $novoCheckboxSecundario = $checkbox;
    listaCheckboxGlobalSecundario.forEach(function(elemento){
        if($novoCheckboxSecundario.attr("id") === $(elemento).attr("id")){
            
            if(marcado){
                listaSecundario.push(JSON.parse($novoCheckboxSecundario.val()).id);
            }
            else{
                listaSecundario = listaSecundario.filter(function(item) {
                    return item !== JSON.parse($novoCheckboxSecundario.val()).id;
                });
            }
        }
       
    });
}

function atualizarCheckboxesSecundario(){
    $("#datalist_checkbox_secundario input").each(function(){
        marcarCheckboxSecundario($(this));
    });
}