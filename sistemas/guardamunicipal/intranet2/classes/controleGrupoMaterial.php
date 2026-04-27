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
	
	$idGrupo = 0;
	$idGrupo = (int)$_POST['idGrupo'];
	if( $idGrupo == 0 )
	{
		$idGrupo = (int)$_GET['idGrupo'];
	}
	$grupo = $_POST['xgrupo'];
	
	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
	$tamanho = strlen($grupo);

	if( $tamanho > 0  && $idGrupo > 0 )
	{
		// alterar dados
		$query = "UPDATE grupo_material set nome='$grupo' where id=$idGrupo";
		$conexao->executaQuery($query);	
		echo "<script>alert('Grupo atualizado com sucesso!');</script>";  
		echo "<script> window.location.href = '../controle/cadastro_grupo_material.php' </script>"; 
		                    
	}
	else{
		if( $idGrupo > 0 )
		{
			// excluir envento
			$query = "delete from grupo_material where id=$idGrupo";
			$conexao->executaQuery($query);
			echo "<script>alert('Grupo deletado com sucesso!');</script>";
			echo "<script> window.location.href = '../controle/cadastro_grupo_material.php' </script>";
		}
		else
		{
			// incluir
			$query = "insert into grupo_material (nome) values('$grupo')";
			$conexao->executaQuery($query);
			echo "<script>alert('Grupo cadastrado com sucesso!');</script>";
			echo "<script> window.location.href = '../controle/cadastro_grupo_material.php' </script>";
		}
	}
?>