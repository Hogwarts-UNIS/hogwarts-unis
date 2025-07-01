<?php

class Desafio
{
    private string $nome;
    private string $descricao;
    private array $regrasEspecificas;
    private int $pontuacaoBase;
    private string $local;
    private DateTime $data;
    private string $status;
    private array $resultados;

    public function __construct(string $nome, string $descricao, array $regrasEspecificas, int $pontuacaoBase, string $local, DateTime $data)
    {
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->regrasEspecificas = $regrasEspecificas;
        $this->pontuacaoBase = $pontuacaoBase;
        $this->local = $local;
        $this->data = $data;
        $this->status = "Pendente";
        $this->resultados = [];
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getPontuacaoBase(): int
    {
        return $this->pontuacaoBase;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getResultados(): array
    {
        return $this->resultados;
    }

    public function iniciarDesafio(): void
    {
        $this->status = "Em Andamento";
        echo "Desafio '{$this->nome}' iniciado!\n";
    }

    public function registrarDesempenho(Inscricao $inscricao, int $pontuacaoObtida): void
    {
        if ($this->status !== "Concluído") {
            $resultado = new ResultadoDesafio($inscricao, $pontuacaoObtida);
            $this->resultados[] = $resultado;
            echo "Desempenho de {$inscricao->getAluno()->getNome()} registrado no desafio '{$this->nome}': {$pontuacaoObtida} pontos.\n";
        } else {
            echo "Erro: Desafio '{$this->nome}' já foi concluído. Não é possível registrar desempenho.\n";
        }
    }

    public function finalizarDesafio(): void
    {
        if ($this->status !== "Concluído") {
            $this->status = "Concluído";
            echo "Desafio '{$this->nome}' finalizado!\n";
        } else {
            echo "Erro: Desafio '{$this->nome}' já está concluído.\n";
        }
    }
}