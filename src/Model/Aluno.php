<?php

namespace App\Model;

class Aluno extends Bruxo {
    
    protected bool $resposta = false;
    protected string $statusConvite = 'pendente'; // pendente, enviado, confirmado, rejeitado
    protected ?\DateTime $dataEnvioConvite = null;
    protected ?\DateTime $dataRespostaConvite = null;
    protected ?string $casa = null;

    public function __construct(string $nome, int $idade, string $email) {
        parent::__construct($nome, $idade, $email, 'aluno');
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

    public function setCasa(string $casa): void {
        $this->casa = $casa;
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
}