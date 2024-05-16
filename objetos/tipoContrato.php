<?
class TipoContrato{

    private $tipoContratoId;
    private $nome;
    private $empresaId;
    private $ativo;

    function __construct(
        $tipoContratoId,
        $empresaId,
        $nome,
        $ativo
    ){
        $this->tipoContratoId = $tipoContratoId;
        $this->empresaId = $empresaId;
        $this->nome = $nome;
        $this->ativo = $ativo;
    }

    public function getTipoContratoId(){
        return $this->tipoContratoId;
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
            'tipoContratoId' => $this->tipoContratoId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo
        ]);
    }

    public function toJsonSemAspas() {
        return [
            'tipoContratoId' => $this->tipoContratoId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo
        ];
    }

}
?>