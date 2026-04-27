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
	
	$idsubgrupo = 0;
	$idsubgrupo = (int)$_POST['idsubgrupo'];
	if( $idsubgrupo == 0 )
	{
		$idsubgrupo = (int)$_GET['idsubgrupo'];
	}
	$grupo = $_POST['ygrupo'];
	$subgrupo = $_POST['xsubgrupo'];
	
	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	require ("trataData.php");
	$objD = new trataData;
	$tamanho = strlen($grupo);

	if( $tamanho > 0  && $idGrupo > 0 )
	{
		// alterar dados
		$query = "UPDATE subgrupo_material set idgrupo=$grupo, nome='$subgrupo' where id=$idsubgrupo";
		$conexao->executaQuery($query);	
		echo "<script>alert('SubGrupo atualizado com sucesso!');</script>";  
		echo "<script> window.location.href = '../controle/cadastro_subgrupo_material.php' </script>"; 
		                    
	}
	else{
		if( $idGrupo > 0 )
		{
			// excluir envento
			$query = "delete from subgrupo_material where id=$idsubgrupo";
			$conexao->executaQuery($query);
			echo "<script>alert('SubGrupo deletado com sucesso!');</script>";
			echo "<script> window.location.href = '../controle/cadastro_subgrupo_material.php' </script>";
		}
		else
		{
			// incluir
			$query = "insert into subgrupo_material (grupo,nome) values('$grupo','$subgrupo')";
			$conexao->executaQuery($query);
			echo "<script>alert('SubGrupo cadastrado com sucesso!');</script>";
			echo "<script> window.location.href = '../controle/cadastro_subgrupo_material.php' </script>";
		}
	}
?>