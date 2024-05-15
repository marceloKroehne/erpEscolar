<?

class TipoContratoBanco{
    
    public static function getTipoContratos($empresaId, $filtrarAtivos=true){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  TIPO_CONTRATO_ID, " .
            "  EMPRESA_ID, " .
            "  ATIVO, " .
            "  NOME ".

            "FROM TIPOS_CONTRATOS " .

            "WHERE EMPRESA_ID = ? ";
        if($filtrarAtivos){
            $sql.="AND ATIVO = 1 ";
        }

        array_push($parametros, $empresaId);
    
        $resultados = $conexao->consulta($sql, $parametros);
    
        $contratos = [];
    
        foreach ($resultados as $resultado) {

            $contrato =  new TipoContrato(
                $resultado['TIPO_CONTRATO_ID'],
                $resultado['EMPRESA_ID'],
                $resultado['NOME'],
                $resultado['ATIVO']
            );
    
            array_push($contratos, $contrato);
        }
    
        return $contrato;
    }

    public static function insertTipoContrato($empresaId, $usuarioId, $tipoContratoId, $nome, $ativo){

        if($tipoContratoId !== 0){
            return TipoContratoBanco::updateTipoContrato($usuarioId, $tipoContratoId, $nome, $ativo);
        }
        else{

            $conexao = new Conexao();

            $conexao->novaConexaoPDO();
            $conexao->iniciarTranscacao();

            $sql =
            "INSERT INTO TIPOS_CONTRATOS(" .
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

    private static function updateTipoContrato($usuarioId, $tipoContratoId, $nome, $ativo){
        $conexao = new Conexao();

        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();
        
        $sql =
        "UPDATE TIPOS_CURSOS SET " .
        "  NOME = ?, " .
        "  ATIVO = ?, " .
        "  USUARIO_ALTERACAO_ID = ? " .
        "WHERE TIPO_CONTRATO_ID = ? ";

        $parametros = array(
            $nome,
            $ativo,
            $usuarioId,
            $tipoContratoId
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