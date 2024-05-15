<?
class Bolsa{

    private $bolsaId;
    private $nome;
    private $empresaId;
    private $ativo;
    private $percentualDesconto;
    private $necessitaAutSup;

    function __construct(
        $bolsaId,
        $empresaId,
        $nome,
        $ativo,
        $percentualDesconto,
        $necessitaAutSup
    ){
        $this->bolsaId = $bolsaId;
        $this->empresaId = $empresaId;
        $this->nome = $nome;
        $this->ativo = $ativo;
        $this->percentualDesconto = $percentualDesconto;
        $this->necessitaAutSup = $necessitaAutSup;
    }

    public function getBolsaId(){
        return $this->bolsaId;
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
    public function getPercentualDesconto(){
        return $this->percentualDesconto; 
    }
    public function isNecessitaAutSup(){
        return $this->necessitaAutSup; 
    }
    
    public function toJson() {
        return json_encode([
            'bolsaId' => $this->bolsaId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo,
            'percentualDesconto' => $this->percentualDesconto,
            'necessitaAutSup' => $this->necessitaAutSup
        ]);
    }

    public function toJsonSemAspas() {
        return [
            'bolsaId' => $this->bolsaId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo,
            'percentualDesconto' => $this->percentualDesconto,
            'necessitaAutSup' => $this->necessitaAutSup
        ];
    }

}
?>