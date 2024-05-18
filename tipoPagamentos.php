<?php 

require("./requires.php");
require("./funcoes/getDados.php");
require("./funcoes/tipoPagamentoBanco.php");

if($usuario->getCargo()->getPermissaoId() != 3){
    header('Location: index.php');
}

$_SESSION['erros'] = null;

if($_SERVER['REQUEST_METHOD'] == "POST"){


    if(isset($_POST['modal_pag_input_nome'])){

        $tipoPagamentoId = intVal($_POST['tipo_pagamento_id']);

        $ativo = $_POST['pag_ativo'] ? 1 : 0;

        $retorno = TipoPagamentoBanco::insertTipoPagamento(
            $empresa->getEmpresaId(), 
            $usuario->getUsuarioId(),
            $tipoPagamentoId, 
            $_POST['modal_pag_input_nome'], 
            $ativo,
            $_POST['valor_salario'],
            $_POST['percentual_inss'],
            $_POST['valor_hora']
        );

        if($retorno->houveErro){
            $_SESSION['erros'] = $retorno->mensagem;
        }

    }
}

$pagamentos = TipoPagamentoBanco::getTipoPagamentos($empresa->getEmpresaId(), false);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    
    <link rel="stylesheet" href="recursos/css/estilo.css">
    <link rel="stylesheet" href="recursos/css/seletor.css">
    <link rel="stylesheet" href="recursos/css/configuracoes.css">
    <link rel="stylesheet" href="recursos/css/modal.css">
    <link rel="stylesheet" href="recursos/css/tabela.css">
    <link rel="stylesheet" href="recursos/css/tipoPagamentos.css">

    <script src="./biblioteca/jquerry.js"></script>
    <script src="./scripts/script.js"></script>
    <script src="./scripts/seletor.js"></script>
    <script src="./scripts/tipoPagamentos.js"></script>
    <script src="./biblioteca/jquerryMask.js"></script>

    <link href="./biblioteca/bootstrap-5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="./biblioteca/bootstrap-5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   
    <title>INSTITUTO LIS</title>
</head>
<body>
    <header class="cabecalho">
        <?require_once('./usaveis/cabecalho.php');?>
    </header>

    

    <main class="principal">

        <? require_once('./usaveis/modaltipoPagamentos.php');?>

        <div class="conteudo">  

            <?php if ($_SESSION['erros'] != null): ?>
                <div class="erros">
                    <p><?=$_SESSION['erros'];?></p>
                </div>
            <?php endif ?>

           <?require_once('./usaveis/tabelatipoPagamentos.php')?>

        </div>
    </main>

    <?require_once('./usaveis/footer.php');?>

</body>
</html>