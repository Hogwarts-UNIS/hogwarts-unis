<?php

namespace App\Model;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Model\Professor;
use App\Model\Funcionario;
use App\Model\Aluno;

class GerenciamentoProfissional
{
    private array $professores;
    private array $funcionarios;
    private array $disciplinasDisponiveis;
    private array $turmasDisponiveis;
    private array $diasSemana;
    private array $setoresDisponiveis;
    private array $cargosDisponiveis;

    public function __construct()
    {
        $this->professores = [];
        $this->funcionarios = [];
        $this->inicializarDados();
    }
//dados sistema
    private function inicializarDados(): void
    {
        $this->disciplinasDisponiveis = [
            'Poções','Defesa Contra as Artes das Trevas','Herbologia','Transfiguração','Feitiços'];

        $this->turmasDisponiveis = [
            "1º Ano","2º Ano","3º Ano","4º Ano","5º Ano","6º Ano","7º Ano"
        ];

        $this->diasSemana = [
            "Segunda","Terça","Quarta","Quinta","Sexta","Sábado"
        ];

        $this->setoresDisponiveis = [
            'Administração','Cozinha','Limpeza','Biblioteca',
            
        ];

        $this->cargosDisponiveis = [
            'Bibliotecário','Cozinheiro','Zelador','Secretário','Assistente'];
    }

    // metodo p prof
     //Busca um professor pelo nome 
     
    private function buscarProfessor(string $nome): ?Professor
    {
        foreach ($this->professores as $professor) {
            if (strcasecmp($professor->getNome(), $nome) === 0) {
                return $professor;
            }
        }
        return null;
    }

    //cadastra novo prof
    public function cadastrarProfessor(string $nome, int $idade = 0, string $email = ''): bool
    {
        if (empty(trim($nome))) {
            echo "Erro: Nome do professor não pode estar vazio!\n";
            return false;
        }

        if ($this->buscarProfessor($nome) !== null) {
            echo "Erro: Professor '$nome' já existe!\n";
            return false;
        }

        try {
            $professor = new Professor($nome, $idade, $email);
            $this->professores[] = $professor;
            return true;
        } catch (Exception $e) {
            echo "Erro ao cadastrar professor: " . $e->getMessage() . "\n";
            return false;
        }
    }

    //associa discip ao prof
    public function associarDisciplina(string $nomeProfessor, string $disciplina): bool
    {
        $professor = $this->buscarProfessor($nomeProfessor);
        if ($professor === null) {
            echo "Professor '$nomeProfessor' não encontrado!\n";
            return false;
        }

        if (!in_array($disciplina, $this->disciplinasDisponiveis)) {
            echo "Disciplina '$disciplina' não está disponível!\n";
            echo "Disciplinas disponíveis: " . implode(', ', $this->disciplinasDisponiveis) . "\n";
            return false;
        }

        $professor->addDisciplina($disciplina);
        return true;
    }

    //turma ao prof
    public function associarTurma(string $nomeProfessor, string $turma): bool
    {
        $professor = $this->buscarProfessor($nomeProfessor);
        if ($professor === null) {
            echo "Professor '$nomeProfessor' não encontrado!\n";
            return false;
        }

        if (!in_array($turma, $this->turmasDisponiveis)) {
            echo "Turma '$turma' não está disponível!\n";
            echo "Turmas disponíveis: " . implode(', ', $this->turmasDisponiveis) . "\n";
            return false;
        }

        $professor->addTurma($turma);
        return true;
    }

    //add horario ao prof
    public function addHorarioProfessor(string $nomeProfessor, string $dia, string $horario): bool
    {
        $professor = $this->buscarProfessor($nomeProfessor);
        if ($professor === null) {
            echo " Professor '$nomeProfessor' não encontrado!\n";
            return false;
        }

        if (!in_array($dia, $this->diasSemana)) {
            echo "Dia '$dia' não é válido!\n";
            echo "Dias disponíveis: " . implode(', ', $this->diasSemana) . "\n";
            return false;
        }

        if (empty(trim($horario))) {
            echo "Horário não pode estar vazio!\n";
            return false;
        }

        $professor->addHorario($dia, $horario);
        return true;
    }

    //p consultar
    public function consultarCronogramaProfessor(string $nomeProfessor): bool
    {
        $professor = $this->buscarProfessor($nomeProfessor);
        if ($professor === null) {
            echo "Professor '$nomeProfessor' não encontrado!\n";
            return false;
        }

        $professor->exibirCronograma();
        return true;
    }

    //mostra tds os prof
    public function listarProfessores(): void
    {
        if (empty($this->professores)) {
            echo " Nenhum professor cadastrado ainda.\n";
            return;
        }

        echo "\n" . str_repeat("=", 50) . "\n";
        echo "           PROFESSORES CADASTRADOS \n";
        echo str_repeat("=", 50) . "\n";

        foreach ($this->professores as $index => $professor) {
            echo ($index + 1) . ". " . $professor . "\n";
            echo str_repeat("-", 30) . "\n";
        }
    }
    // metodo para funcionários

    //busca o funcionario pelo nome
    private function buscarFuncionario(string $nome): ?Funcionario
    {
        foreach ($this->funcionarios as $funcionario) {
            if (strcasecmp($funcionario->getNome(), $nome) === 0) {
                return $funcionario;
            }
        }
        return null;
    }

    //cadastra novo funcionario
    public function cadastrarFuncionario(string $nome, string $cargo, string $setor): bool
    {
        if (empty(trim($nome)) || empty(trim($cargo)) || empty(trim($setor))) {
            echo "Erro: Nome, cargo e setor são obrigatórios!\n";
            return false;
        }

        if ($this->buscarFuncionario($nome) !== null) {
            echo "Erro: Funcionário '$nome' já existe!\n";
            return false;
        }

        if (!in_array($cargo, $this->cargosDisponiveis)) {
            echo "Cargo '$cargo' não está disponível!\n";
            echo "Cargos disponíveis: " . implode(', ', $this->cargosDisponiveis) . "\n";
            return false;
        }

        if (!in_array($setor, $this->setoresDisponiveis)) {
            echo "Setor '$setor' não está disponível!\n";
            echo "Setores disponíveis: " . implode(', ', $this->setoresDisponiveis) . "\n";
            return false;
        }

        try {
            $funcionario = new Funcionario($nome, $cargo, $setor);
            $this->funcionarios[] = $funcionario;
            return true;
        } catch (Exception $e) {
            echo "Erro ao cadastrar funcionário: " . $e->getMessage() . "\n";
            return false;
        }
    }

    // getters

    public function getDisciplinasDisponiveis(): array
    {
        return $this->disciplinasDisponiveis;
    }

    public function getTurmasDisponiveis(): array
    {
        return $this->turmasDisponiveis;
    }

    public function getDiasSemana(): array
    {
        return $this->diasSemana;
    }

    public function getSetoresDisponiveis(): array
    {
        return $this->setoresDisponiveis;
    }

    public function getCargosDisponiveis(): array
    {
        return $this->cargosDisponiveis;
    }

    public function getProfessores(): array
    {
        return $this->professores;
    }

    public function getFuncionarios(): array
    {
        return $this->funcionarios;
    }
}
