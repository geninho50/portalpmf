<HTML>
<HEAD>
</HEAD>

<BODY onload="mensagem()">

<SCRIPT LANGUAGE="JavaScript">
<!--
	function mensagem()
	{
		alert('E-mail enviado com sucesso!');
		location = 'login.php';
	}
//-->
</SCRIPT>

</BODY>
</HTML>

<?php
/* Medida preventiva para evitar que outros domínios sejam remetente da sua mensagem. */
if (eregi('tempsite.ws$|locaweb.com.br$|hospedagemdesites.ws$|websiteseguro.com$', $_SERVER[HTTP_HOST])) {
        $emailsender='jonas@gmf.sc.gov.br'; // Substitua essa linha pelo seu e-mail@seudominio
} else {
        $emailsender = "jonas@" . $_SERVER[HTTP_HOST];
        //    Na linha acima estamos forçando que o remetente seja 'webmaster@seudominio',
        // Você pode alterar para que o remetente seja, por exemplo, 'contato@seudominio'.
}
 
/* Verifica qual éo sistema operacional do servidor para ajustar o cabeçalho de forma correta.  */
if(PATH_SEPARATOR == ";") $quebra_linha = "\r\n"; //Se for Windows
else $quebra_linha = "\n"; //Se "nÃ£o for Windows"
 
// Passando os dados obtidos pelo formulário para as variáveis abaixo
$nomeremetente     = $_POST['xnomeremetente'];
$emailremetente    = $_POST['xemailremetente'];
//$emaildestinatario = $_POST['emaildestinatario'];
$assunto           = 'RECUPERAR SENHA DO USUARIO '.$nomeremetente;
 
 
/* Montando a mensagem a ser enviada no corpo do e-mail. 
$mensagemHTML = '<P>Esse email &eacute; um teste enviado no formato HTML via PHP mail();!</P>
<P>Aqui está a mensagem postada por você; formatada em HTML:</P>
<p><b><i>'.$mensagem.'</i></b></p>
<hr>';*/
 
 
/* Montando o cabeÃ§alho da mensagem */
$headers = "MIME-Version: 1.1" .$quebra_linha;
$headers .= "Content-type: text/html; charset=iso-8859-1" .$quebra_linha;
// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
$headers .= "From: " . $emailsender.$quebra_linha;
$headers .= "Reply-To: " . $emailsender . $quebra_linha;
// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)
 
/* Enviando a mensagem */
//É obrigatório o uso do parâmetro -r (concatenação do "From na linha de envio"), aqui na Locaweb:
if(!mail($emailsender, $assunto, $headers ,"-r".$emailsender)){ // Se for Postfix
    $headers .= "Return-Path: " . $emailsender . $quebra_linha; // Se "não for Postfix"
    mail($emailsender, $assunto, $headers );
}
?>