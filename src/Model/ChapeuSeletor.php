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
    public function perguntarSelecionarCasa(): void 
    {
        $pontos = [
            'Gifinoria' => 0,
            'Sonserina' => 0,
            'Corvinal' => 0,
            'LufaLufa' => 0,     
    ];
        echo "Bem-vindo ao Chapéu Seletor! \n";
        echo "O que você mais gostaria de ser conhecido? \n";
        echo "1 - O Sabio \n";
        echo "2 - O Bom \n";
        echo "3 - O Ousado \n";
        echo "4 - O Grande \n";
        $resposta = readline("Digite o número da opção mais se adequar a você: ");
        switch ($resposta){
            case '1' : $pontos['Corvinal']++; break;
            case '2' : $pontos['LufaLufa']++; break;
            case '3' : $pontos['Grifinoria']++; break;
            case '4' : $pontos['Sonserina']++; break;
        }
    }
}

