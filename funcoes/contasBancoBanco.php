<?

class ContasBancoBanco{

    public static function insertContaBanco($usuarioId, $bancoIdAnt, $agenciaAnt, $numeroContaAnt, $bancoId, $agencia, $numeroConta, $ativo){

        if($bancoIdAnt !== 0 && $agenciaAnt !== 0 && $numeroContaAnt !==0){
            return ContasBancoBanco::updateContaBanco($usuarioId, $bancoIdAnt, $agenciaAnt, $numeroContaAnt, $bancoId, $agencia, $numeroConta, $ativo);
        }
        else{

            $conexao = new Conexao();

            $conexao->novaConexaoPDO();
            $conexao->iniciarTranscacao();

            $sql =
            "INSERT INTO CONTAS_BANCOS(" .
            "  BANCO_ID, ".
            "  AGENCIA, ".
            "  NUMERO_CONTA, " .
            "  USUARIO_CRIACAO_ID, " .
            "  USUARIO_ALTERACAO_ID) " .
            "VALUES (?, ?, ?, ?, ?) ";

            $parametros = array(
                $bancoId,
                $agencia,
                $numeroConta,
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

    public static function getConta($bancoId, $agencia, $numeroConta){

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  CBN.BANCO_ID, " .
            "  CBN.AGENCIA, " .
            "  CBN.NUMERO_CONTA, " .
            "  CBN.ATIVO AS CONTA_ATIVO, " .
            "  BNC.BANCO_ID, " .
            "  BNC.NUMERO_BANCO, " .
            "  BNC.NOME, " .
            "  BNC.EXIGE_OFX, " .
            "  BNC.ATIVO AS BANCO_ATIVO, " .
            "  BNC.EMPRESA_ID " .

            "FROM CONTAS_BANCOS CBN " .

            "INNER JOIN BANCOS BNC ".
            "ON CBN.BANCO_ID = BNC.BANCO_ID ".

            "WHERE BNC.NUMERO_BANCO = ? ".
            "AND CBN.AGENCIA = ? ".
            "AND CBN.NUMERO_CONTA = ? ";

        $parametros = array($bancoId, $agencia, $numeroConta);
    
        $resultados = $conexao->consulta($sql, $parametros);
    
        foreach ($resultados as $resultado) {

            $contaBanco =  new Conta(
                new Banco(
                    $resultado['BANCO_ID'],
                    $resultado['NUMERO_BANCO'],
                    $resultado['EMPRESA_ID'],
                    $resultado['NOME'],
                    $resultado['EXIGE_OFX'],
                    $resultado['BANCO_ATIVO']
                ),
                $resultado['AGENCIA'],
                $resultado['NUMERO_CONTA'],
                $resultado['CONTA_ATIVO']
            );

        }
    
        return $contaBanco;
    }

    public static function getContaBancoId($bancoId, $agencia, $numeroConta){

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  CBN.BANCO_ID, " .
            "  CBN.AGENCIA, " .
            "  CBN.NUMERO_CONTA, " .
            "  CBN.ATIVO AS CONTA_ATIVO, " .
            "  BNC.BANCO_ID, " .
            "  BNC.NUMERO_BANCO, " .
            "  BNC.NOME, " .
            "  BNC.EXIGE_OFX, " .
            "  BNC.ATIVO AS BANCO_ATIVO, " .
            "  BNC.EMPRESA_ID " .

            "FROM CONTAS_BANCOS CBN " .

            "INNER JOIN BANCOS BNC ".
            "ON CBN.BANCO_ID = BNC.BANCO_ID ".

            "WHERE BNC.BANCO_ID = ? ".
            "AND CBN.AGENCIA = ? ".
            "AND CBN.NUMERO_CONTA = ? ";

        $parametros = array($bancoId, $agencia, $numeroConta);
    
        $resultados = $conexao->consulta($sql, $parametros);
    
        foreach ($resultados as $resultado) {

            $contaBanco =  new Conta(
                new Banco(
                    $resultado['BANCO_ID'],
                    $resultado['NUMERO_BANCO'],
                    $resultado['EMPRESA_ID'],
                    $resultado['NOME'],
                    $resultado['EXIGE_OFX'],
                    $resultado['BANCO_ATIVO']
                ),
                $resultado['AGENCIA'],
                $resultado['NUMERO_CONTA'],
                $resultado['CONTA_ATIVO']
            );

        }
    
        return $contaBanco;
    }



    public static function getContasBanco($empresaId, $filtrarAtivos=true){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  CBN.BANCO_ID, " .
            "  CBN.AGENCIA, " .
            "  CBN.NUMERO_CONTA, " .
            "  CBN.ATIVO AS CONTA_ATIVO, " .
            "  BNC.BANCO_ID, " .
            "  BNC.NUMERO_BANCO, " .
            "  BNC.NOME, " .
            "  BNC.EXIGE_OFX, " .
            "  BNC.ATIVO AS BANCO_ATIVO, " .
            "  BNC.EMPRESA_ID " .

            "FROM CONTAS_BANCOS CBN " .

            "INNER JOIN BANCOS BNC ".
            "ON CBN.BANCO_ID = BNC.BANCO_ID ".

            "WHERE BNC.EMPRESA_ID = ? ";
        if($filtrarAtivos){
            $sql .= "AND CBN.ATIVO = 1";
        }

        array_push($parametros, $empresaId);
    
        $resultados = $conexao->consulta($sql, $parametros);
    
        $contasBancos = [];
    
        foreach ($resultados as $resultado) {

            $contaBanco =  new Conta(
                new Banco(
                    $resultado['BANCO_ID'],
                    $resultado['NUMERO_BANCO'],
                    $resultado['EMPRESA_ID'],
                    $resultado['NOME'],
                    $resultado['EXIGE_OFX'],
                    $resultado['BANCO_ATIVO']
                ),
                $resultado['AGENCIA'],
                $resultado['NUMERO_CONTA'],
                $resultado['CONTA_ATIVO']
            );
    
            array_push($contasBancos, $contaBanco);
        }
    
        return $contasBancos;
    }


    private static function updateContaBanco($usuarioId, $bancoIdAnt, $agenciaAnt, $numeroContaAnt, $bancoId, $agencia, $numeroConta, $ativo){
        $conexao = new Conexao();

        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();

        $sql =
        "UPDATE CONTAS_BANCOS SET " .
        "  BANCO_ID = ?, " .
        "  AGENCIA = ?, " .
        "  NUMERO_CONTA = ?, " .
        "  ATIVO = ?, " .
        "  USUARIO_ALTERACAO_ID = ? " .
        "WHERE BANCO_ID = ? ".
        "AND AGENCIA = ? ".
        "AND NUMERO_CONTA = ? ";

        $parametros = array(
            $bancoId,
            $agencia,
            $numeroConta,
            $ativo,
            $usuarioId,
            $bancoIdAnt,
            $agenciaAnt,
            $numeroContaAnt
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