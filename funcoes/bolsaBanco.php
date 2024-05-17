<?

class BolsaBanco{
    
    public static function getBolsas($empresaId, $filtrarAtivos=true){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  BOLSA_ID, " .
            "  EMPRESA_ID, " .
            "  ATIVO, " .
            "  PERCENTUAL_DESCONTO, " .
            "  NECESSITA_AUT_SUP, " .
            "  NOME ".

            "FROM BOLSAS " .

            "WHERE EMPRESA_ID = ? ";
        if($filtrarAtivos){
            $sql.="AND ATIVO = 1 ";
        }

        array_push($parametros, $empresaId);
    
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
    
            array_push($bolsas, $bolsa);
        }
    
        return $bolsas;
    }

    public static function getBolsaPorId($bolsaId){

        $parametros = [];

        $conexao = new Conexao();
    
        $conexao->novaConexao();
    
        $sql =
            "SELECT " .
            "  BOLSA_ID, " .
            "  EMPRESA_ID, " .
            "  ATIVO, " .
            "  PERCENTUAL_DESCONTO, " .
            "  NECESSITA_AUT_SUP, " .
            "  NOME ".

            "FROM BOLSAS " .

            "WHERE BOLSA_ID = ? ";

        array_push($parametros, $bolsaId);
    
        $resultados = $conexao->consulta($sql, $parametros);
    
        foreach ($resultados as $resultado) {

            $bolsa =  new Bolsa(
                $resultado['BOLSA_ID'],
                $resultado['EMPRESA_ID'],
                $resultado['NOME'],
                $resultado['ATIVO'],
                $resultado['PERCENTUAL_DESCONTO'],
                $resultado['NECESSITA_AUT_SUP']
            );
            
        }
    
        return $bolsa;
    }


    public static function getBolsaPorCursoId($cursoId){

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

            "FROM BOLSAS BOL " .

            "INNER JOIN BOLSAS_CURSOS BSC " .
            "ON BOL.BOLSA_ID = BSC.BOLSA_ID " .

            "WHERE BSC.CURSO_ID = ? ".
            "AND BOL.ATIVO = 1 ";

        array_push($parametros, $cursoId);
    
        $resultados = $conexao->consulta($sql, $parametros);
    
        $bolsas = [];
    
        foreach ($resultados as $resultado) {

            $bolsa = new Bolsa(
                $resultado['BOLSA_ID'],
                $resultado['EMPRESA_ID'],
                $resultado['NOME'],
                $resultado['ATIVO'],
                $resultado['PERCENTUAL_DESCONTO'],
                $resultado['NECESSITA_AUT_SUP']
            );
            array_push($bolsas, $bolsa);
        }
    
        return $bolsas;
    }



    public static function insertBolsa($empresaId, $usuarioId, $bolsaId, $nome, $ativo, $percDesconto, $autSup){

        $valorSb = str_replace('.', '',$percDesconto);
        $valorSb = str_replace(',', '.',$valorSb);
        
        $valorDec =  floatval($valorSb);

        if($bolsaId !== 0){
            return BolsaBanco::updateBolsa($usuarioId, $bolsaId, $nome, $ativo, $valorDec, $autSup);
        }
        else{

            $conexao = new Conexao();

            $conexao->novaConexaoPDO();
            $conexao->iniciarTranscacao();

            $sql =
            "INSERT INTO BOLSAS(" .
            "  EMPRESA_ID, " .
            "  NOME, " .
            "  PERCENTUAL_DESCONTO, " .
            "  NECESSITA_AUT_SUP, " .
            "  USUARIO_CRIACAO_ID, " .
            "  USUARIO_ALTERACAO_ID) " .
            "VALUES (?, ?, ?, ?, ?, ?) ";

            $parametros = array(
                $empresaId,
                $nome,
                $valorDec,
                $autSup,
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

    private static function updateBolsa($usuarioId, $bolsaId, $nome, $ativo, $percDesconto, $autSup){
        $conexao = new Conexao();

        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();

        $sql =
        "UPDATE BOLSAS SET " .
        "  NOME = ?, " .
        "  ATIVO = ?, " .
        "  PERCENTUAL_DESCONTO = ?, " .
        "  NECESSITA_AUT_SUP = ?, " .
        "  USUARIO_ALTERACAO_ID = ? " .
        "WHERE BOLSA_ID = ? ";

        $parametros = array(
            $nome,
            $ativo,
            $percDesconto,
            $autSup,
            $usuarioId,
            $bolsaId
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