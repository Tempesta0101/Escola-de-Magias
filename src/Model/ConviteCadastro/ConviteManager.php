<?php

namespace Hogwarts\Model\ConviteCadastro;

class ConviteManager
{
    private array $alunos = [];

    public function menu()
    {
        echo "\n=== Módulo 1: Convite e Cadastro de Alunos ===\n";
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

    private function cadastrarAluno(): void
    {
        echo "Nome do aluno: ";
        $nome = trim(fgets(STDIN));
        echo "Email do aluno: ";
        $email = trim(fgets(STDIN));

        $this->alunos[] = new Aluno($nome, $email);
        echo "Aluno {$nome} cadastrado com sucesso.\n";
    }

    private function enviarConvite(): void
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

    private function confirmarRecebimento(): void
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

    private function listarConvites(): void
    {
        if (empty($this->alunos)) {
            echo "Nenhum aluno cadastrado.\n";
            return;
        }

        echo "\nLista de convites:\n";
        foreach ($this->alunos as $index => $aluno) {
            $num = $index + 1;
            $enviado = $aluno->isConviteEnviado() ? "Sim" : "Não";
            $confirmado = $aluno->isConfirmado() ? "Sim" : "Não";
            echo "{$num}. {$aluno->getNome()} - Convite enviado: {$enviado} - Confirmado: {$confirmado}\n";
        }
    }

    private function listarAlunos(): void
    {
        echo "\nLista de alunos:\n";
        foreach ($this->alunos as $index => $aluno) {
            $num = $index + 1;
            echo "{$num} - {$aluno->getNome()} ({$aluno->getEmail()})\n";
        }
    }
}
