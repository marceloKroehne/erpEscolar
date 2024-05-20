<?

class ContratoBanco{
    
    public static function getContratos($empresaId){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  CON.CONTRATO_ID, " .
            "  CON.EMPRESA_ID, " .
            "  CON.TURMA_ID, " .
            "  CON.ALUNO_ID, " .
            "  CON.VENDEDOR_ID, ".
            "  CON.BOLSA_ID, ".
            "  SIT.SITUACAO_CONTRATO_ID, " .
            "  SIT.NOME AS SITUACAO_NOME, " .
            "  SIT.ATIVO AS SITUACAO_ATIVO, " .
            "  TIP.TIPO_CONTRATO_ID, " .
            "  TIP.NOME AS TIPO_CONTRATO_NOME, " .
            "  TIP.ATIVO AS TIPO_CONTRATO_ATIVO, " .
            "  CON.PLANO_CURSO_ID, " .
            "  PLN.NOME AS PLANOS_CURSOS_NOME, " .
            "  PLN.ATIVO AS PLANOS_CURSOS_ATIVO, " .
            "  PLN.NUMERO_PARCELAS, " .
            "  PLN.VALOR_PARCELA, " .
            "  PLN.VALOR_TOTAL, " .
            "  PLN.NECESSITA_AUT_SUP, " .
            "  CON.DATA_INICIO, " .
            "  CON.DATA_FIM, " .
            "  CON.OBSERVACAO ".

            "FROM CONTRATOS CON " .

            "INNER JOIN SITUACAO_CONTRATOS SIT ".
            "ON CON.SITUACAO_CONTRATO_ID = SIT.SITUACAO_CONTRATO_ID ".

            "INNER JOIN TIPO_CONTRATOS TIP ".
            "ON CON.TIPO_CONTRATO_ID = TIP.TIPO_CONTRATO_ID ".

            
            "LEFT JOIN PLANOS_CURSOS PLN ".
            "ON CON.PLANO_CURSO_ID = PLN.PLANO_CURSO_ID ".

            "WHERE CON.EMPRESA_ID = ? ";

        array_push($parametros, $empresaId);
        
        $resultados = $conexao->consulta($sql, $parametros);
    
        $contratos = [];
    
        foreach ($resultados as $resultado) {

            $turma = TurmaBanco::getTurmaPorId( $resultado['TURMA_ID']);
            $vendedor = UsuarioBanco::getFuncionarioPorId( $resultado['VENDEDOR_ID']);
            $aluno = UsuarioBanco::getAlunoPorId( $resultado['ALUNO_ID']);

            $bolsaAplicada = BolsaBanco::getBolsaPorId($resultado['BOLSA_ID']);

            if($bolsaAplicada == null){
                $bolsaAplicada = new Bolsa(null, null, null, null, null, null);
            }

            $contrato =  new Contrato(
                $resultado['CONTRATO_ID'],
                $resultado['EMPRESA_ID'],
                $aluno,
                $turma,
                $vendedor,
                new SituacaoContrato(
                    $resultado['SITUACAO_CONTRATO_ID'],
                    $resultado['EMPRESA_ID'],
                    $resultado['SITUACAO_NOME'],
                    $resultado['SITUACAO_ATIVO']
                ),
                new TipoContrato(
                    $resultado['TIPO_CONTRATO_ID'],
                    $resultado['EMPRESA_ID'],
                    $resultado['TIPO_CONTRATO_NOME'],
                    $resultado['TIPO_CONTRATO_ATIVO']
                ),
                new PlanoCurso(
                    $resultado['PLANO_CURSO_ID'],
                    $turma->getCurso(),
                    $resultado['EMPRESA_ID'],
                    $resultado['PLANOS_CURSOS_NOME'],
                    $resultado['PLANOS_CURSOS_ATIVO'],
                    $resultado['NECESSITA_AUT_SUP'],
                    $resultado['NUMERO_PARCELAS'],
                    $resultado['VALOR_PARCELA'],
                    $resultado['VALOR_TOTAL']
                ),
                $bolsaAplicada,
                DateTime::createFromFormat('Y-m-d', $resultado['DATA_INICIO'])->format('d/m/Y'),
                DateTime::createFromFormat('Y-m-d', $resultado['DATA_FIM'])->format('d/m/Y'),
                $resultado['OBSERVACAO']
            );
    
            array_push($contratos, $contrato);
        }
    
        return $contratos;
    }

    public static function getContratoPorId($contratoId){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  CON.CONTRATO_ID, " .
            "  CON.EMPRESA_ID, " .
            "  CON.TURMA_ID, " .
            "  CON.ALUNO_ID, " .
            "  CON.VENDEDOR_ID, ".
            "  CON.BOLSA_ID, ".
            "  SIT.SITUACAO_CONTRATO_ID, " .
            "  SIT.NOME AS SITUACAO_NOME, " .
            "  SIT.ATIVO AS SITUACAO_ATIVO, " .
            "  TIP.TIPO_CONTRATO_ID, " .
            "  TIP.NOME AS TIPO_CONTRATO_NOME, " .
            "  TIP.ATIVO AS TIPO_CONTRATO_ATIVO, " .
            "  CON.PLANO_CURSO_ID, " .
            "  PLN.NOME AS PLANOS_CURSOS_NOME, " .
            "  PLN.ATIVO AS PLANOS_CURSOS_ATIVO, " .
            "  PLN.NUMERO_PARCELAS, " .
            "  PLN.VALOR_PARCELA, " .
            "  PLN.VALOR_TOTAL, " .
            "  PLN.NECESSITA_AUT_SUP, " .
            "  CON.DATA_INICIO, " .
            "  CON.DATA_FIM, " .
            "  CON.OBSERVACAO ".

            "FROM CONTRATOS CON " .

            "INNER JOIN SITUACAO_CONTRATOS SIT ".
            "ON CON.SITUACAO_CONTRATO_ID = SIT.SITUACAO_CONTRATO_ID ".

            "INNER JOIN TIPO_CONTRATOS TIP ".
            "ON CON.TIPO_CONTRATO_ID = TIP.TIPO_CONTRATO_ID ".

            
            "LEFT JOIN PLANOS_CURSOS PLN ".
            "ON CON.PLANO_CURSO_ID = PLN.PLANO_CURSO_ID ".

            "WHERE CON.CONTRATO_ID = ? ";

        array_push($parametros, $contratoId);
        
        $resultados = $conexao->consulta($sql, $parametros);
    
        foreach ($resultados as $resultado) {

            $turma = TurmaBanco::getTurmaPorId( $resultado['TURMA_ID']);
            $vendedor = UsuarioBanco::getFuncionarioPorId( $resultado['VENDEDOR_ID']);
            $aluno = UsuarioBanco::getAlunoPorId( $resultado['ALUNO_ID']);

            $bolsaAplicada = BolsaBanco::getBolsaPorId($resultado['BOLSA_ID']);

            
            if($bolsaAplicada == null){
                $bolsaAplicada = new Bolsa(null, null, null, null, null, null);
            }

            $contrato =  new Contrato(
                $resultado['CONTRATO_ID'],
                $resultado['EMPRESA_ID'],
                $aluno,
                $turma,
                $vendedor,
                new SituacaoContrato(
                    $resultado['SITUACAO_CONTRATO_ID'],
                    $resultado['EMPRESA_ID'],
                    $resultado['SITUACAO_NOME'],
                    $resultado['SITUACAO_ATIVO']
                ),
                new TipoContrato(
                    $resultado['TIPO_CONTRATO_ID'],
                    $resultado['EMPRESA_ID'],
                    $resultado['TIPO_CONTRATO_NOME'],
                    $resultado['TIPO_CONTRATO_ATIVO']
                ),
                new PlanoCurso(
                    $resultado['PLANO_CURSO_ID'],
                    $turma->getCurso(),
                    $resultado['EMPRESA_ID'],
                    $resultado['PLANOS_CURSOS_NOME'],
                    $resultado['PLANOS_CURSOS_ATIVO'],
                    $resultado['NECESSITA_AUT_SUP'],
                    $resultado['NUMERO_PARCELAS'],
                    $resultado['VALOR_PARCELA'],
                    $resultado['VALOR_TOTAL']
                ),
                $bolsaAplicada,
                DateTime::createFromFormat('Y-m-d', $resultado['DATA_INICIO'])->format('d/m/Y'),
                DateTime::createFromFormat('Y-m-d', $resultado['DATA_FIM'])->format('d/m/Y'),
                $resultado['OBSERVACAO']
            );
    
        }
    
        return $contrato;
    }

    public static function insertContrato(
        $empresaId, 
        $usuarioId, 
        $contratoId, 
        $turmaId, 
        $alunoId,
        $vendedorId,
        $planoCursoId,
        $bolsaId,
        $situacaoContratoId,
        $tipoContratoId,
        $dataInicio,
        $dataFim,
        $observacao
    ){

        if($contratoId !== 0){
            return ContratoBanco::updateContrato(
                $empresaId,
                $usuarioId, 
                $contratoId, 
                $turmaId, 
                $alunoId,
                $vendedorId,
                $planoCursoId,
                $bolsaId,
                $situacaoContratoId,
                $tipoContratoId,
                $dataInicio,
                $dataFim,
                $observacao
            );
        }
        else{

            $conexao = new Conexao();

            $conexao->novaConexaoPDO();
            $conexao->iniciarTranscacao();

            $sql =
            "INSERT INTO CONTRATOS(" .
            "  EMPRESA_ID, " .
            "  TURMA_ID, " .
            "  ALUNO_ID, " .
            "  VENDEDOR_ID, " .
            "  PLANO_CURSO_ID, " .
            "  BOLSA_ID, " .
            "  SITUACAO_CONTRATO_ID, " .
            "  TIPO_CONTRATO_ID, " .
            "  DATA_INICIO, " .
            "  DATA_FIM, " .
            "  OBSERVACAO, " .
            "  USUARIO_CRIACAO_ID, " .
            "  USUARIO_ALTERACAO_ID) " .
            "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ";

            $parametros = array(
                $empresaId,
                $turmaId, 
                $alunoId,
                $vendedorId,
                $planoCursoId == 0 ? null : $planoCursoId,
                $bolsaId == 0 ? null : $bolsaId,
                $situacaoContratoId,
                $tipoContratoId,
                DateTime::createFromFormat('d/m/Y', $dataInicio)->format('Y-m-d'),
                DateTime::createFromFormat('d/m/Y', $dataFim)->format('Y-m-d'),
                $observacao,
                $usuarioId,
                $usuarioId
            );

            $retorno = $conexao->insertUpdateExcluir($sql, $parametros);

            if ($retorno->houveErro) {
                return $retorno;
            }

            $contratoId = intval($retorno->dados);

            $turma = TurmaBanco::getTurmaPorId($turmaId);
      

            $valor = $turma->getCurso()->getValor();
            $desconto = 1;
            $plano = null;

            if($bolsaId != 0){
                $bolsa = BolsaBanco::getBolsaPorId($bolsaId);

                $desconto = 1 - ($bolsa->getPercentualDesconto()/100);
            }
            if($planoCursoId != 0){
                $plano = PlanoCursoBanco::getPlanoCursoPorId($planoCursoId);
                $valor = $plano->getValorTotal();
            }

            $valor = $valor * $desconto;

            $retorno = ContratoBanco::inserirParcelas($conexao, $usuarioId, $contratoId, $plano, $valor);

            if ($retorno->houveErro) {
                return $retorno;
            }

            $conexao->fecharConexao();

            return $retorno;
        }
    }

    public static function deletarContrato($contratoId){
        $conexao = new Conexao();

        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();

        $sql ="DELETE FROM PARCELAS WHERE CONTRATO_ID = ? ";
        $parametros = array($contratoId);

        $retorno = $conexao->insertUpdateExcluir($sql, $parametros);

        if($retorno->houveErro){
            return $retorno;
        }

        $sql ="DELETE FROM CONTRATOS WHERE CONTRATO_ID = ? ";
        $parametros = array($contratoId);

        $retorno = $conexao->insertUpdateExcluir($sql, $parametros);

        if($retorno->houveErro){
            return $retorno;
        }

        $conexao->fecharConexao();

        return $retorno;

    }

    private static function inserirParcelas(Conexao $conexao, $usuarioId, $contratoId, $plano, $valor){

        $sql ="DELETE FROM PARCELAS WHERE CONTRATO_ID = ? ";
        $parametros = array($contratoId);

        $retorno = $conexao->insertUpdateExcluir($sql, $parametros);

        if($retorno->houveErro){
            return $retorno;
        }

        $sql =
        "INSERT INTO PARCELAS(" .
        "  NOME, " .
        "  VALOR, " .
        "  CONTRATO_ID, " .
        "  USUARIO_CRIACAO_ID, " .
        "  USUARIO_ALTERACAO_ID) " .
        "VALUES (?, ?, ?, ?, ?) ";

        if($plano != null){

            $valorParcela = $valor / $plano->getNumeroParcelas();

            for ($i = 1; $i <= $plano->getNumeroParcelas(); $i++) {

                $parametros = [];
                $parametros = array(
                    "Parcela ".$i." - Contrato: ".$contratoId,
                    $valorParcela,
                    $contratoId,
                    $usuarioId,
                    $usuarioId
                );

                $retorno = $conexao->insertUpdateExcluir($sql, $parametros);

                if($retorno->houveErro){
                    return $retorno;
                }
            }
        }
        else{
            $parametros = array(
                "Parcela única - Contrato: ".$contratoId,
                $valor,
                $contratoId,
                $usuarioId,
                $usuarioId
            );

            $retorno = $conexao->insertUpdateExcluir($sql, $parametros);
        }

        return $retorno;
    }

    private static function updateContrato(
        $empresaId,
        $usuarioId, 
        $contratoId, 
        $turmaId, 
        $alunoId,
        $vendedorId,
        $planoCursoId,
        $bolsaId,
        $situacaoContratoId,
        $tipoContratoId,
        $dataInicio,
        $dataFim,
        $observacao
    ){
        $conexao = new Conexao();

        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();

        $sql =
        "UPDATE CONTRATOS SET " .
        "  TURMA_ID = ?, " .
        "  ALUNO_ID = ?, " .
        "  VENDEDOR_ID = ?, " .
        "  PLANO_CURSO_ID = ?, " .
        "  BOLSA_ID = ?, " .
        "  SITUACAO_CONTRATO_ID = ?, " .
        "  TIPO_CONTRATO_ID = ?, " .
        "  DATA_INICIO = ?, " .
        "  DATA_FIM = ?, " .
        "  OBSERVACAO = ?, " .
        "  USUARIO_ALTERACAO_ID = ? " .
        "WHERE CONTRATO_ID = ? ";

        $parametros = array(
            $turmaId, 
            $alunoId,
            $vendedorId,
            $planoCursoId,
            $bolsaId,
            $situacaoContratoId,
            $tipoContratoId,
            DateTime::createFromFormat('d/m/Y', $dataInicio)->format('Y-m-d'),
            DateTime::createFromFormat('d/m/Y', $dataFim)->format('Y-m-d'),
            $observacao,
            $usuarioId,
            $contratoId
        );

        $retorno = $conexao->insertUpdateExcluir($sql, $parametros);

        if ($retorno->houveErro) {
            return $retorno;
        }

        
        $turma = TurmaBanco::getTurmaPorId($turmaId);
      
        $valor = $turma->getCurso()->getValor();
        $desconto = 0;
        $plano = null;

        if($bolsaId != 0){
            $bolsa = BolsaBanco::getBolsaPorId($bolsaId);

            $desconto = 1 - ($bolsa->getPercentualDesconto()/100);
        }
        if($planoCursoId != 0){
            $plano = PlanoCursoBanco::getPlanoCursoPorId($planoCursoId);
            $valor = $plano->getValorTotal();
        }

        $valor = $valor * $desconto;


        $retorno = ContratoBanco::inserirParcelas($conexao, $usuarioId, $empresaId, $contratoId, $plano, $valor);

        if ($retorno->houveErro) {
            return $retorno;
        }

        $conexao->fecharConexao();

        return $retorno;
    }
}

?>