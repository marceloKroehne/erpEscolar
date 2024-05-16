<?

class SituacaoContratoBanco{
    
    public static function getSituacaoContratos($empresaId, $filtrarAtivos=true){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  SITUACAO_CONTRATO_ID, " .
            "  EMPRESA_ID, " .
            "  ATIVO, " .
            "  NOME ".

            "FROM SITUACAO_CONTRATOS " .

            "WHERE EMPRESA_ID = ? ";
        if($filtrarAtivos){
            $sql.="AND ATIVO = 1 ";
        }

        array_push($parametros, $empresaId);
    
        $resultados = $conexao->consulta($sql, $parametros);
    
        $situacoes = [];
    
        foreach ($resultados as $resultado) {

            $situacao =  new SituacaoContrato(
                $resultado['SITUACAO_CONTRATO_ID'],
                $resultado['EMPRESA_ID'],
                $resultado['NOME'],
                $resultado['ATIVO']
            );
    
            array_push($situacoes, $situacao);
        }
    
        return $situacoes;
    }

    public static function insertSituacaoContrato($empresaId, $usuarioId, $situacaoContratoId, $nome, $ativo){

        if($situacaoContratoId !== 0){
            return SituacaoContratoBanco::updateSituacaoContrato($usuarioId, $situacaoContratoId, $nome, $ativo);
        }
        else{

            $conexao = new Conexao();

            $conexao->novaConexaoPDO();
            $conexao->iniciarTranscacao();

            $sql =
            "INSERT INTO SITUACAO_CONTRATOS(" .
            "  EMPRESA_ID, " .
            "  NOME, " .
            "  USUARIO_CRIACAO_ID, " .
            "  USUARIO_ALTERACAO_ID) " .
            "VALUES (?, ?, ?, ?) ";

            $parametros = array(
                $empresaId,
                $nome,
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

    private static function updateSituacaoContrato($usuarioId, $situacaoContratoId, $nome, $ativo){
        $conexao = new Conexao();

        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();

        $sql =
        "UPDATE SITUACAO_CONTRATOS SET " .
        "  NOME = ?, " .
        "  ATIVO = ?, " .
        "  USUARIO_ALTERACAO_ID = ? " .
        "WHERE SITUACAO_CONTRATO_ID = ? ";

        $parametros = array(
            $nome,
            $ativo,
            $usuarioId,
            $situacaoContratoId
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