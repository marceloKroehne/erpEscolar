<?
class MatrizCurricular{

    private $matrizCurricularId;
    private $nome;
    private $empresaId;
    private $ativo;
    private $disciplinas = [];

    function __construct(
        $matrizCurricularId,
        $empresaId,
        $nome,
        $ativo,
        $disciplinas
    ){
        $this->matrizCurricularId = $matrizCurricularId;
        $this->empresaId = $empresaId;
        $this->nome = $nome;
        $this->ativo = $ativo;
        $this->disciplinas = $disciplinas;
    }

    public function getMatrizCurricularId(){
        return $this->matrizCurricularId;
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
            'matrizCurricularId' => $this->matrizCurricularId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo,
            'disciplinas' => $this->disciplinas
        ]);
    }

    public function toJsonSemAspas() {
        return [
            'matrizCurricularId' => $this->matrizCurricularId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo,
            'disciplinas' => $this->disciplinas
        ];
    }

}
?>