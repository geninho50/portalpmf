<?php
	include_once("gdb.php"); 

    $gdb = new gdb(); 
    
    $id_pessoa= $gdb->vargetpost('id_pessoa');
    $id_evento = $gdb->vargetpost('id_evento');
    
    $retorno = $gdb->inscricaoEventoAdmin($id_pessoa,$id_evento);
    
    switch($retorno) {
        case 0:
            echo json_encode(array('error' => 'Participante já inscrito em outro evento.'));
            break;
        case 1:
            echo json_encode(array('success' => '1'));
            break;
        case 2:
            echo json_encode(array('error' => 'O participante não pode ser inscrito pois está na fila de espera ou inativo!'));
            break;
    }
?>