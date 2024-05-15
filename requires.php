<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


require("./objetos/tipoPagamento.php");
require("./objetos/banco.php");
require("./objetos/conta.php");
require("./objetos/pix.php");
require("./objetos/mensalista.php");
require("./objetos/horista.php");
require("./objetos/cargo.php");
require("./objetos/usuario.php");
require("./objetos/funcionario.php");
require("./objetos/retorno.php");
require("./objetos/empresa.php");
require("./banco/conexao.php");
require("./objetos/parametros.php");

$listaSitesSemRedLogin = ["login.php", "cadastro.php", "recuperarSenha.php", "redefinirSenha.php"];

if (!isset($_SESSION)){
    session_start();
}

if(isset($_COOKIE['usuario'])) {
    $_SESSION['usuario'] = $_COOKIE['usuario'];
    $usuario = unserialize($_SESSION['usuario']);
}

if(isset($_COOKIE['empresa'])) {
    $_SESSION['empresa'] = $_COOKIE['empresa'];
    $empresa = unserialize($_SESSION['empresa']);
}

if(!isset($_SESSION['usuario']) && !in_array(basename($_SERVER['PHP_SELF']), $listaSitesSemRedLogin)){
    header('Location: login.php');
}




?>