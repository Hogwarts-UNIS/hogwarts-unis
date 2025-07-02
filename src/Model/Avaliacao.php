<?php

namespace App\Model;

class Avaliacao
{
    private string $disciplina;
    private float $nota;

public function __construct(string $disciplina, float $nota)
{
    $this->disciplina = $disciplina;
    $this->nota = $nota;
}

public function getDisciplinaNome(): string
{
    return $this->disciplina;
}

    public function getNota(): float
    {
        return $this->nota;
    }
}