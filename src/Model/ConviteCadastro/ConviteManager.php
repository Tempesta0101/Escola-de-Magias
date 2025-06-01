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

    public function enviarConvite()
    {
        $this->conviteEnviado = true;
        echo "Carta-convite enviada para {$this->nome} ({$this->email}).\n";
    
    }

    public function confirmarRecebimento()
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

class ConviteManager
{
    private array $alunos = [];

    public function menu()
    {
        echo "=== Módulo 1: Convite e Cadastro de Alunos ===\n";
        echo "1 - Cadastrar novo aluno\n";
        echo "2 - Enviar convite para aluno\n";
        echo "3 - Confirmar recebimento de convite\n";
        echo "4 - Listar convites enviados e recebidos\n";
        echo "0 - Voltar ao menu principal\n";
        echo "Escolha: ";

        $opcao = trim(fgets(STDIN));

        switch ($opcao) {
            case '1':
                $this->cadastrarAluno();
                break;
            case '2':
                $this->enviarConvite();
                break;
            case '3':
                $this->confirmarRecebimento();
                break;
            case '4':
                $this->listarConvites();
                break;
            case '0':
                return;
            default:
                echo "Opção inválida.\n";
        }
        $this->menu();
    }

    private function cadastrarAluno()
    {
        echo "Nome do aluno: ";
        $nome = trim(fgets(STDIN));
        echo "Email do aluno: ";
        $email = trim(fgets(STDIN));
        $this->alunos[] = new Aluno($nome, $email);
        echo "Aluno {$nome} cadastrado com sucesso.\n";
    }

    private function enviarConvite()
    {
        if (empty($this->alunos)) {
            echo "Nenhum aluno cadastrado.\n";
            return;
        }
        $this->listarAlunos();
        echo "Digite o número do aluno para enviar convite: ";
        $num = intval(trim(fgets(STDIN))) - 1;
        if (!isset($this->alunos[$num])) {
            echo "Aluno inválido.\n";
            return;
        }
        $this->alunos[$num]->enviarConvite();
    }

    private function confirmarRecebimento()
    {
        if (empty($this->alunos)) {
            echo "Nenhum aluno cadastrado.\n";
            return;
        }
        $this->listarAlunos();
        echo "Digite o número do aluno que confirmou: ";
        $num = intval(trim(fgets(STDIN))) - 1;
        if (!isset($this->alunos[$num])) {
            echo "Aluno inválido.\n";
            return;
        }
        $this->alunos[$num]->confirmarRecebimento();
    }

    private function listarConvites()
    {
        if (empty($this->alunos)) {
            echo "Nenhum aluno cadastrado.\n";
            return;
        }
        echo "Lista de convites:\n";
        foreach ($this->alunos as $index => $aluno) {
            $num = $index + 1;
            $enviado = $aluno->isConviteEnviado() ? "Sim" : "Não";
            $confirmado = $aluno->isConfirmado() ? "Sim" : "Não";
            echo "{$num}. {$aluno->getNome()} - Convite enviado: {$enviado} - Confirmado: {$confirmado}\n";
        }
    }

    private function listarAlunos()
    {
        foreach ($this->alunos as $index => $aluno) {
            $num = $index + 1;
            echo "{$num} - {$aluno->getNome()} ({$aluno->getEmail()})\n";
        }
    }
}
