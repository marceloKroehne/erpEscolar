<?

class TurmaBanco{

    public static function getTurmas($empresaId, $filtrarAtivos=true){

        
        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();

        $sql = 
            "SELECT " .
            "  TUR.TURMA_ID, " .
            "  TUR.NOME AS TURMA_NOME, " .
            "  TUR.EMPRESA_ID, " .
            "  TUR.ATIVO AS TURMA_ATIVO, " .
            "  MDL.MODALIDADE_ID, " .
            "  MDL.NOME AS MODALIDADE_NOME, " .
            "  MDL.ATIVO AS MODALIDADE_ATIVO, " .
            "  TUR.DATA_INICIO, " .
            "  TUR.DATA_FIM, " .
            "  TUR.CURSO_ID, " .
            "  SIT.SITUACAO_TURMA_ID, " .
            "  SIT.NOME AS SITUACAO_NOME, " .
            "  SIT.ATIVO AS SITUACAO_ATIVO, " .
            "  TUR.PROFESSOR_ID, " .
            "  TRN.TURNO_ID, " .
            "  TRN.NOME AS TURNO_NOME, " .
            "  TRN.ATIVO AS TURNO_ATIVO, " .
            "  SAL.SALA_ID, " .
            "  SAL.NOME AS SALA_NOME, " .
            "  SAL.ATIVO AS SALA_ATIVO, " .
            "  TUR.MAX_ALUNOS, " .
            "  TUR.MIN_ALUNOS, " .
            "  TUR.META_ALUNOS " .
            
            "FROM TURMAS TUR " .
            
            "INNER JOIN MODALIDADES MDL ".
            "ON TUR.MODALIDADE_ID = MDL.MODALIDADE_ID " .
            
            "INNER JOIN SITUACAO_TURMAS SIT ".
            "ON TUR.SITUACAO_TURMA_ID = SIT.SITUACAO_TURMA_ID " .
            
            "INNER JOIN TURNOS TRN ".
            "ON TUR.TURNO_ID = TRN.TURNO_ID " .
            
            "INNER JOIN SALAS SAL ".
            "ON TUR.SALA_ID = SAL.SALA_ID " .
            
            "WHERE TUR.EMPRESA_ID = ? ";

        if($filtrarAtivos){
            $sql.="AND TUR.ATIVO = 1 ";
        }

        array_push($parametros, $empresaId);

        $resultados = $conexao->consulta($sql, $parametros);
    
        $turmas = [];
    
        foreach ($resultados as $resultado) {

            $curso = CursoBanco::getCursoPorId($resultado['CURSO_ID']);

            $professor = UsuarioBanco::getFuncionarioPorId($resultado['PROFESSOR_ID']);

            $turma = new Turma(
                $resultado['TURMA_ID'],
                $resultado['TURMA_NOME'],
                $resultado['EMPRESA_ID'],
                $resultado['TURMA_ATIVO'],
                DateTime::createFromFormat('Y-m-d', $resultado['DATA_INICIO'])->format('d/m/Y'),
                DateTime::createFromFormat('Y-m-d', $resultado['DATA_FIM'])->format('d/m/Y'),
                $curso,
                new Sala(
                    $resultado['SALA_ID'],
                    $resultado['EMPRESA_ID'],
                    $resultado['SALA_NOME'],
                    $resultado['SALA_ATIVO']
                ),
                new Turno(
                    $resultado['TURNO_ID'],
                    $resultado['EMPRESA_ID'],
                    $resultado['TURNO_NOME'],
                    $resultado['TURNO_ATIVO']
                ),
                $professor,
                new Modalidade(
                    $resultado['MODALIDADE_ID'],
                    $resultado['EMPRESA_ID'],
                    $resultado['MODALIDADE_NOME'],
                    $resultado['MODALIDADE_ATIVO']
                ),
                new SituacaoTurma(
                    $resultado['SITUACAO_TURMA_ID'],
                    $resultado['EMPRESA_ID'],
                    $resultado['SITUACAO_NOME'],
                    $resultado['SITUACAO_ATIVO']
                ),
                $resultado['MAX_ALUNOS'],
                $resultado['MIN_ALUNOS'],
                $resultado['META_ALUNOS']
            );

            array_push($turmas, $turma);

        }
        
        return $turmas;

    }

    public static function getTurmaPorId($turmaId){

        
        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();

        $sql = 
            "SELECT " .
            "  TUR.TURMA_ID, " .
            "  TUR.NOME AS TURMA_NOME, " .
            "  TUR.EMPRESA_ID, " .
            "  TUR.ATIVO AS TURMA_ATIVO, " .
            "  MDL.MODALIDADE_ID, " .
            "  MDL.NOME AS MODALIDADE_NOME, " .
            "  MDL.ATIVO AS MODALIDADE_ATIVO, " .
            "  TUR.DATA_INICIO, " .
            "  TUR.DATA_FIM, " .
            "  TUR.CURSO_ID, " .
            "  SIT.SITUACAO_TURMA_ID, " .
            "  SIT.NOME AS SITUACAO_NOME, " .
            "  SIT.ATIVO AS SITUACAO_ATIVO, " .
            "  TUR.PROFESSOR_ID, " .
            "  TRN.TURNO_ID, " .
            "  TRN.NOME AS TURNO_NOME, " .
            "  TRN.ATIVO AS TURNO_ATIVO, " .
            "  SAL.SALA_ID, " .
            "  SAL.NOME AS SALA_NOME, " .
            "  SAL.ATIVO AS SALA_ATIVO, " .
            "  TUR.MAX_ALUNOS, " .
            "  TUR.MIN_ALUNOS, " .
            "  TUR.META_ALUNOS " .
            
            "FROM TURMAS TUR " .
            
            "INNER JOIN MODALIDADES MDL ".
            "ON TUR.MODALIDADE_ID = MDL.MODALIDADE_ID " .
            
            "INNER JOIN SITUACAO_TURMAS SIT ".
            "ON TUR.SITUACAO_TURMA_ID = SIT.SITUACAO_TURMA_ID " .
            
            "INNER JOIN TURNOS TRN ".
            "ON TUR.TURNO_ID = TRN.TURNO_ID " .
            
            "INNER JOIN SALAS SAL ".
            "ON TUR.SALA_ID = SAL.SALA_ID " .
            
            "WHERE TUR.TURMA_ID = ? ";

        array_push($parametros, $turmaId);

        $resultados = $conexao->consulta($sql, $parametros);
    
        foreach ($resultados as $resultado) {

            $curso = CursoBanco::getCursoPorId($resultado['CURSO_ID']);

            $professor = UsuarioBanco::getFuncionarioPorId($resultado['PROFESSOR_ID']);

            $turma = new Turma(
                $resultado['TURMA_ID'],
                $resultado['TURMA_NOME'],
                $resultado['EMPRESA_ID'],
                $resultado['TURMA_ATIVO'],
                DateTime::createFromFormat('Y-m-d', $resultado['DATA_INICIO'])->format('d/m/Y'),
                DateTime::createFromFormat('Y-m-d', $resultado['DATA_FIM'])->format('d/m/Y'),
                $curso,
                new Sala(
                    $resultado['SALA_ID'],
                    $resultado['EMPRESA_ID'],
                    $resultado['SALA_NOME'],
                    $resultado['SALA_ATIVO']
                ),
                new Turno(
                    $resultado['TURNO_ID'],
                    $resultado['EMPRESA_ID'],
                    $resultado['TURNO_NOME'],
                    $resultado['TURNO_ATIVO']
                ),
                $professor,
                new Modalidade(
                    $resultado['MODALIDADE_ID'],
                    $resultado['EMPRESA_ID'],
                    $resultado['MODALIDADE_NOME'],
                    $resultado['MODALIDADE_ATIVO']
                ),
                new SituacaoTurma(
                    $resultado['SITUACAO_TURMA_ID'],
                    $resultado['EMPRESA_ID'],
                    $resultado['SITUACAO_NOME'],
                    $resultado['SITUACAO_ATIVO']
                ),
                $resultado['MAX_ALUNOS'],
                $resultado['MIN_ALUNOS'],
                $resultado['META_ALUNOS']
            );

        }
        
        return $turma;

    }

    public static function insertTurma(
        $empresaId,   
        $usuarioId, 
        $turmaId, 
        $nome, 
        $ativo, 
        $modalidadeId, 
        $dataInicio, 
        $dataFim, 
        $cursoId, 
        $situacaoTurmaId, 
        $professorId, 
        $turnoId, 
        $salaId, 
        $maxAlunos, 
        $minAlunos, 
        $metaAlunos
    ){

        if($turmaId !== 0){
            return TurmaBanco::updateTurma(
                $usuarioId, 
                $turmaId, 
                $nome, 
                $ativo, 
                $modalidadeId, 
                $dataInicio, 
                $dataFim, 
                $cursoId, 
                $situacaoTurmaId, 
                $professorId, 
                $turnoId, 
                $salaId, 
                $maxAlunos, 
                $minAlunos, 
                $metaAlunos
            );
        }
        else{

            $conexao = new Conexao();

            $conexao->novaConexaoPDO();
            $conexao->iniciarTranscacao();

            $sql =
            "INSERT INTO TURMAS(" .
            "  EMPRESA_ID, " .
            "  NOME, " .
            "  ATIVO, " .
            "  MODALIDADE_ID, " .
            "  DATA_INICIO, " .
            "  DATA_FIM, " .
            "  CURSO_ID, " .
            "  SITUACAO_TURMA_ID, " .
            "  PROFESSOR_ID, " .
            "  TURNO_ID, " .
            "  SALA_ID, " .
            "  MIN_ALUNOS, " .
            "  META_ALUNOS, " .
            "  MAX_ALUNOS, " .
            "  USUARIO_CRIACAO_ID, " .
            "  USUARIO_ALTERACAO_ID) " .
            "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ";

            $parametros = array(
                $empresaId,
                $nome, 
                $ativo, 
                $modalidadeId, 
                DateTime::createFromFormat('d/m/Y', $dataInicio)->format('Y-m-d'), 
                DateTime::createFromFormat('d/m/Y', $dataFim)->format('Y-m-d'), 
                $cursoId, 
                $situacaoTurmaId, 
                $professorId, 
                $turnoId, 
                $salaId, 
                $maxAlunos, 
                $minAlunos, 
                $metaAlunos,
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

    private static function updateTurma(
        $usuarioId, 
        $turmaId, 
        $nome, 
        $ativo, 
        $modalidadeId, 
        $dataInicio, 
        $dataFim, 
        $cursoId, 
        $situacaoTurmaId, 
        $professorId, 
        $turnoId, 
        $salaId, 
        $maxAlunos, 
        $minAlunos, 
        $metaAlunos
    ){
        $conexao = new Conexao();

        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();

        $sql =
            "UPDATE TURMAS SET " .
            "  NOME = ?, " .
            "  ATIVO = ?, " .
            "  MODALIDADE_ID = ?, " .
            "  DATA_INICIO = ?, " .
            "  DATA_FIM = ?, " .
            "  CURSO_ID = ?, " .
            "  SITUACAO_TURMA_ID = ?, " .
            "  PROFESSOR_ID = ?, " .
            "  TURNO_ID = ?, " .
            "  SALA_ID = ?, " .
            "  MAX_ALUNOS = ?, " .
            "  MIN_ALUNOS = ?, " .
            "  META_ALUNOS = ?, " .
            "  USUARIO_ALTERACAO_ID = ? " .
            "WHERE TURMA_ID = ? ";

        $parametros = array(
            $nome, 
            $ativo, 
            $modalidadeId, 
            DateTime::createFromFormat('d/m/Y', $dataInicio)->format('Y-m-d'), 
            DateTime::createFromFormat('d/m/Y', $dataFim)->format('Y-m-d'), 
            $cursoId, 
            $situacaoTurmaId, 
            $professorId, 
            $turnoId, 
            $salaId, 
            $maxAlunos, 
            $minAlunos, 
            $metaAlunos,
            $usuarioId, 
            $turmaId
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