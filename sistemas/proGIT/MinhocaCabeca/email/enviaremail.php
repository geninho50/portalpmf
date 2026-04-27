<?php
include('gmailSender.class.php');
include('../banco/gdb.php');

$gmailSender = new gmailSender();
$gdb = new gdb();

$para = $gdb->vargetpost('para');

$nomeDestinatario = 'Minhoca na Cabeça';
$de = 'minhocanacabeca.comcap@gmail.com';
$assunto = $gdb->vargetpost('Minhoca na Cabeça');
$corpo = $gdb->vargetpost('mensagem');

 
echo ($gmailSender->smtpmailer($para, $de, $nomeDestinatario, $assunto, $corpo)) ? 1 : 0;

define('GPWD', 'Mnc.123.Comcap');