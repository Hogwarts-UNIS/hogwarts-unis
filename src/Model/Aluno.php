<?php

namespace App\Model;

class Aluno extends Bruxo {
    
    private bool $resposta;
    
    public function getResposta() {
        return $this->resposta;
    }

    public function confirmaResposta() {
        
        $resposta = $this->resposta;

        if($resposta) {

        }
    }
}