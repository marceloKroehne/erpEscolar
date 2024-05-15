<?php 

require("./requires.php");
require("./funcoes/getDados.php");
require("./funcoes/contasBancoBanco.php");
require("./funcoes/bancoBanco.php");

if(!($usuario->getCargo()->getPermissaoId() == 3 || $usuario->getCargo()->getPermissaoId() == 0)){
    header('Location: index.php');
}

$_SESSION['erros'] = null;

if($_SERVER['REQUEST_METHOD'] == "POST"){



    if(isset($_POST['banco_id']) && isset($_POST['modal_banco_input_nr_banco']) && isset($_POST['modal_banco_input_nome'])){

        $bancoId = intval($_POST["banco_id"]);
        $numeroBanco = intVal($_POST['modal_banco_input_nr_banco']);
        $exigeOfx = $_POST['input_exige_ofx'] ? 1 : 0;
        $ativo = $_POST['banco_ativo'] ? 1 : 0;
       
        $retorno = BancoBanco::insertBanco($empresa->getEmpresaId(), $usuario->getUsuarioId(), $bancoId, $numeroBanco,  $_POST['modal_banco_input_nome'], $exigeOfx, $ativo);

        if($retorno->houveErro){
            $_SESSION['erros'] = $retorno->mensagem;
        }

    }
    
    else if(isset($_POST['modal_conta_banco_id']) && isset($_POST['modal_conta_input_agencia']) && isset($_POST['modal_conta_input_nr_conta'])){

               
        $bancoId = intval($_POST["modal_conta_banco_id"]);
        $agencia = intval($_POST["modal_conta_input_agencia"]);
        $numeroConta = intval($_POST["modal_conta_input_nr_conta"]);

        $bancoIdAnt = intval($_POST["modal_conta_banco_id_ant"]);
        $agenciaAnt = intval($_POST["modal_conta_input_agencia_ant"]);
        $numeroContaAnt = intval($_POST["modal_conta_input_nr_conta_ant"]);
        $ativo = $_POST['conta_ativo'] ? 1 : 0;

        $retorno = ContasBancoBanco::insertContaBanco($usuario->getUsuarioId(),  $bancoIdAnt, $agenciaAnt, $numeroContaAnt, $bancoId, $agencia, $numeroConta, $ativo);

        if($retorno->houveErro){
            $_SESSION['erros'] = $retorno->mensagem;
        }

    }
}

$bancos = BancoBanco::getBancos($empresa->getEmpresaId(), false);

$contas = ContasBancoBanco::getContasBanco($empresa->getEmpresaId(), false);

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
    <link rel="stylesheet" href="recursos/css/gerenciarBancos.css">

    <script src="./biblioteca/jquerry.js"></script>
    <script src="./scripts/script.js"></script>
    <script src="./scripts/seletor.js"></script>
    <script src="./scripts/gerenciarBancos.js"></script>

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

        <? require_once('./usaveis/modalBancos.php');?>
        <? require_once('./usaveis/modalContas.php');?>

        <div class="conteudo">  

            <?php if ($_SESSION['erros'] != null): ?>
                <div class="erros">
                    <p><?=$_SESSION['erros'];?></p>
                </div>
            <?php endif ?>
           <?require_once('./usaveis/tabelaBancos.php')?>
           <?require_once('./usaveis/tabelaContas.php')?>
        </div>
    </main>

    <?require_once('./usaveis/footer.php');?>

</body>
</html>