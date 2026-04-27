<?php
  @header("Cache-Control: no-cache, must-revalidate");
  @header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
  
include_once("../../banco/gdb.php"); 

$gdb = new gdb();  

$codigoPessoa = $gdb->vargetpost('codigoPessoa');

$gdb->open("SELECT P.*, 
                   DATE_FORMAT( P.lancamento,'%d/%m/%Y') AS data,
				   DATE_FORMAT( P.lancamento,'%Y') AS ano 	
			 FROM proconReclamacao P 
			WHERE P.codigopessoa = '$codigoPessoa' ");

if( $gdb->linhas > 0 ){
	
    $dados = "
	   <div class='row'>
			 <div class='col-md-12' >
				<label><b>Opção - Código - Data - Assunto </b></label>
			</div>
		</div><br><br>";
	
	foreach( $gdb->gs['ASSUNTO'] as $key=>$value ){
		$data    = $gdb->gs['DATA'][$key];
		$codigo  = $gdb->gs['CODIGORECLAMACAO'][$key];
		$ano     = $gdb->gs['ANO'][$key];
		$codigo2 = str_pad($codigo, 6, '0', STR_PAD_LEFT);
		
		// <input type='button' class='btn btn-primary botao' value='Reenviar' onclick='reenviarReclamacao($codigo);' />
		$dados .= "
		<div class='row'>
			 <div class='col-md-12' >
				<input type='button' class='btn btn-primary botao' value='Imprimir' onclick='imprimirComprovante($codigo);' /> - $codigo2/$ano - $data - $value
			</div>
		</div>";
	}
	
}else{
	$dados = "<div class='row'>
			 <div class='col-md-9' >
				<label>Não existe reclamações para este Consumidor !</label>
			</div>
		</div>";
}

print $dados;
?>