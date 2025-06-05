<?php 

namespace App\Model;

class Carta {
    
    private string $mensagem;
    private bool $temIdadeMinima;
    private array $aprovados = [];
    private array $rejeitados = [];
    private Aluno $aluno;

    public function __construct(Aluno $aluno) {
        $this->aluno = $aluno;
        $this->verificaIdade();
    }

    public function getAprovados(): array {
        return $this->aprovados;
    }

    public function getRejeitados(): array {
        return $this->rejeitados;
    }

    public function getMensagem(): string {
        return $this->mensagem;
    }

    public function getTemIdadeMinima(): bool {
        return $this->temIdadeMinima;
    }

    public function getAluno(): Aluno {
        return $this->aluno;
    }

    public function verificaIdade(): void {
        $idade = $this->aluno->getIdade();
        $this->temIdadeMinima = ($idade >= 11);
    }

    public function enviaCarta(): bool {
        $nome = $this->aluno->getNome();

        if($this->temIdadeMinima) {
            $this->mensagem = $this->gerarCartaAprovacao($nome);
            $this->adicionarAosAprovados();
            $this->aluno->marcarConviteEnviado();
            return true;
        } else {
            $this->mensagem = $this->gerarCartaRejeicao($nome);
            $this->adicionarAosRejeitados();
            $this->aluno->marcarConviteEnviado();
            return false;
        }
    }

    private function gerarCartaAprovacao(string $nome): string {
        return "Prezado(a) Sr./Sra. {$nome},

Temos o prazer de informá-lo(a) que foi aceito(a) na Escola de Magia e Bruxaria de Hogwarts.

Estão anexadas a esta carta as informações sobre a lista de materiais necessários para o ano letivo, que começa em 1º de setembro.

Aguardamos ansiosamente o seu retorno até 31 de julho.

Atenciosamente,
Diretor de Hogwarts

---
LISTA DE MATERIAIS NECESSÁRIOS:
• Varinha mágica
• Caldeirão (tamanho padrão 2, estanho, prata)
• Conjunto de balança de latão
• Telescópio
• Kit de vidros para poções

LIVROS OBRIGATÓRIOS:
• O Livro Padrão de Feitiços (1º ano) - Miranda Goshawk
• História da Magia - Bathilda Bagshot
• Teoria Mágica - Adalbert Waffling
• Guia de Transfiguração para Iniciantes - Emeric Switch
• Mil Ervas e Fungos Mágicos - Phyllida Spore

UNIFORME:
• Três conjuntos de vestes de trabalho (pretas) para uso diário
• Um chapéu pontudo (preto) para uso diário
• Um par de luvas protetoras (couro de dragão ou similar)
• Uma capa de inverno (preta, com fechos prateados)";
    }

    private function gerarCartaRejeicao(string $nome): string {
        return "Prezado(a) Sr./Sra. {$nome},

Lamentamos informar que você não atende aos requisitos de idade mínima para ser aceito(a) na Escola de Magia e Bruxaria de Hogwarts.

A idade mínima para ingresso é de 11 anos completos até o início do ano letivo.

Agradecemos o seu interesse e esperamos que você possa se inscrever novamente no futuro quando atingir a idade adequada.

Atenciosamente,
Diretor de Hogwarts

P.S.: Não desanime! A magia estará sempre esperando por você quando chegar a hora certa.";
    }

    private function adicionarAosAprovados(): void {
        $this->aprovados[] = $this->aluno;
    }

    private function adicionarAosRejeitados(): void {
        $this->rejeitados[] = $this->aluno;
    }

    public function simularEnvioCoruja(): void {
        echo "🦉 Uma coruja majestosa alça voo em direção a {$this->aluno->getEmail()}\n";
        echo "📜 Carregando uma carta oficial de Hogwarts para {$this->aluno->getNome()}\n";
        echo "✨ A carta brilha com um selo mágico...\n\n";
    }

    public function exibirCarta(): void {
        echo "=" . str_repeat("=", 60) . "=\n";
        echo "🏰 CARTA OFICIAL DE HOGWARTS 🏰\n";
        echo "=" . str_repeat("=", 60) . "=\n\n";
        echo $this->mensagem . "\n\n";
        echo "=" . str_repeat("=", 60) . "=\n";
        echo "Destinatário: {$this->aluno->getNome()} ({$this->aluno->getEmail()})\n";
        echo "Idade: {$this->aluno->getIdade()} anos\n";
        echo "Status: " . ($this->temIdadeMinima ? "APROVADO ✅" : "AGUARDAR IDADE ⏳") . "\n";
        echo "=" . str_repeat("=", 60) . "=\n\n";
    }
}

?>