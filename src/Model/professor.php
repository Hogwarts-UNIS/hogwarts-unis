<?php
namespace App\Model;
use App\Model\Avaliacao;

require_once __DIR__ . '/Bruxo.php';
require_once __DIR__ . '/Avaliacao.php';
class professor extends Bruxo {
    protected $disciplinas;
    protected $turmas;
    protected $cronograma;
  

 public function __construct(string $nome, int $idade = 0, string $email = '') {
    parent::__construct($nome, $idade, $email, 'professor');
    $this->disciplinas = [];
    $this->turmas = [];
    $this->cronograma = [];
    $this->abrirCronograma();
}

    public function abrirCronograma (){
       $diasSemana = ["Segunda", "Terça", "Quarta", "Quinta", "Sexta"];
        foreach ($diasSemana as $dia) {
            $this->cronograma[$dia] = [];
    }
}
    public function addDisciplina ($disciplina){
        if (!in_array($disciplina, $this->disciplinas)) {
            $this->disciplinas[] = $disciplina;
        }   
    }
    public function addTurma ($turma){
        if (!in_array($turma, $this->turmas)) {
            $this->turmas[] = $turma;
        }   
    }
    public function addHorario ($dia, $horario){
        if (array_key_exists($dia,$this->cronograma)){
            $this->cronograma[$dia][] = $horario;
        }
    }
     public function exibirCronograma() {
        echo "\n Cronograma do Professor " . $this->nome . ":\n";
        echo "══════════════════════════════════════\n";
        foreach ($this->cronograma as $dia => $horarios) {
            printf("%-10s: ", $dia);
            if (empty($horarios)) {
                echo "Livre\n";
            } else {
                echo implode(", ", $horarios) . "\n";
            }
        }
    }
    public function __toString() {
     $disciplinasStr = implode(", ", $this->disciplinas);
        $turmasStr = implode(", ", $this->turmas);
        return sprintf("%s\n   Disciplinas: %s\n   Turmas: %s", 
            $this->nome, $disciplinasStr, $turmasStr);
    }
    public function registrarNota(Aluno $aluno, string $disciplina, float $nota): void
    {
        $avaliacao = new Avaliacao($disciplina, $nota);
        $aluno->getBoletim()->adicionarAvaliacao($avaliacao);
        echo "-> Prof. {$this->getNome()} registrou a nota $nota para {$aluno->getNome()} em $disciplina.\n\n";
    }

    public function darPontos(Casa $casa, int $pontos, string $motivo): void
    {
        echo "-> Prof. {$this->getNome()} deu $pontos pontos para a {$casa->getNome()} por: '$motivo'.\n";
        $casa->adicionarPontos($pontos);
    }

    public function tirarPontos(Casa $casa, int $pontos, string $motivo): void
    {
        echo "-> Prof. {$this->getNome()} tirou $pontos pontos da {$casa->getNome()} por: '$motivo'.\n";
        $casa->adicionarPontos(-$pontos);
    }
}






