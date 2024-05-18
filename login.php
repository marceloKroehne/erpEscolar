<?php 

require("./requires.php");
require("./funcoes/usuarioBanco.php");
require("./funcoes/empresaBanco.php");
require("./funcoes/getDados.php");

$_SESSION['erros'] = null;

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['email']) && isset($_POST['senha'])){

        $usuario = UsuarioBanco::getFuncionario($_POST['email'], $_POST['senha']);

        if(!is_null($usuario)) {

            $empresa = EmpresaBanco::getEmpresa($usuario->getUsuarioId());

            $_SESSION['empresa'] = $empresa;
            $_SESSION['usuario'] = $usuario;
            $exp = time() + 60 * 60 * 24 * 30;
            setcookie('usuario', serialize($usuario), $exp);
            setcookie('empresa', serialize($empresa), $exp);
            header('Location: index.php');
            exit;
        }

        if(!$_SESSION['usuario']) {
            $_SESSION['erros'] = 'Usuário/Senha inválido!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="recursos/css/estilo.css">
    <link rel="stylesheet" href="recursos/css/login.css">
    <script src="./scripts/login.js"></script>
    <title>INSTITUTO LIS</title>
</head>
<body class="login">
    <header class="cabecalho">
        <h1>INSTITUTO LIS</h1>
        <h2>Seja Bem Vindo</h2>
    </header>
    <main class="principal">
        <div class="conteudo_login">

            <h3>Identifique-se</h3>
            
            <?php if ($_SESSION['erros'] != null): ?>
                <div class="erros">
                    <p><?=$_SESSION['erros'];?></p>
                </div>
            <?php endif ?>

            <?php $_SESSION['erros'] = null; ?>
            <form action="login.php" method="post" id="formularioEntrar">
                <div>
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email">
                </div>
                <div>
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha">
                </div>
                <div>
                    <a href="recuperarSenha.php">Esqueci minha senha</a>
                </div>
            </form>

            <div class="botoes">
                <a href="cadastro.php"><button type="button">Cadastrar-se</button></a>
                <button type="submit" form="formularioEntrar" >Entrar</button>
            </div>
            
        </div>
    </main>
    <?require_once('./usaveis/footer.php');?>
</body>
</html>