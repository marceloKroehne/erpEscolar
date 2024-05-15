<?

class Horista extends TipoPagamento{
    private $valorHora;
    function __construct(
        $tipoPagamentoId,
        $nome,
        $empresaId,
        $ativo,
        $valorHora
    ){
        parent::__construct(
            $tipoPagamentoId,
            $nome,
            $empresaId,
            $ativo
        );
        $this->valorHora = $valorHora;
    }

    public function getValorHora(){
        return $this->valorHora;
    }

    public function toJson() {
        return json_encode([
            'tipoPagamentoId' => $this->getTipoPagamentoId(),
            'ativo' => $this->isAtivo(),
            'empresaId' => $this->getEmpresaId(),
            'nome' => $this->getNome(),
            'valorHora' => $this->valorHora
        ]);
    }
    public function toJsonSemAspas() {
        return [
            'tipoPagamentoId' => $this->getTipoPagamentoId(),
            'ativo' => $this->isAtivo(),
            'empresaId' => $this->getEmpresaId(),
            'nome' => $this->getNome(),
            'valorHora' => $this->valorHora
        ];
    }
}


?>