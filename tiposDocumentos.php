<?php 

require("./requires.php");
require("./funcoes/getDados.php");
require("./funcoes/tipoDocumentoBanco.php");
require("./objetos/tipoDocumento.php");

$_SESSION['erros'] = null;

if(!($usuario->getPermissaoId() == 3 || $usuario->getPermissaoId() == 0)){
    header('Location: index.php');
}


if($_SERVER['REQUEST_METHOD'] == "POST"){


    if(isset($_POST['modal_doc_input_nome'])){

        $tipoDocumentoId = intval($_POST["tipo_documento_id"]);

        $ativo = $_POST['doc_ativo'] ? 1 : 0;
       
        $retorno = TipoDocumentoBanco::insertTipoDocumento($empresa->getEmpresaId(), $usuario->getUsuarioId(), $tipoDocumentoId, $_POST['modal_doc_input_nome'], $ativo);

        if($retorno->houveErro){
            $_SESSION['erros'] = $retorno->mensagem;
        }

    }
}

$documentos = TipoDocumentoBanco::getTiposDocumentos($empresa->getEmpresaId(), false);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="recursos/css/estilo.css">
    <link rel="stylesheet" href="recursos/css/seletor.css">
    <link rel="stylesheet" href="recursos/css/configuracoes.css">
    <link rel="stylesheet" href="recursos/css/modal.css">
    <link rel="stylesheet" href="recursos/css/tabela.css">
    <link rel="stylesheet" href="recursos/css/tiposDocumentos.css">

    <script src="./biblioteca/jquerry.js"></script>
    <script src="./scripts/script.js"></script>
    <script src="./scripts/seletor.js"></script>
    <script src="./scripts/tiposDocumentos.js"></script>

    <link href="./biblioteca/bootstrap-5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="./biblioteca/bootstrap-5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   
    <title>INSTITUTO LIS</title>
</head>
<body>
    <header class="cabecalho">
        <?require_once('./usaveis/cabecalho.php');?>
    </header>

    

    <main class="principal">

        <? require_once('./usaveis/modalTiposDocumentos.php');?>

        <div class="conteudo">  

            <?php if ($_SESSION['erros'] != null): ?>
                <div class="erros">
                    <p><?=$_SESSION['erros'];?></p>
                </div>
            <?php endif ?>

           <?require_once('./usaveis/tabelaTiposDocumentos.php')?>

        </div>
    </main>

    <?require_once('./usaveis/footer.php');?>

</body>
</html>