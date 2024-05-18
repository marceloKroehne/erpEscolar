<?php 

require("./requires.php");
require("./funcoes/getDados.php");
require("./funcoes/movimentoBanco.php");
require("./funcoes/subcontasBanco.php");
require("./funcoes/contasBancoBanco.php");
require("./funcoes/tipoDocumentoBanco.php");
require("./objetos/grupoContas.php");
require("./objetos/subconta.php");
require("./objetos/movimento.php");
require("./objetos/tipoDocumento.php");

$_SESSION['erros'] = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="recursos/css/estilo.css">
    <link rel="stylesheet" href="recursos/css/index.css">
    <link rel="stylesheet" href="recursos/css/tabela.css">
    <link rel="stylesheet" href="recursos/css/modal.css">
    <link rel="stylesheet" href="recursos/css/seletor.css">
    <link rel="stylesheet" href="/biblioteca/jquerryUi.css">

    <script src="./biblioteca/jquerry.js"></script>
    <script src="./scripts/index.js"></script>
    <script src="./scripts/script.js"></script>
    <script src="./scripts/seletor.js"></script>
    <script src="./biblioteca/jquerryUi.js"></script>
    <script src="./biblioteca/jquerryMask.js"></script>

    <link href="./biblioteca/bootstrap-5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="./biblioteca/bootstrap-5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <title>INSTITUTO LIS</title>
</head>
<body>
    <header class="cabecalho">
        <?require('./usaveis/cabecalho.php');?>
    </header>

    <main class="principal">

        <?php if ($_SESSION['erros'] != null): ?>
            <div class="erros">
                <p><?=$_SESSION['erros'];?></p>
            </div>
        <?php endif ?>

        <div class="conteudo">
            
        </div>

    </main>

    <?require_once('./usaveis/footer.php');?>

</body>
</html>