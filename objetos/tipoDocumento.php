<?
class TipoDocumento{

    private $tipoDocumentoId;
    private $nome;
    private $empresaId;
    private $ativo;

    function __construct(
        $tipoDocumentoId,
        $empresaId,
        $nome,
        $ativo
    ){
        $this->tipoDocumentoId = $tipoDocumentoId;
        $this->empresaId = $empresaId;
        $this->nome = $nome;
        $this->ativo = $ativo;
    }

    public function getTipoDocumentoId(){
        return $this->tipoDocumentoId;
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
            'tipoDocumentoId' => $this->tipoDocumentoId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo
        ]);
    }

    public function toJsonSemAspas() {
        return [
            'tipoDocumentoId' => $this->tipoDocumentoId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo
        ];
    }

}
?>