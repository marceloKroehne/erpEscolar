<?
class Disciplina{

    private $disciplinaId;
    private $nome;
    private $empresaId;
    private $ativo;

    function __construct(
        $disciplinaId,
        $empresaId,
        $nome,
        $ativo
    ){
        $this->disciplinaId = $disciplinaId;
        $this->empresaId = $empresaId;
        $this->nome = $nome;
        $this->ativo = $ativo;
    }

    public function getDisciplinaId(){
        return $this->disciplinaId;
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
            'disciplinaId' => $this->disciplinaId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo
        ]);
    }

    public function toJsonSemAspas() {
        return [
            'disciplinaId' => $this->disciplinaId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo
        ];
    }

}
?>