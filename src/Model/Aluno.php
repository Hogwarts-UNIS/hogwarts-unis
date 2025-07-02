<?php

namespace App\Model;
use App\Model\Boletim;

class Aluno extends Bruxo {
    
    protected bool $resposta = false;
    protected string $statusConvite = 'pendente'; // pendente, enviado, confirmado, rejeitado
    protected ?\DateTime $dataEnvioConvite = null;
    protected ?\DateTime $dataRespostaConvite = null;
    protected ?string $casa = null;
    private static array $alunos = [];
    private ?string $email = null;
    protected Boletim $boletim;

    public function __construct(string $nome, int $idade, string $email) {
        parent::__construct($nome, $idade, $email, 'aluno');
        $this->boletim = new Boletim();
    }
    
    public function getResposta(): bool {
        return $this->resposta;
    }

    public function getStatusConvite(): string {
        return $this->statusConvite;
    }

    public function getDataEnvioConvite(): ?\DateTime {
        return $this->dataEnvioConvite;
    }

    public function getDataRespostaConvite(): ?\DateTime {
        return $this->dataRespostaConvite;
    }

    public function getCasa(): ?string {
        return $this->casa;
    }
    public function getEmail(): ?string {
        return $this->email;
    }

    public function setCasa(string $casa): void {
        $this->casa = $casa;
    }
     public function getBoletim(): Boletim
    {
        return $this->boletim;
    }

    public function consultarBoletim(): void
    {
        echo "Exibindo boletim de {$this->getNome()}:\n";
        $this->boletim->exibir();
    }


    public function confirmaResposta(bool $aceita = true): void {
        $this->resposta = $aceita;
        $this->dataRespostaConvite = new \DateTime();
        
        if ($aceita) {
            $this->statusConvite = 'confirmado';
        } else {
            $this->statusConvite = 'rejeitado';
        }
    }
    public static function getDistribuicaoPorCasa(): array {
        $distribuicao = [];
        foreach (self::$alunos as $aluno) {
            $casa = $aluno->getCasa();
            if ($casa) {
                if (!isset($distribuicao[$casa])) {
                    $distribuicao[$casa] = 0;
                }
                $distribuicao[$casa]++;
            }
        }
        return $distribuicao;

    }
        public function marcarConviteEnviado(): void
    {
        $this->dataEnvioConvite = new \DateTime();
        $this->statusConvite = 'enviado';
    }
}


