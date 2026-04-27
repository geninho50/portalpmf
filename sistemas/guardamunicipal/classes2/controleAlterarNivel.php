<script type="text/javascript">
opener.location.reload();//Atualiza a página de origem que abriu esse pop-up
window.close();
</script>
<?php 

	$id = $_GET['id'];
	$nome = $_GET['nome'];
	$valor = $_GET['valor'];
	if( $id > 0 )
	{
		// Pegou o Id
	}
	else
	{
		$id = $_POST['id'];
		$nome = $_POST['xnome'];
		$valor = $_POST['xvalor'];
	}

require ("DB_mysql.php"); 
$obj = new DB_mysql; 
$tamanho = strlen($login); 
     
	if($id>0) {
			$queryLE = "update nivel set valor='$valor' where id=$id";
            $obj->executaQuery($queryLE); 
			echo "<script>alert('Dados alterados com sucesso!');</script>";     
			echo "<script> window.location.href = '../controle/buscar_nivel.php' </script>";                  
	}else{
		$query = "INSERT INTO nivel (nome,valor) values ('$nome','$valor')";
		$obj->executaQuery($query);
		echo "<script>alert('Nivel cadastrado com sucesso!');</script>";                       
		echo "<script> window.location.href = '../controle/buscar_nivel.php' </script>";
	}
      $obj->closeVar($query); 
      $obj->closeQuery(); 
      $obj->closeConexaoGeral(); 
?>