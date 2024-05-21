<?

class MovimentoBanco{

    public static function getMovimentos($empresaId, $dataIncio=null, $dataFim=null, $subcontaId=null){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT 
            MOV.MOVIMENTO_ID, 
            MOV.EMPRESA_ID,
            MOV.DATA_LANCAMENTO, 
            MOV.HISTORICO, 
            MOV.VALOR, 
            MOV.OBSERVACAO, 
            MOV.SUBCONTA_ENTRADA_ID,
            MOV.SUBCONTA_SAIDA_ID,
            MOV.NUMERO_DOCUMENTO,
            MOV.TIPO_DOCUMENTO_ID,
            MOV.NUMERO_MOVIMENTO,
            PAR.PARCELA_ID,
            SUB.GRUPO_CONTA_ID AS ENTRADA_GRUPO_CONTA_ID,
            SUB.TIPO AS ENTRADA_TIPO,
            SUB.NOME AS ENTRADA_NOME_SUBCONTA,
            SUB.BANCO_ID AS ENTRADA_BANCO_ID,
            SUB.AGENCIA AS ENTRADA_AGENCIA,
            SUB.NUMERO_CONTA AS ENTRADA_NUMERO_CONTA,
            GRP.NOME AS ENTRADA_NOME_GRUPOS_CONTAS,
            GRP.RECEBIMENTO_VENDAS as ENTRADA_RECEBIMENTO_VENDAS, 
            SAI.GRUPO_CONTA_ID AS SAIDA_GRUPO_CONTA_ID,
            SAI.TIPO AS SAIDA_TIPO,
            SAI.NOME AS SAIDA_NOME_SUBCONTA,
            SAI.BANCO_ID AS SAIDA_BANCO_ID,
            SAI.AGENCIA AS SAIDA_AGENCIA,
            SAI.NUMERO_CONTA AS SAIDA_NUMERO_CONTA,
            GAI.NOME AS SAIDA_NOME_GRUPOS_CONTAS,
            GAI.RECEBIMENTO_VENDAS as SAIDA_RECEBIMENTO_VENDAS, 
            TPD.NOME AS NOME_TIPO_DOCUMENTO

            FROM MOVIMENTOS MOV 

            INNER JOIN EMPRESAS EMP 
            ON MOV.EMPRESA_ID = EMP.EMPRESA_ID 

            LEFT JOIN PARCELAS PAR
            ON MOV.MOVIMENTO_ID = PAR.MOVIMENTO_ID

            INNER JOIN SUBCONTAS SUB 
            ON MOV.SUBCONTA_ENTRADA_ID = SUB.SUBCONTA_ID 
            
            INNER JOIN SUBCONTAS SAI 
            ON MOV.SUBCONTA_SAIDA_ID = SAI.SUBCONTA_ID 

            LEFT JOIN TIPO_DOCUMENTOS TPD 
            ON MOV.TIPO_DOCUMENTO_ID = TPD.TIPO_DOCUMENTO_ID 

            INNER JOIN GRUPOS_CONTAS GRP 
            ON SUB.GRUPO_CONTA_ID = GRP.GRUPO_CONTA_ID 
            
            INNER JOIN GRUPOS_CONTAS GAI
            ON SAI.GRUPO_CONTA_ID = GAI.GRUPO_CONTA_ID 

            WHERE EMP.EMPRESA_ID = ? ";

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
            "AND (SUB.SUBCONTA_ID = ? or SAI.SUBCONTA_ID = ? ) ";
            array_push($parametros, $subcontaId, $subcontaId);
        }

        $resultados = $conexao->consulta($sql, $parametros);
    
        $movimentos = [];
    
        foreach ($resultados as $resultado) {

            $contaEntrada = ContasBancoBanco::getContaBancoId($resultado['ENTRADA_BANCO_ID'],$resultado['ENTRADA_AGENCIA'], $resultado['ENTRADA_NUMERO_CONTA']);
            if($contaEntrada == null){
                $contaEntrada = new Conta(new Banco(null,null,null,null,null, null),null,null,null);
            }
            $contaSaida = ContasBancoBanco::getContaBancoId($resultado['SAIDA_BANCO_ID'],$resultado['SAIDA_AGENCIA'], $resultado['SAIDA_NUMERO_CONTA']);
            if($contaSaida == null){
                $contaSaida = new Conta(new Banco(null,null,null,null,null, null),null,null,null);
            }

            $movimento = new Movimento(
                $resultado['MOVIMENTO_ID'],
                $resultado['EMPRESA_ID'],
                new Subconta(
                    $resultado['SUBCONTA_ENTRADA_ID'],
                    new GrupoContas(
                        $resultado['ENTRADA_GRUPO_CONTA_ID'],
                        $resultado['EMPRESA_ID'],
                        $resultado['ENTRADA_NOME_GRUPOS_CONTAS'],
                        $resultado['ENTRADA_RECEBIMENTO_VENDAS'],
                        true
                    ),
                    $contaEntrada,
                    $resultado['ENTRADA_TIPO'],
                    $resultado['ENTRADA_NOME_SUBCONTA'],
                    true
                ),
                new Subconta(
                    $resultado['SUBCONTA_SAIDA_ID'],
                    new GrupoContas(
                        $resultado['SAIDA_GRUPO_CONTA_ID'],
                        $resultado['EMPRESA_ID'],
                        $resultado['SAIDA_NOME_GRUPOS_CONTAS'],
                        $resultado['SAIDA_RECEBIMENTO_VENDAS'],
                        true
                    ),
                    $contaSaida,
                    $resultado['SAIDA_TIPO'],
                    $resultado['SAIDA_NOME_SUBCONTA'],
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
    
            $movimento->setParcelaId($resultado['PARCELA_ID']);
            array_push($movimentos, $movimento);
        }
    
        return $movimentos;
    }
    
    public static function getMovimentoPorId($movimentoId){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT 
            MOV.MOVIMENTO_ID, 
            MOV.EMPRESA_ID,
            MOV.DATA_LANCAMENTO, 
            MOV.HISTORICO, 
            MOV.VALOR, 
            MOV.OBSERVACAO, 
            MOV.SUBCONTA_ENTRADA_ID,
            MOV.NUMERO_DOCUMENTO,
            MOV.TIPO_DOCUMENTO_ID,
            MOV.NUMERO_MOVIMENTO,
            SUB.GRUPO_CONTA_ID AS ENTRADA_GRUPO_CONTA_ID,
            SUB.TIPO AS ENTRADA_TIPO,
            SUB.NOME AS ENTRADA_NOME_SUBCONTA,
            SUB.BANCO_ID AS ENTRADA_BANCO_ID,
            SUB.AGENCIA AS ENTRADA_AGENCIA,
            SUB.NUMERO_CONTA AS ENTRADA_NUMERO_CONTA,
            GRP.NOME AS ENTRADA_NOME_GRUPOS_CONTAS,
            GRP.RECEBIMENTO_VENDAS as ENTRADA_RECEBIMENTO_VENDAS, 
            SAI.GRUPO_CONTA_ID AS SAIDA_GRUPO_CONTA_ID,
            SAI.TIPO AS SAIDA_TIPO,
            SAI.NOME AS SAIDA_NOME_SUBCONTA,
            SAI.BANCO_ID AS SAIDA_BANCO_ID,
            SAI.AGENCIA AS SAIDA_AGENCIA,
            SAI.NUMERO_CONTA AS SAIDA_NUMERO_CONTA,
            GAI.NOME AS SAIDA_NOME_GRUPOS_CONTAS,
            GAI.RECEBIMENTO_VENDAS as SAIDA_RECEBIMENTO_VENDAS, 
            TPD.NOME AS NOME_TIPO_DOCUMENTO

            FROM MOVIMENTOS MOV 

            INNER JOIN EMPRESAS EMP 
            ON MOV.EMPRESA_ID = EMP.EMPRESA_ID 

            INNER JOIN SUBCONTAS SUB 
            ON MOV.SUBCONTA_ENTRADA_ID = SUB.SUBCONTA_ID 
            
            INNER JOIN SUBCONTAS SAI 
            ON MOV.SUBCONTA_SAIDA_ID = SAI.SUBCONTA_ID 

            LEFT JOIN TIPO_DOCUMENTOS TPD 
            ON MOV.TIPO_DOCUMENTO_ID = TPD.TIPO_DOCUMENTO_ID 

            INNER JOIN GRUPOS_CONTAS GRP 
            ON SUB.GRUPO_CONTA_ID = GRP.GRUPO_CONTA_ID 
            
            INNER JOIN GRUPOS_CONTAS GAI
            ON SAI.GRUPO_CONTA_ID = GAI.GRUPO_CONTA_ID 

            WHERE MOV.MOVIMENTO_ID = ? ";

        $parametros = array($movimentoId);

        $resultados = $conexao->consulta($sql, $parametros);
    
        foreach ($resultados as $resultado) {

            $contaEntrada = ContasBancoBanco::getContaBancoId($resultado['ENTRADA_BANCO_ID'],$resultado['ENTRADA_AGENCIA'], $resultado['ENTRADA_NUMERO_CONTA']);
            if($contaEntrada == null){
                $contaEntrada = new Conta(new Banco(null,null,null,null,null, null),null,null,null);
            }
            $contaSaida = ContasBancoBanco::getContaBancoId($resultado['SAIDA_BANCO_ID'],$resultado['SAIDA_AGENCIA'], $resultado['SAIDA_NUMERO_CONTA']);
            if($contaSaida == null){
                $contaSaida = new Conta(new Banco(null,null,null,null,null, null),null,null,null);
            }
            $movimento = new Movimento(
                $resultado['MOVIMENTO_ID'],
                $resultado['EMPRESA_ID'],
                new Subconta(
                    $resultado['SUBCONTA_ENTRADA_ID'],
                    new GrupoContas(
                        $resultado['ENTRADA_GRUPO_CONTA_ID'],
                        $resultado['EMPRESA_ID'],
                        $resultado['ENTRADA_NOME_GRUPOS_CONTAS'],
                        $resultado['ENTRADA_RECEBIMENTO_VENDAS'],
                        true
                    ),
                    $contaEntrada,
                    $resultado['ENTRADA_TIPO'],
                    $resultado['ENTRADA_NOME_SUBCONTA'],
                    true
                ),
                new Subconta(
                    $resultado['SUBCONTA_SAIDA_ID'],
                    new GrupoContas(
                        $resultado['SAIDA_GRUPO_CONTA_ID'],
                        $resultado['EMPRESA_ID'],
                        $resultado['SAIDA_NOME_GRUPOS_CONTAS'],
                        $resultado['SAIDA_RECEBIMENTO_VENDAS'],
                        true
                    ),
                    $contaSaida,
                    $resultado['SAIDA_TIPO'],
                    $resultado['SAIDA_NOME_SUBCONTA'],
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
            "SELECT 
            MOV.MOVIMENTO_ID, 
            MOV.EMPRESA_ID,
            MOV.DATA_LANCAMENTO, 
            MOV.HISTORICO, 
            MOV.VALOR, 
            MOV.OBSERVACAO, 
            MOV.SUBCONTA_ENTRADA_ID,
            MOV.NUMERO_DOCUMENTO,
            MOV.TIPO_DOCUMENTO_ID,
            MOV.NUMERO_MOVIMENTO,
            SUB.GRUPO_CONTA_ID AS ENTRADA_GRUPO_CONTA_ID,
            SUB.TIPO AS ENTRADA_TIPO,
            SUB.NOME AS ENTRADA_NOME_SUBCONTA,
            SUB.BANCO_ID AS ENTRADA_BANCO_ID,
            SUB.AGENCIA AS ENTRADA_AGENCIA,
            SUB.NUMERO_CONTA AS ENTRADA_NUMERO_CONTA,
            GRP.NOME AS ENTRADA_NOME_GRUPOS_CONTAS,
            GRP.RECEBIMENTO_VENDAS as ENTRADA_RECEBIMENTO_VENDAS, 
            SAI.GRUPO_CONTA_ID AS SAIDA_GRUPO_CONTA_ID,
            SAI.TIPO AS SAIDA_TIPO,
            SAI.NOME AS SAIDA_NOME_SUBCONTA,
            SAI.BANCO_ID AS SAIDA_BANCO_ID,
            SAI.AGENCIA AS SAIDA_AGENCIA,
            SAI.NUMERO_CONTA AS SAIDA_NUMERO_CONTA,
            GAI.NOME AS SAIDA_NOME_GRUPOS_CONTAS,
            GAI.RECEBIMENTO_VENDAS as SAIDA_RECEBIMENTO_VENDAS, 
            TPD.NOME AS NOME_TIPO_DOCUMENTO

            FROM MOVIMENTOS MOV 

            INNER JOIN EMPRESAS EMP 
            ON MOV.EMPRESA_ID = EMP.EMPRESA_ID 

            INNER JOIN SUBCONTAS SUB 
            ON MOV.SUBCONTA_ENTRADA_ID = SUB.SUBCONTA_ID 
            
            INNER JOIN SUBCONTAS SAI 
            ON MOV.SUBCONTA_SAIDA_ID = SAI.SUBCONTA_ID 

            LEFT JOIN TIPO_DOCUMENTOS TPD 
            ON MOV.TIPO_DOCUMENTO_ID = TPD.TIPO_DOCUMENTO_ID 

            INNER JOIN GRUPOS_CONTAS GRP 
            ON SUB.GRUPO_CONTA_ID = GRP.GRUPO_CONTA_ID 
            
            INNER JOIN GRUPOS_CONTAS GAI
            ON SAI.GRUPO_CONTA_ID = GAI.GRUPO_CONTA_ID 

            WHERE EMP.EMPRESA_ID = ? 
            AND MOV.NUMERO_MOVIMENTO = ? ";

        $parametros = array($empresaId, $numeroMovimento);

        $resultados = $conexao->consulta($sql, $parametros);
    

        foreach ($resultados as $resultado) {

            $contaEntrada = ContasBancoBanco::getContaBancoId($resultado['ENTRADA_BANCO_ID'],$resultado['ENTRADA_AGENCIA'], $resultado['ENTRADA_NUMERO_CONTA']);
            if($contaEntrada == null){
                $contaEntrada = new Conta(new Banco(null,null,null,null,null, null),null,null,null);
            }
            $contaSaida = ContasBancoBanco::getContaBancoId($resultado['SAIDA_BANCO_ID'],$resultado['SAIDA_AGENCIA'], $resultado['SAIDA_NUMERO_CONTA']);
            if($contaSaida == null){
                $contaSaida = new Conta(new Banco(null,null,null,null,null, null),null,null,null);
            }

            $movimento = new Movimento(
                $resultado['MOVIMENTO_ID'],
                $resultado['EMPRESA_ID'],new Subconta(
                    $resultado['SUBCONTA_ENTRADA_ID'],
                    new GrupoContas(
                        $resultado['ENTRADA_GRUPO_CONTA_ID'],
                        $resultado['EMPRESA_ID'],
                        $resultado['ENTRADA_NOME_GRUPOS_CONTAS'],
                        $resultado['ENTRADA_RECEBIMENTO_VENDAS'],
                        true
                    ),
                    $contaEntrada,
                    $resultado['ENTRADA_TIPO'],
                    $resultado['ENTRADA_NOME_SUBCONTA'],
                    true
                ),
                new Subconta(
                    $resultado['SUBCONTA_SAIDA_ID'],
                    new GrupoContas(
                        $resultado['SAIDA_GRUPO_CONTA_ID'],
                        $resultado['EMPRESA_ID'],
                        $resultado['SAIDA_NOME_GRUPOS_CONTAS'],
                        $resultado['SAIDA_RECEBIMENTO_VENDAS'],
                        true
                    ),
                    $contaSaida,
                    $resultado['SAIDA_TIPO'],
                    $resultado['SAIDA_NOME_SUBCONTA'],
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
        $subcontaEntradaId, 
        $subcontaSaidaId, 
        $historico, 
        $tipoDocumentoId, 
        $numeroDocumento, 
        $valor,
        $observacao,
        $numeroMovimento,
        $parcelaQuitar
    ){
            
        if($movimentoId !== 0){
            return MovimentoBanco::updateMovimento( 
            $movimentoId,
            $empresaId,
            $usuarioId, 
            $data, 
            $subcontaEntradaId, 
            $subcontaSaidaId, 
            $historico, 
            $tipoDocumentoId, 
            $numeroDocumento, 
            $valor,
            $observacao,
            $parcelaQuitar);
        }
        else{
            $conexao = new Conexao();

            $conexao->novaConexaoPDO();
            $conexao->iniciarTranscacao();

            $sql =
            "INSERT INTO MOVIMENTOS( " .
            "  EMPRESA_ID, ".
            "  SUBCONTA_ENTRADA_ID, ".
            "  SUBCONTA_SAIDA_ID, ".
            "  VALOR, ".
            "  DATA_LANCAMENTO, ".
            "  HISTORICO, ".
            "  OBSERVACAO, ".
            "  TIPO_DOCUMENTO_ID, ".
            "  NUMERO_DOCUMENTO, " .
            "  NUMERO_MOVIMENTO, ".
            "  USUARIO_CRIACAO_ID, " .
            "  USUARIO_ALTERACAO_ID) " .
            "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ";

            
            $valorSb = str_replace('.', '',$valor);
            $valorSb = str_replace(',', '.',$valorSb);
            
            $valorDec =  floatval($valorSb);

            $parametros = array(
                $empresaId,
                $subcontaEntradaId,
                $subcontaSaidaId,
                $valorDec,
                DateTime::createFromFormat('d/m/Y', $data)->format('Y-m-d'),
                $historico,
                $observacao,
                $tipoDocumentoId === 0 ? null : $tipoDocumentoId,
                $numeroDocumento,
                $numeroMovimento,
                $usuarioId,
                $usuarioId
            );

            $retorno = $conexao->insertUpdateExcluir($sql, $parametros);

            if ($retorno->houveErro) {
                return $retorno;
            }

            $movimentoId = $retorno->dados;
            
            if($parcelaQuitar > 0){
                $retorno = ParcelaBanco::quitarParcela($conexao, $parcelaQuitar, $movimentoId, DateTime::createFromFormat('d/m/Y', $data)->format('Y-m-d'));
            }

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
        $subcontaEntradaId, 
        $subcontaSaidaId, 
        $historico, 
        $tipoDocumentoId, 
        $numeroDocumento, 
        $valor,
        $observacao,
        $parcelaQuitar){

        $conexao = new Conexao();

        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();

        $sql =
        "UPDATE MOVIMENTOS SET " .
        "  EMPRESA_ID = ?, " .
        "  SUBCONTA_ENTRADA_ID = ?, " .
        "  SUBCONTA_SAIDA_ID = ?, " .
        "  DATA_LANCAMENTO = ?, " .
        "  HISTORICO = ?, " .
        "  OBSERVACAO = ?, " .
        "  VALOR = ?, " .
        "  TIPO_DOCUMENTO_ID = ?, " .
        "  NUMERO_DOCUMENTO = ?, " .
        "  USUARIO_ALTERACAO_ID = ? " .
        "WHERE MOVIMENTO_ID = ? ";

        $valorSb = str_replace(',', '.',$valor);

        $valorDec =  floatval($valorSb);

        $parametros = array(
            $empresaId,
            $subcontaEntradaId,
            $subcontaSaidaId,
            DateTime::createFromFormat('d/m/Y', $data)->format('Y-m-d'),
            $historico,
            $observacao,
            $valorDec,
            $tipoDocumentoId == 0 ? null : $tipoDocumentoId,
            $numeroDocumento,
            $usuarioId,
            $movimentoId
        );

        $retorno = $conexao->insertUpdateExcluir($sql, $parametros);

        if ($retorno->houveErro) {
            return $retorno;
        }

        if($parcelaQuitar > 0){
            $retorno = ParcelaBanco::quitarParcela($conexao, $parcelaQuitar, $movimentoId,DateTime::createFromFormat('d/m/Y', $data)->format('Y-m-d'));
        }

        
        if ($retorno->houveErro) {
            return $retorno;
        }
        
        $conexao->fecharConexao();

        return $retorno;
    }

}

?>