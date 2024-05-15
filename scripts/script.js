//FUNÇÕES COMUNS

function enviarSelecionados(){
  var checkboxes = document.querySelectorAll("#checkboxes_usuarios input[type=checkbox]");
  var selecionados = [];
  for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].checked) {
          selecionados.push(checkboxes[i].getAttribute("value"));
      }
  }

  $("#input_usuarios_envio").val(JSON.stringify(selecionados));

  var checkboxes = document.querySelectorAll("#checkboxes_etapas input[type=checkbox]");
  var selecionados = [];
  for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].checked) {
          selecionados.push(checkboxes[i].getAttribute("value"));
      }
  }

  $("#input_etapas_envio").val(JSON.stringify(selecionados));

}

/* APARTIR DAQUI É O QUE FOI REFEITO*/

function hideOptionsInput(lista){
  lista.hide();
}

function showOptions(input, lista) {
  text = input.val().toUpperCase();
  lista.each(function() {
    if ($(this).text().toUpperCase().indexOf(text) > -1) {
      $(this).show();
    } else {
      $(this).hide();
    }
  });
}

function addActive(x) {
  if (!x) return false;
  removeActive(x);
  if (currentFocus >= x.length) currentFocus = 0;
  if (currentFocus < 0) currentFocus = (x.length - 1);
  x[currentFocus].classList.add("active");
}

function removeActive(x) {
  for (var i = 0; i < x.length; i++) {
    x[i].classList.remove("active");
  }
}