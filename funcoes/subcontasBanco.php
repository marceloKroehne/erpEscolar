<?

class SubcontasBanco{

    public static function insertSubconta($usuarioId, $subcontaId, $bancoId, $agencia, $numeroConta, $grupoContaId, $nome, $tipo, $ativo){

        if($subcontaId !== 0){
            return SubcontasBanco::updateSubconta($usuarioId, $subcontaId, $bancoId, $agencia, $numeroConta, $grupoContaId, $nome, $tipo, $ativo);
        }
        else{

            $conexao = new Conexao();

            $conexao->novaConexaoPDO();
            $conexao->iniciarTranscacao();

            $sql =
            "INSERT INTO SUBCONTAS(" .
            "  BANCO_ID, ".
            "  AGENCIA, ".
            "  NUMERO_CONTA, " .
            "  GRUPO_CONTA_ID, ".
            "  TIPO, ".
            "  NOME, " .
            "  USUARIO_CRIACAO_ID, " .
            "  USUARIO_ALTERACAO_ID) " .
            "VALUES (?, ?, ?, ?, ?, ?, ?, ?) ";

            $parametros = array(
                $bancoId == 0 ? null : $bancoId, 
                $agencia == 0 ? null : $agencia, 
                $numeroConta == 0 ? null : $numeroConta,
                $grupoContaId,
                $tipo,
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



    public static function getSubcontas($empresaId, $filtrarAtivos=true){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  SUB.SUBCONTA_ID, " .
            "  SUB.GRUPO_CONTA_ID, " .
            "  SUB.TIPO, " .
            "  SUB.BANCO_ID, " .
            "  SUB.AGENCIA, " .
            "  SUB.NUMERO_CONTA, " .
            "  SUB.NOME AS NOME_SUBCONTA, ".
            "  SUB.ATIVO AS SUBCONTA_ATIVO, ".
            "  GRP.EMPRESA_ID, " .
            "  GRP.ATIVO AS GRUPO_ATIVO, " .
            "  GRP.RECEBIMENTO_VENDAS, " .
            "  GRP.NOME AS NOME_GRUPO_CONTA " .

            "FROM SUBCONTAS SUB " .

            "INNER JOIN GRUPOS_CONTAS GRP ".
            "ON SUB.GRUPO_CONTA_ID = GRP.GRUPO_CONTA_ID ".

            "WHERE GRP.EMPRESA_ID = ? ";

        if($filtrarAtivos){
            $sql.="AND SUB.ATIVO = 1 ";
        }
        
        $sql.="ORDER BY GRP.GRUPO_CONTA_ID ";

        array_push($parametros, $empresaId);
    
        $resultados = $conexao->consulta($sql, $parametros);
    
        $subcontas = [];
    
        foreach ($resultados as $resultado) {

            $conta = ContasBancoBanco::getContaBancoId($resultado['BANCO_ID'],$resultado['AGENCIA'], $resultado['NUMERO_CONTA']);

            if($conta == null){
                $conta = new Conta(new Banco(null,null,null,null,null, null),null,null,null);
            }

            $subconta =  new Subconta(
                $resultado['SUBCONTA_ID'],
                new GrupoContas(
                    $resultado['GRUPO_CONTA_ID'],
                    $resultado['EMPRESA_ID'],
                    $resultado['NOME_GRUPO_CONTA'],
                    $resultado['GRUPO_ATIVO'],
                    $resultado['RECEBIMENTO_VENDAS']
                ),
                $conta,
                $resultado['TIPO'],
                $resultado['NOME_SUBCONTA'],
                $resultado['SUBCONTA_ATIVO']
            );
    
            array_push($subcontas, $subconta);
        }
    
        return $subcontas;
    }

    public static function getSubcontaPorId($subcontaId){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  SUB.SUBCONTA_ID, " .
            "  SUB.GRUPO_CONTA_ID, " .
            "  SUB.TIPO, " .
            "  SUB.BANCO_ID, " .
            "  SUB.AGENCIA, " .
            "  SUB.NUMERO_CONTA, " .
            "  SUB.NOME AS NOME_SUBCONTA, ".
            "  SUB.ATIVO AS SUBCONTA_ATIVO, ".
            "  GRP.EMPRESA_ID, " .
            "  GRP.ATIVO AS GRUPO_ATIVO, " .
            "  GRP.RECEBIMENTO_VENDAS, " .
            "  GRP.NOME AS NOME_GRUPO_CONTA " .

            "FROM SUBCONTAS SUB " .

            "INNER JOIN GRUPOS_CONTAS GRP ".
            "ON SUB.GRUPO_CONTA_ID = GRP.GRUPO_CONTA_ID ".

            "WHERE SUB.SUBCONTA_ID = ? ";

        array_push($parametros, $subcontaId);
    
        $resultados = $conexao->consulta($sql, $parametros);
    
        foreach ($resultados as $resultado) {

            $conta = ContasBancoBanco::getContaBancoId($resultado['BANCO_ID'],$resultado['AGENCIA'], $resultado['NUMERO_CONTA']);

            if($conta == null){
                $conta = new Conta(new Banco(null,null,null,null,null, null),null,null,null);
            }

            $subconta =  new Subconta(
                $resultado['SUBCONTA_ID'],
                new GrupoContas(
                    $resultado['GRUPO_CONTA_ID'],
                    $resultado['EMPRESA_ID'],
                    $resultado['NOME_GRUPO_CONTA'],
                    $resultado['GRUPO_ATIVO'],
                    $resultado['RECEBIMENTO_VENDAS']
                ),
                $conta,
                $resultado['TIPO'],
                $resultado['NOME_SUBCONTA'],
                $resultado['SUBCONTA_ATIVO']
            );
    
        }
    
        return $subconta;
    }

    public static function getSubcontaPorBanco($bancoId, $agencia, $numeroConta){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  SUB.SUBCONTA_ID, " .
            "  SUB.GRUPO_CONTA_ID, " .
            "  SUB.TIPO, " .
            "  SUB.BANCO_ID, " .
            "  SUB.AGENCIA, " .
            "  SUB.NUMERO_CONTA, " .
            "  SUB.NOME AS NOME_SUBCONTA, ".
            "  SUB.ATIVO AS SUBCONTA_ATIVO, ".
            "  GRP.EMPRESA_ID, " .
            "  GRP.ATIVO AS GRUPO_ATIVO, " .
            "  GRP.RECEBIMENTO_VENDAS, " .
            "  GRP.NOME AS NOME_GRUPO_CONTA " .

            "FROM SUBCONTAS SUB " .

            "INNER JOIN GRUPOS_CONTAS GRP ".
            "ON SUB.GRUPO_CONTA_ID = GRP.GRUPO_CONTA_ID ".

            "WHERE SUB.BANCO_ID = ? ".
            "AND SUB.AGENCIA = ? ".
            "AND SUB.NUMERO_CONTA = ? ";

        array_push($parametros, $bancoId, $agencia, $numeroConta);
    
        $resultados = $conexao->consulta($sql, $parametros);
    
        foreach ($resultados as $resultado) {

            $conta = ContasBancoBanco::getContaBancoId($resultado['BANCO_ID'],$resultado['AGENCIA'], $resultado['NUMERO_CONTA']);

            if($conta == null){
                $conta = new Conta(new Banco(null,null,null,null,null, null),null,null,null);
            }

            $subconta =  new Subconta(
                $resultado['SUBCONTA_ID'],
                new GrupoContas(
                    $resultado['GRUPO_CONTA_ID'],
                    $resultado['EMPRESA_ID'],
                    $resultado['NOME_GRUPO_CONTA'],
                    $resultado['GRUPO_ATIVO'],
                    $resultado['RECEBIMENTO_VENDAS']
                ),
                $conta,
                $resultado['TIPO'],
                $resultado['NOME_SUBCONTA'],
                $resultado['SUBCONTA_ATIVO']
            );
    
        }
    
        return $subconta;
    }



    private static function updateSubconta($usuarioId, $subcontaId, $bancoId, $agencia, $numeroConta, $grupoContaId, $nome, $tipo, $ativo){
        $conexao = new Conexao();

        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();

        $sql =
        "UPDATE SUBCONTAS SET " .
        "  GRUPO_CONTA_ID = ?, " .
        "  BANCO_ID = ?, " .
        "  AGENCIA = ?, " .
        "  NUMERO_CONTA = ?, ".
        "  TIPO = ?, " .
        "  NOME = ?, " .
        "  ATIVO = ?, ".
        "  USUARIO_ALTERACAO_ID = ? " .
        "WHERE SUBCONTA_ID = ? ";

        $parametros = array(
            $grupoContaId,
            $bancoId == 0 ? null : $bancoId, 
            $agencia == 0 ? null : $agencia, 
            $numeroConta == 0 ? null : $numeroConta,
            $tipo,
            $nome,
            $ativo,
            $usuarioId,
            $subcontaId
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