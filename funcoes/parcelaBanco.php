<?

class ParcelaBanco{
    
    public static function getParcelas($contratoId){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  PARCELA_ID, " .
            "  NOME, " .
            "  VALOR, " .
            "  STATUS_PAGAMENTO, " .
            "  CONTRATO_ID, " .
            "  MOVIMENTO_ID, " .
            "  BANCO_ID, " .
            "  AGENCIA, " .
            "  NUMERO_CONTA, " .
            "  SUBCONTA_ID, " .
            "  DATA_PAGAMENTO ".

            "FROM PARCELAS  ".

            "WHERE CONTRATO_ID = ? ";

        array_push($parametros, $contratoId);
    
        $resultados = $conexao->consulta($sql, $parametros);
    
        $parcelas = [];
    
        foreach ($resultados as $resultado) {
            $movimento = new Movimento(
                null,
                null,
                new Conta(
                    new Banco(
                        null,
                        null,
                        null,
                        null,
                        null,
                        null
                    ),
                    null,
                    null,
                    null
                ),
                new Subconta(null, new GrupoContas(null, null, null, null, null), null, null, null),
                null,
                null,
                null,
                null,
                null,
                new TipoDocumento(null, null, null, null),
                null
            );
            if($resultado['MOVIMENTO_ID'] != null){
                $movimento = MovimentoBanco::getMovimentoPorId($resultado['MOVIMENTO_ID']);
            }

            $conta = new Conta(
                new Banco(null, null,null,null,null,null),
                null,
                null,
                null
            );

            $subconta = new Subconta(
                null,
                new GrupoContas(
                    null,
                    null,
                    null,
                    null,
                    null
                ),
                null,
                null,
                null
            );

            if($resultado['BANCO_ID'] != null){
                $conta = ContasBancoBanco::getContaBancoId($resultado['BANCO_ID'],$resultado['AGENCIA'],$resultado['NUMERO_CONTA']);
            }
            
            if($resultado['SUBCONTA_ID'] != null){
                $subconta = SubcontasBanco::getSubcontaPorId($resultado['SUBCONTA_ID']);
            }
           
            $contrato = ContratoBanco::getContratoPorId($resultado['CONTRATO_ID']);

            $dataPagamento = null;

            if($resultado['DATA_PAGAMENTO'] != null){
                $dataPagamento = DateTime::createFromFormat('Y-m-d', $resultado['DATA_PAGAMENTO'])->format('d/m/Y');
            }

            $parcela =  new Parcela(
                $resultado['PARCELA_ID'],
                $resultado['NOME'],
                $resultado['VALOR'],
                $resultado['STATUS_PAGAMENTO'],
                $movimento,
                $contrato,
                $dataPagamento,
                $conta,
                $subconta
            );
    
            array_push($parcelas, $parcela);
        }
    
        return $parcelas;
    }

    public static function deletarParcela($parcelaId){
        
        $conexao = new Conexao();

        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();

        $sql ="DELETE FROM PARCELAS WHERE PARCELA_ID = ? ";

        $parametros = array($parcelaId);

        $retorno = $conexao->insertUpdateExcluir($sql, $parametros);

        if ($retorno->houveErro) {
            return $retorno;
        }

        $conexao->fecharConexao();

        return $retorno;
    }

    public static function insertParcela(
        $usuarioId, 
        $parcelaId, 
        $nome,
        $valor, 
        $movimentoId, 
        $contrato, 
        $dataPagamento,
        $quitar,
        $conta,
        $subconta
    ){
              
        $valorSb = str_replace('.', '',$valor);
        $valorSb = str_replace(',', '.',$valorSb);
        
        $valorDec =  floatval($valorSb);

        $statusPagamento = $quitar == 1 ? 1 : 0;

        if($parcelaId !== 0){
            return ParcelaBanco::updateParcela(
                $conta,
                $subconta,
                $usuarioId, 
                $parcelaId, 
                $nome,
                $valorDec, 
                $statusPagamento, 
                $movimentoId, 
                $contrato, 
                $dataPagamento
            );
        }
        else{

            $conexao = new Conexao();

            $conexao->novaConexaoPDO();
            $conexao->iniciarTranscacao();

            $sql =
            "INSERT INTO PARCELAS(" .
            "  NOME, " .
            "  VALOR, " .
            "  STATUS_PAGAMENTO, " .
            "  MOVIMENTO_ID, " .
            "  CONTRATO_ID, " .
            "  DATA_PAGAMENTO, " .
            "  BANCO_ID, " .
            "  AGENCIA, " .
            "  NUMERO_CONTA, " .
            "  SUBCONTA_ID, " .
            "  USUARIO_CRIACAO_ID, " .
            "  USUARIO_ALTERACAO_ID) " .
            "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ";

            $parametros = array(
                $nome,
                $valorDec,
                $statusPagamento,
                $movimentoId == 0 ? null : $movimentoId,
                $contrato->contratoId,
                $dataPagamento == null ? null : DateTime::createFromFormat('d/m/Y', $dataPagamento)->format('Y-m-d'),
                $conta->banco->bancoId == null ? null : $conta->banco->bancoId,
                $conta->agencia == null ? null : $conta->agencia,
                $conta->numeroConta == null ? null :  $conta->numeroConta,
                $subconta->subcontaId == null ? null : $subconta->subcontaId,
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

    private static function updateParcela(
        $conta,
        $subconta,
        $usuarioId, 
        $parcelaId, 
        $nome,
        $valor, 
        $statusPagamento, 
        $movimentoId, 
        $contrato, 
        $dataPagamento
    ){
        $conexao = new Conexao();

        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();

        $sql =
        "UPDATE PARCELAS SET " .
        "  NOME = ?, " .
        "  VALOR = ?, " .
        "  STATUS_PAGAMENTO = ?, " .
        "  MOVIMENTO_ID = ?, " .
        "  CONTRATO_ID = ?, " .
        "  DATA_PAGAMENTO = ?, " .
        "  BANCO_ID = ?, " .
        "  AGENCIA = ?, " .
        "  NUMERO_CONTA = ?, " .
        "  SUBCONTA_ID = ?, " .
        "  USUARIO_ALTERACAO_ID = ? " .
        "WHERE PARCELA_ID = ? ";

        $parametros = array(
            $nome,
            $valor, 
            $statusPagamento, 
            $movimentoId == 0 ? null : $movimentoId, 
            $contrato->contratoId, 
            $dataPagamento == null ? null : DateTime::createFromFormat('d/m/Y', $dataPagamento)->format('Y-m-d'),
            $conta->banco->bancoId == null ? null : $conta->banco->bancoId,
            $conta->agencia == null ? null : $conta->agencia,
            $conta->numeroConta == null ? null :  $conta->numeroConta,
            $subconta->subcontaId == null ? null : $subconta->subcontaId,
            $usuarioId, 
            $parcelaId
        );

        $retorno = $conexao->insertUpdateExcluir($sql, $parametros, true);

        if ($retorno->houveErro) {
            return $retorno;
        }

        $conexao->fecharConexao();

        return $retorno;
    }
}

?>