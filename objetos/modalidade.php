<?
class Modalidade{

    private $modalidadeId;
    private $nome;
    private $empresaId;
    private $ativo;

    function __construct(
        $modalidadeId,
        $empresaId,
        $nome,
        $ativo
    ){
        $this->modalidadeId = $modalidadeId;
        $this->empresaId = $empresaId;
        $this->nome = $nome;
        $this->ativo = $ativo;
    }

    public function getModalidadeId(){
        return $this->modalidadeId;
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
            'modalidadeId' => $this->modalidadeId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo
        ]);
    }

    public function toJsonSemAspas() {
        return [
            'modalidadeId' => $this->modalidadeId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo
        ];
    }

}
?>