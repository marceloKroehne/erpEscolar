<?

class Permissoes{
    private $permissaoId;
    private $nome;

    function __construct(
        $permissaoId,
        $nome
    ){
        $this->permissaoId = $permissaoId;
        $this->nome = $nome;
    }

    public function getPermissaoId(){
        return $this->permissaoId;
    }

    public function getNome(){
        return $this->nome;
    }

    public function toJson() {
        return json_encode([
            'permissaoId' => $this->permissaoId,
            'nome' => $this->nome
        ]);
    }
    public function toJsonSemAspas() {
        return [
            'permissaoId' => $this->permissaoId,
            'nome' => $this->nome
        ];
    }
}

?>