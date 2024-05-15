<?

class CargosBanco{
    public static function getCargo($usuarioId){
        $sql = 
        "SELECT ".
        "  CAR.CARGO_ID, " .
        "  CAR.NOME, " .
        "  CAR.EMPRESA_ID, " .
        "  CAR.ADMIN, " .
        "  CAR.ATIVO, " .
        "  CAR.PERMISSAO_ID ". 

        "from CARGOS CAR ".

        "inner join FUNCIONARIOS FUN ".
        "on CAR.CARGO_ID = FUN.CARGO_ID ".

        "where FUN.USUARIO_ID = ? ";

        $conexao = new Conexao();

        $parametros = array($usuarioId);

        $conexao->novaConexao();

        $resultados = $conexao->consulta($sql, $parametros);

        foreach($resultados as $resultado) {
            $cargo = new Cargo(
                $resultado["CARGO_ID"],
                $resultado["EMPRESA_ID"],
                $resultado["PERMISSAO_ID"],
                $resultado['PROFESSOR'],
                $resultado['ATENDENTE'],
                $resultado["NOME"],
                $resultado["ADMIN"],
                $resultado["ATIVO"]
            );
        }

        return $cargo;
    }

    public static function getCargosEmpresa($empresaId, $filtrarAtivos=true){

        $cargos = [];

        $sql =
        "SELECT ".
        "  CARGO_ID, " .
        "  NOME, " .
        "  ATENDENTE, " .
        "  PROFESSOR, " .
        "  EMPRESA_ID, " .
        "  ADMIN, " .
        "  ATIVO, " .
        "  PERMISSAO_ID ". 

        "from CARGOS ".

        "where EMPRESA_ID = ? ";
        if($filtrarAtivos){
            $sql.= "AND ATIVO = 1";
        }

        $conexao = new Conexao();

        $parametros = array($empresaId);

        $conexao->novaConexao();

        $resultados = $conexao->consulta($sql, $parametros);

        foreach($resultados as $resultado) {
            $cargo = new Cargo(
                $resultado["CARGO_ID"],
                $resultado["EMPRESA_ID"],
                $resultado["PERMISSAO_ID"],
                $resultado["PROFESSOR"],
                $resultado["ATENDENTE"],
                $resultado["NOME"],
                $resultado["ADMIN"],
                $resultado["ATIVO"]
            );

            array_push($cargos, $cargo);
        }

        return $cargos;
    }

    public static function getPermissoes(){

        $permissoes = [];

        $sql = "SELECT * FROM VW_PERMISSOES ";

        $conexao = new Conexao();

        $conexao->novaConexao();

        $resultados = $conexao->consulta($sql);

        foreach($resultados as $resultado) {
       
            $permissao = new Permissoes(
                $resultado['PERMISSAO_ID'],
                $resultado['NOME']
            );

            array_push($permissoes, $permissao);
        }

        return $permissoes;
    }

    public static function insertCargo($empresaId, $usuarioId, $cargoId, $nome, $ativo, $permissaoId, $professor, $atendente){

        if($cargoId !== 0){
            return CargosBanco::updateCargo($usuarioId, $cargoId, $nome, $ativo, $permissaoId, $professor, $atendente);
        }
        else{

            $conexao = new Conexao();

            $conexao->novaConexaoPDO();
            $conexao->iniciarTranscacao();

            $sql =
            "INSERT INTO CARGOS(" .
            "  EMPRESA_ID, " .
            "  NOME, " .
            "  PERMISSAO_ID, " .
            "  PROFESSOR, " .
            "  ATENDENTE, " .
            "  USUARIO_CRIACAO_ID, " .
            "  USUARIO_ALTERACAO_ID) " .
            "VALUES (?, ?, ?, ?, ?, ?, ?) ";

            $parametros = array(
                $empresaId,
                $nome,
                $permissaoId,
                $professor,
                $atendente,
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

    private static function updateCargo($usuarioId, $cargoId, $nome, $ativo, $permissaoId, $professor, $atendente){
        $conexao = new Conexao();

        $conexao->novaConexaoPDO();
        $conexao->iniciarTranscacao();

        $sql =
        "UPDATE CARGOS SET " .
        "  NOME = ?, " .
        "  ATIVO = ?, " .
        "  PERMISSAO_ID = ?, " .
        "  PROFESSOR = ?, " .
        "  ATENDENTE = ?, " .
        "  USUARIO_ALTERACAO_ID = ? " .
        "WHERE CARGO_ID = ? ";

        $parametros = array(
            $nome,
            $ativo,
            $permissaoId,
            $professor,
            $atendente,
            $usuarioId,
            $cargoId
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