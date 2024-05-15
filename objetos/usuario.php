<?php

class Usuario{

    private $usuarioId;
    private $ativo;
    private $empresaId;
    private $nome;
    private $email;
    private $cpf;
    private $rg;
    private $telefone;
    private $cep;
    private $logradouro;
    private $numero;
    private $complemento;
    private $bairro;
    private $cidade;
    private $uf;

    function __construct(
        $usuarioId, 
        $ativo,
        $empresaId, 
        $nome, 
        $email, 
        $cpf, 
        $rg, 
        $telefone,
        $cep, 
        $logradouro, 
        $numero, 
        $complemento,
        $bairro, 
        $cidade, 
        $uf
    ){
        $this->usuarioId = $usuarioId;
        $this->ativo = $ativo;
        $this->empresaId = $empresaId;
        $this->nome = $nome;
        $this->email = $email;
        $this->cpf = $cpf;
        $this->rg = $rg;
        $this->telefone = $telefone;
        $this->cep = $cep;
        $this->logradouro = $logradouro;
        $this->numero = $numero;
        $this->complemento = $complemento;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->uf = $uf;
    }

    public function getUsuarioId(){
        return $this->usuarioId;
    }
    public function isAtivo(){
        return $this->ativo;
    }

    public function getEmpresaId(){
        return $this->empresaId;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getEmail(){
        return $this->email;
    }
    public function getCpf(){
        return $this->cpf;
    }
    public function getRg(){
        return $this->rg;
    }
    public function getCep(){
        return $this->cep;
    }
    public function getlogradouro(){
        return $this->logradouro;
    }
    public function getNumero(){
        return $this->numero;
    }
    public function getComplemento(){
        return $this->complemento;
    }
    public function getBairro(){
        return $this->bairro;
    }
    public function getCidade(){
        return $this->cidade;
    }
    public function getUf(){
        return $this->uf;
    }
    public function getTelefone(){
        return $this->telefone;
    }

    public function toJson() {
        return json_encode([
            'usuarioId' => $this->usuarioId,
            'ativo' => $this->ativo,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'rg' => $this->rg,
            'cep' => $this->cep,
            'logradouro' => $this->logradouro,
            'numero' => $this->numero,
            'complemento' => $this->complemento,
            'bairro' => $this->bairro,
            'cidade' => $this->cidade,
            'uf' => $this->uf,
            'telefone' => $this->telefone
        ]);
    }

    public function toJsonSemAspas() {
        return [
            'usuarioId' => $this->usuarioId,
            'ativo' => $this->ativo,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'rg' => $this->rg,
            'cep' => $this->cep,
            'logradouro' => $this->logradouro,
            'numero' => $this->numero,
            'complemento' => $this->complemento,
            'bairro' => $this->bairro,
            'cidade' => $this->cidade,
            'uf' => $this->uf,
            'telefone' => $this->telefone
        ];
    }
    

}