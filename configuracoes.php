<?php 

require("./requires.php");
require("./funcoes/cargoBanco.php");
require("./funcoes/tipoPagamentoBanco.php");
require("./funcoes/bancoBanco.php");
require("./funcoes/empresaBanco.php");
require("./funcoes/usuarioBanco.php");
require("./funcoes/getDados.php");
require("./usaveis/dadosCadastro.php");

$destino = "configuracoes.php";

$usuarioSelecionado = UsuarioBanco::getFuncionarioPorId($usuario->getUsuarioId());

$_SESSION['erros'] = null;
$_SESSION['salvo'] = null;

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if($usuarioSelecionado->getCargo()->getPermissaoId() == 3){
        $retorno = EmpresaBanco::updateEmpresa(
            $empresaId,
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
            $uf
        );

        if($retorno->houveErro){
            $_SESSION['erros'] = $retorno->mensagem;
        }
    }

    if($_POST['update_senha'] == "true"){
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
        }
        else{
            $retorno = UsuarioBanco::insertFuncionario(
                $conexao,
                $usuario->getUsuarioId(),
                $retorno->dados,
                $funcionarioId,
                $cargoId,
                $banco_id,
                $agencia,
                $numeroConta,
                $pix,
                $tipoPixId,
                $tipoPagamentoId,
                $senha,
                $repitaSenha
            );
    
            if($retorno->houveErro){
                $_SESSION['erros'] = $retorno->mensagem;
            }
            else{
                $conexao->fecharConexao();
            }
        }
    }
    else{
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
        
        $usuario = UsuarioBanco::getFuncionarioPorId($usuarioId);
        $empresa = EmpresaBanco::getEmpresa($usuario->getUsuarioId());

        $_SESSION['empresa'] = $empresa;
        $_SESSION['usuario'] = $usuario;
        $exp = time() + 60 * 60 * 24 * 30;
        setcookie('usuario', serialize($usuario), $exp);
        setcookie('empresa', serialize($empresa), $exp);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700" rel="stylesheet">
        
    <link rel="stylesheet" href="recursos/css/estilo.css">
    <link rel="stylesheet" href="recursos/css/configuracoes.css">

    <script src="./biblioteca/jquerry.js"></script>

    <script src="./scripts/script.js"></script>
    <script src="./scripts/configuracoes.js"></script>

    <link href="./biblioteca/bootstrap-5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="./biblioteca/bootstrap-5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <title>INSTITUTO LIS</title>
</head>
<body>

    <header class="cabecalho">
        <? require_once('./usaveis/cabecalho.php'); ?>
    </header>

    

    <main class="principal">

        <div class="conteudo_login">
            <?php if ($_SESSION['salvo'] != null): ?>
                <div class="salvar">
                    <p><?=$_SESSION['salvo']; ?></p>
                </div>
            <?php endif ?>
            <?php if ($_SESSION['erros'] != null): ?>
                <div class="erros">
                    <p><?=$_SESSION['erros'];?></p>
                </div>
            <?php endif ?>
            <?php $_SESSION['erros'] = null; ?>
            <?require_once('./usaveis/infoCadastrais.php');?>
            <script>preencherFormulario('<?php echo $empresa->toJson(); ?>','<?php echo $usuario->toJson(); ?>');</script>
        </div>

    </main>

    <?require_once('./usaveis/footer.php');?>

</body>
</html>