<?php

// app/Models/ResultadoDesafio.php

class ResultadoDesafio
{
    private Inscricao $inscricao; // A quem pertence esse resultado
    private int $pontuacaoObtida;
    private DateTime $dataRegistro;

    public function __construct(Inscricao $inscricao, int $pontuacaoObtida)
    {
        $this->inscricao = $inscricao;
        $this->pontuacaoObtida = $pontuacaoObtida;
        $this->dataRegistro = new DateTime();
    }

    public function getInscricao(): Inscricao
    {
        return $this->inscricao;
    }

    public function getPontuacaoObtida(): int
    {
        return $this->pontuacaoObtida;
    }

    public function getDataRegistro(): DateTime
    {
        return $this->dataRegistro;
    }
}