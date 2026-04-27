<?php

include_once("gdb.php"); 

$gdb = new gdb(); 

$id_usuario = $gdb->vargetpost('id_usuario');
$assunto = $gdb->vargetpost('assunto');
$mensagem = $gdb->vargetpost('mensagem');

if($gdb->enviarMensagemUsuario($id_usuario,$assunto,$mensagem)){
     echo json_encode(array('success' => '1'));    
} else {
   echo json_encode(array('error' => 'Ocorreu algum problema ao enviar a mensagem.'));    
}

?>