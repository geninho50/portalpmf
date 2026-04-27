<?php
function sendMail($para,$de,$mensagem,$assunto)
{
    //DADOS SMTP
    $smtp = "mail.pmf.sc.gov.br";
    $usuario = "portal@pmf.sc.gov.br";
    $senha = "tec20";
	
    require_once 'smtp.php';
	
    $mail = new SMTP;
    $mail->Delivery('relay');
    $mail->Relay($smtp, $usuario, $senha, 25, 'login', false);
    $mail->TimeOut(10);
    $mail->Priority('high');
    $mail->From($de);
    $mail->AddTo($para);
    $mail->Html($mensagem);

    if($mail->Send($assunto))
        return true;
    else
        return false;
}

/**
* Verifica se o e-mail e o dominio s‹o validos
* @param $mail
* @return bool
*/
function validMail($mail) {
	$isMail = preg_match('/^[\d\w._%-]+@[\d\w.-]+\.[\w]{2,4}$/', $mail);
	$retorno = ((bool) $isMail);
	
	if($isMail){
		$host = explode("@", $mail);
		$host = $host[1];
		$retorno = getmxrr($host, $mx);

		if (!$retorno) { 
	    	$ipaddress = gethostbyname($host);
		    if ($ipaddress != $host) {
		    	$retorno=true;
	    	}
		}
	}

	return $retorno;
}
?>