<?php

namespace App\Model;
use App\Model\Bruxo;
class Professor extends Bruxo {
    
    protected string $disciplina;
    protected ?\DateTime $dataContratacao = null;

    public function __construct(string $nome, int $idade, string $email, string $disciplina) {
        parent::__construct($nome, $idade, $email, 'professor');
        $this->disciplina = $disciplina;
        $this->dataContratacao = new \DateTime();
    }
    
    public function getDisciplina(): string {
        return $this->disciplina;
    }

    public function getDataContratacao(): ?\DateTime {
        return $this->dataContratacao;
    }
}