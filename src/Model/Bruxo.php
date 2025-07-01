<?php 

namespace App\Model;


class Bruxo {
    private string $role;
    private string $nome;
    private int $idade;
public function __construct(string $nome, int $idade = 0, string $email = '', string $role = 'bruxo') {
    $this->nome = $nome;
    $this->idade = $idade;
    $this->role = $role;
}

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
