<?

class Funcionario extends Usuario{
    private $funcionarioId;
    private $professor;
    private $atendente;
    private Cargo $cargo;
    private Conta $conta;
    private Pix $pix;
    private Mensalista $mensalista;
    private Horista $horista;
    private $permissaoId;

    function __construct(
        $usuarioId, 
        $ativo,
        $professor,
        $atendente,
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
        $funcionarioId,
        Cargo $cargo,
        Conta $conta,
        Pix $pix,
        Mensalista $mensalista,
        Horista $horista,
        $permissaoId
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

        $this->funcionarioId = $funcionarioId;
        $this->cargo = $cargo;
        $this->conta = $conta;
        $this->pix = $pix;
        $this->mensalista = $mensalista;
        $this->horista = $horista;
        $this->professor = $professor;
        $this->atendente = $atendente;
        $this->permissaoId = $permissaoId;
    }
    
    public function getCargo(){
        return $this->cargo;
    }

    public function getFuncionarioId(){
        return $this->funcionarioId;
    }

    public function getHorista(){
        return $this->horista;
    }
    public function getMensalista(){
        return $this->mensalista;
    }
    public function isProfessor(){
        return $this->professor;
    }
    public function isAtendente(){
        return $this->atendente; 
    }
    public function getPermissaoId(){
        return $this->permissaoId;
    }


    public function toJson() {
        return json_encode([
            'usuarioId' => $this->getUsuarioId(),
            'ativo' => $this->isAtivo(),
            'professor' => $this->professor,
            'atendente' => $this->atendente,
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
            'funcionarioId' => $this->funcionarioId,
            'cargo' => $this->cargo->toJsonSemAspas(),
            'permissaoId' => $this->permissaoId,
            'conta' => $this->conta->toJsonSemAspas(),
            'pix' => $this->pix->toJsonSemAspas(),
            'mensalista' => $this->mensalista->toJsonSemAspas(),
            'horista' => $this->horista->toJsonSemAspas()
        ]);
    }

    public function toJsonSemAspas() {
        return [
            'usuarioId' => $this->getUsuarioId(),
            'ativo' => $this->isAtivo(),
            'professor' => $this->professor,
            'atendente' => $this->atendente,
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
            'funcionarioId' => $this->funcionarioId,
            'cargo' => $this->cargo->toJsonSemAspas(),
            'permissaoId' => $this->permissaoId,
            'conta' => $this->conta->toJsonSemAspas(),
            'pix' => $this->pix->toJsonSemAspas()
        ];
    }

}

?>