<?
    //DADOS EMPRESA
    
    $empresaId = intval($_POST['empresa_id']);
    $nomeRazaoSocial = $_POST['nome_razao_social'];
    $empresaEmail = $_POST['empresa_email'];
    $empresaCpfCnpj = $_POST['cpf_cnpj'];
    $empresaTelefone = $_POST['telefone_empresa'];
    $cep = $_POST['cep'];
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];

    //DADOS USUARIO
    $usuarioId = intval($_POST["usuario_id"]);
    $usuarioNome = $_POST['usuario_nome'];
    $ativo = intval($_POST['situacao_usuario']);
    $emailUsuario = $_POST['email_usuario'];
    $cpfUsuario = $_POST['cpf_usuario'];
    $rgUsuario = $_POST['rg_usuario'];
    $telefoneUsuario = $_POST['telefone_usuario'];
    $cepUsuario = $_POST['cep_usuario'];
    $logradouroUsuario = $_POST['logradouro_usuario'];
    $numeroUsuario = $_POST['numero_usuario'];
    $complementoUsuario = $_POST['complemento_usuario'];
    $bairroUsuario = $_POST['bairro_usuario'];
    $cidadeUsuario = $_POST['cidade_usuario'];
    $ufUsuario = $_POST['uf_usuario'];


    //DADOS FUNCIONARIO
    $senha = $_POST['senha'];
    $repitaSenha = $_POST['confirmar_senha'];
    $bancoId = intval($_POST['banco_id']);
    $agencia = intval($_POST['agencia']);
    $numeroConta = intval($_POST['numero_conta']);
    $pix = $_POST['pix'];
    $tipoPixId = intval($_POST['tipo_pix']);
    $cargoId = $_POST['cargo_id'];
    $tipoPagamentoId = intVal($_POST['pagamento_id']);
    $funcionarioId = intval($_POST["funcionario_id"]);

    //DADOS ALUNO
    $alunoId = intval($_POST["aluno_id"]);
    $matricula = $_POST["matricula_aluno"];
?>
