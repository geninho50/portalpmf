<?php
	include_once("gdb.php"); 

	$gdb = new gdb();  

	$id_evento = $gdb->vargetpost('id_evento');
	$nome_evento = $gdb->vargetpost('nome_evento');
	$descricao = $gdb->vargetpost('descricao');
	$ministrante = $gdb->vargetpost('ministrante');
	$carga_horaria = $gdb->vargetpost('carga_horaria');
	$local = $gdb->vargetpost('local');
	$vagas = $gdb->vargetpost('vagas');
	$data = $gdb->vargetpost('data');
	$hora = $gdb->vargetpost('hora');
	$status_evento = $gdb->vargetpost('status_evento');
	$observacao = $gdb->vargetpost('observacao');
	

    if($gdb->editarEvento($id_evento, $nome_evento,$descricao,$ministrante,$carga_horaria,$local,$vagas,$data,$hora,$status_evento,$observacao)) {
        echo json_encode(array('success' => '1'));    
    } else {
        echo json_encode(array('error' => 'Ocorreu algum problema ao editar o evento.'));    
    }
	
    
?>