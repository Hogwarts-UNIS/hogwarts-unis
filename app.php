<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Model\ChapeuSeletor;
use App\Model\Aluno;
use App\Model\Bruxo;
use App\Model\gerenciamentoProfissional;
use App\Model\Professor;
use App\Model\Funcionario;
use App\Model\DumbledoreOffice;
use App\Model\Carta;


$gerenciador = new gerenciamentoProfissional();
$gerenciador->cadastrarProfessor("Minerva McGonagall");
$gerenciador->cadastrarProfessor("Severo Snape");

$gerenciador->associarDisciplina("Minerva McGonagall", "Transfiguração");
$gerenciador->associarDisciplina("Severo Snape", "Poções");

$gerenciador->associarTurma("Minerva McGonagall", "1º Ano");
$gerenciador->associarTurma("Severo Snape", "2º Ano");

$gerenciador->addHorarioProfessor("Minerva McGonagall", "Segunda", "08:00 - 10:00");
$gerenciador->addHorarioProfessor("Minerva McGonagall", "Quarta", "14:00 - 16:00");

$gerenciador->addHorarioProfessor("Severo Snape", "Terça", "10:00 - 12:00");
$gerenciador->addHorarioProfessor("Severo Snape", "Quinta", "15:00 - 17:00");

$alunosCadastrados = []; // Inicializa o array de alunos cadastrados

do {
    echo "---Bem vindo ao menu de gerenciamento profissional de Hogwarts---\n";
    echo "Você é:\n";
    echo "1 - Aluno\n";
    echo "2 - Professor\n";
    echo "3 - Diretor\n";
    echo "4 - Torneios e Desafios\n";
    echo "5 - Enviar convite \n";
    $perfil = readline("Qual é o número do seu perfil? ");

    switch ($perfil){
        case 1: //dos alunos
            $nome = readline("Digite o nome do aluno: ");
            $idade = (int) readline("Digite a idade do aluno: ");
            $email = readline("Digite seu email (ou deixe vazio): ");
            $aluno = new Aluno($nome, $idade, $email);
            $chapeu = new ChapeuSeletor();
            $chapeu->setAluno($aluno);
            $chapeu->menu();
            $alunosCadastrados[] = $aluno;
            break;
        
        case 2: //dos professores
              $nome = readline("Digite o nome do professor: ");
        echo "\n===== Menu do Professor $nome =====\n";
        do {
            echo "1 - Consultar Cronograma\n";
            echo "0 - Sair\n";
            $opcao = readline("Selecione uma das opções: ");
            switch ($opcao) {
                case '1':
                    $gerenciador->consultarCronogramaProfessor($nome);
                    break;
                case '0':
                    echo "Saindo do sistema do professor...\n";
                    break;
                default:
                    echo "Opção inválida!\n";
                    break;
            }
        } while ($opcao !== '0');
        break;
        
        case 3: //diretoria de dumbledore
            do{
                    echo "Menu de gerenciamento do diretor\n";
                    echo "1 -Cadastrar professor\n";
                    echo "2 -Associar disciplina a professor\n";
                    echo "3 -Associar turma a professor\n";
                    echo "4 -Adicionar horário ao professor\n";
                    echo "5 -Consultar cronograma de professor\n";
                    echo "6 -Cadastrar funcionário\n";
                    echo "0- Sair do menu \n";

                    $opcao = readline("Selecione uma opção: ");

                    switch ($opcao) {
                        case 1:
                            $nomeProfessor = readline("Digite o nome do professor: ");
                            $gerenciador->cadastrarProfessor($nomeProfessor);
                            break;
                        case 2:
                            $nomeProfessor = readline("Digite o nome do professor: ");
                            $disciplina = readline("Digite a disciplina: ");
                            $gerenciador->associarDisciplina($nomeProfessor, $disciplina);
                            break;
                        case 3:
                            $nomeProfessor = readline("Digite o nome do professor: ");
                            $turma = readline("Digite a turma (ex: 1°ano): ");
                            $gerenciador->associarTurma($nomeProfessor, $turma);
                            break;
                        case 4:
                            $nomeProfessor = readline("Digite o nome do professor: ");
                            $dia = readline("Digite o dia da semana (ex: Segunda): ");
                            $horario = readline("Digite o horário (ex: 10:00): ");
                            $gerenciador->addHorarioProfessor($nomeProfessor, $dia, $horario);
                            break;
                
                        case 5:
                             $nome = readline("Nome do professor: ");
                            $gerenciador->consultarCronogramaProfessor($nome);
                            break;
                        case 6:
                            $nome = readline("Nome do funcionário: ");
                            $cargo = readline("Cargo: ");
                            $setor = readline("Setor: ");
                            $gerenciador->cadastrarFuncionario($nome, $cargo, $setor);
                            break;
                            case 0:
                                echo "Saindo do menu.";
                                break;
                        default:
                            echo "Opção inválida. Tente novamente.\n";
                    }
                }while($opcao !== "0");
                break;
        case 4:
            echo "===== TORNEIOS DE HOGWARTS =====\n\n";
            $dumbledoreOffice = new DumbledoreOffice();

            do {
                echo "\n1 - Cadastrar novo aluno";
                echo "\n2 - Listar alunos cadastrados";
                echo "\n3 - Iniciar torneio";
                echo "\n4 - Criar desafio"; // Opção para criar desafio
                echo "\n5 - Listar desafios"; // Listar desafios
                echo "\n6 - Iniciar desafio"; // Iniciar desafio
                echo "\n7 - Registrar desempenho dos alunos"; // Registrar desempenho
                echo "\n8 - Finalizar desafio"; // Finalizar desafio
                echo "\n0 - Voltar ao menu principal\n";
                $opcaoTorneio = readline("Escolha uma opção: ");

                switch ($opcaoTorneio) {
                    case '1':
                    $nome = readline("Nome do aluno: ");
                    $idade = (int)readline("Idade do aluno: ");
                    $email = readline("Email do aluno: ");
                    $casa = readline("Casa do aluno (Grifinória, Sonserina, Lufa-Lufa, Corvinal): ");
                    $aluno = new Aluno($nome, $idade, $email);
                    $aluno->setCasa($casa);
                    $dumbledoreOffice->registrarAluno($aluno);
                    $alunosCadastrados[] = $aluno;
                    echo "Aluno cadastrado!\n";

                    break;
                    case '2':
                        $dumbledoreOffice->listarAlunos();
                        break;
                    case '3':
                        if (empty($alunosCadastrados)) {
                            echo "Cadastre pelo menos um aluno antes de iniciar o torneio!\n";
                            break;
                        }

                        $copaDasCasas = $dumbledoreOffice->criarTorneio(
                            "Copa das Casas",
                            "Pontuação Acumulada",
                            ["Regra 1: Pontos ganhos em desafios", "Regra 2: Pontos perdidos por infrações"],
                            "2025-09-01",
                            "2026-06-30",
                            "Hogwarts"
                        );
                        $dumbledoreOffice->abrirTorneio($copaDasCasas);

                        foreach ($alunosCadastrados as $aluno) {
                            $dumbledoreOffice->inscreverAlunoEmTorneio($aluno, $copaDasCasas);
                        }

                        echo "Todos os alunos cadastrados foram inscritos no torneio!\n";
                    
                        break;
                    case '4': // Criar desafio
                        if (!isset($copaDasCasas)) {
                            echo "Crie o torneio antes!\n";
                            break;
                        }
                        $nomeDesafio = readline("Nome do desafio: ");
                        $descricao = readline("Descrição do desafio: ");
                        $recompensa = readline("Recompensa (pontos): ");
                        $desafio = $copaDasCasas->criarDesafio($nomeDesafio, $descricao, (int)$recompensa);
                        echo "Desafio criado!\n";
                        break;
                    case '5': // Listar desafios
                        if (!isset($copaDasCasas)) {
                            echo "Crie o torneio antes!\n";
                            break;
                        }
                        $desafios = $copaDasCasas->getDesafios();
                        if (empty($desafios)) {
                            echo "Nenhum desafio cadastrado!\n";
                        } else {
                            echo "\n--- Desafios do Torneio ---\n";
                            foreach ($desafios as $i => $desafio) {
                                echo ($i+1) . " - " . $desafio->getNome() . " (Status: " . $desafio->getStatus() . ")\n";
                            }
                        }
                        break;

                    case '6': // Iniciar desafio
                        if (!isset($copaDasCasas)) {
                            echo "Crie o torneio antes!\n";
                            break;
                        }
                        $desafios = $copaDasCasas->getDesafios();
                        if (empty($desafios)) {
                            echo "Nenhum desafio cadastrado!\n";
                            break;
                        }
                        foreach ($desafios as $i => $desafio) {
                            echo ($i+1) . " - " . $desafio->getNome() . " (Status: " . $desafio->getStatus() . ")\n";
                        }
                        $num = (int)readline("Digite o número do desafio para iniciar: ") - 1;
                        if (isset($desafios[$num])) {
                            $desafios[$num]->iniciarDesafio();
                        } else {
                            echo "Desafio inválido!\n";
                        }
                        break;

                    case '7': // Registrar desempenho dos alunos
                        if (!isset($copaDasCasas)) {
                            echo "Crie o torneio antes!\n";
                            break;
                        }
                        $desafios = $copaDasCasas->getDesafios();
                        if (empty($desafios)) {
                            echo "Nenhum desafio cadastrado!\n";
                            break;
                        }
                        foreach ($desafios as $i => $desafio) {
                            echo ($i+1) . " - " . $desafio->getNome() . " (Status: " . $desafio->getStatus() . ")\n";
                        }
                        $num = (int)readline("Digite o número do desafio para registrar desempenho: ") - 1;
                        if (!isset($desafios[$num])) {
                            echo "Desafio inválido!\n";
                            break;
                        }
                        $desafio = $desafios[$num];
                        foreach ($alunosCadastrados as $aluno) {
                            $pontuacao = (int)readline("Pontuação de {$aluno->getNome()} no desafio '{$desafio->getNome()}': ");

                            foreach ($copaDasCasas->getInscricoes() as $inscricao) {
                                if ($inscricao->getAluno() === $aluno) {
                                    $desafio->registrarDesempenho($inscricao, $pontuacao);
                                }
                            }
                        }
                        break;

                    case '8': // Finalizar desafio
                        if (!isset($copaDasCasas)) {
                            echo "Crie o torneio antes!\n";
                            break;
                        }
                        $desafios = $copaDasCasas->getDesafios();
                        if (empty($desafios)) {
                            echo "Nenhum desafio cadastrado!\n";
                            break;
                        }
                        foreach ($desafios as $i => $desafio) {
                            echo ($i+1) . " - " . $desafio->getNome() . " (Status: " . $desafio->getStatus() . ")\n";
                        }
                        $num = (int)readline("Digite o número do desafio para finalizar: ") - 1;
                        if (isset($desafios[$num])) {
                            $desafios[$num]->finalizarDesafio();
                        } else {
                            echo "Desafio inválido!\n";
                        }
                        break;

                    case '0':
                        echo "Voltando ao menu principal...\n";
                        break;
                    default:
                        echo "Opção inválida!\n";
                }
            } while ($opcaoTorneio !== '0');
            break;
        case 5:
            if (empty($alunosCadastrados)) {
                echo "Nenhum aluno cadastrado para envio de convite.\n";
                break;
            }
            echo "\n--- Alunos Cadastrados ---\n";
            foreach ($alunosCadastrados as $i => $aluno) {
                echo ($i+1) . " - " . $aluno->getNome() . " (" . $aluno->getCasa() . ")\n";
            }
            $num = (int)readline("Digite o número do aluno para enviar o convite: ") - 1;
            if (isset($alunosCadastrados[$num])) {
                $aluno = $alunosCadastrados[$num];
                $carta = new Carta($aluno);
                $carta->enviaCarta();
                $status = $aluno->getStatusConvite();
                echo "Status do convite: $status\n";
                $carta->exibirCarta();

                $aluno->confirmaResposta(false); 
                echo "Convite enviado para {$aluno->getNome()}! Aguarde a resposta.\n";
            } else {
                echo "Aluno inválido!\n";
            }
            break;

        default:
            echo "Perfil inválido. Tente novamente.\n";
            $aluno = new Aluno($nome, $idade, $email);
            $aluno->setCasa($casa);
            $dumbledoreOffice->registrarAluno($aluno);
            $alunosCadastrados[] = $aluno;            break;
    }
} while ($perfil !== '0');

echo "Agradecemos por usar nosso sistema, até mais.\n";



