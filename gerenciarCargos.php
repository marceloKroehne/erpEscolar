<?php 

require("./requires.php");
require("./funcoes/getDados.php");
require("./funcoes/cargoBanco.php");


if($usuario->getPermissaoId() != 3){
    header('Location: index.php');
}

$_SESSION['erros'] = null;

if($_SERVER['REQUEST_METHOD'] == "POST"){

    if(
        isset($_POST['cargo_id']) && 
        isset($_POST['cargo_nome']) && 
        isset($_POST['cargo_permissao_id']) 
    ){

        $cargoId = intVal($_POST['cargo_id']);
        $ativo = $_POST['cargo_ativo'] ? 1 : 0;

        $retorno = CargosBanco::insertCargo($empresa->getEmpresaId(), $usuario->getUsuarioId(), $cargoId, $_POST['cargo_nome'], $ativo);

        if($retorno->houveErro){
            $_SESSION['erros'] = $retorno->mensagem;
        }

    }
}

$cargos = CargosBanco::getCargosEmpresa($empresa->getEmpresaId(), false);

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
    <link rel="stylesheet" href="recursos/css/gerenciarCargos.css">

    <script src="./biblioteca/jquerry.js"></script>
    <script src="./scripts/script.js"></script>
    <script src="./scripts/seletor.js"></script>
    <script src="./scripts/gerenciarCargos.js"></script>

    <link href="./biblioteca/bootstrap-5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="./biblioteca/bootstrap-5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   
    <title>INSTITUTO LIS</title>
</head>
<body>
    <header class="cabecalho">
        <?require_once('./usaveis/cabecalho.php');?>
    </header>

    

    <main class="principal">

        <? require_once('./usaveis/modalCargos.php');?>

        <div class="conteudo">  

            <?php if ($_SESSION['erros'] != null): ?>
                <div class="erros">
                    <p><?=$_SESSION['erros'];?></p>
                </div>
            <?php endif ?>

           <?require_once('./usaveis/tabelaCargos.php')?>

        </div>
    </main>

    <?require_once('./usaveis/footer.php');?>

</body>
</html>