# ⚡🦉 Sistema De Gestão com Tema Hogwarts

[![PHP Version](https://img.shields.io/badge/php-8.1%2B-blue)](https://www.php.net/)
[![License: MIT](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)
[![Composer](https://img.shields.io/badge/Autoload-PSR--4-orange)](https://getcomposer.org/doc/04-schema.md#autoload)

---

## 🇧🇷 Português

Trabalho Disciplinar em PHP com **POO — Programação Orientada a Objetos**.  
Feito pelos alunos do primeiro período de **Engenharia de Software** e **Ciência da Computação** do Centro Universitário do Sul de Minas - UNIS.


## Alunos: 
- Maria Eduarda
- Jussara Faria
- Diogo Souza
- Gabriel Luis


Utiliza Composer e Autoload PSR-4. 

### ✅ Módulos Implementados

#### 01 - Módulo 1: Convite e Cadastro de alunos.



#### 02- Módulo 2: Seleção de casas.
No Módulo 2, criei as classes correspondentes, incluindo as **casas da trilogia** e o **Chapéu Seletor**, que faz uma pergunta ao usuário e permite escolher a opção que mais se adequa ao seu perfil.
Também implementei o sistema de distribuição das casas, que exibe o nome do aluno, a casa na qual ele foi selecionado e a pontuação total da casa, que é calculada com base na soma dos pontos de todos os alunos pertencentes a ela.

#### 03- Módulo 3: Gerenciamento de torneios e competições.
A classe **Casa** controla a pontuação de cada uma das quatro casas, enquanto **Desafio** detalha as provas e suas pontuações. **Inscricao** registra a participação de um aluno em um torneio, e **ResultadoDesafio** armazena os pontos obtidos individualmente. A classe Torneio organiza as grandes competições, agrupando desafios e inscrições. A **DumbledoreOffice** é a peça central do módulo, atuando como um painel de controle. Por meio dela, é possível cadastrar alunos, criar torneios, registrar o desempenho dos alunos e atribuir pontos às casas, além de gerar relatórios e rankings. 

#### 04- Módulo 4: Controle acadêmico e disciplinar. 


#### 05- Módulo 5: Gerenciamento de professores e funcionários.
O módulo conta com as classes: professor, Aluno,funcionário e gerenciamentoProfissional. Que contam com esses  objetivos:
**Professor**-Funções de vínculo com turmas, horários e disciplinas.
**Aluno**- Para o módulo 5, com o único objetivo de facilitar o entendimento e funcionamento do sistema, sem funções (do módulo 5).
**Funcionario**- Usa somente a função __toString que tem o objetivo de definir como o objeto será convertido para String.
**gerenciamentoProfissional**: Peça chave do módulo 5, todas as principais funções do diretor **Dumbledore** estão nessa classe, desde o cadastro de um novo funcionário até a consulta de horários de professores ou envio de avisos aos alunos.

#### 06- Módulo 6: Sistema de alertas e comunicação.
Módulo 6
Criei uma classe chamada **Alerta**, com os atributos notificação e aviso, e métodos que permitem criar um aviso que pode ser enviado pelo professor ou pelo diretor para um aluno. O aluno pode visualizar os avisos na sua área do aluno.
Cada aviso contém um título, uma mensagem e um tipo de mensagem, que pode indicar, por exemplo, se o conteúdo é informativo, urgente ou um lembrete.


#### Conclusão final: Um resumo sobre tudo que criamos.
A interação com o sistema se dá via terminal, por meio de um menu de opções numeradas e entrada de dados guiada, tornando o uso direto e fácil de acompanhar. Com organização e uso de POO, o sistema foi desenvolvido cumprindo as exigências que foram pedidas e um pouco mais, trazendo uma interface detalhada e harmoniosa






### 🚀 Como Usar

1. Clone o projeto:

```
git clone https://github.com/Hogwarts-UNIS/hogwarts-unis.git
cd Hogwarts-UNIS
```
2. Instalação
```
composer install
composer dump-autoload
```

3. Execute o arquivo `app.php`
```
php app.php
```
4. Você verá:
```
Hi, OOP World in PHP!
```

## Licença

Este projeto está licenciado sob a Licença MIT - veja o arquivo [LICENSE](LICENSE) para detalhes.



