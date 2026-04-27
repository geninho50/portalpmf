<?php

// Ativar exibição de erros para depuração (remover em produção)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Carregar configurações e funções externas
require_once 'config.php';
require_once 'infosldap.php';
require_once 'glpi.php';

header('Content-Type: application/json');

// Verificar método da requisição
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['cpf']) || empty(trim($data['cpf']))) {
        echo json_encode(['success' => false, 'message' => 'CPF não informado.']);
        exit();
    }

    $cpf = trim($data['cpf']);

    try {
        // Buscar o usuário no AD pelo CPF (sAMAccountName)
        $usuarioInfo = buscarUsuarioPorCPF($cpf, $config);

        if (!$usuarioInfo) {
            echo json_encode(['success' => false, 'message' => 'Usuário não encontrado no AD.']);
            exit();
        }

        // Buscar o ID do usuário no GLPI
        $usuarioGLPI = buscarIdUsuarioGLPI($usuarioInfo['username']);

        // Se o usuário não existir no GLPI, definir um usuário genérico
        if (!$usuarioGLPI) {
            $usuarioGLPI = 10; // ID do usuário genérico no GLPI (substitua pelo ID correto)

            // Criar um link para que o usuário acesse o GLPI e faça login
            $glpiLoginLink = $config['glpi_url'] . "/front/login.php";

            // Retornar a mensagem informando que ele deve acessar o GLPI
            echo json_encode([
                "success" => true,
                "message" => "Não encontramos seu usuário no GLPI. Seu chamado foi aberto com um usuário genérico. Para registrar seu usuário, acesse: $glpiLoginLink",
                "usuario_generico" => true
            ]);
            exit();
        }

        // Criar o chamado no GLPI se o usuário foi encontrado
        if (isset($data['chamado'])) {
            $tituloChamado = trim($data['chamado']['titulo']);
            $descricaoChamado = trim($data['chamado']['descricao']);

            $chamadoId = criarChamadoGLPI($usuarioGLPI, $tituloChamado, $descricaoChamado);

            if ($chamadoId) {
                echo json_encode([
                    "success" => true,
                    "message" => "Chamado criado com sucesso.",
                    "chamado_id" => $chamadoId
                ]);
            } else {
                echo json_encode(["success" => false, "message" => "Erro ao criar chamado no GLPI."]);
            }
        } else {
            // Apenas retorna os dados do usuário se não for abertura de chamado
            echo json_encode(['success' => true, 'usuario' => $usuarioInfo]);
        }

    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
}

?>
