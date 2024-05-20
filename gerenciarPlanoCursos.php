<?php 

require("./requires.php");
require("./funcoes/getDados.php");
require("./funcoes/bolsaBanco.php");
require("./funcoes/cursoBanco.php");
require("./funcoes/planoCursoBanco.php");
require("./funcoes/tipoCursoBanco.php");
require("./funcoes/usuarioBanco.php");
require("./funcoes/matrizCurricularBanco.php");
require("./funcoes/disciplinaBanco.php");
require("./objetos/disciplina.php");
require("./objetos/matrizCurricular.php");
require("./objetos/tipoCurso.php");
require("./objetos/curso.php");
require("./objetos/bolsa.php");
require("./objetos/planoCurso.php");

if(!($usuario->getPermissaoId() == 3 || $usuario->getPermissaoId() == 0)){
    header('Location: index.php');
}

$_SESSION['erros'] = null;

if($_SERVER['REQUEST_METHOD'] == "POST"){

    if(isset($_POST['modal_plano_curso_input_nome'])){
        
        $planoCursoId = intval($_POST["plano_curso_id"]);
        $cursoId = intval($_POST["curso_id"]);

        $ativo = $_POST['plano_curso_ativo'] ? 1 : 0;
        $autSup = $_POST['aut_sup'] ? 1 : 0;
       
        $retorno = PlanoCursoBanco::insertPlanoCurso(
            $empresa->getEmpresaId(),
            $usuario->getUsuarioId(), 
            $planoCursoId, 
            $cursoId,
            $_POST['modal_plano_curso_input_nome'],  
            $ativo,   
            $autSup,
            $_POST['numero_parcelas'],
            $_POST['valor_parcela'],
            $_POST['valor_total']
        );

        if($retorno->houveErro){
            $_SESSION['erros'] = $retorno->mensagem;
        }

    }

}

$cursos = CursoBanco::getCursos($empresa->getEmpresaId());

$planoCursos = PlanoCursoBanco::getPlanoCursos($empresa->getEmpresaId(), false);

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
    <link rel="stylesheet" href="recursos/css/gerenciarPlanoCursos.css">
    <link rel="stylesheet" href="recursos/css/tabela.css">

    <script src="./biblioteca/jquerry.js"></script>
    <script src="./scripts/script.js"></script>
    <script src="./scripts/gerenciarPlanoCursos.js"></script>
    <script src="./scripts/seletor.js"></script>
    <script src="./scripts/seletorCheckbox.js"></script>
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

        <? require_once('./usaveis/modalPlanoCursos.php');?>

        <div class="conteudo">  

            <?php if ($_SESSION['erros'] != null): ?>
                <div class="erros">
                    <p><?=$_SESSION['erros'];?></p>
                </div>
            <?php endif ?>
           
            <?require_once('./usaveis/tabelaPlanoCursos.php')?>

        </div>
    </main>

    <?require_once('./usaveis/footer.php');?>

</body>
</html>