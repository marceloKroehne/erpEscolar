<?

class GruposContasBanco{

    public static function getGrupos($empresaId, $filtrarAtivos=true){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  EMPRESA_ID, " .
            "  GRUPO_CONTA_ID, " .
            "  ATIVO, " .
            "  RECEBIMENTO_VENDAS, " .
            "  NOME ".

            "FROM GRUPOS_CONTAS " .

            "WHERE EMPRESA_ID = ? ";

        if($filtrarAtivos){
            $sql .= "AND ATIVO = 1";
        }

        array_push($parametros, $empresaId);
    
        $resultados = $conexao->consulta($sql, $parametros);
    
        $grupos = [];
    
        foreach ($resultados as $resultado) {

            $grupo =  new GrupoContas(
                $resultado['GRUPO_CONTA_ID'],
                $resultado['EMPRESA_ID'],
                $resultado['NOME'],
                $resultado['ATIVO'],
                $resultado['RECEBIMENTO_VENDAS']
            );
    
            array_push($grupos, $grupo);
        }
    
        return $grupos;
    }

    public static function insertGrupoConta($empresaId, $usuarioId, $grupoId, $nome, $ativo, $recebVenda){

        if($grupoId !== 0){
            return GruposContasBanco::updateGrupoConta($usuarioId, $grupoId, $nome, $ativo, $recebVenda);
        }
        else{

            $conexao = new Conexao();

            $conexao->novaConexaoPDO();
            $conexao->iniciarTranscacao();

            $sql =
            "INSERT INTO GRUPOS_CONTAS(" .
            "  EMPRESA_ID, " .
            "  NOME, " .
            "  RECEBIMENTO_VENDAS, " .
            "  USUARIO_CRIACAO_ID, " .
            "  USUARIO_ALTERACAO_ID) " .
            "VALUES (?, ?, ?, ?, ?) ";

            $parametros = array(
                $empresaId,
                $nome,
                $recebVenda,
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

    private static function updateGrupoConta($usuarioId, $grupoId, $nome, $ativo, $recebVenda){
        $conexao = new Conexao();

        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();

        $sql =
        "UPDATE GRUPOS_CONTAS SET " .
        "  NOME = ?, " .
        "  ATIVO = ?, " .
        "  RECEBIMENTO_VENDAS = ?, " .
        "  USUARIO_ALTERACAO_ID = ? " .
        "WHERE GRUPO_CONTA_ID = ? ";

        $parametros = array(
            $nome,
            $ativo,
            $recebVenda,
            $usuarioId,
            $grupoId
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