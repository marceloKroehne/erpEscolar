<?

class Conta{
    private Banco $banco;
    private $agencia;
    
    private $numeroConta;
    private $ativo;


    function __construct(
        Banco $banco,
        $agencia,
        $numeroConta,
        $ativo
    ){
        $this->banco = $banco;
        $this->agencia = $agencia;
        $this->numeroConta = $numeroConta;
        $this->ativo = $ativo;


    }

    public function getBanco(){
        return $this->banco;
    }

    public function getAgencia(){
        return $this->agencia;
    }

    public function getNumeroConta(){
        return $this->numeroConta;
    }

    
    public function toJson() {
        return json_encode([
            'banco' => $this->banco->toJsonSemAspas(),
            'agencia' => $this->agencia,
            'numeroConta' => $this->numeroConta,
            'ativo' => $this->ativo
        ]);
    }

    public function toJsonSemAspas() {
        return [
            'banco' => $this->banco->toJsonSemAspas(),
            'agencia' => $this->agencia,
            'numeroConta' => $this->numeroConta,
            'ativo' => $this->ativo
        ];
    }

    public function isAtivo(){
        return $this->ativo; 
    }


}

?>