<?php

namespace App\Model;
use App\Model\Bruxo;
class Cadastro {

    private string $professor;
    private string $disciplina;
    private string $funcionario;
    private string $turma;
    private string $horarios;

    public function __construct(string $professor, string $disciplina, string $funcionario, string $turma, string $horarios) {
        $this->disciplina = $disciplina;
        $this->professor = $professor;
        $this->funcionario = $funcionario;
        $this->turma = $turma;
        $this->horarios = $horarios;
    }
    public function cadastrarProfessor(Bruxo $bruxo): void {
        $this->professor = $bruxo->getNome();
        echo "Professor {$this->professor} cadastrado com sucesso na disciplina {$this->disciplina}.\n";
    }
    public function cadastrarFuncionario(Bruxo $bruxo): void {
        $this->funcionario = $bruxo->getNome();
        echo "Funcionário {$this->funcionario} cadastrado com sucesso.\n";
    }
    public function HorarioDasTurmas(string $turma, string $horarios):void{
        $this->turma=$turma.
        $this->horarios=$horarios;
        echo "A turma {$this->turma} possui os seguintes horários: {$this->horarios}.\n";
    }
    public function DisciplinaMinistrada (string $disciplina, string $professor, string $turma):void{
        $this->disciplina=$disciplina;
        $this->professor=$professor;
        $this->turma=$turma;
        echo "O professor {$this->professor} irá ministrar {$this->disciplina} para a turma {$this->turma}.\n";
    }
    }


