<?php
namespace App\Model;

class funcionario{
    private $nome;
    private $cargo;
    private $setor;

    public function __construct($nome, $cargo, $setor){
        $this->nome=$nome;
        $this->cargo=$cargo;
        $this->setor=$setor;
    }
    public function getNome(){
        return $this->nome;
    }
    public function getCargo(){
        return $this->cargo;
    }
    public function getSetor(){
        return $this->setor;
    }
     public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function setCargo(string $cargo): void
    {
        $this->cargo = $cargo;
    }

    public function setSetor(string $setor): void
    {
        $this->setor = $setor;
    }
    public function __toString(){
        return sprintf("%s\n  Cargo:%s\n  Setor:%s",
        $this->nome,
        $this->cargo,
        $this->setor);
    }







           }
