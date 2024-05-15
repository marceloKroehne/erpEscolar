<?

class MatrizCurricularBanco{
    
    public static function getMatrizes($empresaId, $filtrarAtivos=true){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  MATRIZ_CURRICULAR_ID, " .
            "  EMPRESA_ID, " .
            "  ATIVO, " .
            "  NOME ".

            "FROM MATRIZES_CURRICULARES " .

            "WHERE EMPRESA_ID = ? ";
        if($filtrarAtivos){
            $sql.="AND ATIVO = 1 ";
        }

        array_push($parametros, $empresaId);
    
        $resultados = $conexao->consulta($sql, $parametros);
    
        $matrizes = [];
    
        foreach ($resultados as $resultado) {

            $disciplinas = MatrizCurricularBanco::buscarDisciplinasMatriz($resultado['MATRIZ_CURRICULAR_ID']);

            $matriz =  new MatrizCurricular(
                $resultado['MATRIZ_CURRICULAR_ID'],
                $resultado['EMPRESA_ID'],
                $resultado['NOME'],
                $resultado['ATIVO'],
                $disciplinas 
            );
    
            array_push($matrizes, $matriz);
        }
    
        return $matrizes;
    }
    public static function buscarDisciplinasMatriz($matrizId){
        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    

        $sql =
        "SELECT " .
        "  DIS.DISCIPLINA_ID, " .
        "  DIS.EMPRESA_ID, " .
        "  DIS.ATIVO, " .
        "  DIS.NOME ".

        "FROM MATRIZES_DISCIPLINAS MTD " .

        "INNER JOIN DISCIPLINAS DIS ".
        "ON MTD.DISCIPLINA_ID = DIS.DISCIPLINA_ID ".

        "INNER JOIN MATRIZES_CURRICULARES MTZ ".
        "ON MTD.MATRIZ_CURRICULAR_ID = MTZ.MATRIZ_CURRICULAR_ID ".

        "WHERE MTZ.MATRIZ_CURRICULAR_ID = ? ";

        array_push($parametros, $matrizId);
    
        $resultados = $conexao->consulta($sql, $parametros);
    
        $disciplinas = [];
    
        foreach ($resultados as $resultado) {

            $disciplina =  new Disciplina(
                $resultado['DISCIPLINA_ID'],
                $resultado['EMPRESA_ID'],
                $resultado['NOME'],
                $resultado['ATIVO']
            );
    
            array_push($disciplinas, $disciplina->toJson());
        }
    
        return $disciplinas;
    }

    public static function insertMatriz($empresaId, $usuarioId, $matrizId, $disciplinasIds, $nome, $ativo){

        if($matrizId !== 0){
            return MatrizCurricularBanco::updateMatriz($usuarioId, $matrizId, $disciplinasIds, $nome, $ativo);
        }
        else{

            $conexao = new Conexao();

            $conexao->novaConexaoPDO();
            $conexao->iniciarTranscacao();

            $sql =
            "INSERT INTO MATRIZES_CURRICULARES(" .
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

            $matrizCurricularId = intVal($retorno->dados);

            $sql = "DELETE FROM MATRIZES_DISCIPLINAS WHERE MATRIZ_CURRICULAR_ID = ? ";

            $parametros = array(
                $matrizId
            );
    
            $retorno = $conexao->insertUpdateExcluir($sql, $parametros);
    
            
            if ($retorno->houveErro) {
                return $retorno;
            }

            foreach($disciplinasIds as $disciplinaId){

                $sql =
                "INSERT INTO MATRIZES_DISCIPLINAS(" .
                "  MATRIZ_CURRICULAR_ID, " .
                "  DISCIPLINA_ID) " .
                "VALUES (?, ?) ";
    
                $parametros = array(
                    $matrizCurricularId,
                    $disciplinaId
                );

                $retorno = $conexao->insertUpdateExcluir($sql, $parametros, true);

                if ($retorno->houveErro) {
                    return $retorno;
                }
            }

            $conexao->fecharConexao();

            return $retorno;
        }
    }

    private static function updateMatriz($usuarioId, $matrizId, $disciplinasIds, $nome, $ativo){
        $conexao = new Conexao();

        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();

        $sql =
        "UPDATE MATRIZES_CURRICULARES SET " .
        "  NOME = ?, " .
        "  ATIVO = ?, " .
        "  USUARIO_ALTERACAO_ID = ? " .
        "WHERE MATRIZ_CURRICULAR_ID = ? ";

        $parametros = array(
            $nome,
            $ativo,
            $usuarioId,
            $matrizId
        );

        $retorno = $conexao->insertUpdateExcluir($sql, $parametros);

        if ($retorno->houveErro) {
            return $retorno;
        }

        $sql = "DELETE FROM MATRIZES_DISCIPLINAS WHERE MATRIZ_CURRICULAR_ID = ? ";

        $parametros = array(
            $matrizId
        );

        $retorno = $conexao->insertUpdateExcluir($sql, $parametros);

        
        if ($retorno->houveErro) {
            return $retorno;
        }

        foreach($disciplinasIds as $disciplinaId){

            $sql =
            "INSERT INTO MATRIZES_DISCIPLINAS(" .
            "  MATRIZ_CURRICULAR_ID, " .
            "  DISCIPLINA_ID) " .
            "VALUES (?, ?) ";

            $parametros = array(
                $matrizId,
                $disciplinaId
            );

            $retorno = $conexao->insertUpdateExcluir($sql, $parametros);

            if ($retorno->houveErro) {
                return $retorno;
            }
        }

        $conexao->fecharConexao();

        return $retorno;
    }
}

?>