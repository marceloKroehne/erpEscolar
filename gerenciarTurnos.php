<?php 

require("./requires.php");
require("./funcoes/getDados.php");
require("./funcoes/turnoBanco.php");
require("./objetos/turno.php");

$_SESSION['erros'] = null;

if(!($usuario->getCargo()->getPermissaoId() == 3 || $usuario->getCargo()->getPermissaoId() == 0)){
    header('Location: index.php');
}


if($_SERVER['REQUEST_METHOD'] == "POST"){


    if(isset($_POST['modal_turno_input_nome'])){

        $turnoId = intval($_POST["turno_id"]);

        $ativo = $_POST['turno_ativo'] ? 1 : 0;
       
        $retorno = TurnoBanco::insertTurno($empresa->getEmpresaId(), $usuario->getUsuarioId(), $turnoId, $_POST['modal_turno_input_nome'], $ativo);

        if($retorno->houveErro){
            $_SESSION['erros'] = $retorno->mensagem;
        }

    }
}

$turnos = TurnoBanco::getTurnos($empresa->getEmpresaId(), false);

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
    <link rel="stylesheet" href="recursos/css/gerenciarTurnos.css">

    <script src="./biblioteca/jquerry.js"></script>
    <script src="./scripts/script.js"></script>
    <script src="./scripts/seletor.js"></script>
    <script src="./scripts/gerenciarTurnos.js"></script>

    <link href="./biblioteca/bootstrap-5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="./biblioteca/bootstrap-5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   
    <title>INSTITUTO LIS</title>
</head>
<body>
    <header class="cabecalho">
        <?require_once('./usaveis/cabecalho.php');?>
    </header>

    <? require_once('./usaveis/menuLateral.php'); ?>

    <main class="principal">

        <? require_once('./usaveis/modalTurnos.php');?>

        <div class="conteudo">  

            <?php if ($_SESSION['erros'] != null): ?>
                <div class="erros">
                    <p><?=$_SESSION['erros'];?></p>
                </div>
            <?php endif ?>

           <?require_once('./usaveis/tabelaTurnos.php')?>

        </div>
    </main>

    <?require_once('./usaveis/footer.php');?>

</body>
</html>