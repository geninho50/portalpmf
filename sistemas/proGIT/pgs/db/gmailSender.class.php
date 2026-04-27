<?php
/* Extender a classe do phpmailer para envio do email*/
require_once("phpmailer/class.phpmailer.php");

/* Definir Usuário e Senha do Zimbra de onde partirão os emails */
define('GUSER', 'pgs.egov@pmf.sc.gov.br');
define('GPWD', 'Gt76ghe8');

function smtpmailer($para, $de, $nomeDestinatario, $assunto, $corpo) {
    global $error;
    $mail = new PHPMailer();

    /* Montando o Email */
    $mail->IsSMTP(); /* Ativar SMTP */
    $mail->SMTPDebug = 0; /* Definir como 0 para desligar mensagens de depuração */
    $mail->SMTPAuth = true; /* Autenticação ativada */
    $mail->SMTPSecure = 'tls'; /* 'tls' ou 'ssl' */
    $mail->Host = 'lnpmf-zimbra.pmf.sc.gov.br'; /* Servidor SMTP do Zimbra */
    $mail->Port = 587; /* Use a porta correta para o tipo de segurança */
    $mail->Username = GUSER;  
    $mail->Password = GPWD;
    $mail->SetFrom($de, $nomeDestinatario);
    $mail->Subject = $assunto;
    $mail->Body = $corpo;
    $mail->AddAddress($para);
    $mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';

    /* Função Responsável por Enviar o Email */
    if (!$mail->Send()) {
        $error = "Mail error: " . $mail->ErrorInfo; // Captura o erro de envio
        error_log($error); // Loga o erro para depuração
        echo json_encode(['success' => false, 'message' => $error]); // Retorna o erro detalhado na resposta JSON
        return false;
    } else {
        echo json_encode(['success' => true, 'message' => 'E-mail enviado com sucesso.']); // Retorna sucesso
        return true;
    }
}

?>
