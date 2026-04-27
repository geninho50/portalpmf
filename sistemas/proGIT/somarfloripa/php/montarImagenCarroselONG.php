<?php

@header("Cache-Control: no-cache, must-revalidate");
@header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
  
include_once("../../banco/gdb.php"); 

$gdb = new gdb();  

// $codigoPessoa = $gdb->vargetpost('codigoPessoa');

$gdb->open("  select p.codigoPessoa as codigo, 
					 nome, 
					 cnpj, 
					 e.*,
					 a.* 
				from pessoa p, 
					pessoaAuxiliar a, 
					pessoaEndereco e 
				where a.codigoPessoa = p.codigoPessoa 
				and e.codigoPessoa = p.codigoPessoa 
				and a.situacaoSOMAR = 'O'
				and p.nome is not null
				and a.fileDocumento is not null
				limit 1,12");
		
if( $gdb->linhas > 0 ){

	$x = 0;
	$dados = "";

	foreach($gdb->gs['NOME'] as $key=>$value){
		$nome    = $value;
		$logo    = $gdb->gs['FILEDOCUMENTO'][$key];

		if($key==1){
			$dados .= " <div class='carousel-item active'>
							<center><img width='300px' height='300px' src='$logo'/></center>
							<center><label>$nome</label></center>
						</div>";
						
						
						
		}else{
			$dados .= "<div class='carousel-item'>
							<center><img width='300px' height='300px' src='$logo'/></center>
							<center><label>$nome</label></center>
					  </div>";
		}
	}
}else{
		$dados .= "<div class='row'><label>Problemas com o banco de dados !</label></div>";
}

print $dados;

?>