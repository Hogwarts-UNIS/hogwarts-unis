<?php
namespace App\Model;
use App\Model\Avaliacao;

class Boletim
{
    private array $avaliacoes = [];

    public function adicionarAvaliacao(Avaliacao $avaliacao): void
    {
        $this->avaliacoes[] = $avaliacao;
    }

    public function exibir(): void
    {
        echo "--------------------------------\n";
        echo "BOLETIM DE DESEMPENHO\n";
        echo "--------------------------------\n";
        if (empty($this->avaliacoes)) {
            echo "Nenhuma nota registrada.\n";
        } else {
            foreach ($this->avaliacoes as $avaliacao) {
                printf(
                    "- %-25s: %.1f\n",
                    $avaliacao->getDisciplinaNome(),
                    $avaliacao->getNota()
                );
            }
        }
        echo "--------------------------------\n\n";
    }
    }
