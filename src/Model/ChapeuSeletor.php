<?php

namespace App\Model\Grifinoria;
namespace app\model\Sonserina;
namespace app\model\Corvinal;
namespace app\model\LufaLUfa;

    class ChapeuSeletor 
    {
        private array $casas;
        private string $casaSelecionada;

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
}

