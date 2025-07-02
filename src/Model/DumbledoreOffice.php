<?php
namespace App\Model;

use App\Model\Aluno;
use DateTime;
use App\Model\Casa;
use App\Model\Torneio;
use App\Model\Desafio;  
use App\Model\Inscricao;

class DumbledoreOffice
{
    private $torneios;
    private $casas;
    private $alunos;

    public function __construct()
    {
        $this->torneios = [];
        $this->casas = [];
        $this->alunos = [];
        $this->inicializarCasas();
    }

    private function inicializarCasas(): void
    {
        $this->casas['Grifinória'] = new Casa('Grifinória');
        $this->casas['Sonserina'] = new Casa('Sonserina');
        $this->casas['Lufa-Lufa'] = new Casa('Lufa-Lufa');
        $this->casas['Corvinal'] = new Casa('Corvinal');
        echo "Casas de Hogwarts inicializadas.\n";
    }

    public function getCasa(string $nomeCasa): ?Casa
    {
        return $this->casas[$nomeCasa] ?? null;
    }

    public function getAluno(string $matricula): ?Aluno
    {
        foreach ($this->alunos as $aluno) {
            if ($aluno->getMatricula() === $matricula) {
                return $aluno;
            }
        }
        return null;
    }

    public function criarAluno(string $nome, string $matricula, string $nomeCasa): ?Aluno
    {
        $casaObjeto = $this->getCasa($nomeCasa);

        if ($casaObjeto) {
            $aluno = new Aluno($nome, 11, $nome . '@hogwarts.com');
            $aluno->setCasa($nomeCasa);

            $this->alunos[] = $aluno;
            echo "Aluno {$nome} (Matrícula: {$matricula}, Casa: {$nomeCasa}) criado.\n";
            return $aluno;
        }
        echo "Erro: Casa '{$nomeCasa}' não encontrada para criar aluno.\n";
        return null;
    }

    public function registrarAluno(Aluno $aluno): void
    {
        $this->alunos[] = $aluno;
        echo "Aluno {$aluno->getNome()} registrado com sucesso!\n";
    }

    public function criarTorneio(string $nome, string $tipoDesafios, array $regras, string $dataInicioStr, string $dataFimStr, string $local): Torneio
    {
        $dataInicio = new DateTime($dataInicioStr);
        $dataFim = new DateTime($dataFimStr);
        $torneio = new Torneio($nome, $tipoDesafios, $regras, $dataInicio, $dataFim, $local);
        $this->torneios[] = $torneio;
        echo "Torneio '{$nome}' criado com sucesso.\n";
        return $torneio;
    }

    public function adicionarDesafioAoTorneio(Torneio $torneio, string $nomeDesafio, string $descricao, array $regrasEspecificas, int $pontuacaoBase, string $localDesafio, string $dataDesafioStr): Desafio
    {
        $dataDesafio = new DateTime($dataDesafioStr);
        $desafio = new Desafio($nomeDesafio, $descricao, $regrasEspecificas, $pontuacaoBase, $localDesafio, $dataDesafio);
        $torneio->adicionarDesafio($desafio);
        return $desafio;
    }

    public function abrirTorneio(Torneio $torneio): void
    {
        $torneio->abrirTorneio();
    }

    public function inscreverAlunoEmTorneio(Aluno $aluno, Torneio $torneio): ?Inscricao
    {
        if ($torneio->estaAtivo()) {
            $inscricao = new Inscricao($aluno, $torneio);
            $torneio->adicionarInscricao($inscricao);
            $inscricao->confirmarInscricao();
            return $inscricao;
        }
        echo "Erro: Não é possível inscrever-se no torneio '{$torneio->getNome()}', pois ele não está ativo.\n";
        return null;
    }

    public function registrarDesempenhoDesafio(Desafio $desafio, Inscricao $inscricao, int $pontuacaoObtida): void
    {
        $desafio->registrarDesempenho($inscricao, $pontuacaoObtida);
        $nomeCasaAluno = $inscricao->getAluno()->getCasa();
        $casaDoAluno = $this->getCasa($nomeCasaAluno);
        if ($casaDoAluno) {
            $casaDoAluno->adicionarPontos($pontuacaoObtida);
            echo "Pontos adicionados à casa {$casaDoAluno->getNome()} pelo desafio '{$desafio->getNome()}'.\n";
        } else {
            echo "Erro: Casa '{$nomeCasaAluno}' do aluno não encontrada para adicionar pontos.\n";
        }
    }

    public function finalizarDesafio(Desafio $desafio): void
    {
        $desafio->finalizarDesafio();
    }

    public function finalizarTorneio(Torneio $torneio): void
    {
        $torneio->encerrarTorneio();
    }

    public function gerarRankingCasas(): array
    {
        $ranking = [];
        foreach ($this->casas as $casa) {
            $ranking[] = [
                'nome' => $casa->getNome(),
                'pontuacao' => $casa->getPontuacaoTotal()
            ];
        }
        usort($ranking, fn($a, $b) => $b['pontuacao'] <=> $a['pontuacao']);
        echo "\n--- Ranking das Casas ---\n";
        foreach ($ranking as $pos => $item) {
            echo ($pos + 1) . "º Lugar: {$item['nome']} - {$item['pontuacao']} pontos\n";
        }
        return $ranking;
    }

    public function gerarRelatorioDesempenhoAluno(Aluno $aluno): void
    {
        echo "\n--- Relatório de Desempenho de {$aluno->getNome()} ({$aluno->getCasa()}) ---\n";
        $totalPontosTorneios = 0;

        foreach ($this->torneios as $torneio) {
            $inscritoNoTorneio = false;
            foreach ($torneio->getInscricoes() as $inscricao) {
                if ($inscricao->getAluno() === $aluno && $inscricao->getStatus() === "Confirmada") {
                    $inscritoNoTorneio = true;
                    echo "  Torneio: {$torneio->getNome()}\n";
                    echo "    Desafios Participados:\n";
                    $pontosNoTorneio = 0;
                    foreach ($torneio->getDesafios() as $desafio) {
                        foreach ($desafio->getResultados() as $resultado) {
                            if ($resultado->getInscricao()->getAluno() === $aluno) {
                                echo "      - {$desafio->getNome()}: {$resultado->getPontuacaoObtida()} pontos\n";
                                $pontosNoTorneio += $resultado->getPontuacaoObtida();
                            }
                        }
                    }
                    echo "    Pontuação Total no Torneio: {$pontosNoTorneio} pontos\n";
                    $totalPontosTorneios += $pontosNoTorneio;
                }
            }
        }
        echo "Total de pontos em competições: {$totalPontosTorneios} pontos.\n";
    }

    public function gerarRankingTorneio(Torneio $torneio): void
    {
        echo "\n--- Ranking do Torneio '{$torneio->getNome()}' ---\n";
        $rankingTorneio = [];

        foreach ($torneio->getInscricoes() as $inscricao) {
            if ($inscricao->getStatus() === "Confirmada") {
                $aluno = $inscricao->getAluno();
                $pontosAlunoNoTorneio = 0;
                foreach ($torneio->getDesafios() as $desafio) {
                    foreach ($desafio->getResultados() as $resultado) {
                        if ($resultado->getInscricao()->getAluno() === $aluno) {
                            $pontosAlunoNoTorneio += $resultado->getPontuacaoObtida();
                        }
                    }
                }
                $rankingTorneio[] = [
                    'aluno' => $aluno->getNome(),
                    'casa' => $aluno->getCasa(),
                    'pontuacao' => $pontosAlunoNoTorneio
                ];
            }
        }

        usort($rankingTorneio, fn($a, $b) => $b['pontuacao'] <=> $a['pontuacao']);

        foreach ($rankingTorneio as $pos => $item) {
            echo ($pos + 1) . "º Lugar: {$item['aluno']} ({$item['casa']}) - {$item['pontuacao']} pontos\n";
        }
    }

    public function listarAlunos()
{
    if (empty($this->alunos)) {
        echo "Nenhum aluno cadastrado!\n";
        return;
    }
    echo "\n--- Alunos Cadastrados ---\n";
    foreach ($this->alunos as $i => $aluno) {
        echo ($i+1) . " - " . $aluno->getNome() . " (" . $aluno->getCasa() . ")\n";
    }
}
}