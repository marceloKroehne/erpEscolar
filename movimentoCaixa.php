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

if(!($usuario->getPermissaoId() == 3 || $usuario->getPermissaoId() == 0)){
    header('Location: index.php');
}


$_SESSION['erros'] = null;

$dataIni = date('d/m/Y');
$dataFim = date('d/m/Y');

$posicao = 0;

if($_SERVER['REQUEST_METHOD'] == "POST"){

    if(
        isset($_POST['movimento_id']) &&
        isset($_POST['modal_movimento_data']) &&
        isset($_POST['subconta_entrada_id']) &&
        isset($_POST['subconta_saida_id']) &&
        isset($_POST['modal_movimento_historico']) &&
        isset($_POST['tipo_documento_id']) &&
        isset($_POST['modal_movimento_nr_documento']) &&
        isset($_POST['modal_movimento_valor']) &&
        isset($_POST['modal_movimento_obs']) &&
        isset($_POST['numero_movimento']) &&
        isset($_POST['lista_movimentos']) &&
        isset($_POST['posicao_lista'])
    ){
        $movimentoId = intVal($_POST['movimento_id']);
        $data = $_POST['modal_movimento_data'];
        $subcontaEntradaId = intVal($_POST['subconta_entrada_id']);
        $subcontaSaidaId = intVal($_POST['subconta_saida_id']);
        $historico = $_POST['modal_movimento_historico'];
        $tipoDocumentoId = intVal($_POST['tipo_documento_id']);
        $numeroDocumento = $_POST['modal_movimento_nr_documento'];
        $valor = $_POST['modal_movimento_valor'];
        $observacao = $_POST['modal_movimento_obs'];
        $numeroMovimento = $_POST['numero_movimento'];
        $listaMovimentosOfx =  json_decode($_POST['lista_movimentos']);
        $posicao = intVal($_POST['posicao_lista']);
        $parcelaQuitar = intVal($_POST['parcela_quitar']);

        if($listaMovimentosOfx == null || count($listaMovimentosOfx) == 0 || (!json_decode($listaMovimentosOfx[$posicao])->duplicado)){

            
            $retorno = MovimentoBanco::insertMovimento(
                $movimentoId,
                $empresa->getEmpresaId(),
                $usuario->getUsuarioId(), 
                $data, 
                $subcontaEntradaId, 
                $subcontaSaidaId,
                $historico, 
                $tipoDocumentoId, 
                $numeroDocumento, 
                $valor,
                $observacao,
                $numeroMovimento
            );

            if($retorno->houveErro){
                $_SESSION['erros'] = $retorno->mensagem;
            }

        }

        $posicao = $posicao + 1;

    }
    else if(isset($_POST['deletar_movimento_id'])){

        $retorno = MovimentoBanco::deleteMovimento(intval(($_POST['deletar_movimento_id'])));

        if($retorno->houveErro){
            $_SESSION['erros'] = $retorno->mensagem;
        }

    }
    else if(isset($_FILES['arquivo_ofx'])){

        $conteudoOfx = file_get_contents($_FILES['arquivo_ofx']["tmp_name"]);

        $listaMovimentosOfx = processarOFX($conteudoOfx, $empresa->getEmpresaId());
    }
    
    if(isset($_POST['data_movimento_ini']) && isset($_POST['data_movimento_fim'])){
        $dataIni = $_POST['data_movimento_ini'];
        $dataFim = $_POST['data_movimento_fim'];

    }   

    if(isset($_POST['filtro_subconta'])){
        $filtroSubConta = json_decode($_POST['filtro_subconta']);
        $filtroSubcontaId = $filtroSubConta->subcontaId;
    }

}

$movimentos = MovimentoBanco::getMovimentos($empresa->getEmpresaId(), $dataIni, $dataFim, $filtroSubcontaId);

$movimentosExp = [];

foreach($movimentos as $movExp){
    array_push($movimentosExp, $movExp->toJson());
}

$subcontas = SubcontasBanco::getSubcontas($empresa->getEmpresaId());

$contas = ContasBancoBanco::getContasBanco($empresa->getEmpresaId());

$tiposDocumentos = TipoDocumentoBanco::getTiposDocumentos($empresa->getEmpresaId());

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="recursos/css/estilo.css">
    <link rel="stylesheet" href="recursos/css/movimentoCaixa.css">
    <link rel="stylesheet" href="recursos/css/tabela.css">
    <link rel="stylesheet" href="recursos/css/modal.css">
    <link rel="stylesheet" href="recursos/css/seletor.css">
    <link rel="stylesheet" href="/biblioteca/jquerryUi.css">

    <script src="./biblioteca/jquerry.js"></script>
    <script src="./scripts/movimentoCaixa.js"></script>
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

    <?require_once('./usaveis/modalMovimentos.php');?>

    <main class="principal">

        <?php if ($_SESSION['erros'] != null): ?>
            <div class="erros">
                <p><?=$_SESSION['erros'];?></p>
            </div>
        <?php endif ?>

        <div class="conteudo">
            <div class="titulo">
                <H1>Movimentação financeira</H1>                
            </div>
            <div class="filtro_movimento">

                <input hidden id="data_hoje" value="<?=date('d/m/Y');?>">

                <form id="filtro_movimento_form" action="movimentoCaixa.php" method="post">

                    <input hidden value='<?=json_encode($filtroSubConta)?>' id="filtro_subconta" name="filtro_subconta">

                    <div class="filtro_data">
                        <label>Data início: 
                            <input id="data_movimento_ini" name="data_movimento_ini" value="<?=$dataIni;?>" maxlength="10" type="text">
                        </label> 

                        <label>Data fim: 
                            <input id="data_movimento_fim" name="data_movimento_fim" value="<?=$dataFim;?>" maxlength="10" type="text">
                        </label> 
                    </div>

                    <?

                    $parametrosPesquisa = [];

                    foreach($subcontas as $subconta){
                        $parametro = new Parametro($subconta->getSubcontaId(), $subconta->getNome());
                        $parametro->dados = $subconta->toJson();

                        array_push($parametrosPesquisa, $parametro);
                    }

                    $inputId = "filtro_input_subcontas";
                    $listaId = "filtro_lista_subcontas";
                    $placeHolderPesquisa = "subcontas";
                    ?>
                    <div class="filtro_subconta">
                        <label for="filtro_input_subcontas">Subcontas:</label>

                        <?
                        require("./usaveis/seletor.php");
                        ?>
                    </div>

                </form>
                <div class="filtro_botao">
                    <button id="filtro_movimento_botao" type="submit">Filtrar</button>
                </div>
            </div>

            <div class="movimentos">

                <?require_once('./usaveis/tabelaMovimento.php');?>
            </div>

        </div>

    </main>

    <?require_once('./usaveis/footer.php');?>

</body>
</html>