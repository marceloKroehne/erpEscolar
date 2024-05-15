<?php

require("./requires.php");
require("./funcoes/usuarioBanco.php");
require("./funcoes/empresaBanco.php");
require("./funcoes/bancoBanco.php");
require("./funcoes/getDados.php");
require("./usaveis/dadosCadastro.php");

$destino = 'cadastro.php';

$_SESSION['erros'] = null;

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $retornoEmpresa = EmpresaBanco::insertEmpresa(
        $nomeRazaoSocial,
        $empresaEmail,
        $empresaCpfCnpj,
        $empresaTelefone,
        $cep,
        $logradouro,
        $numero,
        $complemento,
        $bairro,
        $cidade,
        $uf,
        $usuarioNome,
        $emailUsuario,
        $cpfUsuario,
        $rgUsuario,
        $cepUsuario,
        $logradouroUsuario,
        $numeroUsuario,
        $complementoUsuario,
        $bairroUsuario,
        $cidadeUsuario,
        $ufUsuario,
        $telefoneUsuario,
        $senha
    );

    if($retornoEmpresa->houveErro){
        $_SESSION['erros'] = $retornoEmpresa->mensagem;
    }
    
    if(is_null($_SESSION['erros'])){
        header('Location: login.php');
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <script src="./biblioteca/jquerry.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700" rel="stylesheet">

    <link rel="stylesheet" href="recursos/css/estilo.css">
    <link rel="stylesheet" href="recursos/css/login.css">

    <script src="./scripts/cadastro.js"></script>
    
    <title>INSTITUTO LIS</title>
</head>
<body class="login">
    <header class="cabecalho">
        <h1>Crie seu cadastro</h1>
    </header>
    <main class="principal">
        <div class="conteudo_login">
            <h3>Cadastre-se</var></h3>
            <?php if ($_SESSION['erros']): ?>
                <div class="erros">
                        <p><?=$_SESSION['erros'] ?></p>
                </div>
            <?php endif ?>
            <?php $_SESSION['erros'] = null?>
            <?php require_once('./usaveis/infoCadastrais.php');?>
        </div>
    </main>
    <?require_once('./usaveis/footer.php');?>
</body>
</html>