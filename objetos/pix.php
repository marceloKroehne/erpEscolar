<?

class Pix{

    private $chave;
    private $tipoChave;

    function __construct(
        $chave,
        $tipoChave
    ){
        $this->chave = $chave;
        $this->tipoChave = $tipoChave;
    }

    public function getChave(){
        return $this->chave;
    }

    public function getTipoChave(){
        return $this->tipoChave;
    }

    public function toJson() {
        return json_encode([
            'chave' => $this->chave,
            'tipoChave' => $this->tipoChave
        ]);
    }
    public function toJsonSemAspas() {
        return [
            'chave' => $this->chave,
            'tipoChave' => $this->tipoChave
        ];
    }

}

?>