<?
class Documento{

    private $documentoId;
    private $contratoId;
    private $descricao;
    private $documento;

    function __construct(
        $documentoId,
        $contratoId,
        $descricao,
        $documento
    ){
        $this->documentoId = $documentoId;
        $this->contratoId = $contratoId;
        $this->descricao = $descricao;
        $this->documento = $documento;
    }

    public function getDocumentoId(){
        return $this->documentoId;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function getContratoId(){
        return $this->contratoId;
    }

    public function getDocumento(){
        return $this->documento; 
    }
    
    public function toJson() {
        return json_encode([
            'documentoId' => $this->documentoId,
            'contratoId' => $this->contratoId,
            'descricao' => $this->descricao,
            'documento' => $this->documento
        ]);
    }

    public function toJsonSemAspas() {
        return [
            'documentoId' => $this->documentoId,
            'contratoId' => $this->contratoId,
            'descricao' => $this->descricao,
            'documento' => $this->documento
        ];
    }

}
?>