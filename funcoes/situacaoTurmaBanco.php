<?

class SituacaoTurmaBanco{
    
    public static function getSituacaoTurmas($empresaId, $filtrarAtivos=true){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  SITUACAO_TURMA_ID, " .
            "  EMPRESA_ID, " .
            "  ATIVO, " .
            "  NOME ".

            "FROM SITUACAO_TURMAS " .

            "WHERE EMPRESA_ID = ? ";
        if($filtrarAtivos){
            $sql.="AND ATIVO = 1 ";
        }

        array_push($parametros, $empresaId);
    
        $resultados = $conexao->consulta($sql, $parametros);
    
        $situacoes = [];
    
        foreach ($resultados as $resultado) {

            $situacao =  new SituacaoTurma(
                $resultado['SITUACAO_TURMA_ID'],
                $resultado['EMPRESA_ID'],
                $resultado['NOME'],
                $resultado['ATIVO']
            );
    
            array_push($situacoes, $situacao);
        }
    
        return $situacoes;
    }

    public static function insertSituacaoTurma($empresaId, $usuarioId, $situacaoTurmaId, $nome, $ativo){

        if($situacaoTurmaId !== 0){
            return SituacaoTurmaBanco::updateSituacaoTurma($usuarioId, $situacaoTurmaId, $nome, $ativo);
        }
        else{

            $conexao = new Conexao();

            $conexao->novaConexaoPDO();
            $conexao->iniciarTranscacao();

            $sql =
            "INSERT INTO SITUACAO_TURMAS(" .
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

    private static function updateSituacaoTurma($usuarioId, $situacaoTurmaId, $nome, $ativo){
        $conexao = new Conexao();

        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();

        $sql =
        "UPDATE SITUACAO_TURMAS SET " .
        "  NOME = ?, " .
        "  ATIVO = ?, " .
        "  USUARIO_ALTERACAO_ID = ? " .
        "WHERE SITUACAO_TURMA_ID = ? ";

        $parametros = array(
            $nome,
            $ativo,
            $usuarioId,
            $situacaoTurmaId
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