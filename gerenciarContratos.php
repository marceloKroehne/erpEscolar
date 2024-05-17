<?php 

require("./requires.php");
require("./funcoes/getDados.php");
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

$_SESSION['erros'] = null;
$planoCursos = [];

if(!($usuario->getCargo()->getPermissaoId() == 3 || $usuario->getCargo()->getPermissaoId() == 0)){
    header('Location: index.php');
}


if($_SERVER['REQUEST_METHOD'] == "POST"){

    if(isset($_POST['turma_id']) && isset($_POST["aluno_id"])){
        $contratoId = intval($_POST["contrato_id"]);
        $turmaId = intval($_POST["turma_id"]);
        $alunoId = intval($_POST["aluno_id"]);
        $vendedorId = intval($_POST["vendedor_id"]);
        $planoCursoId = intval($_POST["plano_curso_id"]);
        $bolsaId = intval($_POST["bolsa_id"]);
        $situacaoContratoId = intval($_POST["situacao_contrato_id"]);
        $tipoContratoId = intval($_POST["tipo_contrato_id"]);
        
        $retorno = ContratoBanco::insertContrato(
            $empresa->getEmpresaId(), 
            $usuario->getUsuarioId(), 
            $contratoId, 
            $turmaId,
            $alunoId,
            $vendedorId,
            $planoCursoId,
            $bolsaId,
            $situacaoContratoId,
            $tipoContratoId,
            $_POST["data_inicio"],
            $_POST["data_fim"],
            $_POST["observacao"]
        );

           
        if($retorno->houveErro){
            $_SESSION['erros'] = $retorno->mensagem;
        }
    
    }
    else if(isset($_POST['contrato_deletar_id'])){
        $retorno = ContratoBanco::deletarContrato(intval($_POST['contrato_deletar_id']));
        
           
        if($retorno->houveErro){
            $_SESSION['erros'] = $retorno->mensagem;
        }
    }

}

$planoCursos = PlanoCursoBanco::getPlanosCursosPorCursoId(intVal($_POST['curso_ins_id']));
$bolsas = BolsaBanco::getBolsaPorCursoId(intVal($_POST['curso_ins_id']));
$alunos = UsuarioBanco::getAlunosEmpresa($empresa->getEmpresaId());
$contratos = ContratoBanco::getContratos($empresa->getEmpresaId());
$turmas = TurmaBanco::getTurmas($empresa->getEmpresaId());
$vendedores = UsuarioBanco::getFuncionariosEmpresa($empresa->getEmpresaId());
$situacoes = SituacaoContratoBanco::getSituacaoContratos($empresa->getEmpresaId());
$tipoContratos = TipoContratoBanco::getTipoContratos($empresa->getEmpresaId());


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
    <link rel="stylesheet" href="recursos/css/gerenciarContratos.css">
    <link rel="stylesheet" href="/biblioteca/jquerryUi.css">

    <script src="./biblioteca/jquerry.js"></script>
    <script src="./biblioteca/jquerryUi.js"></script>
    <script src="./biblioteca/jquerryMask.js"></script>
    <script src="./scripts/script.js"></script>
    <script src="./scripts/seletor.js"></script>
    <script src="./scripts/gerenciarContratos.js"></script>

    <link href="./biblioteca/bootstrap-5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="./biblioteca/bootstrap-5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   
    <title>INSTITUTO LIS</title>
</head>
<body>
    <header class="cabecalho">
        <?require_once('./usaveis/cabecalho.php');?>
    </header>

    <main class="principal">

        <? require_once('./usaveis/modalContratos.php');?>

        <div class="conteudo">  

            <?php if ($_SESSION['erros'] != null): ?>
                <div class="erros">
                    <p><?=$_SESSION['erros'];?></p>
                </div>
            <?php endif ?>

           <?require_once('./usaveis/tabelaContratos.php')?>

        </div>
    </main>

    <?require_once('./usaveis/footer.php');?>

</body>
</html>