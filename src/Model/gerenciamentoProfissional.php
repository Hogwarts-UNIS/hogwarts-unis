<?php
namespace App\Model;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Model\Aluno;

class GerenciamentoProfissional
{
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