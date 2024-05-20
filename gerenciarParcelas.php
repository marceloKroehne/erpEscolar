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
require("./funcoes/contratoBanco.php");
require("./funcoes/situacaoContratoBanco.php");
require("./funcoes/tipoContratoBanco.php");
require("./objetos/contrato.php");
require("./objetos/aluno.php");
require("./funcoes/cursoBanco.php");
require("./funcoes/bolsaBanco.php");
require("./funcoes/tipoCursoBanco.php");
require("./funcoes/usuarioBanco.php");
require("./funcoes/matrizCurricularBanco.php");
require("./funcoes/disciplinaBanco.php");
require("./objetos/disciplina.php");
require("./objetos/matrizCurricular.php");
require("./objetos/tipoCurso.php");
require("./objetos/curso.php");
require("./objetos/bolsa.php");
require("./funcoes/turmaBanco.php");
require("./objetos/turma.php");
require("./funcoes/situacaoTurmaBanco.php");
require("./objetos/situacaoTurma.php");
require("./funcoes/turnoBanco.php");
require("./objetos/turno.php");
require("./funcoes/salaBanco.php");
require("./funcoes/planoCursoBanco.php");
require("./objetos/sala.php");
require("./funcoes/modalidadeBanco.php");
require("./objetos/modalidade.php");
require("./objetos/planoCurso.php");
require("./objetos/situacaoContrato.php");
require("./objetos/tipoContrato.php");
require("./funcoes/parcelaBanco.php");
require("./objetos/parcela.php");


$_SESSION['erros'] = null;

if(!($usuario->getPermissaoId() == 3 || $usuario->getPermissaoId() == 0)){
    header('Location: index.php');
}


if($_SERVER['REQUEST_METHOD'] == "POST"){


    if(isset($_POST['contrato_sel']) && isset($_POST['modal_parcela_input_nome'])){

        $parcelaId = intval($_POST["parcela_id"]);
        $contrato = json_decode($_POST['contrato_sel']);
        $movimentoId = intval($_POST["movimento_id"]);
        
        $quitar = $_POST['quitar'] ? 1 : 0;

        $retorno = parcelaBanco::insertParcela(
            $usuario->getUsuarioId(), 
            $parcelaId, 
            $_POST['modal_parcela_input_nome'], 
            $_POST['valor'], 
            $movimentoId,
            $contrato,
            $_POST['data_pagamento'],
            $quitar,
            json_decode($_POST['filtro_conta']),
            json_decode($_POST['filtro_subconta'])
        );

        if($retorno->houveErro){
            $_SESSION['erros'] = $retorno->mensagem;
        }

        $parcelas = parcelaBanco::getparcelas(intval($contrato->contratoId));

    }
    else if(isset($_POST['contrato_del']) && isset($_POST['parcela_deletar_id'])){
        $retorno = ParcelaBanco::deletarParcela(intval($_POST['parcela_deletar_id']));
        $contrato = json_decode($_POST['contrato_del']);
        $parcelas = parcelaBanco::getparcelas(intval($contrato->contratoId));

        if($retorno->houveErro){
            $_SESSION['erros'] = $retorno->mensagem;
        }
    }
    if(isset($_POST['contrato'])){
        $contrato = json_decode($_POST['contrato']);
        $parcelas = parcelaBanco::getparcelas(intval($contrato->contratoId));
    }
}

$contratos = ContratoBanco::getContratos($empresa->getEmpresaId());
$contas = ContasBancoBanco::getContasBanco($empresa->getEmpresaId());
$subcontas = SubcontasBanco::getSubcontas($empresa->getEmpresaId());

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
    <link rel="stylesheet" href="recursos/css/gerenciarParcelas.css">
    <link rel="stylesheet" href="/biblioteca/jquerryUi.css">

    <script src="./biblioteca/jquerry.js"></script>
    <script src="./scripts/script.js"></script>
    <script src="./scripts/seletor.js"></script>
    <script src="./scripts/gerenciarParcelas.js"></script>
    <script src="./biblioteca/jquerryUi.js"></script>
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

        <? require_once('./usaveis/modalParcelas.php');?>

        <div class="conteudo">  

            <?php if ($_SESSION['erros'] != null): ?>
                <div class="erros">
                    <p><?=$_SESSION['erros'];?></p>
                </div>
            <?php endif ?>

           <?require_once('./usaveis/tabelaParcelas.php')?>

        </div>
    </main>

    <?require_once('./usaveis/footer.php');?>

</body>
</html>