<?
class PlanoCurso{

    private $planoCursoId;
    private Curso $curso;
    private $nome;
    private $empresaId;
    private $ativo;
    private $necessitaAutSup;
    private $numeroParcelas;
    private $valorParcela;
    private $valorTotal;

    function __construct(
        $planoCursoId,
        Curso $curso,
        $empresaId,
        $nome,
        $ativo,
        $necessitaAutSup,
        $numeroParcelas,
        $valorParcela,
        $valorTotal
    ){
        $this->planoCursoId = $planoCursoId;
        $this->curso = $curso;
        $this->empresaId = $empresaId;
        $this->nome = $nome;
        $this->ativo = $ativo;
        $this->necessitaAutSup = $necessitaAutSup;
        $this->numeroParcelas = $numeroParcelas;
        $this->valorParcela = $valorParcela;
        $this->valorTotal = $valorTotal;
    }

    public function getPlanoCursoId(){
        return $this->planoCursoId;
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
    public function isNecessitaAutSup(){
        return $this->necessitaAutSup; 
    }
    public function getNumeroParcelas(){
        return $this->numeroParcelas;
    }
    public function getValorParcela(){
        return $this->valorParcela;
    }
    public function getValorTotal(){
        return $this->valorTotal;
    }
    public function getCurso(){
        return $this->curso;
    }
    
    public function toJson() {
        return json_encode([
            'planoCursoId' => $this->planoCursoId,
            'curso' => $this->curso->toJsonSemAspas(),
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo,
            'necessitaAutSup' => $this->necessitaAutSup,
            'numeroParcelas' => $this->numeroParcelas,
            'valorParcela' => $this->valorParcela,
            'valorTotal' => $this->valorTotal
        ]);
    }

    public function toJsonSemAspas() {
        return [
            'planoCursoId' => $this->planoCursoId,
            'curso' => $this->curso->toJsonSemAspas(),
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo,
            'necessitaAutSup' => $this->necessitaAutSup,
            'numeroParcelas' => $this->numeroParcelas,
            'valorParcela' => $this->valorParcela,
            'valorTotal' => $this->valorTotal
        ];
    }

}
?>