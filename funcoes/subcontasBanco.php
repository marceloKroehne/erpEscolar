<?

class SubcontasBanco{

    public static function insertSubconta($usuarioId, $subContaId, $grupoContaId, $nome, $tipo, $ativo){

        if($subContaId !== 0){
            return SubcontasBanco::updateSubconta($usuarioId, $subContaId, $grupoContaId, $nome, $tipo, $ativo);
        }
        else{

            $conexao = new Conexao();

            $conexao->novaConexaoPDO();
            $conexao->iniciarTranscacao();

            $sql =
            "INSERT INTO SUBCONTAS(" .
            "  GRUPO_CONTA_ID, ".
            "  TIPO, ".
            "  NOME, " .
            "  USUARIO_CRIACAO_ID, " .
            "  USUARIO_ALTERACAO_ID) " .
            "VALUES (?, ?, ?, ?, ?) ";

            $parametros = array(
                $grupoContaId,
                $tipo,
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



    public static function getSubcontas($empresaId, $filtrarAtivos=true){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  SUB.SUBCONTA_ID, " .
            "  SUB.GRUPO_CONTA_ID, " .
            "  SUB.TIPO, " .
            "  SUB.NOME AS NOME_SUBCONTA, ".
            "  SUB.ATIVO AS SUBCONTA_ATIVO, ".
            "  GRP.EMPRESA_ID, " .
            "  GRP.ATIVO AS GRUPO_ATIVO, " .
            "  GRP.RECEBIMENTO_VENDAS, " .
            "  GRP.NOME AS NOME_GRUPO_CONTA " .

            "FROM SUBCONTAS SUB " .

            "INNER JOIN GRUPOS_CONTAS GRP ".
            "ON SUB.GRUPO_CONTA_ID = GRP.GRUPO_CONTA_ID ".

            "WHERE GRP.EMPRESA_ID = ? ";

        if($filtrarAtivos){
            $sql.="AND SUB.ATIVO = 1 ";
        }
        
        $sql.="ORDER BY GRP.GRUPO_CONTA_ID ";

        array_push($parametros, $empresaId);
    
        $resultados = $conexao->consulta($sql, $parametros);
    
        $subcontas = [];
    
        foreach ($resultados as $resultado) {

            $subconta =  new Subconta(
                $resultado['SUBCONTA_ID'],
                new GrupoContas(
                    $resultado['GRUPO_CONTA_ID'],
                    $resultado['EMPRESA_ID'],
                    $resultado['NOME_GRUPO_CONTA'],
                    $resultado['GRUPO_ATIVO'],
                    $resultado['RECEBIMENTO_VENDAS']
                ),
                $resultado['TIPO'],
                $resultado['NOME_SUBCONTA'],
                $resultado['SUBCONTA_ATIVO']
            );
    
            array_push($subcontas, $subconta);
        }
    
        return $subcontas;
    }

    public static function getSubcontaPorId($subcontaId){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  SUB.SUBCONTA_ID, " .
            "  SUB.GRUPO_CONTA_ID, " .
            "  SUB.TIPO, " .
            "  SUB.NOME AS NOME_SUBCONTA, ".
            "  SUB.ATIVO AS SUBCONTA_ATIVO, ".
            "  GRP.EMPRESA_ID, " .
            "  GRP.ATIVO AS GRUPO_ATIVO, " .
            "  GRP.RECEBIMENTO_VENDAS, " .
            "  GRP.NOME AS NOME_GRUPO_CONTA " .

            "FROM SUBCONTAS SUB " .

            "INNER JOIN GRUPOS_CONTAS GRP ".
            "ON SUB.GRUPO_CONTA_ID = GRP.GRUPO_CONTA_ID ".

            "WHERE SUB.SUBCONTA_ID = ? ";

        array_push($parametros, $subcontaId);
    
        $resultados = $conexao->consulta($sql, $parametros);
    
        foreach ($resultados as $resultado) {

            $subconta =  new Subconta(
                $resultado['SUBCONTA_ID'],
                new GrupoContas(
                    $resultado['GRUPO_CONTA_ID'],
                    $resultado['EMPRESA_ID'],
                    $resultado['NOME_GRUPO_CONTA'],
                    $resultado['GRUPO_ATIVO'],
                    $resultado['RECEBIMENTO_VENDAS']
                ),
                $resultado['TIPO'],
                $resultado['NOME_SUBCONTA'],
                $resultado['SUBCONTA_ATIVO']
            );
    
        }
    
        return $subconta;
    }


    private static function updateSubconta($usuarioId, $subcontaId, $grupoContaId, $nome, $tipo, $ativo){
        $conexao = new Conexao();

        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();

        $sql =
        "UPDATE SUBCONTAS SET " .
        "  GRUPO_CONTA_ID = ?, " .
        "  TIPO = ?, " .
        "  NOME = ?, " .
        "  ATIVO = ?, ".
        "  USUARIO_ALTERACAO_ID = ? " .
        "WHERE SUBCONTA_ID = ? ";

        $parametros = array(
            $grupoContaId,
            $tipo,
            $nome,
            $ativo,
            $usuarioId,
            $subcontaId
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