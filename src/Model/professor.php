<?php
class professor{
    private $nome;
    private $disciplinas;
    private $turmas;
    private $cronograma;
  

    public function __construct($nome){
        $this->nome = $nome;
        $this->disciplinas = [];
        $this->turmas = [];
        $this->cronograma = [];
    }
    public function abrirCronograma (){
       $diasSemana = ["Segunda", "Terça", "Quarta", "Quinta", "Sexta"];
        foreach ($diasSemana as $dia) {
            $this->cronograma[$dia] = [];
    }
}
public function getNome(){
    return $this->nome;
}
public function getDisciplinas(){
    return $this->disciplinas;
}
public function getTurmas(){
    return $this->turmas;
}
public function getCronograma(){
    return $this->cronograma;
}
    public function AddDisciplina ($disciplina){
        if (!in_array($disciplina, $this->disciplinas)) {
            $this->disciplinas[] = $disciplina;
        }   
    }
    public function AddTurma ($turma){
        if (!in_array($turma, $this->turmas)) {
            $this->turmas[] = $turma;
        }   
    }
    public function AddHorario ($dia, $horario){
        if (array_key_exists($dia,$this->cronograma)){
            $this->cronograma[$dia][] = $horario;
        }
    }
     public function exibirCronograma() {
        echo "\n📅 Cronograma do Professor " . $this->nome . ":\n";
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
}





