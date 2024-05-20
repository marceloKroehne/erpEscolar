<?

class Subconta{

    private $subcontaId;
    private GrupoContas $grupoConta;
    private Conta $conta;
    private $nome;
    private $tipo;
    private $ativo;

    function __construct(
        $subcontaId,
        GrupoContas $grupoConta,
        Conta $conta,
        $tipo,
        $nome,
        $ativo
    ){
        $this->subcontaId = $subcontaId;
        $this->grupoConta = $grupoConta;
        $this->conta = $conta;
        $this->nome = $nome;
        $this->tipo = $tipo;
        $this->ativo = $ativo;

    }

    public function getSubcontaId(){
        return $this->subcontaId;
    }

    public function getGrupoConta(){
        return $this->grupoConta;
    }

    public function getTipo(){
        return $this->tipo;
    }

    
    public function getNome(){
        return $this->nome;
    }

    public function isAtivo(){
        return $this->ativo; 
    }
    public function getConta(){
        return $this->conta; 
    }

    public function toJsonSemAspas() {
        return [
            'subcontaId' => $this->subcontaId,
            'grupoConta' => $this->grupoConta->toJsonSemAspas(),
            'conta' => $this->conta->toJsonSemAspas(),
            'tipo' => $this->tipo,
            'nome' => $this->nome,
            'ativo' => $this->ativo
        ];
    }

    public function toJson() {
        return json_encode([
            'subcontaId' => $this->subcontaId,
            'grupoConta' => $this->grupoConta->toJsonSemAspas(),
            'conta' => $this->conta->toJsonSemAspas(),
            'tipo' => $this->tipo,
            'nome' => $this->nome,
            'ativo' => $this->ativo
        ]);
    }

}

?>