<?php 

require("./requires.php");
require("./funcoes/getDados.php");
require("./funcoes/matrizCurricularBanco.php");
require("./funcoes/disciplinaBanco.php");
require("./objetos/matrizCurricular.php");
require("./objetos/disciplina.php");

if(!($usuario->getPermissaoId() == 3 || $usuario->getPermissaoId() == 0)){
    header('Location: index.php');
}

$_SESSION['erros'] = null;

if($_SERVER['REQUEST_METHOD'] == "POST"){

    if(isset($_POST['modal_disciplina_input_nome'])){
        
        $disciplinaId = intval($_POST["disciplina_id"]);

        $ativo = $_POST['disciplina_ativo'] ? 1 : 0;
       
        $retorno = DisciplinaBanco::insertDisciplina($empresa->getEmpresaId(), $usuario->getUsuarioId(), $disciplinaId, $_POST['modal_disciplina_input_nome'],  $ativo);

        if($retorno->houveErro){
            $_SESSION['erros'] = $retorno->mensagem;
        }

    }
    
    else if(isset($_POST['modal_matriz_input_nome'])){

        $lista = [];

        foreach($_POST['checkboxes'] as $checkbox){
            $disciplinaInsId = json_decode($checkbox)->id;

            if($disciplinaInsId != 0){
                array_push($lista, $disciplinaInsId);
            }

        }

        $matrizId = intVal($_POST['matriz_id']);

        $ativo = $_POST['matriz_ativo'] ? 1 : 0;

        $retorno = MatrizCurricularBanco::insertMatriz($empresa->getEmpresaId(), $usuario->getUsuarioId(), $matrizId, $lista, $_POST['modal_matriz_input_nome'], $ativo);

        if($retorno->houveErro){
            $_SESSION['erros'] = $retorno->mensagem;
        }

    }

}

$matrizes = MatrizCurricularBanco::getMatrizes($empresa->getEmpresaId(), false);

$disciplinas = DisciplinaBanco::getDisciplinas($empresa->getEmpresaId(), false);

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
    <link rel="stylesheet" href="recursos/css/matrizesCurriculares.css">
    <link rel="stylesheet" href="recursos/css/tabela.css">

    <script src="./biblioteca/jquerry.js"></script>
    <script src="./scripts/script.js"></script>
    <script src="./scripts/matrizesCurriculares.js"></script>
    <script src="./scripts/seletorCheckbox.js"></script>
    <link href="./biblioteca/bootstrap-5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="./biblioteca/bootstrap-5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   
    <title>INSTITUTO LIS</title>
</head>
<body>
    <header class="cabecalho">
        <?require_once('./usaveis/cabecalho.php');?>
    </header>

    

    <main class="principal">

        <? require_once('./usaveis/modalMatrizesCurriculares.php');?>
        <? require_once('./usaveis/modalDisciplinas.php');?>

        <div class="conteudo">  

            <?php if ($_SESSION['erros'] != null): ?>
                <div class="erros">
                    <p><?=$_SESSION['erros'];?></p>
                </div>
            <?php endif ?>
           
            <?require_once('./usaveis/tabelaMatrizesCurriculares.php')?>
            <?require_once('./usaveis/tabelaDisciplinas.php')?>

        </div>
    </main>

    <?require_once('./usaveis/footer.php');?>

</body>
</html>