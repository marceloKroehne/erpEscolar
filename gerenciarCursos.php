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

if(!($usuario->getPermissaoId() == 3 || $usuario->getPermissaoId() == 0)){
    header('Location: index.php');
}

$_SESSION['erros'] = null;

if($_SERVER['REQUEST_METHOD'] == "POST"){

    if(isset($_POST['modal_bolsa_input_nome'])){
        
        $bolsaId = intval($_POST["bolsa_id"]);

        $ativo = $_POST['bolsa_ativo'] ? 1 : 0;
        $autSup = $_POST['aut_sup'] ? 1 : 0;
       
        $retorno = BolsaBanco::insertbolsa($empresa->getEmpresaId(), $usuario->getUsuarioId(), $bolsaId, $_POST['modal_bolsa_input_nome'],  $ativo, $_POST['percentual_desconto'],  $autSup);

        if($retorno->houveErro){
            $_SESSION['erros'] = $retorno->mensagem;
        }

    }
    
    else if(isset($_POST['modal_curso_input_nome'])){

        $lista = [];

        foreach($_POST['checkboxes'] as $checkbox){
            $bolsaInsId = json_decode($checkbox)->id;

            if($bolsaInsId != 0){
                array_push($lista, $bolsaInsId);
            }

        }

        $cursoId = intVal($_POST['curso_id']);

        $ativo = $_POST['curso_ativo'] ? 1 : 0;

        $retorno = CursoBanco::insertCurso(
            $empresa->getEmpresaId(), 
            $usuario->getUsuarioId(), 
            $cursoId, 
            $lista, 
            $_POST['modal_curso_input_nome'], 
            $ativo, 
            $_POST['valor'],
            intVal($_POST['coordenador_id']), 
            intVal($_POST['matriz_id']), 
            intVal($_POST['tipo_curso_id']),
            intVal($_POST['numero_aulas']), 
            intVal($_POST['carga_horaria'])
        );

        if($retorno->houveErro){
            $_SESSION['erros'] = $retorno->mensagem;
        }

    }

}

$cursos = CursoBanco::getCursos($empresa->getEmpresaId(), false);

$bolsas = BolsaBanco::getBolsas($empresa->getEmpresaId(), false);

$matrizes = MatrizCurricularBanco::getMatrizes($empresa->getEmpresaId());

$tiposCursos = TipoCursoBanco::getTipoCursos($empresa->getEmpresaId());

$coordenadores = UsuarioBanco::getFuncionariosEmpresa($empresa->getEmpresaId());

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
    <link rel="stylesheet" href="recursos/css/gerenciarCursos.css">
    <link rel="stylesheet" href="recursos/css/tabela.css">

    <script src="./biblioteca/jquerry.js"></script>
    <script src="./scripts/script.js"></script>
    <script src="./scripts/gerenciarCursos.js"></script>
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

        <? require_once('./usaveis/modalCursos.php');?>
        <? require_once('./usaveis/modalBolsas.php');?>

        <div class="conteudo">  

            <?php if ($_SESSION['erros'] != null): ?>
                <div class="erros">
                    <p><?=$_SESSION['erros'];?></p>
                </div>
            <?php endif ?>
           
            <?require_once('./usaveis/tabelaCursos.php')?>
            <?require_once('./usaveis/tabelaBolsas.php')?>

        </div>
    </main>

    <?require_once('./usaveis/footer.php');?>

</body>
</html>