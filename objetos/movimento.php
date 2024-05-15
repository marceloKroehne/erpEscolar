<?

class Movimento{

    private $movimentoId;
    private $empresaId;
    private Conta $conta;
    private Subconta $subconta;
    private $valor;
    private $dataLancamento;
    private $historico;
    private $observacao;
    private $numeroDocumento;
    private TipoDocumento $tipoDocumento;
    private $numeroMovimento;
    private $duplicado;

    function __construct(
        $movimentoId,
        $empresaId,
        Conta $conta,
        Subconta $subconta,
        $valor,
        $dataLancamento,
        $historico,
        $observacao,
        $numeroDocumento,
        TipoDocumento $tipoDocumento,
        $numeroMovimento
    ){
        $this->movimentoId = $movimentoId;
        $this->empresaId = $empresaId;
        $this->conta = $conta;
        $this->subconta = $subconta;
        $this->valor = $valor;
        $this->dataLancamento = $dataLancamento;
        $this->historico = $historico;
        $this->observacao = $observacao;
        $this->numeroDocumento = $numeroDocumento;
        $this->tipoDocumento = $tipoDocumento;
        $this->numeroMovimento = $numeroMovimento;
    }

    public function getMovimentoId(){
        return $this->movimentoId;
    }

    public function getNumeroMovimento(){
        return $this->numeroMovimento;
    }

    public function isDuplicado(){
        return $this->duplicado;
    }
    
    public function setDuplicado($duplicado){
        $this->duplicado = $duplicado;
    }
    public function getEmpresaId(){
        return $this->empresaId;
    }

    public function getConta(){
        return $this->conta;
    }

    public function getSubconta(){
        return $this->subconta;
    }
    public function getValor(){
        return $this->valor;
    }
    public function getDataLancamento(){
        return $this->dataLancamento;
    }

    public function getHistorico(){
        return $this->historico;
    }
    public function getObservacao(){
        return $this->observacao;
    }

    public function getNumeroDocumento(){
        return $this->numeroDocumento;
    }
    public function getTipoDocumento(){
        return $this->tipoDocumento;
    }

    public function toJson() {
        return json_encode([
            'movimentoId' => $this->movimentoId,
            'empresaId' => $this->empresaId,
            'conta' => $this->conta->toJsonSemAspas(),
            'subconta' =>  $this->subconta->toJsonSemAspas(),
            'valor' =>  $this->valor,
            'dataLancamento' => $this->dataLancamento,
            'historico' => $this->historico,
            'observacao' => $this->observacao,
            'tipoDocumento' => $this->tipoDocumento->toJsonSemAspas(),
            'duplicado' => $this->duplicado,
            'numeroMovimento' => $this->numeroMovimento 
        ]);
    }
    
}

?>