<?

class Aluno extends Usuario{
    private $alunoId;
    private $matricula;

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
        $uf,
        $alunoId,
        $matricula
    ){
        parent::__construct(
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
        );

        $this->alunoId = $alunoId;
        $this->matricula = $matricula;
    }
    
    public function getAlunoId(){
        return $this->alunoId;
    }

    public function getMatricula(){
        return $this->matricula;
    }

    public function toJson() {
        return json_encode([
            'usuarioId' => $this->getUsuarioId(),
            'ativo' => $this->isAtivo(),
            'empresaId' => $this->getEmpresaId(),
            'nome' => $this->getNome(),
            'email' => $this->getEmail(),
            'cpf' => $this->getCpf(),
            'rg' => $this->getRg(),
            'cep' => $this->getCep(),
            'logradouro' => $this->getlogradouro(),
            'numero' => $this->getNumero(),
            'complemento' => $this->getComplemento(),
            'bairro' => $this->getBairro(),
            'cidade' => $this->getCidade(),
            'uf' => $this->getUf(),
            'telefone' => $this->getTelefone(),
            'alunoId' => $this->alunoId,
            'matricula' => $this->matricula
        ]);
    }

    public function toJsonSemAspas() {
        return [
            'usuarioId' => $this->getUsuarioId(),
            'ativo' => $this->isAtivo(),
            'empresaId' => $this->getEmpresaId(),
            'nome' => $this->getNome(),
            'email' => $this->getEmail(),
            'cpf' => $this->getCpf(),
            'rg' => $this->getRg(),
            'cep' => $this->getCep(),
            'logradouro' => $this->getlogradouro(),
            'numero' => $this->getNumero(),
            'complemento' => $this->getComplemento(),
            'bairro' => $this->getBairro(),
            'cidade' => $this->getCidade(),
            'uf' => $this->getUf(),
            'telefone' => $this->getTelefone(),
            'alunoId' => $this->alunoId,
            'matricula' => $this->matricula
        ];
    }

}

?>