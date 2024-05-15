<?

class TipoPagamentoBanco{

    public static function getTipoPagamentos($empresaId, $filtrarAtivos=true){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  EMPRESA_ID, " .
            "  TIPO_PAGAMENTO_ID, " .
            "  ATIVO, " .
            "  NOME, ".
            "  VALOR_SALARIO, " .
            "  VALOR_HORA, " .
            "  PERCENTUAL_INSS " .

            "FROM TIPO_PAGAMENTOS " .

            "WHERE EMPRESA_ID = ? ";

        if($filtrarAtivos){
            $sql .= "AND ATIVO = 1";
        }

        array_push($parametros, $empresaId);
    
        $resultados = $conexao->consulta($sql, $parametros);
    
        $pagamentos = [];
    
        foreach ($resultados as $resultado) {

            if($resultado['VALOR_SALARIO'] != "0.00"){
                $mensalista = new Mensalista(
                    $resultado['TIPO_PAGAMENTO_ID'],
                    $resultado['NOME'],
                    $resultado['EMPRESA_ID'],
                    $resultado['ATIVO'],
                    $resultado['VALOR_SALARIO'],
                    $resultado['PERCENTUAL_INSS']
                );

                array_push($pagamentos, $mensalista);
            }
            else if($resultado['VALOR_HORA'] != "0.00"){
                $horista = new Horista(
                    $resultado['TIPO_PAGAMENTO_ID'],
                    $resultado['NOME'],
                    $resultado['EMPRESA_ID'],
                    $resultado['ATIVO'],
                    $resultado['VALOR_HORA']
                );

                array_push($pagamentos, $horista);
            }
    
           
        }
    
        return $pagamentos;
    }

    public static function insertTipoPagamento($empresaId, $usuarioId, $tipoPagamentoId, $nome, $ativo, $valorSalario, $percentualInss, $valorHora){

        if($tipoPagamentoId !== 0){
            return TipoPagamentoBanco::updateTipoPagamento($usuarioId, $tipoPagamentoId, $nome, $ativo, $valorSalario, $percentualInss, $valorHora);
        }
        else{

            $conexao = new Conexao();

            $conexao->novaConexaoPDO();
            $conexao->iniciarTranscacao();

            $sql =
            "INSERT INTO TIPO_PAGAMENTOS(" .
            "  EMPRESA_ID, " .
            "  NOME, " .
            "  VALOR_SALARIO, " .
            "  PERCENTUAL_INSS, " .
            "  VALOR_HORA, " .
            "  USUARIO_CRIACAO_ID, " .
            "  USUARIO_ALTERACAO_ID) " .
            "VALUES (?, ?, ?, ?, ?, ?, ?) ";

            $valorSbSalario = str_replace('.', '',$valorSalario);
            $valorSbSalario = str_replace(',', '.',$valorSbSalario);
            
            $valorDecSalario =  floatval($valorSbSalario);

            $valorSbInss = str_replace('.', '',$percentualInss);
            $valorSbInss = str_replace(',', '.',$valorSbInss);
            
            $valorDecInss =  floatval($valorSbInss);

            $valorSbHora = str_replace('.', '',$valorHora);
            $valorSbHora = str_replace(',', '.',$valorSbHora);
            
            $valorDecHora =  floatval($valorSbHora);

            $parametros = array(
                $empresaId,
                $nome,
                $valorDecSalario, 
                $valorDecInss, 
                $valorDecHora,
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

    private static function updateTipoPagamento($usuarioId, $grupoId, $nome, $ativo, $valorSalario, $percentualInss, $valorHora){
        $conexao = new Conexao();

        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();

        $sql =
        "UPDATE TIPO_PAGAMENTOS SET " .
        "  NOME = ?, " .
        "  ATIVO = ?, " .
        "  VALOR_SALARIO = ?, " .
        "  PERCENTUAL_INSS = ?, " .
        "  VALOR_HORA = ?, " .
        "  USUARIO_ALTERACAO_ID = ? " .
        "WHERE TIPO_PAGAMENTO_ID = ? ";

        $valorSbSalario = str_replace('.', '',$valorSalario);
        $valorSbSalario = str_replace(',', '.',$valorSbSalario);
        
        $valorDecSalario =  floatval($valorSbSalario);

        $valorSbInss = str_replace('.', '',$percentualInss);
        $valorSbInss = str_replace(',', '.',$valorSbInss);
        
        $valorDecInss =  floatval($valorSbInss);

        $valorSbHora = str_replace('.', '',$valorHora);
        $valorSbHora = str_replace(',', '.',$valorSbHora);
                    
        $valorDecHora =  floatval($valorSbHora);

        $parametros = array(
            $nome,
            $ativo,
            $valorDecSalario, 
            $valorDecInss, 
            $valorDecHora,
            $usuarioId,
            $grupoId
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