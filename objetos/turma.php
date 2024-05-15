<?

class Turma {

    private $turmaId;
    private $nome;
    private $empresaId;
    private $ativo;
    private $dataInicio;
    private $dataFim;
    private Curso $curso;
    private Sala $sala;
    private Turno $turno;
    private Funcionario $professor;
    private Modalidade $modalidade;
    private SituacaoTurma $situacaoTurma;
    private $maxAlunos;
    private $minAlunos;
    private $metaAlunos;

    public function __construct(
        $turmaId, 
        $nome,
        $empresaId, 
        $ativo, 
        $dataInicio, 
        $dataFim,
        Curso $curso, 
        Sala $sala, 
        Turno $turno,
        Funcionario $professor,
        Modalidade $modalidade, 
        SituacaoTurma $situacaoTurma,
        $maxAlunos, 
        $minAlunos,
        $metaAlunos
    ) {
        $this->turmaId = $turmaId;
        $this->nome = $nome;
        $this->empresaId = $empresaId;
        $this->ativo = $ativo;
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
        $this->curso = $curso;
        $this->sala = $sala;
        $this->turno = $turno;
        $this->professor = $professor;
        $this->modalidade = $modalidade;
        $this->situacaoTurma = $situacaoTurma;
        $this->maxAlunos = $maxAlunos;
        $this->minAlunos = $minAlunos;
        $this->metaAlunos = $metaAlunos;
    }

    public function getTurmaId() {
        return $this->turmaId;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmpresaId() {
        return $this->empresaId;
    }

    public function getAtivo() {
        return $this->ativo;
    }

    public function getDataInicio() {
        return $this->dataInicio;
    }

    public function getDataFim() {
        return $this->dataFim;
    }

    public function getCurso() {
        return $this->curso;
    }

    public function getSala() {
        return $this->sala;
    }

    public function getTurno() {
        return $this->turno;
    }

    public function getProfessor() {
        return $this->professor;
    }

    public function getModalidade() {
        return $this->modalidade;
    }

    public function getSituacaoTurma() {
        return $this->situacaoTurma;
    }

    public function getMaxAlunos() {
        return $this->maxAlunos;
    }

    public function getMinAlunos() {
        return $this->minAlunos;
    }
    public function getMetaAlunos() {
        return $this->metaAlunos;
    }
    
    public function toJson() {
        return json_encode([
            'turmaId' => $this->turmaId,
            'nome' => $this->nome,
            'empresaId' => $this->empresaId,
            'ativo' => $this->ativo,
            'dataInicio' => $this->dataInicio,
            'dataFim' => $this->dataFim,
            'curso' => $this->curso->toJsonSemAspas(), 
            'sala' => $this->sala->toJsonSemAspas(), 
            'turno' => $this->turno->toJsonSemAspas(), 
            'professor' => $this->professor->toJsonSemAspas(), 
            'modalidade' => $this->modalidade->toJsonSemAspas(), 
            'situacaoTurma' => $this->situacaoTurma->toJsonSemAspas(), 
            'maxAlunos' => $this->maxAlunos,
            'minAlunos' => $this->minAlunos,
            'metaAlunos' => $this->metaAlunos
        ]);
    }
    public function toJsonSemAspas() {
        return [
            'turmaId' => $this->turmaId,
            'nome' => $this->nome,
            'empresaId' => $this->empresaId,
            'ativo' => $this->ativo,
            'dataInicio' => $this->dataInicio,
            'dataFim' => $this->dataFim,
            'curso' => $this->curso->toJsonSemAspas(), 
            'sala' => $this->sala->toJsonSemAspas(), 
            'turno' => $this->turno->toJsonSemAspas(), 
            'professor' => $this->professor->toJsonSemAspas(), 
            'modalidade' => $this->modalidade->toJsonSemAspas(), 
            'situacaoTurma' => $this->situacaoTurma->toJsonSemAspas(), 
            'maxAlunos' => $this->maxAlunos,
            'minAlunos' => $this->minAlunos,
            'metaAlunos' => $this->metaAlunos
        ];
    }

}
?>