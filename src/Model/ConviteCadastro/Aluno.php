<?php

namespace Hogwarts\Model\ConviteCadastro;

class Aluno
{
    private string $nome;
    private string $email;
    private bool $conviteEnviado = false;
    private bool $confirmaRecebimento = false;

    public function __construct(string $nome, string $email)
    {
        $this->nome = $nome;
        $this->email = $email;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function isConviteEnviado(): bool
    {
        return $this->conviteEnviado;
    }

    public function enviarConvite(): void
    {
        $this->conviteEnviado = true;
        echo "Carta-convite enviada para {$this->nome} ({$this->email}).\n";
    }

    public function confirmarRecebimento(): void
    {
        if (!$this->conviteEnviado) {
            echo "Convite não enviado ainda para {$this->nome}.\n";
            return;
        }
        $this->confirmaRecebimento = true;
        echo "{$this->nome} confirmou recebimento da carta.\n";
    }

    public function isConfirmado(): bool
    {
        return $this->confirmaRecebimento;
    }
}
