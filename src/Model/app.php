<?php

namespace Hogwarts;

use Hogwarts\Model\ConviteCadastro\ConviteManager;

class App
{
    public function run()
    {
        echo "=== Sistema de Gestão Escolar Hogwarts ===\n";
        echo "Selecione um módulo:\n";
        echo "1 - Convite e Cadastro de Alunos\n";
        echo "0 - Sair\n";
        echo "Escolha: ";

        $choice = trim(fgets(STDIN));

        switch ($choice) {
            case '1':
                (new ConviteManager())->menu();
                break;
            case '0':
                echo "Saindo...\n";
                exit;
            default:
                echo "Opção inválida.\n";
        }

        $this->run();
    }
}
