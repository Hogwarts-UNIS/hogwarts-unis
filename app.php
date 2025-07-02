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
use App\Model\Alerta;
use App\Model\Torneio;
use App\Model\Avaliacao;




$dumbledoreOffice = new DumbledoreOffice();

$gerenciador = new gerenciamentoProfissional();

$gerenciador->cadastrarProfessor("Minerva McGonagall", 0, '', false);
$gerenciador->cadastrarProfessor("Severo Snape", 0, '', false);
$gerenciador->associarDisciplina("Minerva McGonagall", "Transfiguração", false);
$gerenciador->associarDisciplina("Severo Snape", "Poções", false);
$gerenciador->associarTurma("Minerva McGonagall", "1º Ano", false);
$gerenciador->associarTurma("Severo Snape", "2º Ano", false);
$gerenciador->addHorarioProfessor("Minerva McGonagall", "Segunda", "10:00", false);
$gerenciador->addHorarioProfessor("Severo Snape", "Terça", "11:00", false);
$gerenciador->addHorarioProfessor("Minerva McGonagall", "Quarta", "09:00", false);
$gerenciador->addHorarioProfessor("Severo Snape", "Quinta", "14:00", false);
$gerenciador->cadastrarFuncionario("Rubeus Hagrid", "Guardião das Chaves e Terrenos", "Hogsmeade", false);
$gerenciador->cadastrarFuncionario("Pomona Sprout", "Professora de Herbologia", "Jardim de Herbologia", false);

do {
    echo "=====🏰 BEM VINDO AO MENU DE GERENCIAMENTO PROFISSIONAL DE HOGWARTS 🏰=====\n";
    echo "O que você procura?:\n";
    echo "1 - 🔮 Área do Aluno\n";
    echo "2 - 🍎 Área do Professor\n";
    echo "3 - 🧙 Área do Diretor\n";
    echo "4 - 🏆 Torneios e Desafios\n";
    echo "5 - 🦉 Enviar convite \n";
    $perfil = readline("QUAL É O NÚMERO DO SEU PERFIL?");

    switch ($perfil){
        case 1: // dos alunos
            if (empty($alunosCadastrados)) {
                echo "Nenhum aluno cadastrado. Cadastre um aluno pelo menu de convites primeiro!\n";
                break;
            }
            echo "\n===== ALUNOS CADASTRADOS =====\n";
            foreach ($alunosCadastrados as $i => $aluno) {
                echo ($i+1) . " - " . $aluno->getNome() . " (Casa: " . ($aluno->getCasa() ?? "Sem casa") . ")\n";
            }
            $num = (int)readline("Digite o número do aluno para acessar o menu: ") - 1;
            if (!isset($alunosCadastrados[$num])) {
                echo "Aluno inválido!\n";
                break;
            }
            $aluno = $alunosCadastrados[$num];
            $nome = $aluno->getNome();

    do {
        echo "\n===== MENU DO ALUNO $nome =====\n";
        echo "1 - 🎩 Escolher casa (Chapéu Seletor)\n";
        echo "2 - 📧 Ver status do convite\n";
        echo "3 - ✅ Aceitar convite\n";
        echo "4 - ❌ Recusar convite\n";
        echo "5 - 📢 Avisos do Diretor\n";
        echo "6 - 📢 Avisos do Professor\n";
        echo "7 - 📝 Consultar Boletim\n";
        echo "0 - 🧹 Sair\n";
        $opcaoAluno = readline("Escolha uma opção: ");

        switch ($opcaoAluno) {
            case '1':
                $chapeu = new ChapeuSeletor();
                $chapeu->setAluno($aluno);
                $chapeu->menu();
                break;
            case '2':
                echo "Status do convite: " . $aluno->getStatusConvite() . "\n";
                break;
            case '3':
                $aluno->confirmaResposta(true);
                echo "Convite aceito!\n";
                break;
            case '4':
                $aluno->confirmaResposta(false);
                echo "Convite recusado!\n";
                break;
            case '5':
            if (empty($avisosGerais)) {
                    echo "Nenhum aviso do diretor no momento.\n";
            } else {
                    echo "\n 🧙AVISOS DO DIRETOR!!:\n";
                    foreach ($avisosGerais as $aviso) {
                        echo "🔔 " . $aviso->getnotificacao() . "\n";
                        echo "📄 " . $aviso->getaviso() . "\n";
                        echo "Tipo: " . $aviso->gettipo() . "\n";
                        echo "--------------------------\n";
                    }
            }
            break;
            case '6':
            if (empty($avisosProfessores)) {
                    echo "Nenhum aviso do diretor no momento.\n";
                }  else {
                    echo "\n 🍎 AVISOS DO PROFESSOR!!:\n";
                    foreach ($avisosProfessores as $aviso) {
                        echo "🔔 " . $aviso->getnotificacao() . "\n";
                        echo "📄 " . $aviso->getaviso() . "\n";
                        echo "Tipo: " . $aviso->gettipo() . "\n";
                        echo "--------------------------\n";
                    }
                }
                break;
            case '7':
                    echo "\n===== BOLETIM DE " . $aluno->getNome() . " =====\n";
                    $aluno->getBoletim()->exibir();
                break;
            case '0':
                echo "Saindo do menu do aluno...\n";
                break;
            default:
                echo "Opção inválida!\n";
        }
    } while ($opcaoAluno !== '0');
    break;
        
        case 2: //dos professores
            echo "🍎 BEM VINDO AO MENU DO PROFESSOR 🍎\n";
              $nome = readline("Digite o nome do professor: ");
        echo "\n===== MENU DO PROFESSOR $nome =====\n";
        do {
            echo "1 - 📅 Consultar Cronograma\n";
            echo "2 - 📧 Enviar Aviso para os alunos\n";
            echo "3 - 📝 Dar nota para aluno\n";
            echo "0 - 🧹 Sair\n";
            $opcao = readline("SELECIONE UMA DAS OPÇÕES: ");
            switch ($opcao) {
                case '1':
                    $gerenciador->consultarCronogramaProfessor($nome);
                    break;
                case '2':
                $notificacao = readline("Digite o titulo da notificação: ");
                $aviso = readline("Digite o Aviso que deseja enviar: ");
                $tipo = readline("Digite sobre oque e a notificação (aula, evento, etc): ");
                $alerta = new Alerta($notificacao, $aviso, $tipo);
                $avisosProfessores[] = $alerta;
                echo "Notificação Criada!\n";
                echo "Titulo: " . $alerta->getnotificacao() . "\n";
                echo "Aviso: " .$alerta->getaviso() . "\n";
                echo "Tipo: " . $alerta->gettipo() . "\n";
                break;"-----------\n";
                case '3':
                    if (empty($alunosCadastrados)) {
                        echo "Nenhum aluno cadastrado!\n";
                    break;
                }
                    echo "\n===== ALUNOS CADASTRADOS =====\n";
                    foreach ($alunosCadastrados as $i => $aluno) {
                    echo ($i+1) . " - " . $aluno->getNome() . " (Casa: " . ($aluno->getCasa() ?? "Sem casa") . ")\n";
                }
                    $num = (int)readline("Digite o número do aluno para dar a nota: ") - 1;
                    if (!isset($alunosCadastrados[$num])) {
                    echo "Aluno inválido!\n";
                        break;
                }
                $aluno = $alunosCadastrados[$num];
                $disciplina = readline("Digite a disciplina: ");
                $nota = (float)readline("Digite a nota: ");
                // Aqui você pode usar o método do professor ou do gerenciador, conforme sua arquitetura
                $professorObj = $gerenciador->getProfessorPorNome($nome); // supondo que exista esse método
                if ($professorObj) {
                    $professorObj->registrarNota($aluno, $disciplina, $nota);
                } else {
                    echo "Professor não encontrado!\n";
                }
                break;
                case '0':
                    echo "SAINDO DO SISTEMA DO PROFESSOR $nome...\n";
                    break;
                default:
                    echo "OPÇÃO INVÁLIDA\n";
                    break;
            }
        } while ($opcao !== '0');
        break;
        
        case 3: //diretoria de dumbledore
            do{
                echo "🧙 BEM VINDO AO MENU DE GERENCIAMENTO DO DIRETOR 🧙\n";
                    echo "1 - 🧑‍🏫 Cadastrar professor\n";
                    echo "2 - 📖 Associar disciplina a professor\n";
                    echo "3 - 🧑‍🎓 Associar turma a professor\n";
                    echo "4 - 🕰 Adicionar horário ao professor\n";
                    echo "5 - 🔍 Consultar cronograma de professor\n";
                    echo "6 - 👨‍💼Cadastrar funcionário\n";
                    echo "7 - 📨 Enviar Alerta \n";
                    echo "0 - 🧹 Sair do menu \n";

                    $opcao = readline("SELECIONE UMA OPÇÃO: ");

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
                            $turma = readline("Digite a turma (ex: 1° ano): ");
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
                            $cargo = readline("Cargo (ex:cozinheiro): ");
                            $setor = readline("Setor(ex:cozinha): ");
                            $gerenciador->cadastrarFuncionario($nome, $cargo, $setor);
                            break;
                        case 7:
                            $notificacao = readline("Digite o titulo da notificação: ");
                            $aviso = readline("Digite o Aviso que deseja enviar: ");
                            $tipo = readline("Digite sobre oque e a notificação (aula, evento, etc): ");
                            $alerta = new Alerta($notificacao, $aviso, $tipo);
                            $avisosGerais[] = $alerta;
                            echo "Notificação Criada!\n";
                            echo "Titulo: " . $alerta->getnotificacao() . "\n";
                            echo "Aviso: " .$alerta->getaviso() . "\n";
                            echo "Tipo: " . $alerta->gettipo() . "\n";
                            case 0:
                                echo "SAINDO DO MENU...";
                                break;
                        default:
                            echo "Opção inválida. Tente novamente.\n";
                    }
                }while($opcao !== "0");
                break;
        case 4: 
            echo "🏆 TORNEIOS DE HOGWARTS 🏆 \n";

            do {
                echo "\n1 - ➕ Cadastrar novo aluno";
                echo "\n2 - 📝 Listar alunos cadastrados";
                echo "\n3 - 🏆 Iniciar torneio";
                echo "\n4 - 🎯 Criar desafio"; // Opção para criar desafio
                echo "\n5 - ⚔️ Listar desafios"; // Listar desafios
                echo "\n6 - 🧩 Iniciar desafio"; // Iniciar desafio
                echo "\n7 - ✏️ Registrar desempenho dos alunos"; // Registrar desempenho
                echo "\n8 - 🔚 Finalizar desafio"; // Finalizar desafio
                echo "\n0 - 🧹 Voltar ao menu principal\n";
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
                            "COPA DAS CASAS",
                            "PONTUAÇÃO ACUMULADA",
                            ["Regra 1: Pontos ganhos em desafios", "Regra 2: Pontos perdidos por infrações"],
                            "2025-09-01",
                            "2026-06-30",
                            "Hogwarts"
                        );
                        $dumbledoreOffice->abrirTorneio($copaDasCasas);

                        foreach ($alunosCadastrados as $aluno) {
                            $dumbledoreOffice->inscreverAlunoEmTorneio($aluno, $copaDasCasas);
                        }

                        echo "TODOS OS ALUNOS CADASTRADOS FORAM INSCRITOS NO TORNEIO!\n";
                    
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
                        echo "DESAFIO CRIADO!\n";
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
            echo "🦉 ENVIAR CONVITES 🦉\n";
            $nome = readline("Digite o nome do aluno: ");
            $idade = (int)readline("Digite a idade do aluno: ");
            $email = readline("Digite o email do aluno: ");
            $aluno = new Aluno($nome, $idade, $email);
            $alunosCadastrados[] = $aluno;
            $dumbledoreOffice->registrarAluno($aluno);

            if (empty($alunosCadastrados)) {
                echo "Nenhum aluno cadastrado para envio de convite.\n";
                break;
            }
            echo "\n📚 ALUNOS CADASTRADOS 📚\n";
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

echo "Agradecemos por usar nosso sistema, até mais, trouxa!\n";



