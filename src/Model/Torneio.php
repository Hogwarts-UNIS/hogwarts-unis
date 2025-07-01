<?php
namespace App\Model;

class Torneio
{
    private string $nome;
    private string $tipoDesafios;
    private array $regras;
    private \DateTime $dataInicio;
    private \DateTime $dataFim;
    private string $local;
    private array $desafios;
    private array $inscricoes;
    private bool $ativo;

    public function __construct(
        string $nome,
        string $tipoDesafios,
        array $regras,
        \DateTime $dataInicio,
        \DateTime $dataFim,
        string $local
    ) {
        $this->nome = $nome;
        $this->tipoDesafios = $tipoDesafios;
        $this->regras = $regras;
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
        $this->local = $local;
        $this->desafios = [];
        $this->inscricoes = [];
        $this->ativo = false;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function estaAtivo(): bool
    {
        return $this->ativo;
    }

    public function getDesafios(): array
    {
        return $this->desafios;
    }

    public function getInscricoes(): array
    {
        return $this->inscricoes;
    }

    public function adicionarDesafio(Desafio $desafio): void
    {
        $this->desafios[] = $desafio;
    }

    public function adicionarInscricao(Inscricao $inscricao): void
    {
        $this->inscricoes[] = $inscricao;
        echo "Inscrição de {$inscricao->getAluno()->getNome()} no torneio '{$this->nome}' registrada.\n";
    }

    public function abrirTorneio(): void
    {
        $this->ativo = true;
        echo "Torneio '{$this->nome}' está agora ATIVO e pronto para inscrições e desafios.\n";
    }

    public function encerrarTorneio(): void
    {
        $this->ativo = false;
        echo "Torneio '{$this->nome}' ENCERRADO.\n";
    }

    public function criarDesafio(string $nome, string $descricao, int $pontuacaoBase): Desafio
    {
        $desafio = new Desafio($nome, $descricao, [], $pontuacaoBase, "Local indefinido", new \DateTime());
        $this->adicionarDesafio($desafio);
        return $desafio;
    }
}