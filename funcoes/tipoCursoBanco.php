<?

class TipoCursoBanco{
    
    public static function getTipoCursos($empresaId, $filtrarAtivos=true){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  TIPO_CURSO_ID, " .
            "  EMPRESA_ID, " .
            "  ATIVO, " .
            "  NOME ".

            "FROM TIPO_CURSOS " .

            "WHERE EMPRESA_ID = ? ";
        if($filtrarAtivos){
            $sql.="AND ATIVO = 1 ";
        }

        array_push($parametros, $empresaId);
    
        $resultados = $conexao->consulta($sql, $parametros);
    
        $cursos = [];
    
        foreach ($resultados as $resultado) {

            $curso =  new TipoCurso(
                $resultado['TIPO_CURSO_ID'],
                $resultado['EMPRESA_ID'],
                $resultado['NOME'],
                $resultado['ATIVO']
            );
    
            array_push($cursos, $curso);
        }
    
        return $cursos;
    }

    public static function insertTipoCurso($empresaId, $usuarioId, $tipoCursoId, $nome, $ativo){

        if($tipoCursoId !== 0){
            return TipoCursoBanco::updateTipoCurso($usuarioId, $tipoCursoId, $nome, $ativo);
        }
        else{

            $conexao = new Conexao();

            $conexao->novaConexaoPDO();
            $conexao->iniciarTranscacao();

            $sql =
            "INSERT INTO TIPO_CURSOS(" .
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

    private static function updateTipoCurso($usuarioId, $tipoCursoId, $nome, $ativo){
        $conexao = new Conexao();

        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();

        $sql =
        "UPDATE TIPO_CURSOS SET " .
        "  NOME = ?, " .
        "  ATIVO = ?, " .
        "  USUARIO_ALTERACAO_ID = ? " .
        "WHERE TIPO_CURSO_ID = ? ";

        $parametros = array(
            $nome,
            $ativo,
            $usuarioId,
            $tipoCursoId
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