<?php
namespace App\Model;
use App\Model\Grifinoria;
use App\Model\Sonserina;
use App\Model\Corvinal;
use App\Model\LufaLufa;
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
        echo "Quando você morrer, o que gostaria que as pessoas lembrassem de você? \n";
        echo "1 - Que eu era corajoso \n";
        echo "2 - Que eu era sábio \n";
        echo "3 - Que eu era ambicioso \n";
        echo "4 - Que eu era leal \n";
        $resposta = readline("Digite o número da opção mais se adequar a você: ");
        switch ($resposta) {
            case '1':
                $this->setCasaSelecionada('Grifinoria');
                break;
            case '2':
                $this->setCasaSelecionada('corvinal');
                break;
            case '3':
                $this->setCasaSelecionada('Sonserina');
                break;
            case '4':
                $this->setCasaSelecionada('LufaLufa');
                break;
            default:
                echo "Opção invalida. Por favor, tente novamnete.\n";
                $this->setCasaSelecionada('');
                $this->perguntarSelecionarCasa();
                return;
        }
        echo "Você foi selecionado para a casa: " . $this->getCasaSelecionada() . "\n";
    }
}