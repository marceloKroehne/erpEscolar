<?php

class Empresa{

    private $empresaId;
    private $nomeRazaoSocial;
    private $empresaEmail;
    private $empresaCpfCnpj;
    private $cep;
    private $logradouro;
    private $numero;
    private $complemento;
    private $bairro;
    private $cidade;
    private $uf;
    private $empresaTelefone;

    function __construct(
        $empresaId, 
        $nomeRazaoSocial, 
        $empresaEmail, 
        $empresaCpfCnpj, 
        $cep, 
        $logradouro, 
        $numero, 
        $complemento,
        $bairro, 
        $cidade, 
        $uf, 
        $empresaTelefone
    ){
        $this->empresaId = $empresaId;
        $this->nomeRazaoSocial = $nomeRazaoSocial;
        $this->empresaEmail = $empresaEmail;
        $this->empresaCpfCnpj = $empresaCpfCnpj;
        $this->cep = $cep;
        $this->logradouro = $logradouro;
        $this->numero = $numero;
        $this->complemento = $complemento;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->uf = $uf;
        $this->empresaTelefone = $empresaTelefone;
    }

    public function getEmpresaId(){
        return $this->empresaId;
    }

    public function getNomeRazaoSocial(){
        return $this->nomeRazaoSocial;
    }

    public function getEmailEmpresa(){
        return $this->empresaEmail;
    }
    public function getCpfCnpjEmpresa(){
        return $this->empresaCpfCnpj;
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

    public function getTelefoneEmpresa(){
        return $this->empresaTelefone;
    }

    public function toJson() {
        return json_encode([
            'empresaId' => $this->empresaId,
            'nomeRazaoSocial' => $this->nomeRazaoSocial,
            'empresaEmail' => $this->empresaEmail,
            'empresaCpfCnpj' => $this->empresaCpfCnpj,
            'cep' => $this->cep,
            'logradouro' => $this->logradouro,
            'numero' => $this->numero,
            'complemento' => $this->complemento,
            'bairro' => $this->bairro,
            'cidade' => $this->cidade,
            'uf' => $this->uf,
            'empresaTelefone' => $this->empresaTelefone,
        ]);
    }
    
}