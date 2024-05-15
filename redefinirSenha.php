<?php

if (!isset($_SESSION))
{
    session_start();
}

require_once "./banco/conexao.php";
require_once("./objetos/retorno.php");

$_SESSION['erros'] = null;

$usuarioId = 0;

if (isset($_GET['usuario_id'])) {
    $usuarioId = intVal($_GET['usuario_id']);

    $sql = "SELECT USUARIO_ID FROM USUARIOS WHERE USUARIO_ID = ".$usuarioId;

    $conexao = new Conexao();

    $conexao->novaConexao();

    $resultados = $conexao->consulta($sql);

    if(empty($resultados)){
        header('Location: login.php');
    }
}
else{
    header('Location: login.php');
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $senha = $_POST['senha'];
    $repita_senha = $_POST['repita_senha'];

    if(strlen($senha) < 6){
        $_SESSION['erros'] =  'A senha deve conter pelo menos 6 carcteres!';
    }
    else if($senha != $repita_senha){
        $_SESSION['erros'] = 'As senhas digitadas não correspondem!';
    }
    else{

        $sql = "update USUARIOS set SENHA = '$senha' where USUARIO_ID = $usuarioId";

        $conexao = new Conexao();

        $conexao->novaConexao();

        $retorno = $conexao->insertUpdateExcluir($sql);

        if($retorno->houveErro){
            $_SESSION['erros'] = $retorno->mensagem;
        }
        else{
            header('Location: login.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="recursos/css/estilo.css">
    <link rel="stylesheet" href="recursos/css/login.css">
    <title>INSTITUTO LIS</title>
</head>
<body class="login">
    <header class="cabecalho">
        <h1>Redefinir Senha</h1>
    </header>
    <main class="principal">
        <div class="conteudo">
            <h3>Redifina sua senha</h3>
            <?php if ($_SESSION['erros'] != null): ?>
                <div class="erros">
                    <p><?=$_SESSION['erros'];?></p>
                </div>
            <?php endif ?>
            <?php $_SESSION['erros'] = null?>
            <form action="redefinirSenha.php?usuario_id=<?= $usuarioId; ?>" method="post">
                <div>
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha">
                </div>
                <div>
                    <label for="senha">Repita sua senha</label>
                    <input type="password" name="repita_senha" id="repita_senha">
                </div>
                <button>Redefinir Senha</button>
            </form>
        </div>
    </main>
    <footer class="rodape">
        INSTITUTO LIS © <?= date('Y'); ?>
    </footer>
</body>
</html>