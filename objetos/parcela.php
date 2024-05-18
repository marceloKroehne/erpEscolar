<?
class Parcela{

    private $parcelaId;
    private $nome;
    private $valor;
    private $statusPagamento;
    private Movimento $movimento;
    private Contrato $contrato;
    private Conta $conta;
    private Subconta $subconta;
    private $dataPagamento;
    function __construct(
        $parcelaId,
        $nome,
        $valor,
        $statusPagamento,
        $movimento,
        $contrato,
        $dataPagamento,
        $conta,
        $subconta
    ){
        $this->parcelaId = $parcelaId;
        $this->nome = $nome;
        $this->valor = $valor;
        $this->statusPagamento = $statusPagamento;
        $this->movimento = $movimento;
        $this->contrato = $contrato;
        $this->dataPagamento = $dataPagamento;
        $this->conta = $conta;
        $this->subconta = $subconta;
    }

    public function getparcelaId(){
        return $this->parcelaId;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getValor(){
        return $this->valor; 
    }
    
    public function getStatusPagamento(){
        return $this->statusPagamento;
    }

    public function getMovimento(){
        return $this->movimento; 
    }
    
    public function getContrato(){
        return $this->contrato;
    }
    public function getDataPagamento(){
        return $this->dataPagamento;
    }
    
    public function getConta(){
        return $this->conta;
    }
    public function getSubconta(){
        return $this->subconta;
    } 
    
    public function toJson() {
        return json_encode([
            'parcelaId' => $this->parcelaId,
            'nome' => $this->nome,
            'valor' => $this->valor,
            'statusPagamento' => $this->statusPagamento,
            'movimento' => $this->movimento->toJsonSemAspas(),
            'contrato' => $this->contrato->toJsonSemAspas(),
            'dataPagamento' => $this->dataPagamento,
            'conta' => $this->conta->toJsonSemAspas(),
            'subconta' => $this->subconta->toJsonSemAspas()
        ]);
    }

    public function toJsonSemAspas() {
        return [
            'parcelaId' => $this->parcelaId,
            'nome' => $this->nome,
            'valor' => $this->valor,
            'statusPagamento' => $this->statusPagamento,
            'movimento' => $this->movimento->toJsonSemAspas(),
            'contrato' => $this->contrato->toJsonSemAspas(),
            'dataPagamento' => $this->dataPagamento,
            'conta' => $this->conta->toJsonSemAspas(),
            'subconta' => $this->subconta->toJsonSemAspas()
        ];
    }

}
?>