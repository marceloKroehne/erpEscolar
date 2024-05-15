<?

class Cargo{
    private $cargoId;
    private $empresaId;
    private $permissaoId;
    private $professor;
    private $atendente;
    private $nome;
    private $isAdmin; 
    private $ativo;

    
    function __construct(
        $cargoId, 
        $empresaId,
        $permissaoId,
        $professor,
        $atendente,
        $nome, 
        $isAdmin,
        $ativo
    ){
        $this->cargoId = $cargoId;
        $this->empresaId = $empresaId;
        $this->nome = $nome;
        $this->permissaoId = $permissaoId;
        $this->isAdmin = $isAdmin;
        $this->ativo = $ativo;
        $this->professor = $professor;
        $this->atendente = $atendente;
    }

    public function getCargoId(){
        return $this->cargoId;
    }

    public function getEmpresaId(){
        return $this->empresaId;
    }

    public function getNome(){
        return $this->nome;
    }
    public function getPermissaoId(){
        return $this->permissaoId;
    }
    public function isAdmin(){
        return $this->isAdmin;
    }
    public function isAtivo(){
        return $this->ativo; 
    }
    public function isProfessor(){
        return $this->professor;
    }
    public function isAtendente(){
        return $this->atendente; 
    }

    public function toJson() {
        return json_encode([
            'cargoId' => $this->cargoId,
            'permissaoId' => $this->permissaoId,
            'isAdmin' => $this->isAdmin,
            'empresaId' => $this->empresaId,
            'professor' => $this->professor,
            'atendente' => $this->atendente,
            'nome' => $this->nome,
            'ativo' => $this->ativo
        ]);
    }
    public function toJsonSemAspas() {
        return [
            'cargoId' => $this->cargoId,
            'permissaoId' => $this->permissaoId,
            'isAdmin' => $this->isAdmin,
            'empresaId' => $this->empresaId,
            'professor' => $this->professor,
            'atendente' => $this->atendente,
            'nome' => $this->nome,
            'ativo' => $this->ativo
        ];
    }
}

?>