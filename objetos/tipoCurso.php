<?
class TipoCurso{

    private $tipoCursoId;
    private $nome;
    private $empresaId;
    private $ativo;

    function __construct(
        $tipoCursoId,
        $empresaId,
        $nome,
        $ativo
    ){
        $this->tipoCursoId = $tipoCursoId;
        $this->empresaId = $empresaId;
        $this->nome = $nome;
        $this->ativo = $ativo;
    }

    public function getTipoCursoId(){
        return $this->tipoCursoId;
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
            'tipoCursoId' => $this->tipoCursoId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo
        ]);
    }

    public function toJsonSemAspas() {
        return [
            'tipoCursoId' => $this->tipoCursoId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo
        ];
    }

}
?>