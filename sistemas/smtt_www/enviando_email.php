<?php
	$nome = $_POST["nome"];
	$email = $_POST["email"];
	$mensagem = $_POST["mensagem"];
	$assunto = $_POST["assunto"]; 
	
	$msg = "Mensagem enviada pelo Portal da Sec. Transportes:\n\n";
	$msg .= "Nome: $nome\n";
	$msg .= "E-mail: $email\n";
	$msg .= "Assunto: $assunto\n";
	$msg .= "Mensagem: $mensagem";
	$de = "$email";
	
	//$envio = mail("guirguis@pmf.sc.gov.br", "Mensagem", $msg, "From: $de\nReply-To: $email");
	$envio = mail("kiko@pmf.sc.gov.br", $assunto, $msg, "From: $de");
	session_start();
	if($envio)
	{
		//$_SESSION['msgenvio'] = "Mensagem enviada com sucesso";
		$_SESSION['msgenvio'] = "em manuten&ccedil&atildeo, favor n&atildeo utilizar";
	}
	else
	{
		$_SESSION['msgenvio'] = "A mensagem n&atildeo pode ser enviada";
	}
	header ("Location: email.php");
?>