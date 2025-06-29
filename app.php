<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Model\ChapeuSeletor;
use App\Model\Aluno;
use App\Model\Bruxo;
use App\Model\gerenciamentoProfissional;

$nome = readline("Digite o nome do aluno: ");
$idade = (int) readline("Digite a idade do aluno: ");
$email = readline("Digite a casa do aluno (ou deixe vazio): ");
$aluno = new Aluno($nome, $idade, $email);
$chapeu = new ChapeuSeletor();
$chapeu->setAluno($aluno);
$chapeu->menu();






