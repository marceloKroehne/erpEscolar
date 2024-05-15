window.addEventListener("load", function (event) {
  const ultimoCampo = document.getElementById('senha');

  ultimoCampo.addEventListener('keydown', function(event) {

    if (event.key === 'Enter') {

      event.preventDefault();

      document.getElementById('formularioEntrar').submit();
    }
  });
});