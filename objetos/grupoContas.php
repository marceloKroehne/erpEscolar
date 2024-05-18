<?

class GrupoContas{
    private $grupoContaId;
    private $nome;
    private $empresaId;
    private $ativo;
    private $recebimentoVendas;

    function __construct(
        $grupoContaId,
        $empresaId,
        $nome,
        $ativo,
        $recebimentoVendas
    ){
        $this->grupoContaId = $grupoContaId;
        $this->nome = $nome;
        $this->empresaId = $empresaId;
        $this->ativo = $ativo;
        $this->recebimentoVendas = $recebimentoVendas;
    }

    public function getGrupoContaId(){
        return $this->grupoContaId;
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

    public function isRecebimentoVendas(){
        return $this->recebimentoVendas; 
    }
    public function toJsonSemAspas() {
        return [
            'grupoContaId' => $this->grupoContaId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo,
            'recebimentoVendas' => $this->recebimentoVendas
        ];
    }

    public function toJson() {
        return json_encode([
            'grupoContaId' => $this->grupoContaId,
            'empresaId' => $this->empresaId,
            'nome' => $this->nome,
            'ativo' => $this->ativo,
            'recebimentoVendas' => $this->recebimentoVendas
        ]);
    }

}

?>