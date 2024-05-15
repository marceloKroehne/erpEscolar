<?php 
if (!isset($_SESSION))
{
    session_start();
}

require("./requires.php");
require("./funcoes/cargoBanco.php");
require("./funcoes/tipoPagamentoBanco.php");
require("./funcoes/empresaBanco.php");
require("./funcoes/usuarioBanco.php");
require("./funcoes/bancoBanco.php");
require("./funcoes/getDados.php");
require("./usaveis/dadosCadastro.php");
require("./objetos/aluno.php");

$_SESSION['erros'] = null;
$_SESSION['salvo'] = null;

$destino = "cadastroAlunos.php";

if($usuario->getCargo()->getPermissaoId() != 3){
    header('Location: index.php');
}

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $conexao = new Conexao();
    $conexao->novaConexaoPDO();
    $conexao->iniciarTranscacao();
    
    $retorno = UsuarioBanco::insertUsuario(
        $conexao,
        $usuario->getUsuarioId(),
        $usuarioId, 
        $ativo, 
        $usuarioNome,
        $emailUsuario,
        $cpfUsuario,
        $rgUsuario,
        $telefoneUsuario,
        $empresa->getEmpresaId(),
        $cepUsuario,
        $logradouroUsuario,
        $numeroUsuario,
        $complementoUsuario,
        $bairroUsuario,
        $cidadeUsuario,
        $ufUsuario
    );
    
    if($retorno->houveErro){
        $_SESSION['erros'] = $retorno->mensagem;
    }else{
        $retorno = UsuarioBanco::insertAluno(
            $conexao,
            $usuario->getUsuarioId(),
            $retorno->dados,
            $alunoId,
            $matricula
        );
        if($retorno->houveErro){
            $_SESSION['erros'] = $retorno->mensagem;
        }
        else{
            $conexao->fecharConexao();
        }

    }

    if($retorno->houveErro){
        $_SESSION['erros'] = $retorno->mensagem;
    }
        

    if(is_null($_SESSION['erros'])){
        $_SESSION['salvo'] = "Alterações salvas com sucesso";
    }
        
    
}

$usuarios = UsuarioBanco::getAlunosEmpresa($empresa->getEmpresaId(), false);
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700" rel="stylesheet">
    
    <link href="./biblioteca/bootstrap-5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="recursos/css/estilo.css">
    <link rel="stylesheet" href="recursos/css/cadastroUsuarios.css">
    <link rel="stylesheet" href="recursos/css/seletor.css">
    <link rel="stylesheet" href="recursos/css/configuracoes.css">

    <script src="./biblioteca/jquerry.js"></script>
    <script src="./biblioteca/bootstrap-5.3.3/dist/js/bootstrap.bundle.min.js"></script>   
    <script src="./biblioteca/jquerryMask.js"></script>
    <script src="./scripts/seletor.js"></script>
    <script src="./scripts/script.js"></script>
    <script src="./scripts/cadastroUsuarios.js"></script>
    
    <title>INSTITUTO LIS</title>
</head>
<body>

    <header class="cabecalho">
        <? require_once('./usaveis/cabecalho.php'); ?>
    </header>

    <? require_once('./usaveis/menuLateral.php'); ?>

    <main class="principal">

        <div class="conteudo_login">
        
            <div class="seletor_usuario">

                <label id="lb_selecionar_usuario" for="lb_selecionar_usuario">Selecione o aluno:</label>

                <div class="input_pesquisa">
                    <?
                        $usuarios = UsuarioBanco::getAlunosEmpresa($empresa->getEmpresaId(), false);

                        $parametrosPesquisa = [];
                        $inputId = "input_gerenciar_usuario";
                        $listaId = "lista_gerenciar_usuario";
                        $placeHolderPesquisa = "usuarios";
                        $valorInputPesquisa="";

                        foreach($usuarios as $usuariox){
                            
                            $parametro = new Parametro($usuariox->getUsuarioId(), $usuariox->getNome());
                            $parametro->dados = $usuariox->toJson();
                            array_push($parametrosPesquisa, $parametro);
                        }

                        require('./usaveis/seletor.php');
                    ?>
                </div>

                <button id="botao_novo_usuario">Novo aluno</button>
            
            </div>
            
            <br>

            <?php if ($_SESSION['salvo']): ?>
                <div class="salvar">
                    <p><?= $_SESSION['salvo']; ?></p>
                </div>
            <?php endif ?>
            <?php if ($_SESSION['erros']): ?>
                <div class="erros">
                    <p><?= $_SESSION['erros']; ?></p>
                </div>
            <?php endif ?>
            <?php $_SESSION['erros'] = null; ?>

            <?require_once('./usaveis/infoCadastrais.php');?>
            
        </div>

    </main>
    <?require_once('./usaveis/footer.php');?>
</body>
</html>