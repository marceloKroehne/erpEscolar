<?

class DisciplinaBanco{
    
    public static function getDisciplinas($empresaId, $filtrarAtivos=true){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  DISCIPLINA_ID, " .
            "  EMPRESA_ID, " .
            "  ATIVO, " .
            "  NOME ".

            "FROM DISCIPLINAS " .

            "WHERE EMPRESA_ID = ? ";
        if($filtrarAtivos){
            $sql.="AND ATIVO = 1 ";
        }

        array_push($parametros, $empresaId);
    
        $resultados = $conexao->consulta($sql, $parametros);
    
        $disciplinas = [];
    
        foreach ($resultados as $resultado) {

            $disciplina =  new Disciplina(
                $resultado['DISCIPLINA_ID'],
                $resultado['EMPRESA_ID'],
                $resultado['NOME'],
                $resultado['ATIVO']
            );
    
            array_push($disciplinas, $disciplina);
        }
    
        return $disciplinas;
    }

    public static function insertDisciplina($empresaId, $usuarioId, $disciplinaId, $nome, $ativo){

        if($disciplinaId !== 0){
            return DisciplinaBanco::updateDisciplina($usuarioId, $disciplinaId, $nome, $ativo);
        }
        else{

            $conexao = new Conexao();

            $conexao->novaConexaoPDO();
            $conexao->iniciarTranscacao();

            $sql =
            "INSERT INTO DISCIPLINAS(" .
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

    private static function updateDisciplina($usuarioId, $disciplinaId, $nome, $ativo){
        $conexao = new Conexao();

        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();

        $sql =
        "UPDATE DISCIPLINAS SET " .
        "  NOME = ?, " .
        "  ATIVO = ?, " .
        "  USUARIO_ALTERACAO_ID = ? " .
        "WHERE DISCIPLINA_ID = ? ";

        $parametros = array(
            $nome,
            $ativo,
            $usuarioId,
            $disciplinaId
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