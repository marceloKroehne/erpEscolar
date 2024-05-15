<?

class GrupoContas{
    private $grupoContaId;
    private $nome;
    private $empresaId;
    private $ativo;

    function __construct(
        $grupoContaId,
        $empresaId,
        $nome,
        $ativo
    ){
        $this->grupoContaId = $grupoContaId;
        $this->nome = $nome;
        $this->empresaId = $empresaId;
        $this->ativo = $ativo;

    }

    public function getGrupoContaId(){
        return $this->grupoContaId;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getEmpresaId(){
        return $this->empresaId;
    }

    public function isAtivo(){
        return $this->ativo; 
    }


    public function toJsonSemAspas() {
        return [
            'grupoContaId' => $this->grupoContaId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo
        ];
    }

    public function toJson() {
        return json_encode([
            'grupoContaId' => $this->grupoContaId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo
        ]);
    }

}

?>