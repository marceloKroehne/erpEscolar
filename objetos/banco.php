<?

class Banco{

    private $bancoId;
    private $numeroBanco;
    
    private $empresaId;
    private $nome;
    private $exigeOfx;
    private $ativo;

    function __construct(
        $bancoId,
        $numeroBanco,
        $empresaId,
        $nome,
        $exigeOfx,
        $ativo
    ){
        $this->bancoId = $bancoId;
        $this->numeroBanco = $numeroBanco;
        $this->empresaId = $empresaId;
        $this->nome = $nome;
        $this->exigeOfx = $exigeOfx;
        $this->ativo = $ativo;

    }

    public function getBancoId(){
        return $this->bancoId;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getEmpresaId(){
        return $this->empresaId;
    }

    public function getNumeroBanco(){
        return $this->numeroBanco; 
    }

    public function isExigeOfx(){
        return $this->exigeOfx; 
    }

    public function isAtivo(){
        return $this->ativo; 
    }

    public function toJson() {
        return json_encode([
            'bancoId' => $this->bancoId,
            'numeroBanco' => $this->numeroBanco,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'exigeOfx' => $this->exigeOfx,
            'ativo' => $this->ativo
        ]);
    }

    public function toJsonSemAspas() {
        return [
            'bancoId' => $this->bancoId,
            'numeroBanco' => $this->numeroBanco,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'exigeOfx' => $this->exigeOfx,
            'ativo' => $this->ativo
        ];
    }

}

?>