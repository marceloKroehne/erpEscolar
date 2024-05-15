<?

class BancoBanco{
    
    public static function getBancos($empresaId, $filtrarAtivos=true){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  BANCO_ID, " .
            "  EMPRESA_ID, " .
            "  NUMERO_BANCO, " .
            "  NOME, ".
            "  ATIVO, ".
            "  EXIGE_OFX " .

            "FROM BANCOS " .

            "WHERE EMPRESA_ID = ? ";
            
        if($filtrarAtivos){
            $sql .= "AND ATIVO = 1";
        }

        array_push($parametros, $empresaId);
    
        $resultados = $conexao->consulta($sql, $parametros);
    
        $bancos = [];
    
        foreach ($resultados as $resultado) {

            $banco =  new Banco(
                $resultado['BANCO_ID'],
                $resultado['NUMERO_BANCO'],
                $resultado['EMPRESA_ID'],
                $resultado['NOME'],
                $resultado['EXIGE_OFX'],
                $resultado['ATIVO']
            );
    
            array_push($bancos, $banco);
        }
    
        return $bancos;
    }

    public static function insertBanco($empresaId, $usuarioId, $bancoId, $numeroBanco, $nome, $exigeOfx, $ativo){

        if($bancoId !== 0){
            return BancoBanco::updateBanco($usuarioId, $bancoId, $numeroBanco, $nome, $exigeOfx, $ativo);
        }
        else{

            $conexao = new Conexao();

            $conexao->novaConexaoPDO();
            $conexao->iniciarTranscacao();

            $sql =
            "INSERT INTO BANCOS(" .
            "  NUMERO_BANCO, " .
            "  EMPRESA_ID, " .
            "  NOME, " .
            "  EXIGE_OFX, " .
            "  USUARIO_CRIACAO_ID, " .
            "  USUARIO_ALTERACAO_ID) " .
            "VALUES (?, ?, ?, ?, ?, ?) ";

            $parametros = array(
                $numeroBanco,
                $empresaId,
                $nome,
                $exigeOfx,
                $usuarioId,
                $usuarioId
            );

            $retorno = $conexao->insertUpdateExcluir($sql, $parametros);

            if ($retorno->houveErro) {
                return $retorno;
            }

            $conexao->fecharConexao();

            return $retorno;
        }
    }

    private static function updateBanco($usuarioId, $bancoId, $numeroBanco, $nome, $exigeOfx, $ativo){
        $conexao = new Conexao();

        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();

        $sql =
        "UPDATE BANCOS SET " .
        "  NUMERO_BANCO = ?, " .
        "  NOME = ?, " .
        "  EXIGE_OFX = ?, " .
        "  ATIVO = ?, " .
        "  USUARIO_ALTERACAO_ID = ? " .
        "WHERE BANCO_ID = ? ";

        $parametros = array(
            $numeroBanco,
            $nome,
            $exigeOfx,
            $ativo,
            $usuarioId,
            $bancoId
        );

        $retorno = $conexao->insertUpdateExcluir($sql, $parametros);

        if ($retorno->houveErro) {
            return $retorno;
        }

        $conexao->fecharConexao();

        return $retorno;
    }
}

?>