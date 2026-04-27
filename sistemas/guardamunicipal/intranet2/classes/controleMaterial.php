<script language='javascript'>
function fecha(){
window.close();
}
tempo = 100;
setTimeout("fecha()",tempo);
</script>
<?php
	$idMaterial = 0;
	$idMaterial = (int)$_POST['idMaterial'];
	if( $idMaterial == 0 )
	{
		$idMaterial = (int)$_GET['idMaterial'];
	}
	$codmaterial = $_POST['xcodmaterial'];
	$grupo = $_POST['ygrupo'];
	$subgrupo = $_POST['subgrupo'];
	$descricaocurta = $_POST['xdescricaocurta'];
	$descricaolonga = $_POST['xdescricaolonga'];
	$tamanhomat = $_POST['tamanho'];
	$datavalidade = $_POST['datavalidade'];
	$minimo = $_POST['xminimo'];
	$quantidade = $_POST['xquantidade'];
	
	require ("DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	$tamanho = strlen($codmaterial);

	if( $tamanho > 0  && $idMaterial > 0 )
	{
		// alterar dados
		$query = "UPDATE material set estoque='$estoque' where id=$idMaterial";
		$conexao->executaQuery($query);	
		echo "<script>alert('Material atualizado com sucesso!');</script>";  
		echo "<script> window.location.href = '../controle/cadastro_departamento.php' </script>"; 
		                    
	}
	else{
		if( $idMaterial > 0 )
		{
			// excluir envento
			$query = "delete from material where id=$idMaterial";
			$conexao->executaQuery($query);
			echo "<script>alert('Material deletado com sucesso!');</script>";
			echo "<script>window.location.href = '../controle/cadastro_departamento.php' </script>";
		}
		else
		{
			// incluir
			$queryD = "select * from material where codmaterial='$codmaterial'";
			$resultadoD = $conexao->executaQuery($queryD);
			$linhaD = mysql_fetch_array($resultadoD);
			if($linhaD)
			{
				echo "<script>alert('Código já em uso, tente outro!');</script>";
				echo "<script> window.location.href = '../controle/cadastro_material.php?descricaocurta=$descricaocurta&descricaolonga=$descricaolonga&tamanho=$tamanhomat&datavalidade=$datavalidade&estoque=$estoque' </script>";
			}else{
				$query = "insert into material (codmaterial,grupo,subgrupo,descricaocurta,descricaolonga,tamanho,datavalidade,qtdmin,quantidade) values('$codmaterial','$grupo','$subgrupo','$descricaocurta','$descricaolonga','$tamanhomat','$datavalidade',$minimo,$quantidade)";
				$conexao->executaQuery($query);
				echo "<script>alert('Material cadastrado com sucesso!');</script>";
				echo "<script> window.location.href = '../controle/cadastro_material.php' </script>";
				
			}
		}
	}
?>