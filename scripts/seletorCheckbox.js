
$(document).ready(function() {
    lista = [];
    listaCheckboxGlobal = [];
    iniciarSeletorCheckbox();
});

function iniciarSeletorCheckbox() {
    var inputPesquisaCheckbox = $("#input_checkbox");
    var listaCheckbox = $("#datalist_checkbox input");

    inputPesquisaCheckbox.on("focus", function() {

        $(this).css("borderRadius", "5px 5px 0 0");
        var datalistPesquisa = $("#datalist_checkbox");
        datalistPesquisa.show();
        showOptions($("#input_checkbox"), datalistPesquisa);
        atualizarCheckboxes();

    });


    inputPesquisaCheckbox.on('blur', function() {
        $(window).on('click', function eventoClickCheckbox(event){
            if( !( $(event.target).is($("#datalist_checkbox")) || $(event.target).is($("#datalist_checkbox input")) || $(event.target).is($("#datalist_checkbox label"))  || $(event.target).is($("#input_checkbox")) ) ){
                hideOptionsInput($("#datalist_checkbox"));
                $(window).off('click', eventoClickCheckbox);
            }
           
        });
        
    });

    listaCheckbox.each(function(){
        listaCheckboxGlobal.push($(this).clone());
    });

    listaCheckbox.each(
        function(){
            $(this).on("click", function() {
                
                if($(this).is($("#todos_checkbox"))){
                    $("#datalist_checkbox input").prop("checked", $(this).prop("checked"));
                    listaCheckbox.each(function(){
                        atualizarLista($(this), $("#todos_checkbox").prop("checked"));
                    });
                }
                else{
                    if(!($(this).prop("checked"))){
                        $("#todos_checkbox").prop("checked", false);
                        atualizarLista($("#todos_checkbox"), false);
                    }

                    atualizarLista($(this), $(this).prop("checked"));
                }

                
            });
        }
    );

    const $datalistCheckboxCopia = $("#datalist_checkbox label").clone(true);

    inputPesquisaCheckbox.on("input", function() {

        const textoDigitadoCheckbox = $("#input_checkbox").val().toLowerCase();
        const $datalistCheckbox = $("#datalist_checkbox");

        $datalistCheckbox.empty();

        $datalistCheckboxCopia.each(function(){
            var parametro = JSON.parse($(this).find("input").val());
            if(parametro.label.toLowerCase().includes(textoDigitadoCheckbox)){
                
                var novoCheckbox = $(this).clone(true);
                $datalistCheckbox.append(novoCheckbox);
                marcarCheckbox(novoCheckbox.find("input"));
                
            }

            marcarCheckbox($(this).find("input"));
        });

        if(lista.length != $datalistCheckboxCopia.length){
            lista.splice(0, 1);
            $("#todos_checkbox").prop("checked", false);
        }

    });
}

function marcarCheckbox($checkbox){
    $novoCheckbox = $checkbox;
    $novoCheckbox.prop("checked", false);
    lista.forEach(function(item){
        if(JSON.parse($novoCheckbox.val()).id === item){
            $novoCheckbox.prop("checked", true);
        }
    });

}

function atualizarLista($checkbox, marcado){
    $novoCheckbox = $checkbox;
    listaCheckboxGlobal.forEach(function(elemento){
        if($novoCheckbox.attr("id") === $(elemento).attr("id")){
            
            if(marcado){
                lista.push(JSON.parse($novoCheckbox.val()).id);
            }
            else{
                lista = lista.filter(function(item) {
                    return item !== JSON.parse($novoCheckbox.val()).id;
                });
            }
        }
       
    });
}

function atualizarCheckboxes(){
    $("#datalist_checkbox input").each(function(){
        marcarCheckbox($(this));
    });
}