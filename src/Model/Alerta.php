<?php

namespace App\Model;

class Alerta {

    protected string $notificacao;
    protected string $aviso;
    protected string $tipo;


    public function __construct(string $notificacao, string $aviso, string $tipo) {
        $this->notificacao = $notificacao;
        $this->aviso = $aviso;
        $this->tipo = $tipo;
    }

    public function getnotificacao() : string {
        return $this->notificacao;
    }   
    public function setnotificacao(string $notificacao): void {
        $this->notificacao = $notificacao;
    }
    public function getaviso() : string {
        return $this->aviso;
    }
    public function setaviso(string $aviso) : void {
        $this->aviso = $aviso;
    }
    public function gettipo() : string {
        return $this->tipo;
    }
    public function settipo(string $tipo) : void {
        $this->tipo = $tipo;
    }

}


