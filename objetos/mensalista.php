<?

class Mensalista extends TipoPagamento{
    private $valorSalario;
    private $percentualInss;

    function __construct(
        $tipoPagamentoId,
        $nome,
        $empresaId,
        $ativo,
        $valorSalario,
        $percentualInss
    ){
        parent::__construct(
            $tipoPagamentoId,
            $nome,
            $empresaId,
            $ativo
        );
        $this->valorSalario = $valorSalario;
        $this->percentualInss = $percentualInss;
    }

    public function getValorSalario(){
        return $this->valorSalario;
    }
    public function getPercentualInss(){
        return $this->percentualInss;
    }

    public function toJson() {
        return json_encode([
            'tipoPagamentoId' => $this->getTipoPagamentoId(),
            'ativo' => $this->isAtivo(),
            'empresaId' => $this->getEmpresaId(),
            'nome' => $this->getNome(),
            'valorSalario' => $this->valorSalario,
            'percentualInss' => $this->percentualInss
        ]);
    }
    public function toJsonSemAspas() {
        return [
            'tipoPagamentoId' => $this->getTipoPagamentoId(),
            'ativo' => $this->isAtivo(),
            'empresaId' => $this->getEmpresaId(),
            'nome' => $this->getNome(),
            'valorSalario' => $this->valorSalario,
            'percentualInss' => $this->percentualInss
        ];
    }
}


?>