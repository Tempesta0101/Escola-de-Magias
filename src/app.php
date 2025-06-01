<?php
namespace Hogwarts;

use Hogwarts\Model\ConviteCadastro\ConviteManager;
use Hogwarts\Model\SelecaoCasas\SelecaoCasasManager;
use Hogwarts\Model\TorneiosCompeticoes\TorneiosManager;
use Hogwarts\Model\ControleAcademico\ControleAcademicoManager;
use Hogwarts\Model\GerenciamentoPessoal\ProfessoresManager;
use Hogwarts\Model\AlertasComunicacao\AlertasManager;

class App
{
    public function run()
    {
        echo "=== Sistema de Gestão Escolar Hogwarts ===\n";
        echo "Selecione um módulo:\n";
        echo "1 - Convite e Cadastro de Alunos\n";
        echo "2 - Seleção de Casas\n";
        echo "3 - Gerenciamento de Torneios e Competições\n";
        echo "4 - Controle Acadêmico e Disciplinar\n";
        echo "5 - Gerenciamento de Professores e Funcionários\n";
        echo "6 - Sistema de Alertas e Comunicação\n";
        echo "0 - Sair\n";
        echo "Escolha: ";

        $choice = trim(fgets(STDIN));

        switch ($choice) {
            case '1':
                (new ConviteManager())->menu();
                break;
            case '2':
                (new SelecaoCasasManager())->menu();
                break;
            case '3':
                (new TorneiosManager())->menu();
                break;
            case '4':
                (new ControleAcademicoManager())->menu();
                break;
            case '5':
                (new ProfessoresManager())->menu();
                break;
            case '6':
                (new AlertasManager())->menu();
                break;
            case '0':
                echo "Saindo...\n";
                exit;
            default:
                echo "Opção inválida.\n";
                break;
        }
        
        $this->run();
    }
}
