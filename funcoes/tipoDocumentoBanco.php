<?

class TipoDocumentoBanco{
    
    public static function getTiposDocumentos($empresaId, $filtrarAtivos=true){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  TIPO_DOCUMENTO_ID, " .
            "  EMPRESA_ID, " .
            "  ATIVO, " .
            "  NOME ".

            "FROM TIPO_DOCUMENTOS " .

            "WHERE EMPRESA_ID = ? ";
        if($filtrarAtivos){
            $sql.="AND ATIVO = 1 ";
        }

        array_push($parametros, $empresaId);
    
        $resultados = $conexao->consulta($sql, $parametros);
    
        $tiposDocumentos = [];
    
        foreach ($resultados as $resultado) {

            $tipoDocumento =  new TipoDocumento(
                $resultado['TIPO_DOCUMENTO_ID'],
                $resultado['EMPRESA_ID'],
                $resultado['NOME'],
                $resultado['ATIVO']
            );
    
            array_push($tiposDocumentos, $tipoDocumento);
        }
    
        return $tiposDocumentos;
    }

    public static function insertTipoDocumento($empresaId, $usuarioId, $tipoDocumentoId, $nome, $ativo){

        if($tipoDocumentoId !== 0){
            return TipoDocumentoBanco::updateTipoDocumento($usuarioId, $tipoDocumentoId, $nome, $ativo);
        }
        else{

            $conexao = new Conexao();

            $conexao->novaConexaoPDO();
            $conexao->iniciarTranscacao();

            $sql =
            "INSERT INTO TIPO_DOCUMENTOS(" .
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

    private static function updateTipoDocumento($usuarioId, $tipoDocumentoId, $nome, $ativo){
        $conexao = new Conexao();

        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();

        $sql =
        "UPDATE TIPO_DOCUMENTOS SET " .
        "  NOME = ?, " .
        "  ATIVO = ?, " .
        "  USUARIO_ALTERACAO_ID = ? " .
        "WHERE TIPO_DOCUMENTO_ID = ? ";

        $parametros = array(
            $nome,
            $ativo,
            $usuarioId,
            $tipoDocumentoId
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