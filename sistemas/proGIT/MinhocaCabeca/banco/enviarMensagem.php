<?php

include_once("gdb.php"); 

$gdb = new gdb();  

$id_mensagem = $gdb->vargetpost('id_mensagem');
$id_usuario_admin = $gdb->vargetpost('id_usuario_admin');
$resposta = $gdb->vargetpost('resposta');

if($gdb->enviarMensagemAdmin($id_mensagem,$id_usuario_admin,$resposta)){
   echo json_encode(array('success' => '1'));    
} else {
   echo json_encode(array('error' => 'Ocorreu algum problema ao enviar a mensagem.'));    
}

?>