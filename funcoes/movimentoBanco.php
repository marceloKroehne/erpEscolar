<?

class MovimentoBanco{

    public static function getMovimentos($empresaId, $dataIncio=null, $dataFim=null, $subcontaId=null, $agencia=null, $numeroConta=null, $bancoId=null){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  MOV.MOVIMENTO_ID, " .
            "  MOV.EMPRESA_ID,".
            "  MOV.DATA_LANCAMENTO, " .
            "  MOV.HISTORICO, " .
            "  MOV.BANCO_ID,".
            "  MOV.AGENCIA,".
            "  MOV.NUMERO_CONTA,".
            "  MOV.VALOR, " .
            "  MOV.OBSERVACAO, " .
            "  MOV.SUBCONTA_ID,".
            "  MOV.NUMERO_DOCUMENTO,".
            "  MOV.TIPO_DOCUMENTO_ID,".
            "  SUB.GRUPO_CONTA_ID,".
            "  MOV.NUMERO_MOVIMENTO,".
            "  SUB.TIPO,".
            "  SUB.NOME AS NOME_SUBCONTA,".
            "  TPD.NOME AS NOME_TIPO_DOCUMENTO,".
            "  GRP.NOME AS NOME_GRUPOS_CONTAS,".
            "  GRP.RECEBIMENTO_VENDAS, ".
            "  BNC.NOME AS NOME_BANCO,".
            "  BNC.EXIGE_OFX,".
            "  BNC.ATIVO AS BANCO_ATIVO,".
            "  BNC.NUMERO_BANCO " .

            "FROM MOVIMENTOS MOV " .

            "INNER JOIN EMPRESAS EMP " .
            "ON MOV.EMPRESA_ID = EMP.EMPRESA_ID " .

            "INNER JOIN SUBCONTAS SUB " .
            "ON MOV.SUBCONTA_ID = SUB.SUBCONTA_ID " .

            "LEFT JOIN TIPO_DOCUMENTOS TPD " .
            "ON MOV.TIPO_DOCUMENTO_ID = TPD.TIPO_DOCUMENTO_ID " .

            "INNER JOIN GRUPOS_CONTAS GRP " .
            "ON SUB.GRUPO_CONTA_ID = GRP.GRUPO_CONTA_ID " .

            "INNER JOIN BANCOS BNC " .
            "ON MOV.BANCO_ID = BNC.BANCO_ID " .

            "WHERE EMP.EMPRESA_ID = ? ";

        array_push($parametros, $empresaId);

        if($dataIncio !== null){
            $sql .=
            "AND MOV.DATA_LANCAMENTO >= ? ";
            array_push($parametros, DateTime::createFromFormat('d/m/Y', $dataIncio)->format('Y-m-d'));
        }
        if($dataFim !== null){
            $sql .=
            "AND MOV.DATA_LANCAMENTO <= ? ";
            array_push($parametros, DateTime::createFromFormat('d/m/Y', $dataFim)->format('Y-m-d'));
        }
        if($subcontaId !== null){
            $sql .=
            "AND SUB.SUBCONTA_ID = ? ";
            array_push($parametros, $subcontaId);
        }
        if($agencia !== null){
            $sql .=
            "AND MOV.AGENCIA = ? ";
            array_push($parametros, $agencia);
        }
        if($numeroConta !== null){
            $sql .=
            "AND MOV.NUMERO_CONTA = ? ";
            array_push($parametros, $numeroConta);
        }
        if($bancoId !== null){
            $sql .=
            "AND MOV.BANCO_ID = ? ";
            array_push($parametros, $bancoId);
        }

        $resultados = $conexao->consulta($sql, $parametros);
    
        $movimentos = [];
    
        foreach ($resultados as $resultado) {

            $movimento = new Movimento(
                $resultado['MOVIMENTO_ID'],
                $resultado['EMPRESA_ID'],
                new Conta(
                    new Banco(
                        $resultado['BANCO_ID'],
                        $resultado['NUMERO_BANCO'],
                        $resultado['EMPRESA_ID'],
                        $resultado['NOME_BANCO'],
                        $resultado['EXIGE_OFX'],
                        $resultado['BANCO_ATIVO']
                    ),
                    $resultado['AGENCIA'],
                    $resultado['NUMERO_CONTA'],
                    true
                ),
                new Subconta(
                    $resultado['SUBCONTA_ID'],
                    new GrupoContas(
                        $resultado['GRUPO_CONTA_ID'],
                        $resultado['EMPRESA_ID'],
                        $resultado['NOME_GRUPOS_CONTAS'],
                        $resultado['RECEBIMENTO_VENDAS'],
                        true
                    ),
                    $resultado['TIPO'],
                    $resultado['NOME_SUBCONTA'],
                    true
                ),
                $resultado['VALOR'],
                DateTime::createFromFormat('Y-m-d', $resultado['DATA_LANCAMENTO'])->format('d/m/Y'),
                $resultado['HISTORICO'],
                $resultado['OBSERVACAO'],
                $resultado['NUMERO_DOCUMENTO'],
                new TipoDocumento(
                    $resultado['TIPO_DOCUMENTO_ID'],
                    $resultado['EMPRESA_ID'],
                    $resultado['NOME_TIPO_DOCUMENTO'],
                    true
                ),
                $resultado['NUMERO_MOVIMENTO']
            );
    
            array_push($movimentos, $movimento);
        }
    
        return $movimentos;
    }
    
    public static function getMovimentoPorId($movimentoId){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  MOV.MOVIMENTO_ID, " .
            "  MOV.EMPRESA_ID,".
            "  MOV.DATA_LANCAMENTO, " .
            "  MOV.HISTORICO, " .
            "  MOV.BANCO_ID,".
            "  MOV.AGENCIA,".
            "  MOV.NUMERO_CONTA,".
            "  MOV.VALOR, " .
            "  MOV.OBSERVACAO, " .
            "  MOV.SUBCONTA_ID,".
            "  MOV.NUMERO_DOCUMENTO,".
            "  MOV.TIPO_DOCUMENTO_ID,".
            "  SUB.GRUPO_CONTA_ID,".
            "  MOV.NUMERO_MOVIMENTO,".
            "  SUB.TIPO,".
            "  SUB.NOME AS NOME_SUBCONTA,".
            "  TPD.NOME AS NOME_TIPO_DOCUMENTO,".
            "  GRP.NOME AS NOME_GRUPOS_CONTAS,".
            "  GRP.RECEBIMENTO_VENDAS, ".
            "  BNC.NOME AS NOME_BANCO,".
            "  BNC.EXIGE_OFX,".
            "  BNC.ATIVO AS BANCO_ATIVO,".
            "  BNC.NUMERO_BANCO " .

            "FROM MOVIMENTOS MOV " .

            "INNER JOIN EMPRESAS EMP " .
            "ON MOV.EMPRESA_ID = EMP.EMPRESA_ID " .

            "INNER JOIN SUBCONTAS SUB " .
            "ON MOV.SUBCONTA_ID = SUB.SUBCONTA_ID " .

            "LEFT JOIN TIPO_DOCUMENTOS TPD " .
            "ON MOV.TIPO_DOCUMENTO_ID = TPD.TIPO_DOCUMENTO_ID " .

            "INNER JOIN GRUPOS_CONTAS GRP " .
            "ON SUB.GRUPO_CONTA_ID = GRP.GRUPO_CONTA_ID " .

            "INNER JOIN BANCOS BNC " .
            "ON MOV.BANCO_ID = BNC.BANCO_ID " .

            "WHERE MOV.MOVIMENTO_ID = ? ";

        $parametros = array($movimentoId);

        $resultados = $conexao->consulta($sql, $parametros);
    
        foreach ($resultados as $resultado) {

            $movimento = new Movimento(
                $resultado['MOVIMENTO_ID'],
                $resultado['EMPRESA_ID'],
                new Conta(
                    new Banco(
                        $resultado['BANCO_ID'],
                        $resultado['NUMERO_BANCO'],
                        $resultado['EMPRESA_ID'],
                        $resultado['NOME_BANCO'],
                        $resultado['EXIGE_OFX'],
                        $resultado['BANCO_ATIVO']
                    ),
                    $resultado['AGENCIA'],
                    $resultado['NUMERO_CONTA'],
                    true
                ),
                new Subconta(
                    $resultado['SUBCONTA_ID'],
                    new GrupoContas(
                        $resultado['GRUPO_CONTA_ID'],
                        $resultado['EMPRESA_ID'],
                        $resultado['NOME_GRUPOS_CONTAS'],
                        $resultado['RECEBIMENTO_VENDAS'],
                        true
                    ),
                    $resultado['TIPO'],
                    $resultado['NOME_SUBCONTA'],
                    true
                ),
                $resultado['VALOR'],
                DateTime::createFromFormat('Y-m-d', $resultado['DATA_LANCAMENTO'])->format('d/m/Y'),
                $resultado['HISTORICO'],
                $resultado['OBSERVACAO'],
                $resultado['NUMERO_DOCUMENTO'],
                new TipoDocumento(
                    $resultado['TIPO_DOCUMENTO_ID'],
                    $resultado['EMPRESA_ID'],
                    $resultado['NOME_TIPO_DOCUMENTO'],
                    true
                ),
                $resultado['NUMERO_MOVIMENTO']
            );
    
        }
    
        return $movimento;
    }

    public static function isMovimentoDuplicado($numeroMovimento, $empresaId){

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
        "SELECT " .
        "  MOV.MOVIMENTO_ID, " .
        "  MOV.EMPRESA_ID,".
        "  MOV.DATA_LANCAMENTO, " .
        "  MOV.HISTORICO, " .
        "  MOV.BANCO_ID,".
        "  MOV.AGENCIA,".
        "  MOV.NUMERO_CONTA,".
        "  MOV.VALOR, " .
        "  MOV.OBSERVACAO, " .
        "  MOV.SUBCONTA_ID,".
        "  MOV.NUMERO_DOCUMENTO,".
        "  MOV.NUMERO_MOVIMENTO,".
        "  MOV.TIPO_DOCUMENTO_ID,".
        "  SUB.GRUPO_CONTA_ID,".
        "  SUB.TIPO,".
        "  SUB.NOME AS NOME_SUBCONTA,".
        "  TPD.NOME AS NOME_TIPO_DOCUMENTO,".
        "  GRP.NOME AS NOME_GRUPOS_CONTAS,".
        "  GRP.RECEBIMENTO_VENDAS, ".
        "  BNC.NOME AS NOME_BANCO,".
        "  BNC.EXIGE_OFX,".
        "  BNC.ATIVO AS BANCO_ATIVO,".
        "  BNC.NUMERO_BANCO " .

        "FROM MOVIMENTOS MOV " .

        "INNER JOIN EMPRESAS EMP " .
        "ON MOV.EMPRESA_ID = EMP.EMPRESA_ID " .

        "INNER JOIN SUBCONTAS SUB " .
        "ON MOV.SUBCONTA_ID = SUB.SUBCONTA_ID " .

        "LEFT JOIN TIPO_DOCUMENTOS TPD " .
        "ON MOV.TIPO_DOCUMENTO_ID = TPD.TIPO_DOCUMENTO_ID " .

        "INNER JOIN GRUPOS_CONTAS GRP " .
        "ON SUB.GRUPO_CONTA_ID = GRP.GRUPO_CONTA_ID " .

        "INNER JOIN BANCOS BNC " .
        "ON MOV.BANCO_ID = BNC.BANCO_ID " .

        "WHERE EMP.EMPRESA_ID = ? ".
        "AND MOV.NUMERO_MOVIMENTO = ? ";

        $parametros = array($empresaId, $numeroMovimento);

        $resultados = $conexao->consulta($sql, $parametros);
    

        foreach ($resultados as $resultado) {
            $movimento = new Movimento(
                $resultado['MOVIMENTO_ID'],
                $resultado['EMPRESA_ID'],
                new Conta(
                    new Banco(
                        $resultado['BANCO_ID'],
                        $resultado['NUMERO_BANCO'],
                        $resultado['EMPRESA_ID'],
                        $resultado['NOME_BANCO'],
                        $resultado['EXIGE_OFX'],
                        $resultado['BANCO_ATIVO']
                    ),
                    $resultado['AGENCIA'],
                    $resultado['NUMERO_CONTA'],
                    true
                ),
                new Subconta(
                    $resultado['SUBCONTA_ID'],
                    new GrupoContas(
                        $resultado['GRUPO_CONTA_ID'],
                        $resultado['EMPRESA_ID'],
                        $resultado['NOME_GRUPOS_CONTAS'],
                        $resultado['RECEBIMENTO_VENDAS'],
                        true
                    ),
                    $resultado['TIPO'],
                    $resultado['NOME_SUBCONTA'],
                    true
                ),
                $resultado['VALOR'],
                DateTime::createFromFormat('Y-m-d', $resultado['DATA_LANCAMENTO'])->format('d/m/Y'),
                $resultado['HISTORICO'],
                $resultado['OBSERVACAO'],
                $resultado['NUMERO_DOCUMENTO'],
                new TipoDocumento(
                    $resultado['TIPO_DOCUMENTO_ID'],
                    $resultado['EMPRESA_ID'],
                    $resultado['NOME_TIPO_DOCUMENTO'],
                    true
                ),
                $resultado['NUMERO_MOVIMENTO']
            );
        }
    
        return $movimento;
    }

    public static function insertMovimento(
        $movimentoId,
        $empresaId,
        $usuarioId, 
        $data, 
        $subcontaId, 
        $bancoId, 
        $agencia, 
        $numeroConta, 
        $historico, 
        $tipoDocumentoId, 
        $numeroDocumento, 
        $valor,
        $observacao,
        $numeroMovimento
    ){
            
        if($movimentoId !== 0){
            echo("UPDAT");
            return MovimentoBanco::updateMovimento( 
            $movimentoId,
            $empresaId,
            $usuarioId, 
            $data, 
            $subcontaId, 
            $bancoId, 
            $agencia, 
            $numeroConta, 
            $historico, 
            $tipoDocumentoId, 
            $numeroDocumento, 
            $valor,
            $observacao);
        }
        else{
            $conexao = new Conexao();

            $conexao->novaConexaoPDO();
            $conexao->iniciarTranscacao();

            $sql =
            "INSERT INTO MOVIMENTOS( " .
            "  EMPRESA_ID, ".
            "  SUBCONTA_ID, ".
            "  VALOR, ".
            "  DATA_LANCAMENTO, ".
            "  HISTORICO, ".
            "  OBSERVACAO, ".
            "  TIPO_DOCUMENTO_ID, ".
            "  NUMERO_DOCUMENTO, " .
            "  BANCO_ID, ".
            "  AGENCIA, ".
            "  NUMERO_CONTA, " .
            "  NUMERO_MOVIMENTO, ".
            "  USUARIO_CRIACAO_ID, " .
            "  USUARIO_ALTERACAO_ID) " .
            "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ";

            
            $valorSb = str_replace('.', '',$valor);
            $valorSb = str_replace(',', '.',$valorSb);
            
            $valorDec =  floatval($valorSb);

            $parametros = array(
                $empresaId,
                $subcontaId,
                $valorDec,
                DateTime::createFromFormat('d/m/Y', $data)->format('Y-m-d'),
                $historico,
                $observacao,
                $tipoDocumentoId === 0 ? null : $tipoDocumentoId,
                $numeroDocumento,
                $bancoId,
                $agencia,
                $numeroConta,
                $numeroMovimento,
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

    public static function deleteMovimento($movimentoId){
        $conexao = new Conexao();

        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();

        $sql ="UPDATE PARCELAS SET MOVIMENTO_ID = null, STATUS_PAGAMENTO = 1 WHERE MOVIMENTO_ID = ? ";

        $parametros = array($movimentoId);

        $retorno = $conexao->insertUpdateExcluir($sql, $parametros);

        if ($retorno->houveErro) {
            return $retorno;
        }

        $sql = "DELETE FROM MOVIMENTOS WHERE MOVIMENTO_ID = ? ";

        $parametros = array($movimentoId);

        $retorno = $conexao->insertUpdateExcluir($sql, $parametros);

        if ($retorno->houveErro) {
            return $retorno;
        }

        $conexao->fecharConexao();

        return $retorno;

    }

    private static function updateMovimento(  
        $movimentoId,
        $empresaId,
        $usuarioId, 
        $data, 
        $subcontaId, 
        $bancoId, 
        $agencia, 
        $numeroConta, 
        $historico, 
        $tipoDocumentoId, 
        $numeroDocumento, 
        $valor,
        $observacao){

        $conexao = new Conexao();

        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();

        $sql =
        "UPDATE MOVIMENTOS SET " .
        "  EMPRESA_ID = ?, " .
        "  SUBCONTA_ID = ?, " .
        "  DATA_LANCAMENTO = ?, " .
        "  HISTORICO = ?, " .
        "  OBSERVACAO = ?, " .
        "  VALOR = ?, " .
        "  TIPO_DOCUMENTO_ID = ?, " .
        "  NUMERO_DOCUMENTO = ?, " .
        "  BANCO_ID = ?, " .
        "  AGENCIA = ?, " .
        "  NUMERO_CONTA = ?, " .
        "  USUARIO_ALTERACAO_ID = ? " .
        "WHERE MOVIMENTO_ID = ? ";

        $valorSb = str_replace(',', '.',$valor);

        $valorDec =  floatval($valorSb);

        $parametros = array(
            $empresaId,
            $subcontaId,
            DateTime::createFromFormat('m/d/Y', $data)->format('Y-m-d'),
            $historico,
            $observacao,
            $valorDec,
            $tipoDocumentoId,
            $numeroDocumento,
            $bancoId,
            $agencia,
            $numeroConta,
            $usuarioId,
            $movimentoId
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