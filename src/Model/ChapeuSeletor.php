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
        private ?Aluno $aluno = null;

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
    public function getAluno() : ?Aluno 
    {
        return $this->aluno;
    }
    public function setaluno(Aluno $aluno): void 
    {
        $this->aluno = $aluno;
    }

    Public function menu(): void 
    {
        while (true) {
            echo "BEM VINDO!! AGORA QUE VOCÊ É UM DOS NOSSOS ALUNOS, PRECISA ESCOLHER UMA CASA!🏘 \n";
            echo "1 - ✅ Começar a seleção \n";
            echo "2 - 🏡 Ver casa selecionada \n";
            echo "3 - 🧹 Sair \n";
            $Opcao = readline("digite o número do serviço que deseja: ");

            switch ($Opcao) {
                case '1':
                    $this->perguntarSelecionarCasa();
                    break;
                case '2':
                    if ($this->getCasaSelecionada() !== '') {
                        echo "Você está na casa: " . $this->getCasaSelecionada() . "\n";
                    } else {
                        echo "Você ainda não foi selecionado para uma casa.\n"; 
                    }
                    break;
                case '3':
                    echo "Parabéns {$this->aluno->getNome()} você foi selecionado para Hogwarts! 🎉\n";
                    echo "Obrigado por usar o Chapéu Seletor. Até logo!\n";
                    return;
                default:
                    echo "Opção inválida. Por favor, tente novamente.\n";
            }
        }
    }

    public function perguntarSelecionarCasa(): void 
    {

        echo "SEJA BEM VINDO AO CHAPÉU SELETOR!🎩 \n";
        echo "RESPONDA A PERGUNTA DO CHAPÉU PARA SELECIONARMOS A SUA CASA ⬇\n";
        echo "--Quando você morrer, como gostaria que as pessoas se lembrassem de você? \n";
        echo "1 - De que eu era corajoso \n";
        echo "2 - De que eu era sábio \n";
        echo "3 - De que eu era ambicioso \n";
        echo "4 - De que eu era leal \n";
        $resposta = readline("DIGITE AQUI O NÚMERO DA OPÇÃO QUE VOCÊ MAIS SE IDENTIFICOU: ");
        $casa = null;
        switch ($resposta) {
            case '1':
               $casa = 'GRIFINÓRIA! 🦁';
                break;
            case '2':
                $casa = 'CORVINAL 🦅';
                break;
            case '3':
                $casa = 'SONSERINA 🐍';
                break;
            case '4':
                $casa = 'LUFALUFA 🦨';
                break;
            default:
                echo "Opção inválida. Por favor, tente novamente!\n";
                $this->perguntarSelecionarCasa();
                return;
        }
        $this->setCasaSelecionada($casa);
        if ($this->aluno) {
            $this->aluno->setCasa($casa);
            echo "---O aluno {$this->aluno->getNome()} foi selecionado para a casa: " . $this->aluno->getCasa() . "\n";
        }
            else {
                echo "Você foi selecionado para a casa: " . $this->getCasaSelecionada() . "\n";
            }
    }
}