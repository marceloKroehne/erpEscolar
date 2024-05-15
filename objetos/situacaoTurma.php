<?
class SituacaoTurma{

    private $situacaoTurmaId;
    private $nome;
    private $empresaId;
    private $ativo;

    function __construct(
        $situacaoTurmaId,
        $empresaId,
        $nome,
        $ativo
    ){
        $this->situacaoTurmaId = $situacaoTurmaId;
        $this->empresaId = $empresaId;
        $this->nome = $nome;
        $this->ativo = $ativo;
    }

    public function getSituacaoTurmaId(){
        return $this->situacaoTurmaId;
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
            'situacaoTurmaId' => $this->situacaoTurmaId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo
        ]);
    }

    public function toJsonSemAspas() {
        return [
            'situacaoTurmaId' => $this->situacaoTurmaId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo
        ];
    }

}
?>