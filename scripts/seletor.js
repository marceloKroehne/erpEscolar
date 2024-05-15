function iniciarSeletor(input, lista) {
    var inputPesquisa = $("#"+input);
    var listaPesquisa = $("#"+lista + " option");
    const $datalistCopia = $("#"+lista + " option").clone();
  
    inputPesquisa.on("focus", function() {

        $("#"+input).val("");
        
        $(this).css("borderRadius", "5px 5px 0 0");
        var datalistPesquisa = $("#"+lista);
        datalistPesquisa.show();
        showOptions($("#"+input), datalistPesquisa);
        
        $(window).on('click', function eventoClickPesquisa(event){
            if( !( $(event.target).is($("#"+input)) ) ){
                hideOptionsInput($("#"+lista));
                $(window).off('click', eventoClickPesquisa);
            }
            
        });

    });

    listaPesquisa.each(
        function() {
        
            $(this).on("click", function() {

                var parametro = JSON.parse($(this).val());
                var inputPesquisa = $("#"+input);

                inputPesquisa.val(parametro.label);
                inputPesquisa.css("borderRadius", "5px");
                $(lista).hide();
                
            });
        }
    );

    inputPesquisa.on("input", function() {


        const textoDigitado = $("#"+input).val().toLowerCase();
        const $datalist = $("#"+lista);

        $datalist.empty();

        $datalistCopia.each(function(){
            var parametro = JSON.parse($(this).val());
            if(parametro.label.toLowerCase().includes(textoDigitado)){
                $datalist.append($(this).clone());
            }
        });

        $("#"+lista + " option").each(function (){
            $(this).on("click", function() {

                var parametro = JSON.parse($(this).val());
                var inputPesquisa = $("#"+input);

                inputPesquisa.val(parametro.label);
                inputPesquisa.css("borderRadius", "5px");
                $(lista).hide();
                
            });
        });
    });
}