<?
class Turno{

    private $turnoId;
    private $nome;
    private $empresaId;
    private $ativo;

    function __construct(
        $turnoId,
        $empresaId,
        $nome,
        $ativo
    ){
        $this->turnoId = $turnoId;
        $this->empresaId = $empresaId;
        $this->nome = $nome;
        $this->ativo = $ativo;
    }

    public function getTurnoId(){
        return $this->turnoId;
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
            'turnoId' => $this->turnoId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo
        ]);
    }

    public function toJsonSemAspas() {
        return [
            'turnoId' => $this->turnoId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo
        ];
    }

}
?>