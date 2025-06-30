<?php
namespace App\Model;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Model\Aluno;

class GerenciamentoProfissional //jussara
{
    private $professores;
    private $funcionarios;
    private $disciplinasDisponiveis;
    private $turmasDisponiveis;

    public function __construct(){
        $this->professores = [];
        $this->funcionarios = [];
        $this->inicioDados();
    }
    private function inicioDados(): void
    {
        $this->disciplinasDisponiveis = [
        'Poções', 'Defesa Contra as Artes das Trevas', 'Herbologia', 'Transfiguração'];
       $this->turmasDisponiveis=[
            "1º Ano", "2º Ano", "3º Ano", "4º Ano", "5º Ano", "6º Ano", "7º Ano"];
       }
    private function buscarProfessor($nome) {
        foreach ($this->professores as $professor) {
            if (strcasecmp($professor->getNome(), $nome) == 0) {
                return $professor;
            }
        }
        return null;
    }
    //metodos pra profs
    private function cadastrarProfessor($nome) {
        if ($this->buscarProfessor($nome) != null) {
            echo "Erro: Professor " . $nome . " já existe!\n";
            return;
        }
//ccadastro prof
      $professor = new Professor($nome);
        $this->professores[] = $professor;
        echo "Professor " . $nome . " cadastrado com sucesso!\n";
    }
    //associa disciplina ao prof pelo nome
    public function associarDisciplina($nomeProfessor, $disciplina) {
        $professor = $this->buscarProfessor($nomeProfessor);
        if ($professor == null) {
            echo "Professor " . $nomeProfessor . " não encontrado!\n";
            return;
        }
        if (!in_array($disciplina, $this->disciplinasDisponiveis)) {
            echo "Disciplina '" . $disciplina . "' não disponível!\n";
            return;
        }
        $professor->adicionarDisciplina($disciplina);
        echo "Disciplina '" . $disciplina . "' associada ao professor " . $nomeProfessor . "\n";
    }
    //associa turma ao prof pelo nome
    public function associarTurma($nomeProfessor, $turma) {
        $professor = $this->buscarProfessor($nomeProfessor);
        if ($professor == null) {
            echo "Professor " . $nomeProfessor . " não encontrado!\n";
            return;
        }
        if (!in_array($turma, $this->turmasDisponiveis)) {
            echo "Turma '" . $turma . "' não disponível!\n";
            return;
        }
        $professor->adicionarTurma($turma);
        echo "Turma '" . $turma . "' associada ao professor " . $nomeProfessor . "\n";
    }
    //adiciona horario ao cronograma do prof pelo nome
    public function adicionarHorarioProfessor($nomeProfessor, $dia, $horario) {
        $professor = $this->buscarProfessor($nomeProfessor);
        if ($professor == null) {
            echo "Professor " . $nomeProfessor . " não encontrado!\n";
            return;
        }
        $professor->adicionarHorario($dia, $horario);
        echo "Horário adicionado ao cronograma do professor " . $nomeProfessor . "\n";
    }
    //para consultar horario do prof
    public function consultarCronogramaProfessor($nomeProfessor) {
        $professor = $this->buscarProfessor($nomeProfessor);
        if ($professor == null) {
            echo "Professor " . $nomeProfessor . " não encontrado!\n";
            return;
        }
        //chama o metodo exbibirCronograma da class professor
        $professor->exibirCronograma();
    }
    //metodos para funcionarios
      private function buscarFuncionario($nome) {
        foreach ($this->funcionarios as $funcionario) {
            if (strcasecmp($funcionario->getNome(), $nome) == 0) {
                return $funcionario;
            }
        }
        return null;
    }
    public function cadastrarFuncionario ($nome, $cargo, $setor){
        if ($this->buscarFuncionario ($nome)!==null) {
            echo "Funcionário" . $nome . "já existe.\n";
            return;
        }
        $funcionario = new Funcionario($nome, $cargo, $setor);
        $this->funcionarios[] = $funcionario;
        echo "Funcionário " . $nome . " cadastrado com sucesso!\n";
    }

    //diogo
    public function mostrarDistribuicaoPorCasa(): void
    {
        $distribuicao = Aluno::getDistribuicaoPorCasa();
        echo "Distribuição de alunos por casa:\n";
        foreach ($distribuicao as $casa => $quantidade) {
            echo "$casa: $quantidade\n";
        }
    }
}

$gerente = new GerenciamentoProfissional();
$gerente->mostrarDistribuicaoPorCasa();

