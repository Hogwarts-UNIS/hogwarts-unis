<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Model\ChapeuSeletor;
use App\Model\Aluno;
use App\Model\Bruxo;
use App\Model\gerenciamentoProfissional;
use App\Model\Professor;
use App\Model\Funcionario;


//criando menu c acesso de aluno, professor e dumbledore(diretor)

$gerenciador= new gerenciamentoProfissional();
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

// Não exibir mensagens automáticas, apenas o menu:
echo "---Bem vindo ao menu de gerenciamento profissional de Hogwarts---\n";
echo "Você é:\n";
echo "1 -Aluno\n";
echo "2 -Professor\n";
echo "3 -Diretor\n";
echo "4 -Torneios e Desafios\n"; // Adicione esta linha

$perfil= readline ("Qual é o número do seu perfil? ");

switch ($perfil){
    case 1: //dos alunos
     $nome = readline("Digite o nome do aluno: ");
    $idade = (int) readline("Digite a idade do aluno: ");
    $email = readline("Digite a casa do aluno (ou deixe vazio): ");
    $aluno = new Aluno($nome, $idade, $email);
    $chapeu = new ChapeuSeletor();
    $chapeu->setAluno($aluno);
    $chapeu->menu();
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
        require_once __DIR__ . '/src/Model/Casas.php';
        require_once __DIR__ . '/src/Model/DumbledoreOffice.php';
        require_once __DIR__ . '/src/Model/Torneio.php';
        require_once __DIR__ . '/src/Model/Desafio.php';
        require_once __DIR__ . '/src/Model/Inscricao.php';
        require_once __DIR__ . '/src/Model/ResultadoDesafio.php';

        echo "===== TORNEIOS DE HOGWARTS =====\n\n";

        $dumbledoreOffice = new DumbledoreOffice();

        $harry = new Aluno("Harry Potter", 11, "harry@hogwarts.com");
        $harry->setCasa("Grifinória"); 
        $dumbledoreOffice->registrarAluno($harry);

        $hermione = new Aluno("Hermione Granger", 11, "hermione@hogwarts.com");
        $hermione->setCasa("Grifinória");
        $dumbledoreOffice->registrarAluno($hermione);

        $draco = new Aluno("Draco Malfoy", 11, "draco@hogwarts.com");
        $draco->setCasa("Sonserina");
        $dumbledoreOffice->registrarAluno($draco);

        $luna = new Aluno("Luna Lovegood", 10, "luna@hogwarts.com");
        $luna->setCasa("Corvinal");
        $dumbledoreOffice->registrarAluno($luna);

        echo "\n";

        // 1. Criar e Abrir um Torneio
        $copaDasCasas = $dumbledoreOffice->criarTorneio(
            "Copa das Casas",
            "Pontuação Acumulada",
            ["Regra 1: Pontos ganhos em desafios", "Regra 2: Pontos perdidos por infrações"],
            "2025-09-01",
            "2026-06-30",
            "Hogwarts"
        );
        $dumbledoreOffice->abrirTorneio($copaDasCasas);

        echo "\n";

        // 2. Inscrever Alunos no Torneio
        $inscricaoHarry = $dumbledoreOffice->inscreverAlunoEmTorneio($harry, $copaDasCasas);
        $inscricaoHermione = $dumbledoreOffice->inscreverAlunoEmTorneio($hermione, $copaDasCasas);
        $inscricaoDraco = $dumbledoreOffice->inscreverAlunoEmTorneio($draco, $copaDasCasas);
        $inscricaoLuna = $dumbledoreOffice->inscreverAlunoEmTorneio($luna, $copaDasCasas);

        echo "\n";
        // 3. Adicionar Desafios ao Torneio
        echo "===== INICIANDO DESAFIOS =====\n\n";

        // Desafio: Duelo de Feitiços
        $dueloFeiticos = $dumbledoreOffice->adicionarDesafioAoTorneio(
            $copaDasCasas,
            "Duelo de Feitiços",
            "Alunos duelarão para demonstrar suas habilidades.",
            ["Não use feitiços das trevas imperdoáveis"],
            50, // Pontos máximos
            "Salão Principal",
            "2025-10-15 14:00"
        );
        $dueloFeiticos->iniciarDesafio();

        // 4. Registrar Desempenho nos Desafios
        echo "Registrando desempenho no Duelo de Feitiços:\n";
        if ($inscricaoHarry) $dumbledoreOffice->registrarDesempenhoDesafio($dueloFeiticos, $inscricaoHarry, 50);
        if ($inscricaoHermione) $dumbledoreOffice->registrarDesempenhoDesafio($dueloFeiticos, $inscricaoHermione, 40);
        if ($inscricaoDraco) $dumbledoreOffice->registrarDesempenhoDesafio($dueloFeiticos, $inscricaoDraco, 30);
        $dueloFeiticos->finalizarDesafio();

        echo "\n";

        // Desafio: Quiz de Poções
        $quizPocoes = $dumbledoreOffice->adicionarDesafioAoTorneio(
            $copaDasCasas,
            "Quiz de Poções",
            "Teste de conhecimento em preparação de poções.",
            ["Consultar livros é permitido"],
            30, // Pontos máximos
            "Sala de Poções",
            "2025-11-20 10:00"
        );
        $quizPocoes->iniciarDesafio();

        echo "Registrando desempenho no Quiz de Poções:\n";
        if ($inscricaoHermione) $dumbledoreOffice->registrarDesempenhoDesafio($quizPocoes, $inscricaoHermione, 30);
        if ($inscricaoDraco) $dumbledoreOffice->registrarDesempenhoDesafio($quizPocoes, $inscricaoDraco, 20);
        if ($inscricaoLuna) $dumbledoreOffice->registrarDesempenhoDesafio($quizPocoes, $inscricaoLuna, 25);
        $quizPocoes->finalizarDesafio();

        echo "\n";

        // 5. Exibir Rankings e Relatórios
        echo "===== EXIBINDO RANKINGS E RELATÓRIOS =====\n\n";

        $dumbledoreOffice->gerarRankingCasas(); // Ranking geral das casas

        echo "\n";

        $dumbledoreOffice->gerarRankingTorneio($copaDasCasas); // Ranking de um torneio específico

        echo "\n";

        // Relatórios de desempenho individuais
        $dumbledoreOffice->gerarRelatorioDesempenhoAluno($harry);
        $dumbledoreOffice->gerarRelatorioDesempenhoAluno($hermione);
        $dumbledoreOffice->gerarRelatorioDesempenhoAluno($draco);
        $dumbledoreOffice->gerarRelatorioDesempenhoAluno($luna);


        echo "\n===== ATÉ MAIS TROUXAS =====\n";
        break;
    default:
        echo "Perfil inválido. Tente novamente.\n";
        break;
}
echo "Agradecemos por usar nosso sistema, até mais, trouxa!\n";



