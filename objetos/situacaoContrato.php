<?
class SituacaoContrato{

    private $situacaoContratoId;
    private $nome;
    private $empresaId;
    private $ativo;

    function __construct(
        $situacaoContratoId,
        $empresaId,
        $nome,
        $ativo
    ){
        $this->situacaoContratoId = $situacaoContratoId;
        $this->empresaId = $empresaId;
        $this->nome = $nome;
        $this->ativo = $ativo;
    }

    public function getSituacaoContratoId(){
        return $this->situacaoContratoId;
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
            'situacaoContratoId' => $this->situacaoContratoId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo
        ]);
    }

    public function toJsonSemAspas() {
        return [
            'situacaoContratoId' => $this->situacaoContratoId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo
        ];
    }

}
?>