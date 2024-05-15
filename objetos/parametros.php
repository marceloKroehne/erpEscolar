<?
Class Parametro{
    private $id;
    private $label;
    public $dados;

    function __construct(
        $id,
        $label

    ){
        $this->id =  $id;
        $this->label = $label;
    }

    function getId(){
        return $this->id;
    }

    function getNome(){
        return $this->label;
    }

    public function toJson() {
        return json_encode(
            [
                'id' => $this->id,
                'label' => $this->label,
                'dados' => $this->dados
            ]
        );
    }

    public function toJsonAutocomplete() {
        return json_encode(
            [
                'label' => $this->label,
                'value' => $this->dados
            ]
        );
    }
}

?>