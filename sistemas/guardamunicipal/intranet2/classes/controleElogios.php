<script language='javascript'>
function fecha(){
window.close();
}
tempo = 100;
setTimeout("fecha()",tempo);
</script>
<?php
	
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
	
	$idElogio = 0;
	$idElogio = (int)$_POST['idElogio'];
	if( $idElogio == 0 )
	{
		$idElogio = (int)$_GET['idElogio'];
	}
	$guarda = $_POST['xguarda'];
	$numero = $_POST['xnumero'];
	$data = $_POST['xdataini'];
	$titulo = $_POST['xtitulo'];
	$tituloT = strtr(strtoupper($titulo),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"); 
	
	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
	$tamanho = strlen($guarda);

	if( $tamanho > 0 && $idElogio > 0 )
	{
		// alterar dados
		$query = "UPDATE elogio set guarda='$guarda',numero='$numero',data='$data',titulo='$tituloT' where id=$idElogio";
		$conexao->executaQuery($query);	
		echo "<script>alert('Elogio atualizado com sucesso!');</script>";                       
	}
	else
	{
		// incluir
		$query = "insert into elogio (guarda,numero,data,titulo,data_cadastro) values('$guarda','$numero','$data','$tituloT','$data_atual')";
		$conexao->executaQuery($query);
		echo "<script>alert('Elogio cadastrado com sucesso!');</script>";
		echo "<script> window.location.href = '../controle/cadastro_elogios.php' </script>";
	}
?>