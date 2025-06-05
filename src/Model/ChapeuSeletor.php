<?php

namespace App\Model\Grifinoria;
namespace app\model\Sonserina;
namespace app\model\Corvinal;
namespace app\model\LufaLUfa;

    class ChapeuSeletor 
    {
        private array $Casas;
        private string $CasaSelecionada;

    public function __construct()
    {
            $this-> casas = [
                new Grifinoria(),
                new Sonserina(),
                new Corvinal(),
                new LufaLufa(), 
            ];
    }

    public function getCasas(): array
    {
        return $this->$casas;
    }
    public function getCasaSelecionada(): string 
    {
        return $this->CasaSelecionada;
        
    }
    public function setCasas(array $casas): void 
    {
        $this->Casas = $casas;
    }
    public function setCasaSelecionada(string $casaSelecionada): void
    {
        $this->CasaSelecionada = $casaSelecionada;
    }
}

