<?
class Contrato{

    private $contratoId;
    private $empresaId;
    private Aluno $aluno;
    private Turma $turma;
    private Funcionario $vendedor;
    private SituacaoContrato $situacaoContrato;
    private TipoContrato $tipoContrato;
    private PlanoCurso $planoCurso;
    private Bolsa $bolsa;
    private $dataInicio;
    private $dataFim;
    private $observacao;

    public function __construct(
        $contratoId,
        $empresaId,
        Aluno $aluno,
        Turma $turma,
        Funcionario $vendedor,
        SituacaoContrato $situacaoContrato,
        TipoContrato $tipoContrato,
        PlanoCurso $planoCurso,
        Bolsa $bolsa,
        $dataInicio,
        $dataFim,
        $observacao
    ) {
        $this->contratoId = $contratoId;
        $this->empresaId = $empresaId;
        $this->aluno = $aluno;
        $this->turma = $turma;
        $this->vendedor = $vendedor;
        $this->planoCurso = $planoCurso;
        $this->bolsa = $bolsa;
        $this->situacaoContrato = $situacaoContrato;
        $this->tipoContrato = $tipoContrato;
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
        $this->observacao = $observacao;
    }

    public function getContratoId(){
        return $this->contratoId;
    }

    public function getEmpresaId(){
        return $this->empresaId;
    }

    public function getAluno(){
        return $this->aluno;
    }

    public function getTurma(){
        return $this->turma;
    }

    public function getVendedor(){
        return $this->vendedor;
    }

    public function getPlanoCurso(){
        return $this->planoCurso;
    }

    public function getBolsa(){
        return $this->bolsa;
    }
    public function getSituacaoContrato(){
        return $this->situacaoContrato;
    }
    public function getTipoContrato(){
        return $this->tipoContrato;
    }

    public function getDataInicio(){
        return $this->dataInicio;
    }

    public function getDataFim()
    {
        return $this->dataFim;
    }

    public function getObservacao(){
        return $this->observacao;
    }
    
    public function toJson() {
        return json_encode([
            'contratoId' => $this->contratoId,
            'empresaId' => $this->empresaId,
            'aluno' => $this->aluno->toJsonSemAspas(),  
            'turma' => $this->turma->toJsonSemAspas(),  
            'vendedor' => $this->vendedor->toJsonSemAspas(),  
            'planoCurso' => $this->planoCurso->toJsonSemAspas(),
            'bolsa' => $this->bolsa->toJsonSemAspas(),
            'situacaoContrato' => $this->situacaoContrato->toJsonSemAspas(),  
            'tipoContrato' => $this->tipoContrato->toJsonSemAspas(),  
            'dataInicio' => $this->dataInicio,
            'dataFim' => $this->dataFim,
            'observacao' => $this->observacao
        ]);
    }

    public function toJsonSemAspas() {
        return [
            'contratoId' => $this->contratoId,
            'empresaId' => $this->empresaId,
            'aluno' => $this->aluno->toJsonSemAspas(),  
            'turma' => $this->turma->toJsonSemAspas(),  
            'vendedor' => $this->vendedor->toJsonSemAspas(),  
            'planoCurso' => $this->planoCurso->toJsonSemAspas(),
            'bolsa' => $this->bolsa->toJsonSemAspas(),
            'situacaoContrato' => $this->situacaoContrato->toJsonSemAspas(),  
            'tipoContrato' => $this->tipoContrato->toJsonSemAspas(),  
            'dataInicio' => $this->dataInicio,
            'dataFim' => $this->dataFim,
            'observacao' => $this->observacao
        ];
    }

}
?>