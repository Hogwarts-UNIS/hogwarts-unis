<?php
class funcionario{
    private $nome;
    private $cargo;
    private $setor;

    public function __construct($nome, $cargo, $setot){
        $this->nome=$nome;
        $this->cargo=$cargo;
        $this->setor=$settor;
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
    public function __toString(){
        return sprintf("%s\n  Cargo:%s \n  Setor:%s",
        $this->nome,
        $this->cargo,
        $this->setor);
    }







           }
