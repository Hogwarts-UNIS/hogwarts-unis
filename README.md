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
Nesse módulo, foi criada a parte responsável pelos alunos que recebem seu convite da Coruja. O cadastro do aluno é realizado na área da Coruja, onde são inseridos o nome, a idade e o e-mail. Após o cadastro, o convite é enviado ao aluno, que precisa aceitá-lo para ter acesso ao sistema. É necessário ter uma idade mínima para aceitar o convite. Somente após essa aceitação, o aluno consegue acessar o menu do aluno. Caso o convite não tenha sido aceito ou não exista, o acesso ao menu é bloqueado.


#### 02- Módulo 2: Seleção de casas.
No Módulo 2, criei as classes correspondentes, incluindo as **casas da trilogia** e o **Chapéu Seletor**, que faz uma pergunta ao usuário e permite escolher a opção que mais se adequa ao seu perfil.
Também implementei o sistema de distribuição das casas, que exibe o nome do aluno, a casa na qual ele foi selecionado e a pontuação total da casa, que é calculada com base na soma dos pontos de todos os alunos pertencentes a ela.

#### 03- Módulo 3: Gerenciamento de torneios e competições.
A classe **Casa** controla a pontuação de cada uma das quatro casas, enquanto **Desafio** detalha as provas e suas pontuações. **Inscricao** registra a participação de um aluno em um torneio, e **ResultadoDesafio** armazena os pontos obtidos individualmente. A classe Torneio organiza as grandes competições, agrupando desafios e inscrições. A **DumbledoreOffice** é a peça central do módulo, atuando como um painel de controle. Por meio dela, é possível cadastrar alunos, criar torneios, registrar o desempenho dos alunos e atribuir pontos às casas, além de gerar relatórios e rankings. 

#### 04- Módulo 4: Controle acadêmico e disciplinar. 
Nesse módulo criei um menu interativo onde você pode adicionar notas para alunos, consultar boletins, adicionar penalização para as casas, todas as informações importantes como notas ou pontos de uma casa foram protegidas usando encapsulamento, assim pode ser acessadas ou modificadas pelos métodos corretos.
(Professor Ângelo tive um pequeno imprevisto com meu computador na hora de subir os códigos, por isso meu nome não está nos commits, meu amigo Diogo subiu meus códigos para mim como uma opção B, por isso meu nome não aparece no histórico dos códigos.)

#### 05- Módulo 5: Gerenciamento de professores e funcionários.
O módulo conta com as classes: professor, Aluno,funcionário e gerenciamentoProfissional. Que contam com esses  objetivos:
**Professor**-Funções de vínculo com turmas, horários e disciplinas.
**Aluno**- Para o módulo 5, com o único objetivo de facilitar o entendimento e funcionamento do sistema, sem funções (do módulo 5).
**Funcionario**- Usa somente a função __toString que tem o objetivo de definir como o objeto será convertido para String.
**gerenciamentoProfissional**: Peça chave do módulo 5, todas as principais funções do diretor **Dumbledore** estão nessa classe, desde o cadastro de um novo funcionário até a consulta de horários de professores ou envio de avisos aos alunos.

#### 06- Módulo 6: Sistema de alertas e comunicação.
Criei uma classe chamada **Alerta** com atributos de notificações e avisos, com métodos que criam um aviso em que professores e o diretor poderão enviar aos alunos e, assim, o aluno poderá visualizar os avisos em sua área de aluno. No aviso, professor ou diretor poderão incluir o título da mensagem, o corpo da mesma e o tipo de mensagem que será enviada. 

(Professor Angelo, há um commit sobre essa parte que diz "parte do juliano" por favor desconsiderar, pois o Juliano saiu do nosso grupo e fez sozinho, dessa forma, o Diogo teve que fazer a parte dele.)


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



