<?php

class email{

    private $destinatario;
    private $remetente;
    private $assunto;
    private $mensagem;

    function __construct($destinatario, $remetente, $assunto, $mensagem){
        $this->destinatario = $destinatario;
        $this->remetente = $remetente;
        $this->assunto = $assunto;
        $this->mensagem = $mensagem;
    }

    function enviarEmail(){
        $headers = "From: $this->remetente" . "\r\n" .
        "Reply-To: $this->remetente" . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

        mail($this->destinatario, $this->assunto, $this->mensagem, $headers);
    }

}