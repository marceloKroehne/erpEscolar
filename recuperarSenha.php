<?php 

if (!isset($_SESSION))
{
    session_start();
}

require_once "./banco/conexao.php";
require("./objetos/usuario.php");
require("./objetos/email.php");

$_SESSION['erros'] = null;

$_SESSION['recuperarSenha'] = null;

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $recuperarSenha = false;

    $email = $_POST['email'];

    $sql = "SELECT USUARIO_ID, EMAIL FROM USUARIOS WHERE EMAIL = '$email'";

    $conexao = new Conexao();

    $conexao->novaConexao();

    $resultado = $conexao->consulta($sql);

    foreach($resultado as $resultado) {
        $emailCadastrado = $resultado['EMAIL'];
        $cadastroId = $resultado['USUARIO_ID'];
    }

    if(is_null($emailCadastrado)) {
        $_SESSION['erros'] = "E-mail informado não corresponde a um e-mail de uma conta existente";
    }
    else{
        $emailRecuperarSenha = new email($email,"kranelzin@gmail.com",
        "Recuperação de senha! - INSTITUTO LIS", "Clique aqui para redefinir a senha: redefinirsenha.php?cadastroId='$cadastroId'");
        $emailRecuperarSenha->enviarEmail();
        $recuperarSenha = [true];
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
    <script src="./scripts/script.js"></script>
    <title>INSTITUTO LIS</title>
</head>
<body class="login">
    <header class="cabecalho">
        <h1>INSTITUTO LIS</h1>
        <h2>Seja Bem Vindo</h2>
    </header>
    <main class="principal">
        <div class="conteudo">
            <h3>Informe o E-mail cadastrado:</h3>
            
            <?php if ($_SESSION['erros'] != null): ?>
                <div class="erros">
                    <p><?=$_SESSION['erros'];?></p>
                </div>
            <?php endif ?>

            <?php if($recuperarSenha): ?>
                <div>
                    <p>E-mail de recuperação de conta enviado!</p>
                </div>
            <?php endif ?>
            
            <?php $_SESSION['erros'] = null; ?>
            <form action="recuperarSenha.php" method="post">
                <div>
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email">
                </div>
                <button type="submit">Enviar</button>
            </form>
            
        </div>
    </main>
    <footer class="rodape">
        INSTITUTO LIS © <?= date('Y'); ?>
    </footer>
</body>
</html>