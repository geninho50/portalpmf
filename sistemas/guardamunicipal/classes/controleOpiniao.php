<script language='javascript'>
function fecha(){
window.close();
}
tempo = 100;
setTimeout("fecha()",tempo);
</script>
<?php
	$id = 0;
	$id = (int)$_POST['id'];
	if( $id == 0 )
	{
		$id = (int)$_GET['id'];
	}
	$guarda = $_POST['guarda'];
	$opiniao = $_POST['opiniao'];
	$opiniaoT = strtr(strtoupper($opiniao),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"); 
	$tamanho = strlen($opiniaoT);
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");

	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;

	$query = "insert into opiniao (idenquete,guarda,data_cadastro,hora_cadastro,opiniao) values ('$id','$guarda','$data_atual','$hora_atual','$opiniaoT')";
	$conexao->executaQuery($query);
	echo "<script>alert('Inserido com sucesso!');</script>";  
?>