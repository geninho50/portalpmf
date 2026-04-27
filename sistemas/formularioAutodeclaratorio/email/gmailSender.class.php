<?php 
include_once("phpmailer/class.phpmailer.php");
define('GUSER', 'adote.pmf@gmail.com');
define('GPWD', '@dote.2019');

class gmailSender {	
	function smtpmailer($para, $de, $nomeDestinatario, $assunto, $corpo, $path, $path1) {
		global $error;
		$mail = new PHPMailer();
		/* Montando o Email*/
		$mail->IsSMTP(); /* Ativar SMTP*/
		$mail->SMTPDebug = 1; /* Debugar: 1 = erros e mensagens, 2 = mensagens apenas*/
		$mail->SMTPAuth = true; /* Autenticação ativada */
		$mail->SMTPSecure = 'ssl'; /* TLS REQUERIDO pelo GMail*/
		$mail->Host = 'smtp.gmail.com'; /* SMTP utilizado*/
		$mail->Port = 465; /* A porta 465 deverá estar aberta em seu servidor*/
		$mail->Username = GUSER;
		$mail->Password = GPWD;
		$mail->SetFrom($de, $nomeDestinatario);
		$mail->Subject = $assunto;
		$mail->Body = $corpo;
		$mail->AddAddress($para);
		$mail->IsHTML(true);
		$mail->AddAttachment($path, $name = 'ficha_requisicao_adocao.pdf', $encoding = 'base64', $type = 'application/octet-stream');
		$mail->AddAttachment($path1, $name = 'termo_de_adocao_e_aceite.pdf', $encoding = 'base64', $type = 'application/octet-stream');
		
		if(!$mail->Send()) {
			$error = "<font color='red'><b>Mail error: </b></font>".$mail->ErrorInfo;
			return false;
		} else {
			$error = "<font color='blue'><b>Mensagem enviada com Sucesso!</b></font>";
			return true;
		}
	}
}