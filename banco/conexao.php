<?php

class Conexao{

    private $conexao;
    private $emUso = false;

    public function novaConexao($banco = 'gestao_empresarial') {
        $servidor = '127.0.0.1:3306';
        $usuario = 'root';
        $senha = 'root';

        $conexao = new mysqli($servidor, $usuario, $senha, $banco);

        if($conexao->connect_error) {
            die('Erro: ' . $conexao->connect_error);
        }

        $this->conexao = $conexao;
    }
    
    public function novaConexaoPDO($banco = 'gestao_empresarial') {
        $servidor = '127.0.0.1:3306';
        $usuario = 'root';
        $senha = 'root';

        try {
            $conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die('Erro: ' . $e->getMessage());
        }

        $this->conexao = $conexao;
    }    
    
    public function consulta($sql, $parametros = []){
        $this->emUso = true;
        $stmt = $this->conexao->prepare($sql);
        
        if (!empty($parametros)) {
            $stmt->bind_param(str_repeat('s', count($parametros)), ...$parametros);
            $stmt->execute();
        } else {
            $stmt->execute();
        }
    
        $registros = [];
    
        $result = $stmt->get_result();
    
        while ($row = $result->fetch_assoc()) {
            $registros[] = $row;
        }

        $this->emUso = false;
        return $registros;
    }
    
    public function iniciarTranscacao(){
        $this->conexao->beginTransaction();
        $this->emUso = true;
    }

    public function insertUpdateExcluir($sql, $parametros = [], $versql=false) {
        $retorno = new RetornoSql();
        $retorno->sql = $sql." - ".json_encode($parametros);
        $this->emUso = true;

        try {

            $stmt = $this->conexao->prepare($sql);

            if (!empty($parametros)) {
                $i = 1;
                foreach ($parametros as $parametro) {
                    $stmt->bindValue($i, $parametro);
                    $i++;
                }
            }

            $stmt->execute();

            $retorno->dados = $this->conexao->lastInsertId();
            $retorno->houveErro = false;
            $retorno->mensagem = "Sucesso";
            
            
        } catch (PDOException $e) {
            $this->conexao->rollBack(); 
            $mensagemCompleta = $e->getMessage();
            $posicaoInicio = strpos($mensagemCompleta, "|");
            $mensagem = substr($mensagemCompleta, $posicaoInicio + 1);

            $retorno->houveErro = true;
            $retorno->mensagem = $versql ? $mensagem . "SQL : " . $sql . "PARAMS: " . json_encode($parametros) : $mensagem;
        }

        return $retorno;
    }

    public function executarProcedure($nomeProcedure, $parametros = []) { 
        $retorno = new RetornoSql();

        $sql = "CALL $nomeProcedure(";
        $placeholders = [];

        try{
            if (!empty($parametros)) {
                $placeholders = array_fill(0, count($parametros), '?');
                $sql .= implode(',', $placeholders);
            }

            $sql .= ")";
            
            $retorno->sql = $sql;

            $stmt = $this->conexao->prepare($sql);

            if (!empty($parametros)) {
                $i = 1;
                foreach ($parametros as $parametro) {
                    $stmt->bindValue($i, $parametro);
                    $i++;
                }
            }

            $stmt->execute();

            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $retorno->dados = $resultado;
        }
        catch(Exception $e){
            $mensagemCompleta = $e->getMessage();
            $posicaoInicio = strpos($mensagemCompleta, "|");
            $mensagem = substr($mensagemCompleta, $posicaoInicio + 1);

            $retorno->houveErro = true;
            $retorno->mensagem = $mensagem;
        }

        return $retorno;
    }

    public function colunaIn($coluna, $lista){
        $sql = $coluna. " IN ( ";

        foreach($lista as $item){
            if($item == $lista[sizeof($lista) - 1]){
                $sql.= "?) ";
            }
            else{
                $sql.= "?, ";
            }
        }

        return $sql;

    }

    public function fecharConexao(){
        $this->conexao->commit();
    }

    public function reverter(){
        $this->conexao->rollBack(); 
    }

    public function matarConexao(){
        $this->conexao->close();
    }

    public function matarConexaoPDO(){
        $this->conexao = null;
    }

    public function reservarConexao(){
        $this->emUso = true;
    }
 
    public function liberarConexao(){
        $this->emUso = false;
    }

    public function isEmUso(){
        return $this->emUso;
    }
}
