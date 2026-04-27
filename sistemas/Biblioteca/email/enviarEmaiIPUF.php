<?php
/* Extender a classe do phpmailer para envio do email*/
require_once("phpmailer/class.phpmailer.php");
 
/* Definir Usuário e Senha do Gmail de onde partirá os emails*/
define('GUSER', 'suporte.site@pmf.sc.gov.br');
define('GPWD', 'portal.123');
 
function smtpmailer($para, $de, $nomeDestinatario, $assunto, $corpo) {
	
	global $error;
	$mail = new PHPMailer();
	
	/* Montando o Email*/
	$mail->IsSMTP(); /* Ativar SMTP*/
	$mail->SMTPDebug = 1; /* Debugar: 1 = erros e mensagens, 2 = mensagens apenas*/
	$mail->SMTPAuth = true; /* Autenticação ativada */
	$mail->SMTPSecure = 'tls'; /* TLS REQUERIDO pelo GMail*/
	$mail->Host = 'lnpmf-zimbra.pmf.sc.gov.br'; /* SMTP utilizado*/
	$mail->Port = 25; /* A porta 465 deverá estar aberta em seu servidor*/
	$mail->Username = GUSER;
	$mail->Password = GPWD;
	$mail->SetFrom($de, $nomeDestinatario);
	$mail->Subject = $assunto;
	$mail->Body = $corpo;
	$mail->AddAddress($para);
	$mail->IsHTML(true);
	 
	/* Função Responsável por Enviar o Email*/
	if(! $mail->Send()) {
		$error = "<font color='red'><b>Mail error: </b></font>".$mail->ErrorInfo;
	} else {
		$error = "<font color='blue'><b>Mensagem enviada com Sucesso!</b></font>";
	}
	
	return $error;
}
?>