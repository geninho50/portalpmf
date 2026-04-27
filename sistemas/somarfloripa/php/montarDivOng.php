<?php
  @header("Cache-Control: no-cache, must-revalidate");
  @header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
  
include_once("../../banco/gdb.php"); 

$gdb = new gdb();  

// $codigoPessoa = $gdb->vargetpost('codigoPessoa');

$gdb->open("SELECT nome 	
			 FROM backend.pessoa P 
			WHERE UPPER(P.nome) like 'MARIA%' 
			limit 1,12 ");

if( $gdb->linhas > 0 ){
	$x = 0;
    $dados = "<div class='row'>";
	
	foreach( $gdb->gs['NOME'] as $key=>$value ){
		if( $x == 4 ){
			$dados .= " </div>
						<div class='row'>
						<button class='col' id='btn1'>$value</button>";
			$x = 0;
		}else{
			$dados .= "<button class='col'>$value</button>";
		}
		$x++;
	}

	$dados .= " </div>";
}else{
	$dados = "<div class='row'>
			
				<label>Problemas com o banco de dados !</label>
			
		</div>";
}

print $dados;
?>