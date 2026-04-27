<?php
ob_start(); // Inicia o buffer de saída
include 'db/connect.php'; 
include_once('db/gdb_mysql.php'); 
require_once('db/gmailSender.class.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json'); 

    $gdb = new gdb(); 
    $response = []; 

    function generateResetCode($length = 6) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    if (isset($_POST['email'])) {
        $email = $_POST['email']; 

        if (empty($email)) {
            $response['success'] = false;
            $response['message'] = 'E-mail não fornecido ou inválido.';
            ob_end_clean(); // Limpa o buffer de saída
            echo json_encode($response);
            exit();
        }

        $gdb->open("SELECT idUsuario FROM usuario WHERE emailUsuario = '$email'");

        if ($gdb->gs['IDUSUARIO'][0]) { 
            $idUsuario = $gdb->gs['IDUSUARIO'][0];
            $codeReset = generateResetCode(); 
            $gdb->open("UPDATE usuario 
                        SET resetSenha = 1,
                            codeReset = '$codeReset'
                        WHERE idUsuario = $idUsuario");

            date_default_timezone_set('America/Sao_Paulo');
            $current_time = date('d-m-Y H:i:s');

            $gdb->open("INSERT INTO auditoria (tipoInteracao, idUsuario, horaAuditoria, nomeDoAlvo) 
                        VALUES ('Resetou a Senha do Usuário', 'Sistema', '$current_time', '$email')");

            $nomeDestinatario = 'Gestão de Sistemas';
            $de = 'pgs.egov@pmf.sc.gov.br';
            $assunto = 'Código de Redefinição de Senha';
            $corpo = "Olá, seu código de redefinição de senha é: $codeReset \n
                        Para redefinir senha, clique <a href='http://pgs.pmf.sc.gov.br/TelaReset.php'>AQUI</a>";

            if (smtpmailer($email, $de, $nomeDestinatario, $assunto, $corpo)) {
                $response['success'] = true;
                $response['message'] = 'E-mail enviado com sucesso.';
            } else {
                $response['success'] = false;
                $response['message'] = 'Erro ao enviar e-mail.';
            }

        } else {
            $response['success'] = false;
            $response['message'] = 'E-mail não encontrado. Verifique o valor inserido.';
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'E-mail não informado.';
    }

    ob_end_clean(); // Limpa o buffer de saída novamente antes de enviar a resposta JSON
    echo json_encode($response); 
    exit(); 
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
    <title>Reset Senha - Email</title>
</head>
<body>
    <div class="background"></div>
    <div>
        <form id="resetForm" method="POST">
            <h3>Reset de Senha - Email</h3>
            <label for="email">Digite Seu E-mail</label>
            <input name="email" type="email" placeholder="Digite Seu E-mail" id="email" required>
            <input type="submit" value="Registrar">
            <h3 id="message"></h3>
        </form>
        <!-- <div id="message"></div> -->
    </div>

    <script>
        document.getElementById('resetForm').addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(this);
            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text()) // Recebe a resposta como texto
            .then(data => {
                console.log('Resposta recebida do servidor:', data); // Loga a resposta recebida
                try {
                    const jsonData = JSON.parse(data); // Tenta fazer o parse para JSON
                    const messageDiv = document.getElementById('message');
                    messageDiv.innerHTML = jsonData.message;
                    messageDiv.style.color = jsonData.success ? 'green' : 'red';
                } catch (error) {
                    console.error('Erro ao converter para JSON:', error);
                    const messageDiv = document.getElementById('message');
                    messageDiv.innerHTML = 'Erro no servidor. Por favor, tente novamente.';
                    messageDiv.style.color = 'red';
                }
            })
            .catch(error => {
                console.error('Erro na requisição:', error);
            });
        });
    </script>
</body>
</html>
