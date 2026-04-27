<script language='javascript'>
function fecha(){
window.close();
}
tempo = 100;
setTimeout("fecha()",tempo);
</script>
<?php
	//$id = $_POST['id'];
	$login = $_POST['login'];
	$grupo = $_POST['grupo'];
	$turno = $_POST['turno'];
	$novogrupo = $_POST['ygrupo'];
	
	require ("DB_mysql.php");
	$obj = new DB_mysql;

	$queryU = "select * from usuario where login='$login'";
	$resultadoU = $obj->executaQuery($queryU);
	if ($linhaU=mysql_fetch_array($resultadoU))
	{
		$soma = $linhaU['soma'];
	}
	
	$queryG = "select * from grupo where nome='$grupo'";
	$resultadoG = $obj->executaQuery($queryG);
	if ($linhaG=mysql_fetch_array($resultadoG))
	{
		$idgrupo = $linhaG['id'];
	}
	
	$query = "select max(soma) as valor from usuario where grupo=$novogrupo";
	$result = $obj->executaQuery($query);
	if($linha = mysql_fetch_array($result)){
		$maiorvalor = $linha['valor'];
	}
	
	if($soma > $maiorvalor){
		$somatemp = $soma;
	}else{
		$somatemp = $maiorvalor;
	}
	
	$data_atual = date("Y-m-d");
	$queryI = "INSERT INTO grupohistorico (login,grupo, gruponovo, data) values ('$login','$idgrupo','$novogrupo','$data_atual')";
	$obj->executaQuery($queryI);
	
	$query = "UPDATE usuario set ordenar=$somatemp, grupo=$novogrupo,turno=$turno where login='$login'";	
	$obj->executaQuery($query);
	
	$queryF = "SELECT max( id ) AS id FROM ferias WHERE login = '$login'";
	$resultF = $obj->executaQuery($queryF);
	if($linhaF = mysql_fetch_array($resultF)){
		$id = $linhaF['id'];
		$query = "UPDATE  `ferias` SET  `grupo` =  '$novogrupo' WHERE  `id` =$id";	
		$obj->executaQuery($query);
	}
	
	echo "<script>alert('Alterado com sucesso!');</script>";
	echo "<script> window.location.href = '../controle/cadastro_ferias.php' </script>";
	
	// Fechando as variáveis
	$obj->closeVar($id);
	$obj->closeVar($query);		
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>