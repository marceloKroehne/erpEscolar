<?php 

require("./requires.php");
require("./funcoes/getDados.php");
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
require("./objetos/sala.php");
require("./funcoes/modalidadeBanco.php");
require("./objetos/modalidade.php");


$_SESSION['erros'] = null;

if(!($usuario->getCargo()->getPermissaoId() == 3 || $usuario->getCargo()->getPermissaoId() == 0)){
    header('Location: index.php');
}


if($_SERVER['REQUEST_METHOD'] == "POST"){

    if(isset($_POST['modal_turma_input_nome'])){

        $turmaId = intval($_POST["turma_id"]);
        $modalidadeId = intval($_POST['modalidade_id']);
        $cursoId = intval($_POST['curso_id']);
        $situacaoTurmaId = intval($_POST['situacao_turma_id']);
        $professorId = intval($_POST['professor_id']);
        $turnoId = intval($_POST['turno_id']);
        $salaId = intval($_POST['sala_id']);

        $maxAlunos = intval($_POST['max_alunos']);
        $minAlunos = intval($_POST['min_alunos']);
        $metaAlunos = intval($_POST['meta_alunos']);
        
        $dataInicio = $_POST['data_inicio'];
        $dataFim = $_POST['data_fim'];

        $ativo = $_POST['turma_ativo'] ? 1 : 0;
       
        $retorno = TurmaBanco::insertTurma(
            $empresa->getEmpresaId(), 
            $usuario->getUsuarioId(), 
            $turmaId, 
            $_POST['modal_turma_input_nome'], 
            $ativo,
            $modalidadeId,
            $dataInicio,
            $dataFim,
            $cursoId,
            $situacaoTurmaId,
            $professorId,
            $turnoId,
            $salaId,
            $maxAlunos,
            $minAlunos,
            $metaAlunos

        );

        if($retorno->houveErro){
            $_SESSION['erros'] = $retorno->mensagem;
        }

    }
}

$turmas = TurmaBanco::getTurmas($empresa->getEmpresaId(), false);
$modalidades = ModalidadeBanco::getModalidades($empresa->getEmpresaId());
$cursos = CursoBanco::getCursos($empresa->getEmpresaId());
$turnos = TurnoBanco::getTurnos($empresa->getEmpresaId());
$salas = SalaBanco::getSalas($empresa->getEmpresaId());
$situacoes = SituacaoTurmaBanco::getSituacaoTurmas($empresa->getEmpresaId());
$professores = UsuarioBanco::getFuncionariosEmpresa($empresa->getEmpresaId());


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
    <link rel="stylesheet" href="recursos/css/gerenciarTurmas.css">
    <link rel="stylesheet" href="/biblioteca/jquerryUi.css">

    <script src="./biblioteca/jquerry.js"></script>
    <script src="./biblioteca/jquerryUi.js"></script>
    <script src="./biblioteca/jquerryMask.js"></script>
    <script src="./scripts/script.js"></script>
    <script src="./scripts/seletor.js"></script>
    <script src="./scripts/gerenciarTurmas.js"></script>

    <link href="./biblioteca/bootstrap-5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="./biblioteca/bootstrap-5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   
    <title>INSTITUTO LIS</title>
</head>
<body>
    <header class="cabecalho">
        <?require_once('./usaveis/cabecalho.php');?>
    </header>

    

    <main class="principal">

        <? require_once('./usaveis/modalTurmas.php');?>

        <div class="conteudo">  

            <?php if ($_SESSION['erros'] != null): ?>
                <div class="erros">
                    <p><?=$_SESSION['erros'];?></p>
                </div>
            <?php endif ?>

           <?require_once('./usaveis/tabelaTurmas.php')?>

        </div>
    </main>

    <?require_once('./usaveis/footer.php');?>

</body>
</html>