<?php
namespace App\Model;

class Casa
{
    private string $nome;
    private int $pontuacao = 0;

    public function __construct(string $nome)
    {
        $this->nome = $nome;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function adicionarPontos(int $pontos): void
    {
        $this->pontuacao += $pontos;
    }

    public function getPontuacaoTotal(): int
    {
        return $this->pontuacao;
    }
}