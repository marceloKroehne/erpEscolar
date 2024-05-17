<?

class PlanoCursoBanco{
    
    public static function getPlanoCursos($empresaId, $filtrarAtivos=true){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  PLANO_CURSO_ID, " .
            "  CURSO_ID, " .
            "  EMPRESA_ID, " .
            "  ATIVO, " .
            "  NUMERO_PARCELAS, " .
            "  VALOR_PARCELA, " .
            "  VALOR_TOTAL, " .
            "  NECESSITA_AUT_SUP, " .
            "  NOME ".

            "FROM PLANOS_CURSOS " .

            "WHERE EMPRESA_ID = ? ";
        if($filtrarAtivos){
            $sql.="AND ATIVO = 1 ";
        }

        array_push($parametros, $empresaId);
    
        $resultados = $conexao->consulta($sql, $parametros);
    
        $planos = [];
    
        foreach ($resultados as $resultado) {

            $curso = CursoBanco::getCursoPorId($resultado['CURSO_ID']);

            $plano =  new PlanoCurso(
                $resultado['PLANO_CURSO_ID'],
                $curso,
                $resultado['EMPRESA_ID'],
                $resultado['NOME'],
                $resultado['ATIVO'],
                $resultado['NECESSITA_AUT_SUP'],
                $resultado['NUMERO_PARCELAS'],
                $resultado['VALOR_PARCELA'],
                $resultado['VALOR_TOTAL']
            );
    
            array_push($planos, $plano);
        }
    
        return $planos;
    }

    public static function getPlanoCursoPorId($planoId){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  PLANO_CURSO_ID, " .
            "  CURSO_ID, " .
            "  EMPRESA_ID, " .
            "  ATIVO, " .
            "  NUMERO_PARCELAS, " .
            "  VALOR_PARCELA, " .
            "  VALOR_TOTAL, " .
            "  NECESSITA_AUT_SUP, " .
            "  NOME ".

            "FROM PLANOS_CURSOS " .

            "WHERE PLANO_CURSO_ID = ? ";

        array_push($parametros, $planoId);
    
        $resultados = $conexao->consulta($sql, $parametros);

    
        foreach ($resultados as $resultado) {

            $curso = CursoBanco::getCursoPorId($resultado['CURSO_ID']);

            $plano =  new PlanoCurso(
                $resultado['PLANO_CURSO_ID'],
                $curso,
                $resultado['EMPRESA_ID'],
                $resultado['NOME'],
                $resultado['ATIVO'],
                $resultado['NECESSITA_AUT_SUP'],
                $resultado['NUMERO_PARCELAS'],
                $resultado['VALOR_PARCELA'],
                $resultado['VALOR_TOTAL']
            );
    
        }
    
        return $plano;
    }

    public static function getPlanosCursosPorCursoId($cursoId){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  PLANO_CURSO_ID, " .
            "  CURSO_ID, " .
            "  EMPRESA_ID, " .
            "  ATIVO, " .
            "  NUMERO_PARCELAS, " .
            "  VALOR_PARCELA, " .
            "  VALOR_TOTAL, " .
            "  NECESSITA_AUT_SUP, " .
            "  NOME ".

            "FROM PLANOS_CURSOS " .

            "WHERE CURSO_ID = ? ".
            "AND ATIVO = 1 ";

        array_push($parametros, $cursoId);
    
        $resultados = $conexao->consulta($sql, $parametros);

        $planos = [];
    
        foreach ($resultados as $resultado) {

            $curso = CursoBanco::getCursoPorId($resultado['CURSO_ID']);

            $plano =  new PlanoCurso(
                $resultado['PLANO_CURSO_ID'],
                $curso,
                $resultado['EMPRESA_ID'],
                $resultado['NOME'],
                $resultado['ATIVO'],
                $resultado['NECESSITA_AUT_SUP'],
                $resultado['NUMERO_PARCELAS'],
                $resultado['VALOR_PARCELA'],
                $resultado['VALOR_TOTAL']
            );

            array_push($planos, $plano);
    
        }
    
        return $planos;
    }

    public static function insertPlanoCurso(
        $empresaId, 
        $usuarioId, 
        $planoCursoId, 
        $cursoId,
        $nome, 
        $ativo,
        $autSup,
        $numeroParcelas,
        $valorParcela,
        $valorTotal    
    ){

        $valorSb = str_replace('.', '',$valorParcela);
        $valorSb = str_replace(',', '.',$valorSb);
        
        $valorDecParc =  floatval($valorSb);

        $valorSbTot = str_replace('.', '',$valorTotal);
        $valorSbTot = str_replace(',', '.',$valorSbTot);
        
        $valorDecTot =  floatval($valorSbTot);

        if($planoCursoId !== 0){
            return PlanoCursoBanco::updatePlanoCurso(
                $usuarioId, 
                $planoCursoId, 
                $cursoId,
                $nome, 
                $ativo,
                $autSup,
                $numeroParcelas,
                $valorDecParc,
                $valorDecTot  
            );
        }
        else{

            $conexao = new Conexao();

            $conexao->novaConexaoPDO();
            $conexao->iniciarTranscacao();

            $sql =
            "INSERT INTO PLANOS_CURSOS(" .
            "  EMPRESA_ID, " .
            "  NOME, " .
            "  CURSO_ID, " .
            "  NECESSITA_AUT_SUP, " .
            "  NUMERO_PARCELAS, " .
            "  VALOR_PARCELA, " .
            "  VALOR_TOTAL, " .
            "  USUARIO_CRIACAO_ID, " .
            "  USUARIO_ALTERACAO_ID) " .
            "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) ";

            $parametros = array(
                $empresaId,
                $nome, 
                $cursoId,
                $autSup,
                $numeroParcelas,
                $valorDecParc,
                $valorDecTot,
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

    private static function updatePlanoCurso(
        $usuarioId, 
        $planoCursoId, 
        $cursoId,
        $nome, 
        $ativo,
        $autSup,
        $numeroParcelas,
        $valorDecParc,
        $valorDecTot  
    ){
        $conexao = new Conexao();

        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();

        $sql =
        "UPDATE PLANOS_CURSOS SET " .
        "  CURSO_ID = ?, " .
        "  NOME = ?, " .
        "  ATIVO = ?, " .
        "  NUMERO_PARCELAS = ?, " .
        "  VALOR_PARCELA = ?, " .
        "  VALOR_TOTAL = ?, " .
        "  NECESSITA_AUT_SUP = ?, " .
        "  USUARIO_ALTERACAO_ID = ? " .
        "WHERE PLANO_CURSO_ID = ? ";

        $parametros = array(
            $cursoId,
            $nome,
            $ativo,
            $numeroParcelas,
            $valorDecParc,
            $valorDecTot,
            $autSup,
            $usuarioId,
            $planoCursoId
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