<?
class Turno{

    private $turnoId;
    private $nome;
    private $empresaId;
    private $valor;
    private $statusPagamento;
    private Movimento $movimento;
    private Contrato $contrato;

    function __construct(
        $turnoId,
        $empresaId,
        $nome,
        $valor,
        $statusPagamento,
        $movimento,
        $contrato
    ){
        $this->turnoId = $turnoId;
        $this->empresaId = $empresaId;
        $this->nome = $nome;
        $this->valor = $valor;
        $this->statusPagamento = $statusPagamento;
        $this->movimento = $movimento;
        $this->contrato = $contrato;
    }

    public function getTurnoId(){
        return $this->turnoId;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getEmpresaId(){
        return $this->empresaId;
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
    
    
    public function toJson() {
        return json_encode([
            'turnoId' => $this->turnoId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'valor' => $this->valor,
            'statusPagamento' => $this->statusPagamento,
            'movimento' => $this->movimento,
            'contrato' => $this->contrato
        ]);
    }

    public function toJsonSemAspas() {
        return [
            'turnoId' => $this->turnoId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'valor' => $this->valor,
            'statusPagamento' => $this->statusPagamento,
            'movimento' => $this->movimento,
            'contrato' => $this->contrato
        ];
    }

}
?>