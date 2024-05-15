<?

class EmpresaBanco{

    public static function insertEmpresa(
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
        $usuarioEmail,
        $usuarioCpf,
        $rgUsuario,
        $cepUsuario,
        $logradouroUsuario,
        $numeroUsuario,
        $complementoUsuario,
        $bairroUsuario,
        $cidadeUsuario,
        $ufUsuario,
        $usuarioTelefone,
        $senha
        
    ){
        $senha = password_hash($senha, PASSWORD_DEFAULT);
        
        $retorno = new RetornoSql();

        $conexao = new Conexao();
        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();

        $params = array(
            $nomeRazaoSocial,
            $empresaEmail,
            $empresaCpfCnpj,
            $cep,
            $logradouro,
            $numero,
            $complemento,
            $bairro,
            $cidade,
            $uf,
            $empresaTelefone,
            $usuarioNome,
            $usuarioEmail,
            $usuarioCpf,
            $rgUsuario,
            $cepUsuario,
            $logradouroUsuario,
            $numeroUsuario,
            $complementoUsuario,
            $bairroUsuario,
            $cidadeUsuario,
            $ufUsuario,
            $usuarioTelefone,
            $senha
        );

        $retorno = $conexao->executarProcedure("INSER_NOVA_EMP", $params);

        if ($retorno->houveErro) {
            return $retorno;
        }

        $conexao->fecharConexao();

        return $retorno;
    }


    public static function updateEmpresa(
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
    ) {

        $conexao = new Conexao();
        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();

        $retorno = new RetornoSql();

        $sql =
            "UPDATE EMPRESAS SET " .
            "  NOME_RAZAO_SOCIAL = ?, " .
            "  EMAIL = ?, " .
            "  CPF_CNPJ = ?, " .
            "  CEP = ?, " .
            "  LOGRADOURO = ?, " .
            "  NUMERO = ?, " .
            "  COMPLEMENTO = ?, " .
            "  BAIRRO = ?, " .
            "  CIDADE = ?, " .
            "  UF = ?, " .
            "  TELEFONE = ? " .
            "WHERE EMPRESA_ID = ?";

        $parametros = array(
            $nomeRazaoSocial,
            $empresaEmail,
            $empresaCpfCnpj,
            $cep,
            $logradouro,
            $numero,
            $complemento,
            $bairro,
            $cidade,
            $uf,
            $empresaTelefone,
            $empresaId
        );

        $retorno = $conexao->insertUpdateExcluir($sql, $parametros);

        if ($retorno->houveErro) {
            return $retorno;
        }

        $conexao->fecharConexao();

        return $retorno;

    }

    public static function excluirEmpresa($empresaId) {
        $retorno = new RetornoSql();

        $conexao = new Conexao();
        $sql = "DELETE FROM EMPRESAS WHERE EMPRESA_ID = ?";

        $parametros = array($empresaId);

        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();
        
        $retorno = $conexao->insertUpdateExcluir($sql, $parametros);

        if ($retorno->houveErro) {
            return $retorno;
        }
        
        $conexao->fecharConexao();

        return $retorno;
    }

    public static function getEmpresa($usuarioId){

        $conexao = new Conexao();
        $conexao->novaConexao();

        $sql =  
            "SELECT ".
            "	EMP.EMPRESA_ID, ".
            "	EMP.NOME_RAZAO_SOCIAL, ".
            "	EMP.EMAIL, ".
            "	EMP.CPF_CNPJ, ".
            "	EMP.CEP, ".
            "	EMP.LOGRADOURO, ".
            "	EMP.NUMERO, ".
            "	EMP.COMPLEMENTO, ".
            "	EMP.BAIRRO, ".
            "	EMP.CIDADE, ".
            "	EMP.UF, ".
            "	EMP.TELEFONE ".
            "from EMPRESAS EMP ".

            "inner join USUARIOS USU ".
            "on EMP.EMPRESA_ID = USU.EMPRESA_ID ".

            "where USU.USUARIO_ID = ? ";

        $parametros = array($usuarioId);

        $resultados = $conexao->consulta($sql, $parametros);

        foreach($resultados as $resultado){
            $empresa = new Empresa(
                $resultado['EMPRESA_ID'], 
                $resultado['NOME_RAZAO_SOCIAL'], 
                $resultado['EMAIL'], 
                $resultado['CPF_CNPJ'], 
                $resultado['CEP'], 
                $resultado['LOGRADOURO'], 
                $resultado['NUMERO'], 
                $resultado['COMPLEMENTO'], 
                $resultado['BAIRRO'], 
                $resultado['CIDADE'], 
                $resultado['UF'], 
                $resultado['TELEFONE']
            );
        }

        return $empresa;
    }

}

?>