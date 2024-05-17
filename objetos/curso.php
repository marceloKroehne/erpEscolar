<?
class Curso{

    private $cursoId;
    private $nome;
    private $empresaId;
    private $valor;
    private Usuario $coordenador;
    private MatrizCurricular $matriz;
    private TipoCurso $tipoCurso;
    private $numeroAulas;
    private $cargaHoraria;
    private $ativo;
    private $bolsas = [];

    function __construct(
        $cursoId,
        $empresaId,
        $nome,
        $ativo,
        $bolsas,
        $valor,
        Funcionario $coordenador,
        MatrizCurricular $matriz,
        TipoCurso $tipoCurso,
        $numeroAulas,
        $cargaHoraria
    ){
        $this->cursoId = $cursoId;
        $this->empresaId = $empresaId;
        $this->nome = $nome;
        $this->ativo = $ativo;
        $this->bolsas = $bolsas;
        $this->coordenador = $coordenador;
        $this->matriz = $matriz;
        $this->valor = $valor;
        $this->tipoCurso = $tipoCurso;
        $this->numeroAulas = $numeroAulas;
        $this->cargaHoraria = $cargaHoraria;
    }

    public function getcursoId(){
        return $this->cursoId;
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
    public function getValor(){
        return $this->valor;
    }

    public function getMatrizCurricular(){
        return $this->matriz;
    }

    public function getTipoCurso(){
        return $this->tipoCurso; 
    }
    public function getcoordenador(){
        return $this->coordenador;
    }

    public function getNumeroAulas(){
        return $this->numeroAulas;
    }

    public function getCargaHoraria(){
        return $this->cargaHoraria; 
    }
    public function getBolsas(){
        return $this->bolsas; 
    }
    
    
    public function toJson() {
        return json_encode([
            'cursoId' => $this->cursoId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo,
            'bolsas' => $this->bolsas,
            'valor' => $this->valor,
            'matriz' => $this->matriz->toJsonSemAspas(),
            'coordenador' => $this->coordenador->toJsonSemAspas(),
            'tipoCurso' => $this->tipoCurso->toJsonSemAspas(),
            'numeroAulas' => $this->numeroAulas,
            'cargaHoraria' => $this->cargaHoraria
        ]);
    }

    public function toJsonSemAspas() {
        return [
            'cursoId' => $this->cursoId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo,
            'bolsas' => $this->bolsas,
            'valor' => $this->valor,
            'matriz' => $this->matriz->toJsonSemAspas(),
            'coordenador' => $this->coordenador->toJsonSemAspas(),
            'tipoCurso' => $this->tipoCurso->toJsonSemAspas(),
            'numeroAulas' => $this->numeroAulas,
            'cargaHoraria' => $this->cargaHoraria
        ];
    }

}
?>