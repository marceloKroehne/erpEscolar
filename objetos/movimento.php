<?

class Movimento{

    private $movimentoId;
    private $empresaId;
    private Conta $conta;
    private Subconta $subcontaEntrada;
    private Subconta $subcontaSaida;
    private $valor;
    private $dataLancamento;
    private $historico;
    private $observacao;
    private $numeroDocumento;
    private TipoDocumento $tipoDocumento;
    private $numeroMovimento;
    private $duplicado;
    private $importacaoOfx;
    private $parcelaId;

    function __construct(
        $movimentoId,
        $empresaId,
        Subconta $subcontaEntrada,
        Subconta $subcontaSaida,
        $valor,
        $dataLancamento,
        $historico,
        $observacao,
        $numeroDocumento,
        TipoDocumento $tipoDocumento,
        $numeroMovimento,
        $importacaoOfx=false
    ){
        $this->movimentoId = $movimentoId;
        $this->empresaId = $empresaId;
        $this->subcontaEntrada = $subcontaEntrada;
        $this->subcontaSaida = $subcontaSaida;
        $this->valor = $valor;
        $this->dataLancamento = $dataLancamento;
        $this->historico = $historico;
        $this->observacao = $observacao;
        $this->numeroDocumento = $numeroDocumento;
        $this->tipoDocumento = $tipoDocumento;
        $this->numeroMovimento = $numeroMovimento;
        $this->importacaoOfx = $importacaoOfx;
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

    public function getSubcontaEntrada(){
        return $this->subcontaEntrada;
    }

    public function getSubcontaSaida(){
        return $this->subcontaSaida;
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
    
    public function isImportacaoOfx(){
        return $this->importacaoOfx;
    }

    public function getParcelaId(){
        return $this->parcelaId;
    }

    public function setParcelaId($parcelaId){
        $this->parcelaId = $parcelaId;
    }
    public function toJson() {
        return json_encode([
            'movimentoId' => $this->movimentoId,
            'empresaId' => $this->empresaId,
            'subcontaEntrada' => $this->subcontaEntrada->toJsonSemAspas(),
            'subcontaSaida' =>  $this->subcontaSaida->toJsonSemAspas(),
            'valor' =>  $this->valor,
            'dataLancamento' => $this->dataLancamento,
            'historico' => $this->historico,
            'observacao' => $this->observacao,
            'tipoDocumento' => $this->tipoDocumento->toJsonSemAspas(),
            'duplicado' => $this->duplicado,
            'importacaoOfx' => $this->importacaoOfx,
            'parcelaId' => $this->parcelaId,
            'numeroMovimento' => $this->numeroMovimento 
        ]);
    }

    public function toJsonSemAspas() {
        return [
            'movimentoId' => $this->movimentoId,
            'empresaId' => $this->empresaId,
            'subcontaEntrada' => $this->subcontaEntrada->toJsonSemAspas(),
            'subcontaSaida' =>  $this->subcontaSaida->toJsonSemAspas(),
            'valor' =>  $this->valor,
            'dataLancamento' => $this->dataLancamento,
            'historico' => $this->historico,
            'observacao' => $this->observacao,
            'tipoDocumento' => $this->tipoDocumento->toJsonSemAspas(),
            'duplicado' => $this->duplicado,
            'importacaoOfx' => $this->importacaoOfx,
            'parcelaId' => $this->parcelaId,
            'numeroMovimento' => $this->numeroMovimento 
        ];
    }
    
}

?>