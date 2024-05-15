<?

class TipoPagamento{
    private $tipoPagamentoId;
    private $nome;
    private $empresaId;
    private $ativo;

    function __construct(
        $tipoPagamentoId,
        $nome,
        $empresaId,
        $ativo
    ){
        $this->tipoPagamentoId = $tipoPagamentoId;
        $this->nome = $nome;
        $this->empresaId = $empresaId;
        $this->ativo = $ativo;
    }

    public function getTipoPagamentoId(){
        return $this->tipoPagamentoId;
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

    public function toJson() {
        return json_encode([
            'tipoPagamentoId' => $this->tipoPagamentoId,
            'ativo' => $this->ativo,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome
        ]);
    }
    public function toJsonSemAspas() {
        return[
            'tipoPagamentoId' => $this->tipoPagamentoId,
            'ativo' => $this->ativo,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome
        ];
    }
}

?>