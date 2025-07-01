<?php

class Inscricao
{
    private Aluno $aluno;
    private Torneio $torneio;
    private string $status;

    public function __construct(Aluno $aluno, Torneio $torneio)
    {
        $this->aluno = $aluno;
        $this->torneio = $torneio;
        $this->status = "Pendente";
    }

    public function getAluno(): Aluno
    {
        return $this->aluno;
    }

    public function getTorneio(): Torneio
    {
        return $this->torneio;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function confirmarInscricao(): void
    {
        $this->status = "Confirmada";
        echo "Inscrição de {$this->aluno->getNome()} no {$this->torneio->getNome()} confirmada.\n";
    }

    public function cancelarInscricao(): void
    {
        $this->status = "Cancelada";
        echo "Inscrição de {$this->aluno->getNome()} no {$this->torneio->getNome()} cancelada.\n";
    }
}