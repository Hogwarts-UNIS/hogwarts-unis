<?php 

namespace App\Model;


class Bruxo {
    private string $role;
    private string $nome;
    private int $idade;


    public function getNome() {
        return $this->nome;
    }

    public function getIdade() {
        return $this->idade;
    }

    public function getRole() {
        return $this->role;
    }

}