<?php
namespace App\Model;

class Casa
{
    protected string $nome;
    protected array $alunos = [];
    protected int $pontosAvaliacao = 0;

    public function __construct(string $nome)
    {
        $this->nome = $nome;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

        public function setPontosAvaliacao(int $pontos): void
    {
        $this->pontosAvaliacao = $pontos;
    }

    public function getPontosAvaliacao(): int
    {
        return $this->pontosAvaliacao;
    }
    
    public function adicionarAluno(Aluno $aluno): void 
    {
        $this->alunos[] = $aluno;
        $this->pontosAvaliacao++;
    
    }
    public function getAlunos(): array
    {
        return $this->alunos;
    }
    public function getQuantidadeAlunos(): int
    {
        return count($this->alunos);
    }

}