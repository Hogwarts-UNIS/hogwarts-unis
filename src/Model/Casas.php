<?php
    
   class Casa
{
    private string $nome;
    private int $pontuacaoTotal;

    public function __construct(string $nome)
    {
        $this->nome = $nome;
        $this->pontuacaoTotal = 0; // Começa com 0 pontos
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getPontuacaoTotal(): int
    {
        return $this->pontuacaoTotal;
    }

    public function adicionarPontos(int $pontos): void
    {
        if ($pontos > 0) {
            $this->pontuacaoTotal += $pontos;
            echo "{$this->nome} ganhou {$pontos} pontos. Pontuação total: {$this->pontuacaoTotal}\n";
        }
    }

    public function removerPontos(int $pontos): void
    {
        if ($pontos > 0) {
            $this->pontuacaoTotal -= $pontos;
            if ($this->pontuacaoTotal < 0) {
                $this->pontuacaoTotal = 0; 
            }
            echo "{$this->nome} perdeu {$pontos} pontos. Pontuação total: {$this->pontuacaoTotal}\n";
        }
    }
}