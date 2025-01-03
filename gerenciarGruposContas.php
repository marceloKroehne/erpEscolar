<?php 

require("./requires.php");
require("./funcoes/getDados.php");
require("./funcoes/gruposContasBanco.php");
require("./funcoes/subcontasBanco.php");
require("./funcoes/contasBancoBanco.php");
require("./objetos/grupoContas.php");
require("./objetos/subconta.php");

if(!($usuario->getPermissaoId() == 3 || $usuario->getPermissaoId() == 0)){
    header('Location: index.php');
}

$_SESSION['erros'] = null;

if($_SERVER['REQUEST_METHOD'] == "POST"){

    if(isset($_POST['modal_grp_input_nome'])){
        
        if(isset($_POST["grupo_conta_id"])){
            $grupoId = intval($_POST["grupo_conta_id"]);
        }

        $ativo = $_POST['conta_ativo'] ? 1 : 0;
        $recebVenda = $_POST['grupo_receb_vendas'] ? 1 : 0;
       
        $retorno = GruposContasBanco::insertGrupoConta($empresa->getEmpresaId(), $usuario->getUsuarioId(), $grupoId, $_POST['modal_grp_input_nome'],  $ativo, $recebVenda);

        if($retorno->houveErro){
            $_SESSION['erros'] = $retorno->mensagem;
        }

    }
    
    else if(isset($_POST['modal_sub_input_nome']) && isset($_POST['modal_sub_grupo_id']) && isset($_POST['modal_sub_select_tipo_id'])){

        if(isset($_POST["subconta_id"])){
            $subContaId = intval($_POST["subconta_id"]);
        }

        $ativo = $_POST['subconta_ativo'] ? 1 : 0;

        $bancoId = intVal($_POST['banco_id']);
        $agencia = intVal($_POST['agencia']);
        $numeroConta = intVal($_POST['numero_conta']);

        $retorno = SubContasBanco::insertSubconta(
            $usuario->getUsuarioId(), 
            $subContaId, 
            $bancoId,
            $agencia,
            $numeroConta,
            $_POST['modal_sub_grupo_id'], 
            $_POST['modal_sub_input_nome'], 
            $_POST['modal_sub_select_tipo_id'], 
            $ativo
        );

        if($retorno->houveErro){
            $_SESSION['erros'] = $retorno->mensagem;
        }

    }
}

$grupos = GruposContasBanco::getGrupos($empresa->getEmpresaId(), false);

$contas = ContasBancoBanco::getContasBanco($empresa->getEmpresaId());

$subcontas = SubcontasBanco::getSubcontas($empresa->getEmpresaId(), false);

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
    <link rel="stylesheet" href="recursos/css/gerenciarGrupoConta.css">
    <link rel="stylesheet" href="recursos/css/tabela.css">
    
    <script src="./biblioteca/jquerry.js"></script>
    <script src="./scripts/script.js"></script>
    <script src="./scripts/seletor.js"></script>
    <script src="./scripts/gerenciarGrupoConta.js"></script>
    <link href="./biblioteca/bootstrap-5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="./biblioteca/bootstrap-5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   
    <title>INSTITUTO LIS</title>
</head>
<body>
    <header class="cabecalho">
        <?require_once('./usaveis/cabecalho.php');?>
    </header>

    

    <main class="principal">

        <? require_once('./usaveis/modalGrupoContas.php');?>
        <? require_once('./usaveis/modalSubcontas.php');?>

        <div class="conteudo">  

            <?php if ($_SESSION['erros'] != null): ?>
                <div class="erros">
                    <p><?=$_SESSION['erros'];?></p>
                </div>
            <?php endif ?>
           
            <?require_once('./usaveis/tabelaGruposContas.php')?>
            <?require_once('./usaveis/tabelaSubconta.php')?>

        </div>
    </main>

    <?require_once('./usaveis/footer.php');?>

</body>
</html>