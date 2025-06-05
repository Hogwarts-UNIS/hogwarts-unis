<?php

namespace App\Model;

class PainelAdministrativo {
    
    private array $alunos = [];
    private array $cartasEnviadas = [];
    private int $proximoId = 1;

    public function cadastrarAluno(string $nome, int $idade, string $email): Aluno {
        $aluno = new Aluno($nome, $idade, $email);
        $this->alunos[$this->proximoId] = $aluno;
        $this->proximoId++;
        return $aluno;
    }

    public function enviarCartaConvite(int $idAluno): ?Carta {
        if (!isset($this->alunos[$idAluno])) {
            echo "❌ Aluno não encontrado!\n";
            return null;
        }

        $aluno = $this->alunos[$idAluno];
        $carta = new Carta($aluno);
        
        echo "📝 Processando carta para {$aluno->getNome()}...\n";
        $aprovado = $carta->enviaCarta();
        
        $carta->simularEnvioCoruja();
        $this->cartasEnviadas[$idAluno] = $carta;
        
        if ($aprovado) {
            echo "🎉 Carta de APROVAÇÃO enviada!\n\n";
        } else {
            echo "⏳ Carta informando sobre idade mínima enviada.\n\n";
        }

        return $carta;
    }

    public function confirmarRespostaAluno(int $idAluno, bool $aceita = true): bool {
        if (!isset($this->alunos[$idAluno])) {
            echo "❌ Aluno não encontrado!\n";
            return false;
        }

        $aluno = $this->alunos[$idAluno];
        $aluno->confirmaResposta($aceita);
        
        $status = $aceita ? "CONFIRMOU presença" : "RECUSOU o convite";
        echo "📧 {$aluno->getNome()} {$status}!\n";
        
        return true;
    }

    public function visualizarListaConvites(): void {
        echo "🏰 === PAINEL ADMINISTRATIVO HOGWARTS === 🏰\n\n";
        
        $relatorio = $this->gerarRelatorio();
        
        echo "📊 RESUMO GERAL:\n";
        echo "Total de alunos: {$relatorio['totalAlunos']}\n";
        echo "Cartas enviadas: {$relatorio['cartasEnviadas']}\n";
        echo "Confirmações recebidas: {$relatorio['confirmacoes']}\n";
        echo "Aprovados (idade OK): {$relatorio['aprovados']}\n";
        echo "Aguardando idade: {$relatorio['aguardandoIdade']}\n";
        echo "Taxa de resposta: {$relatorio['taxaResposta']}%\n\n";

        echo "📋 LISTA DETALHADA:\n";
        echo str_repeat("-", 100) . "\n";
        echo sprintf("%-4s %-20s %-4s %-25s %-12s %-15s %-10s\n", 
                    "ID", "Nome", "Idade", "Email", "Status Carta", "Resposta", "Casa");
        echo str_repeat("-", 100) . "\n";

        foreach ($this->alunos as $id => $aluno) {
            $resposta = $aluno->getResposta() ? 'Confirmou' : 'Pendente';
            if ($aluno->getStatusConvite() === 'rejeitado') {
                $resposta = 'Recusou';
            }
            
            echo sprintf("%-4d %-20s %-4d %-25s %-12s %-15s %-10s\n",
                        $id,
                        substr($aluno->getNome(), 0, 20),
                        $aluno->getIdade(),
                        substr($aluno->getEmail(), 0, 25),
                        $aluno->getStatusConvite(),
                        $resposta,
                        $aluno->getCasa() ?? 'N/A');
        }
        echo str_repeat("-", 100) . "\n\n";
    }

    public function listarAlunosPorStatus(string $status): array {
        return array_filter($this->alunos, function($aluno) use ($status) {
            return $aluno->getStatusConvite() === $status;
        });
    }

    public function listarAprovados(): array {
        $aprovados = [];
        foreach ($this->cartasEnviadas as $carta) {
            if ($carta->getTemIdadeMinima()) {
                $aprovados[] = $carta->getAluno();
            }
        }
        return $aprovados;
    }

    public function gerarRelatorio(): array {
        $totalAlunos = count($this->alunos);
        $cartasEnviadas = count($this->cartasEnviadas);
        $confirmacoes = count(array_filter($this->alunos, fn($aluno) => $aluno->getResposta()));
        $aprovados = count($this->listarAprovados());
        $aguardandoIdade = $cartasEnviadas - $aprovados;
        
        $taxaResposta = $cartasEnviadas > 0 ? 
                       round(($confirmacoes / $cartasEnviadas) * 100, 2) : 0;

        return [
            'totalAlunos' => $totalAlunos,
            'cartasEnviadas' => $cartasEnviadas,
            'confirmacoes' => $confirmacoes,
            'aprovados' => $aprovados,
            'aguardandoIdade' => $aguardandoIdade,
            'taxaResposta' => $taxaResposta
        ];
    }

    public function exibirCartaCompleta(int $idAluno): void {
        if (!isset($this->cartasEnviadas[$idAluno])) {
            echo "❌ Carta não encontrada para este aluno!\n";
            return;
        }

        $carta = $this->cartasEnviadas[$idAluno];
        $carta->exibirCarta();
    }

    public function buscarAluno(string $criterio, $valor): array {
        $resultados = [];
        
        foreach ($this->alunos as $id => $aluno) {
            switch ($criterio) {
                case 'nome':
                    if (stripos($aluno->getNome(), $valor) !== false) {
                        $resultados[$id] = $aluno;
                    }
                    break;
                case 'email':
                    if ($aluno->getEmail() === $valor) {
                        $resultados[$id] = $aluno;
                    }
                    break;
                case 'idade':
                    if ($aluno->getIdade() === (int)$valor) {
                        $resultados[$id] = $aluno;
                    }
                    break;
                case 'status':
                    if ($aluno->getStatusConvite() === $valor) {
                        $resultados[$id] = $aluno;
                    }
                    break;
            }
        }
        
        return $resultados;
    }

    public function enviarCartasEmLote(array $idsAlunos): array {
        $resultados = [
            'sucessos' => 0,
            'falhas' => 0,
            'detalhes' => []
        ];

        foreach ($idsAlunos as $id) {
            if (isset($this->alunos[$id])) {
                $carta = $this->enviarCartaConvite($id);
                if ($carta) {
                    $resultados['sucessos']++;
                    $resultados['detalhes'][$id] = 'Sucesso';
                } else {
                    $resultados['falhas']++;
                    $resultados['detalhes'][$id] = 'Falha';
                }
            } else {
                $resultados['falhas']++;
                $resultados['detalhes'][$id] = 'Aluno não encontrado';
            }
        }

        echo "📤 ENVIO EM LOTE CONCLUÍDO:\n";
        echo "✅ Sucessos: {$resultados['sucessos']}\n";
        echo "❌ Falhas: {$resultados['falhas']}\n\n";

        return $resultados;
    }

    public function getAlunos(): array {
        return $this->alunos;
    }

    public function getCartasEnviadas(): array {
        return $this->cartasEnviadas;
    }
}

?>