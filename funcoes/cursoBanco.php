<?

class CursoBanco{
    
    public static function getCursos($empresaId, $filtrarAtivos=true){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT ".
            "  CUR.CURSO_ID, ".
            "  CUR.NOME AS CURSO_NOME, ".
            "  CUR.EMPRESA_ID, ".
            "  CUR.VALOR, ".
            "  CUR.NUMERO_AULAS, ".
            "  CUR.CARGA_HORARIA, ".
            "  CUR.COORDENADOR_ID, ".
            "  CUR.ATIVO AS CURSO_ATIVO, ".
            "  TIP.TIPO_CURSO_ID, ".
            "  TIP.NOME AS TIPO_CURSO_NOME, ".
            "  TIP.ATIVO AS TIPO_CURSO_ATIVO, ".
            "  MTZ.MATRIZ_CURRICULAR_ID, ".
            "  MTZ.NOME AS MATRIZ_NOME, ".
            "  MTZ.ATIVO AS MATRIZ_ATIVO ".
            
            "FROM CURSOS CUR ".
            
            "INNER JOIN TIPO_CURSOS TIP ".
            "ON CUR.TIPO_CURSO_ID = TIP.TIPO_CURSO_ID ".
           
            "INNER JOIN MATRIZES_CURRICULARES MTZ ".
            "ON CUR.MATRIZ_CURRICULAR_ID = MTZ.MATRIZ_CURRICULAR_ID ".

            "WHERE CUR.EMPRESA_ID = ? ";
        if($filtrarAtivos){
            $sql.="AND CUR.ATIVO = 1 ";
        }

        array_push($parametros, $empresaId);
    
        $resultados = $conexao->consulta($sql, $parametros);
    
        $cursos = [];
    
        foreach ($resultados as $resultado) {

            $disciplinas = MatrizCurricularBanco::buscarDisciplinasMatriz($resultado['MATRIZ_CURRICULAR_ID']);

            $matriz =  new MatrizCurricular(
                $resultado['MATRIZ_CURRICULAR_ID'],
                $resultado['EMPRESA_ID'],
                $resultado['MATRIZ_NOME'],
                $resultado['MATRIZ_ATIVO'],
                $disciplinas 
            );

            $coordenador = UsuarioBanco::getFuncionarioPorId($resultado['COORDENADOR_ID']);
            
            $bolsas = CursoBanco::buscarBolsasCurso($resultado['CURSO_ID']);

            $curso = new Curso(
                $resultado['CURSO_ID'],
                $resultado['EMPRESA_ID'],
                $resultado['CURSO_NOME'],
                $resultado['CURSO_ATIVO'],
                $bolsas,
                $resultado['VALOR'],
                $coordenador,
                $matriz,
                new TipoCurso(
                    $resultado['TIPO_CURSO_ID'],
                    $resultado['EMPRESA_ID'],
                    $resultado['TIPO_CURSO_NOME'],
                    $resultado['TIPO_CURSO_ATIVO']
                ),
                $resultado['NUMERO_AULAS'],
                $resultado['CARGA_HORARIA']
            );
    
            array_push($cursos, $curso);
        }
    
        return $cursos;
    }

    public static function getCursoPorId($cursoId){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT ".
            "  CUR.CURSO_ID, ".
            "  CUR.NOME AS CURSO_NOME, ".
            "  CUR.EMPRESA_ID, ".
            "  CUR.VALOR, ".
            "  CUR.NUMERO_AULAS, ".
            "  CUR.CARGA_HORARIA, ".
            "  CUR.COORDENADOR_ID, ".
            "  CUR.ATIVO AS CURSO_ATIVO, ".
            "  TIP.TIPO_CURSO_ID, ".
            "  TIP.NOME AS TIPO_CURSO_NOME, ".
            "  TIP.ATIVO AS TIPO_CURSO_ATIVO, ".
            "  MTZ.MATRIZ_CURRICULAR_ID, ".
            "  MTZ.NOME AS MATRIZ_NOME, ".
            "  MTZ.ATIVO AS MATRIZ_ATIVO ".
            
            "FROM CURSOS CUR ".
            
            "INNER JOIN TIPO_CURSOS TIP ".
            "ON CUR.TIPO_CURSO_ID = TIP.TIPO_CURSO_ID ".
           
            "INNER JOIN MATRIZES_CURRICULARES MTZ ".
            "ON CUR.MATRIZ_CURRICULAR_ID = MTZ.MATRIZ_CURRICULAR_ID ".

            "WHERE CUR.CURSO_ID = ? ";

        array_push($parametros, $cursoId);
    
        $resultados = $conexao->consulta($sql, $parametros);
    
    
        foreach ($resultados as $resultado) {

            $disciplinas = MatrizCurricularBanco::buscarDisciplinasMatriz($resultado['MATRIZ_CURRICULAR_ID']);

            $matriz =  new MatrizCurricular(
                $resultado['MATRIZ_CURRICULAR_ID'],
                $resultado['EMPRESA_ID'],
                $resultado['MATRIZ_NOME'],
                $resultado['MATRIZ_ATIVO'],
                $disciplinas 
            );

            $coordenador = UsuarioBanco::getFuncionarioPorId($resultado['COORDENADOR_ID']);
            
            $bolsas = CursoBanco::buscarBolsasCurso($resultado['CURSO_ID']);

            $curso = new Curso(
                $resultado['CURSO_ID'],
                $resultado['EMPRESA_ID'],
                $resultado['CURSO_NOME'],
                $resultado['CURSO_ATIVO'],
                $bolsas,
                $resultado['VALOR'],
                $coordenador,
                $matriz,
                new TipoCurso(
                    $resultado['TIPO_CURSO_ID'],
                    $resultado['EMPRESA_ID'],
                    $resultado['TIPO_CURSO_NOME'],
                    $resultado['TIPO_CURSO_ATIVO']
                ),
                $resultado['NUMERO_AULAS'],
                $resultado['CARGA_HORARIA']
            );
    
        }
    
        return $curso;
    }
    private static function buscarBolsasCurso($cursoId){
        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    

        $sql =
        "SELECT " .
        "  BOL.BOLSA_ID, " .
        "  BOL.EMPRESA_ID, " .
        "  BOL.ATIVO, " .
        "  BOL.PERCENTUAL_DESCONTO, " .
        "  BOL.NECESSITA_AUT_SUP, " .
        "  BOL.NOME ".

        "FROM bolsas_cursos CBL " .

        "INNER JOIN BOLSAS BOL ".
        "ON CBL.BOLSA_ID = BOL.BOLSA_ID ".

        "INNER JOIN CURSOS CUR ".
        "ON CBL.CURSO_ID = CUR.CURSO_ID ".

        "WHERE CBL.CURSO_ID = ? ";

        array_push($parametros, $cursoId);
    
        $resultados = $conexao->consulta($sql, $parametros);
    
        $bolsas = [];
    
        foreach ($resultados as $resultado) {

            $bolsa =  new Bolsa(
                $resultado['BOLSA_ID'],
                $resultado['EMPRESA_ID'],
                $resultado['NOME'],
                $resultado['ATIVO'],
                $resultado['PERCENTUAL_DESCONTO'],
                $resultado['NECESSITA_AUT_SUP']
            );
    
            array_push($bolsas, $bolsa->toJson());
        }
    
        return $bolsas;
    }

    public static function insertCurso(
        $empresaId, 
        $usuarioId,
        $cursoId,
        $bolsasIds, 
        $nome, 
        $ativo, 
        $valor, 
        $coordenadorId, 
        $matrizId, 
        $tipoCursoId, 
        $numeroAulas, 
        $cargaHoraria
    ){

     
        $valorSb = str_replace('.', '',$valor);
        $valorSb = str_replace(',', '.',$valorSb);
        
        $valorDec =  floatval($valorSb);

        if($cursoId !== 0){
            return CursoBanco::updateCurso(        
                $usuarioId,
                $cursoId,
                $bolsasIds, 
                $nome, 
                $ativo, 
                $valorDec, 
                $coordenadorId, 
                $matrizId, 
                $tipoCursoId, 
                $numeroAulas, 
                $cargaHoraria
            );
        }
        else{

            $conexao = new Conexao();

            $conexao->novaConexaoPDO();
            $conexao->iniciarTranscacao();

            $sql =
            "INSERT INTO CURSOS(" .
            "  EMPRESA_ID, " .
            "  NOME, " .
            "  VALOR, " .
            "  COORDENADOR_ID, " .
            "  MATRIZ_CURRICULAR_ID, " .
            "  TIPO_CURSO_ID, " .
            "  NUMERO_AULAS, " .
            "  CARGA_HORARIA, " .
            "  USUARIO_CRIACAO_ID, " .
            "  USUARIO_ALTERACAO_ID) " .
            "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ";

            $parametros = array(
                $empresaId,
                $nome,
                $valorDec, 
                $coordenadorId, 
                $matrizId, 
                $tipoCursoId, 
                $numeroAulas,
                $cargaHoraria,
                $usuarioId,
                $usuarioId
            );

            $retorno = $conexao->insertUpdateExcluir($sql, $parametros, true);

            if ($retorno->houveErro) {
                return $retorno;
            }

            $cursoId = intVal($retorno->dados);

            $sql = "DELETE FROM bolsas_cursos WHERE CURSO_ID = ? ";

            $parametros = array(
                $cursoId
            );
    
            $retorno = $conexao->insertUpdateExcluir($sql, $parametros);
    
            
            if ($retorno->houveErro) {
                return $retorno;
            }

            foreach($bolsasIds as $bolsaId){

                $sql =
                "INSERT INTO bolsas_cursos(" .
                "  CURSO_ID, " .
                "  BOLSA_ID) " .
                "VALUES (?, ?) ";
    
                $parametros = array(
                    $cursoId,
                    $bolsaId
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

    private static function updateCurso(  
        $usuarioId,
        $cursoId,
        $bolsasIds, 
        $nome, 
        $ativo, 
        $valor, 
        $coordenadorId, 
        $matrizId, 
        $tipoCursoId, 
        $numeroAulas, 
        $cargaHoraria
    ){
        $conexao = new Conexao();

        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();

        $sql =
        "UPDATE CURSOS SET " .
        "  NOME = ?, " .
        "  ATIVO = ?, " .
        "  VALOR = ?, " .
        "  COORDENADOR_ID = ?, " .
        "  MATRIZ_CURRICULAR_ID = ?, " .
        "  TIPO_CURSO_ID = ?, " .
        "  NUMERO_AULAS = ?, " .
        "  CARGA_HORARIA = ?, " .
        "  USUARIO_ALTERACAO_ID = ? " .
        "WHERE CURSO_ID = ? ";

        $parametros = array(
            $nome,
            $ativo,
            $valor, 
            $coordenadorId, 
            $matrizId, 
            $tipoCursoId, 
            $numeroAulas, 
            $cargaHoraria,
            $usuarioId,
            $cursoId
        );

        $retorno = $conexao->insertUpdateExcluir($sql, $parametros, true);

        if ($retorno->houveErro) {
            return $retorno;
        }

        $sql = "DELETE FROM bolsas_cursos WHERE CURSO_ID = ? ";

        $parametros = array(
            $cursoId
        );

        $retorno = $conexao->insertUpdateExcluir($sql, $parametros);

        
        if ($retorno->houveErro) {
            return $retorno;
        }

        foreach($bolsasIds as $bolsaId){

            $sql =
            "INSERT INTO bolsas_cursos(" .
            "  CURSO_ID, " .
            "  BOLSA_ID) " .
            "VALUES (?, ?) ";

            $parametros = array(
                $cursoId,
                $bolsaId
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