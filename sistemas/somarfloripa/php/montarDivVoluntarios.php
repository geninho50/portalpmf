<?php
  @header("Cache-Control: no-cache, must-revalidate");
  @header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
  
include_once("../../banco/gdb.php"); 

$gdb = new gdb();  

// $codigoPessoa = $gdb->vargetpost('codigoPessoa');

$gdb->open("SELECT count(*) as total 
			 FROM backend.pessoa P 
			WHERE UPPER(P.nome) like 'JOAO%'");

if( $gdb->linhas > 0 ){
	$dados = $gdb->gs['TOTAL'][0]."<br> JOAO";
}else{
	$dados = "<div class='row'>
			
				<label>Problemas com o banco de dados !</label>
			
		</div>";
}

print $dados;
?>