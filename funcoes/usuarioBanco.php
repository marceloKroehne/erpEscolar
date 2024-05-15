<?
class UsuarioBanco{

    public static function getFuncionario($email, $senha){

        $sql = 
        "SELECT ".
        "  USU.USUARIO_ID, " .
        "  USU.ATIVO, " .
        "  USU.EMPRESA_ID, " .
        "  USU.USUARIO_NOME, ". 
        "  USU.EMAIL, ". 
        "  USU.CPF, ".
        "  USU.RG, ".
        "  USU.CEP, ".
        "  USU.LOGRADOURO, ".
        "  USU.NUMERO, ".
        "  USU.COMPLEMENTO, ".
        "  USU.BAIRRO, ".
        "  USU.CIDADE, ".
        "  USU.UF, ".
        "  USU.TELEFONE, ".
        "  FUN.FUNCIONARIO_ID, ".
        "  CAR.CARGO_ID, ".
        "  CAR.PERMISSAO_ID, ".
        "  CAR.ADMIN, ".
        "  CAR.PROFESSOR, ".
        "  CAR.ATENDENTE, ".
        "  CAR.NOME AS NOME_CARGO, ".
        "  CAR.ATIVO AS CARGO_ATIVO, ".
        "  FUN.BANCO_ID, ".
        "  FUN.AGENCIA, ".
        "  FUN.NUMERO_CONTA, ".
        "  FUN.PIX, ".
        "  FUN.TIPO_PIX_ID, ".
        "  FUN.SENHA, ".
        "  TPG.TIPO_PAGAMENTO_ID, ".
        "  TPG.NOME AS NOME_PAGAMENTO, ".
        "  TPG.VALOR_SALARIO, ".
        "  TPG.VALOR_HORA, ".
        "  TPG.PERCENTUAL_INSS, ".
        "  TPG.ATIVO AS TIPO_PAG_ATIVO, ".
        "  BNC.NOME AS NOME_BANCO, ".
        "  BNC.BANCO_ID, ".
        "  BNC.NUMERO_BANCO ".

        "from USUARIOS USU ".

        "inner join FUNCIONARIOS FUN ".
        "on USU.USUARIO_ID = FUN.USUARIO_ID ".
        
        "inner join CARGOS CAR ".
        "on FUN.CARGO_ID = CAR.CARGO_ID ".
        
        "left join TIPO_PAGAMENTOS TPG ".
        "on FUN.TIPO_PAGAMENTO_ID = TPG.TIPO_PAGAMENTO_ID ".

        "left join BANCOS BNC ".
        "on FUN.BANCO_ID = BNC.BANCO_ID ".

        "where USU.EMAIL = ? ".
        "and USU.ATIVO = 1 ";

        $conexao = new Conexao();

        $parametros = array($email);

        $conexao->novaConexao();

        $resultados = $conexao->consulta($sql, $parametros);

        foreach($resultados as $resultado) {

            if(!password_verify($senha,  $resultado['SENHA'])){
                return null;
            }

            $funcionario = new Funcionario(
                $resultado['USUARIO_ID'],
                $resultado['ATIVO'],
                $resultado['EMPRESA_ID'],
                $resultado['USUARIO_NOME'],
                $resultado['EMAIL'],
                $resultado['CPF'],
                $resultado['RG'],
                $resultado['TELEFONE'],
                $resultado['CEP'], 
                $resultado['LOGRADOURO'], 
                $resultado['NUMERO'], 
                $resultado['COMPLEMENTO'], 
                $resultado['BAIRRO'], 
                $resultado['CIDADE'], 
                $resultado['UF'],
                $resultado['FUNCIONARIO_ID'],
                new Cargo(
                    $resultado['CARGO_ID'],
                    $resultado['EMPRESA_ID'],
                    $resultado['PERMISSAO_ID'],
                    $resultado['PROFESSOR'],
                    $resultado['ATENDENTE'],
                    $resultado['NOME_CARGO'],
                    $resultado['ADMIN'],
                    $resultado['CARGO_ATIVO']
                ),
                new Conta(
                    new Banco(
                        $resultado['BANCO_ID'],
                        $resultado['NUMERO_BANCO'],
                        $resultado['EMPRESA_ID'],
                        $resultado['NOME_BANCO'],
                        false,
                        true
                    ),
                    $resultado['AGENCIA'], 
                    $resultado['NUMERO_CONTA'],
                    true
                ),
                new Pix(
                    $resultado['PIX'],
                    $resultado['TIPO_PIX_ID']
                ),
                new Mensalista(
                    $resultado['TIPO_PAGAMENTO_ID'],
                    $resultado['NOME_PAGAMENTO'],
                    $resultado['EMPRESA_ID'],
                    $resultado['TIPO_PAG_ATIVO'],
                    $resultado['VALOR_SALARIO'],
                    $resultado['PERCENTUAL_INSS']
                ),
                new Horista(
                    $resultado['TIPO_PAGAMENTO_ID'],
                    $resultado['NOME_PAGAMENTO'],
                    $resultado['EMPRESA_ID'],
                    $resultado['TIPO_PAG_ATIVO'],
                    $resultado['VALOR_HORA']
                )

            );
        }

        return $funcionario;
    }

    
    public static function getAlunosEmpresa($empresaId, $filtrarAtivos=true){

        $sql =
        "SELECT ".
        "  USU.USUARIO_ID, " .
        "  USU.ATIVO, " .
        "  USU.EMPRESA_ID, " .
        "  USU.USUARIO_NOME, ". 
        "  USU.EMAIL, ". 
        "  USU.CPF, ".
        "  USU.RG, ".
        "  USU.CEP, ".
        "  USU.LOGRADOURO, ".
        "  USU.NUMERO, ".
        "  USU.COMPLEMENTO, ".
        "  USU.BAIRRO, ".
        "  USU.CIDADE, ".
        "  USU.UF, ".
        "  USU.TELEFONE, ".
        "  ALU.ALUNO_ID, ".
        "  ALU.MATRICULA ".

        "from USUARIOS USU ".

        "inner join ALUNOS ALU ".
        "on USU.USUARIO_ID = ALU.USUARIO_ID ".

        "where USU.EMPRESA_ID = ? ";
        
        if($filtrarAtivos){
            $sql .= "and USU.ATIVO = 1 ";
        }

        $conexao = new Conexao();

        $parametros = array($empresaId);

        $conexao->novaConexao();

        $resultados = $conexao->consulta($sql, $parametros);

        $alunos = [];

        foreach($resultados as $resultado) {
            $aluno = new Aluno(
                $resultado['USUARIO_ID'],
                $resultado['ATIVO'],
                $resultado['EMPRESA_ID'],
                $resultado['USUARIO_NOME'],
                $resultado['EMAIL'],
                $resultado['CPF'],
                $resultado['RG'],
                $resultado['TELEFONE'],
                $resultado['CEP'], 
                $resultado['LOGRADOURO'], 
                $resultado['NUMERO'], 
                $resultado['COMPLEMENTO'], 
                $resultado['BAIRRO'], 
                $resultado['CIDADE'], 
                $resultado['UF'],
                $resultado['ALUNO_ID'],
                $resultado['MATRICULA']

            );

            array_push($alunos, $aluno);
        }

        return $alunos;
    }
        

    
    public static function getFuncionariosEmpresa($empresaId, $filtrarAtivos=true){

        $sql = 
        "SELECT ".
        "  USU.USUARIO_ID, " .
        "  USU.ATIVO, " .
        "  USU.EMPRESA_ID, " .
        "  USU.USUARIO_NOME, ". 
        "  USU.EMAIL, ". 
        "  USU.CPF, ".
        "  USU.RG, ".
        "  USU.CEP, ".
        "  USU.LOGRADOURO, ".
        "  USU.NUMERO, ".
        "  USU.COMPLEMENTO, ".
        "  USU.BAIRRO, ".
        "  USU.CIDADE, ".
        "  USU.UF, ".
        "  USU.TELEFONE, ".
        "  FUN.FUNCIONARIO_ID, ".
        "  CAR.CARGO_ID, ".
        "  CAR.PERMISSAO_ID, ".
        "  CAR.ADMIN, ".
        "  CAR.PROFESSOR, ".
        "  CAR.ATENDENTE, ".
        "  CAR.NOME AS NOME_CARGO, ".
        "  CAR.ATIVO AS CARGO_ATIVO, ".
        "  FUN.BANCO_ID, ".
        "  FUN.AGENCIA, ".
        "  FUN.NUMERO_CONTA, ".
        "  FUN.PIX, ".
        "  FUN.TIPO_PIX_ID, ".
        "  TPG.TIPO_PAGAMENTO_ID, ".
        "  TPG.NOME AS NOME_PAGAMENTO, ".
        "  TPG.VALOR_SALARIO, ".
        "  TPG.VALOR_HORA, ".
        "  TPG.PERCENTUAL_INSS, ".
        "  TPG.ATIVO AS TIPO_PAG_ATIVO, ".
        "  BNC.NOME AS NOME_BANCO, ".
        "  BNC.BANCO_ID, ".
        "  BNC.NUMERO_BANCO ".

        "from USUARIOS USU ".

        "inner join FUNCIONARIOS FUN ".
        "on USU.USUARIO_ID = FUN.USUARIO_ID ".
        
        "inner join CARGOS CAR ".
        "on FUN.CARGO_ID = CAR.CARGO_ID ".
        
        "left join TIPO_PAGAMENTOS TPG ".
        "on FUN.TIPO_PAGAMENTO_ID = TPG.TIPO_PAGAMENTO_ID ".

        "left join BANCOS BNC ".
        "on FUN.BANCO_ID = BNC.BANCO_ID ".

        "where USU.EMPRESA_ID = ? ";
        
        if($filtrarAtivos){
            $sql .= "and USU.ATIVO = 1 ";
        }

        $conexao = new Conexao();

        $parametros = array($empresaId);

        $conexao->novaConexao();

        $resultados = $conexao->consulta($sql, $parametros);

        $funcionarios = [];

        foreach($resultados as $resultado) {

            $funcionario = new Funcionario(
                $resultado['USUARIO_ID'],
                $resultado['ATIVO'],
                $resultado['EMPRESA_ID'],
                $resultado['USUARIO_NOME'],
                $resultado['EMAIL'],
                $resultado['CPF'],
                $resultado['RG'],
                $resultado['TELEFONE'],
                $resultado['CEP'], 
                $resultado['LOGRADOURO'], 
                $resultado['NUMERO'], 
                $resultado['COMPLEMENTO'], 
                $resultado['BAIRRO'], 
                $resultado['CIDADE'], 
                $resultado['UF'],
                $resultado['FUNCIONARIO_ID'],
                new Cargo(
                    $resultado['CARGO_ID'],
                    $resultado['EMPRESA_ID'],
                    $resultado['PERMISSAO_ID'],
                    $resultado['PROFESSOR'],
                    $resultado['ATENDENTE'],
                    $resultado['NOME_CARGO'],
                    $resultado['ADMIN'],
                    $resultado['CARGO_ATIVO']
                ),
                new Conta(
                    new Banco(
                        $resultado['BANCO_ID'],
                        $resultado['NUMERO_BANCO'],
                        $resultado['EMPRESA_ID'],
                        $resultado['NOME_BANCO'],
                        false,
                        true
                    ),
                    $resultado['AGENCIA'], 
                    $resultado['NUMERO_CONTA'],
                    true
                ),
                new Pix(
                    $resultado['PIX'],
                    $resultado['TIPO_PIX_ID']
                ),
                new Mensalista(
                    $resultado['TIPO_PAGAMENTO_ID'],
                    $resultado['NOME_PAGAMENTO'],
                    $resultado['EMPRESA_ID'],
                    $resultado['TIPO_PAG_ATIVO'],
                    $resultado['VALOR_SALARIO'],
                    $resultado['PERCENTUAL_INSS']
                ),
                new Horista(
                    $resultado['TIPO_PAGAMENTO_ID'],
                    $resultado['NOME_PAGAMENTO'],
                    $resultado['EMPRESA_ID'],
                    $resultado['TIPO_PAG_ATIVO'],
                    $resultado['VALOR_HORA']
                )

            );

            array_push($funcionarios, $funcionario);
        }

        return $funcionarios;
    }
        
    public static function getFuncionarioPorId($funcionarioId){

        $sql =
        "SELECT ".
        "  USU.USUARIO_ID, " .
        "  USU.ATIVO, " .
        "  USU.EMPRESA_ID, " .
        "  USU.USUARIO_NOME, ". 
        "  USU.EMAIL, ". 
        "  USU.CPF, ".
        "  USU.RG, ".
        "  USU.CEP, ".
        "  USU.LOGRADOURO, ".
        "  USU.NUMERO, ".
        "  USU.COMPLEMENTO, ".
        "  USU.BAIRRO, ".
        "  USU.CIDADE, ".
        "  USU.UF, ".
        "  USU.TELEFONE, ".
        "  FUN.FUNCIONARIO_ID, ".
        "  CAR.CARGO_ID, ".
        "  CAR.PERMISSAO_ID, ".
        "  CAR.ADMIN, ".
        "  CAR.PROFESSOR, ".
        "  CAR.ATENDENTE, ".
        "  CAR.NOME AS NOME_CARGO, ".
        "  CAR.ATIVO AS CARGO_ATIVO, ".
        "  FUN.BANCO_ID, ".
        "  FUN.AGENCIA, ".
        "  FUN.NUMERO_CONTA, ".
        "  FUN.PIX, ".
        "  FUN.TIPO_PIX_ID, ".
        "  FUN.SENHA, ".
        "  TPG.TIPO_PAGAMENTO_ID, ".
        "  TPG.NOME AS NOME_PAGAMENTO, ".
        "  TPG.VALOR_SALARIO, ".
        "  TPG.VALOR_HORA, ".
        "  TPG.PERCENTUAL_INSS, ".
        "  TPG.ATIVO AS TIPO_PAG_ATIVO, ".
        "  BNC.NOME AS NOME_BANCO, ".
        "  BNC.BANCO_ID, ".
        "  BNC.NUMERO_BANCO ".

        "from USUARIOS USU ".

        "inner join FUNCIONARIOS FUN ".
        "on USU.USUARIO_ID = FUN.USUARIO_ID ".

        "inner join CARGOS CAR ". 
        "on FUN.CARGO_ID = CAR.CARGO_ID ".
        
        "left join TIPO_PAGAMENTOS TPG ".
        "on FUN.TIPO_PAGAMENTO_ID = TPG.TIPO_PAGAMENTO_ID ".

        "left join BANCOS BNC ".
        "on FUN.BANCO_ID = BNC.BANCO_ID ".

        "where FUN.FUNCIONARIO_ID = ? ";

        $conexao = new Conexao();

        $parametros = array($funcionarioId);

        $conexao->novaConexao();

        $resultados = $conexao->consulta($sql, $parametros);

        foreach($resultados as $resultado) {

            $funcionario = new Funcionario(
                $resultado['USUARIO_ID'],
                $resultado['ATIVO'],
                $resultado['EMPRESA_ID'],
                $resultado['USUARIO_NOME'],
                $resultado['EMAIL'],
                $resultado['CPF'],
                $resultado['RG'],
                $resultado['TELEFONE'],
                $resultado['CEP'], 
                $resultado['LOGRADOURO'], 
                $resultado['NUMERO'], 
                $resultado['COMPLEMENTO'], 
                $resultado['BAIRRO'], 
                $resultado['CIDADE'], 
                $resultado['UF'],
                $resultado['FUNCIONARIO_ID'],
                new Cargo(
                    $resultado['CARGO_ID'],
                    $resultado['EMPRESA_ID'],
                    $resultado['PERMISSAO_ID'],
                    $resultado['PROFESSOR'],
                    $resultado['ATENDENTE'],
                    $resultado['NOME_CARGO'],
                    $resultado['ADMIN'],
                    $resultado['CARGO_ATIVO']
                ),
                new Conta(
                    new Banco(
                        $resultado['BANCO_ID'],
                        $resultado['NUMERO_BANCO'],
                        $resultado['EMPRESA_ID'],
                        $resultado['NOME_BANCO'],
                        false,
                        true
                    ),
                    $resultado['AGENCIA'], 
                    $resultado['NUMERO_CONTA'],
                    true
                ),
                new Pix(
                    $resultado['PIX'],
                    $resultado['TIPO_PIX_ID']
                ),
                new Mensalista(
                    $resultado['TIPO_PAGAMENTO_ID'],
                    $resultado['NOME_PAGAMENTO'],
                    $resultado['EMPRESA_ID'],
                    $resultado['TIPO_PAG_ATIVO'],
                    $resultado['VALOR_SALARIO'],
                    $resultado['PERCENTUAL_INSS']
                ),
                new Horista(
                    $resultado['TIPO_PAGAMENTO_ID'],
                    $resultado['NOME_PAGAMENTO'],
                    $resultado['EMPRESA_ID'],
                    $resultado['TIPO_PAG_ATIVO'],
                    $resultado['VALOR_HORA']
                )

            );
        }

        return $funcionario;

    }

    public static function getAlunoPorId($alunoId){

        $sql =
        "SELECT ".
        "  USU.USUARIO_ID, " .
        "  USU.ATIVO, " .
        "  USU.EMPRESA_ID, " .
        "  USU.USUARIO_NOME, ". 
        "  USU.EMAIL, ". 
        "  USU.CPF, ".
        "  USU.RG, ".
        "  USU.CEP, ".
        "  USU.LOGRADOURO, ".
        "  USU.NUMERO, ".
        "  USU.COMPLEMENTO, ".
        "  USU.BAIRRO, ".
        "  USU.CIDADE, ".
        "  USU.UF, ".
        "  USU.TELEFONE, ".
        "  ALU.ALUNO_ID, ".
        "  ALU.MATRICULA ".

        "from USUARIOS USU ".

        "inner join ALUNOS ALU ".
        "on USU.USUARIO_ID = ALU.USUARIO_ID ".

        "where ALU.ALUNO_ID = ? ";

        $conexao = new Conexao();

        $parametros = array($alunoId);

        $conexao->novaConexao();

        $resultados = $conexao->consulta($sql, $parametros);

        foreach($resultados as $resultado) {

            $aluno = new Aluno(
                $resultado['USUARIO_ID'],
                $resultado['ATIVO'],
                $resultado['EMPRESA_ID'],
                $resultado['USUARIO_NOME'],
                $resultado['EMAIL'],
                $resultado['CPF'],
                $resultado['RG'],
                $resultado['TELEFONE'],
                $resultado['CEP'], 
                $resultado['LOGRADOURO'], 
                $resultado['NUMERO'], 
                $resultado['COMPLEMENTO'], 
                $resultado['BAIRRO'], 
                $resultado['CIDADE'], 
                $resultado['UF'],
                $resultado['ALUNO_ID'],
                $resultado['MATRICULA']

            );
        }

        return $aluno;

    }
    
        
    public static function insertUsuario(
        Conexao $conexao,
        $usuarioAltId, 
        $usuarioId, 
        $ativo, 
        $usuarioNome,
        $emailUsuario,
        $cpfUsuario,
        $rg,
        $telefoneUsuario,
        $empresaId,
        $cep,
        $logradouro,
        $numero,
        $complemento,
        $bairro,
        $cidade,
        $uf
        
    ) {
        $retorno = conferirNome($usuarioNome);

        if($retorno->houveErro){
            return $retorno;
        }

        if($usuarioId !== 0){

            $retorno = UsuarioBanco::updateUsuario(
                $conexao,
                $usuarioAltId,
                $usuarioId, 
                $usuarioNome, 
                $ativo, 
                $emailUsuario,
                $cpfUsuario,
                $rg,
                $telefoneUsuario,
                $cep,
                $logradouro,
                $numero,
                $complemento,
                $bairro,
                $cidade,
                $uf
            );

            return $retorno;

        }

        $sql =
            "INSERT INTO USUARIOS(" .
            "  EMPRESA_ID, " .
            "  USUARIO_NOME, " .
            "  EMAIL, " .
            "  CPF, " .
            "  RG,".
            "  CEP, ".
            "  LOGRADOURO, ".
            "  NUMERO, ".
            "  COMPLEMENTO, ".
            "  BAIRRO, ".
            "  CIDADE, ".
            "  UF, ".
            "  TELEFONE, " .
            "  USUARIO_CRIACAO_ID, ".
            "  USUARIO_ALTERACAO_ID) " .
            "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ";

        $parametros = array(
            $empresaId,
            $usuarioNome,
            $emailUsuario,
            $cpfUsuario,
            $rg,
            $cep,
            $logradouro,
            $numero,
            $complemento,
            $bairro,
            $cidade,
            $uf,
            $telefoneUsuario,
            $usuarioAltId,
            $usuarioAltId
        );

        $retorno = $conexao->insertUpdateExcluir($sql, $parametros);

        return $retorno;
    }

    public static function insertFuncionario(
        Conexao $conexao,
        $usuarioAltId,
        $usuarioId,
        $funcionarioId,
        $cargoId,
        $bancoId,
        $agencia,
        $numeroConta,
        $pix,
        $tipoPixId,
        $tipoPagamentoId,
        $senha,
        $repitaSenha
    ){

        if($funcionarioId != 0){
    
            $retorno = UsuarioBanco::updateFuncionario(
                $conexao,
                $usuarioAltId,
                $funcionarioId,
                $cargoId,
                $bancoId,
                $agencia,
                $numeroConta,
                $pix,
                $tipoPixId,
                $tipoPagamentoId,
                $senha,
                $repitaSenha
            );

            return $retorno;
        }

        $sql =
        "INSERT INTO FUNCIONARIOS(" .
        "  USUARIO_ID, " .
        "  CARGO_ID, " .
        "  BANCO_ID, " .
        "  AGENCIA, " .
        "  NUMERO_CONTA,".
        "  PIX, ".
        "  TIPO_PIX_ID, ".
        "  TIPO_PAGAMENTO_ID, ".
        "  USUARIO_CRIACAO_ID, ".
        "  USUARIO_ALTERACAO_ID, ".
        "  SENHA) ".
        "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ";

        $parametros = array(
            $usuarioId,
            $cargoId,
            $bancoId,
            $agencia,
            $numeroConta,
            $pix,
            $tipoPixId,
            $tipoPagamentoId,
            $usuarioAltId,
            $usuarioAltId,
            password_hash($senha, PASSWORD_DEFAULT)
        );

        $retorno = $conexao->insertUpdateExcluir($sql, $parametros, true);

        return $retorno;
    }

    public static function insertAluno(
        Conexao $conexao,
        $usuarioAltId,
        $usuarioId,
        $alunoId,
        $matricula
    ){

        if($alunoId != 0){
    
            $retorno = UsuarioBanco::updateAluno(
                $conexao,
                $usuarioAltId,
                $alunoId,
                $matricula
            );

            return $retorno;
        }

        $sql =
        "INSERT INTO ALUNOS(" .
        "  USUARIO_ID, " .
        "  ALUNO_ID, " .
        "  MATRICULA, " .
        "  USUARIO_CRIACAO_ID, ".
        "  USUARIO_ALTERACAO_ID) ".
        "VALUES (?, ?, ?, ?, ?) ";

        $parametros = array(
            $usuarioId,
            $alunoId,
            $matricula,
            $usuarioAltId,
            $usuarioAltId
        );

        $retorno = $conexao->insertUpdateExcluir($sql, $parametros, true);

        return $retorno;
    }

        

        
    private static function updateUsuario(
        $conexao,
        $usuarioAltId,
        $usuarioUpdateId,
        $usuarioNome, 
        $ativo, 
        $emailUsuario,
        $cpfUsuario,
        $rg,
        $telefoneUsuario,
        $cep,
        $logradouro,
        $numero,
        $complemento,
        $bairro,
        $cidade,
        $uf

    ) {
        $retorno = new RetornoSql();

        $retorno = conferirNome($usuarioNome);

        if ($retorno->houveErro) {
            return $retorno;
        }

        $sql =
            "UPDATE USUARIOS SET " .
            "  USUARIO_NOME = ?, " .
            "  ATIVO = ?, " .
            "  EMAIL = ?, " .
            "  CPF = ?, " .
            "  RG = ?, " .
            "  CEP = ?, " .
            "  LOGRADOURO = ?, " .
            "  NUMERO = ?, " .
            "  COMPLEMENTO = ?, " .
            "  BAIRRO = ?, " .
            "  CIDADE = ?, " .
            "  UF = ?, " .
            "  USUARIO_ALTERACAO_ID = ?, " .
            "  TELEFONE = ? " .
            "WHERE USUARIO_ID = ?";

        $parametros = array(
            $usuarioNome,
            $ativo,
            $emailUsuario,
            $cpfUsuario,
            $rg,
            $cep,
            $logradouro,
            $numero,
            $complemento,
            $bairro,
            $cidade,
            $uf,
            $usuarioAltId,
            $telefoneUsuario,
            $usuarioUpdateId
        );

        $retorno = $conexao->insertUpdateExcluir($sql, $parametros, true);
        
        return $retorno;
    }

    
    private static function updateFuncionario(
        $conexao,
        $usuarioAltId,
        $funcionarioId,
        $cargoId,
        $bancoId,
        $agencia,
        $numeroConta,
        $pix,
        $tipoPixId,
        $tipoPagamentoId,
        $senha,
        $repitaSenha

    ) {
        $retorno = new RetornoSql();

        if($senha != null && $repitaSenha != null){
            $retorno = conferirErros($senha, $repitaSenha);
        }

        if ($retorno->houveErro) {
            $conexao->reverter();
            return $retorno;
        }

        $sql =
            "UPDATE FUNCIONARIOS SET " .
            "  CARGO_ID = ?, " .
            "  BANCO_ID = ?, " .
            "  AGENCIA = ?, " .
            "  NUMERO_CONTA = ?, " .
            "  PIX = ?, " .
            "  USUARIO_ALTERACAO_ID = ?, " .
            "  TIPO_PIX_ID = ?, ";

        $parametros = array(
            $cargoId,
            $bancoId,
            $agencia,
            $numeroConta,
            $pix,
            $usuarioAltId,
            $tipoPixId
        );

        if($senha != null){
            $sql .= "  SENHA = ?, " ;
            array_push($parametros, $senha);
        }

        $sql .= 
        "  TIPO_PAGAMENTO_ID = ? ".
        "WHERE FUNCIONARIO_ID = ?";
        
        array_push($parametros, $tipoPagamentoId);
        array_push($parametros, $funcionarioId);
        
        $retorno = $conexao->insertUpdateExcluir($sql, $parametros);
        
        return $retorno;
    }
    
    private static function updateAluno(
        $conexao,
        $usuarioAltId,
        $alunoId,
        $matricula

    ) {

        $sql =
            "UPDATE ALUNOS SET " .
            "  MATRICULA = ?, " .
            "  USUARIO_ALTERACAO_ID = ? " .
            "WHERE ALUNO_ID = ?";
        
        $parametros = array($matricula, $usuarioAltId, $alunoId);
        
        $retorno = $conexao->insertUpdateExcluir($sql, $parametros);
        
        return $retorno;
    }


}

?>