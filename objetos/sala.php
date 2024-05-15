<?
class Sala{

    private $salaId;
    private $nome;
    private $empresaId;
    private $ativo;

    function __construct(
        $salaId,
        $empresaId,
        $nome,
        $ativo
    ){
        $this->salaId = $salaId;
        $this->empresaId = $empresaId;
        $this->nome = $nome;
        $this->ativo = $ativo;
    }

    public function getSalaId(){
        return $this->salaId;
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
            'salaId' => $this->salaId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo
        ]);
    }

    public function toJsonSemAspas() {
        return [
            'salaId' => $this->salaId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo
        ];
    }

}
?>