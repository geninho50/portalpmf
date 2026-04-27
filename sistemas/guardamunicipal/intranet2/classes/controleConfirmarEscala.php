<script type="text/javascript">
opener.location.reload();//Atualiza a página de origem que abriu esse pop-up
window.close();
</script>
<?php 
require ("DB_mysql.php"); 
$obj = new DB_mysql; 
$tamanho = strlen($login); 

$id  = $_POST['id'];
$login = $_POST['login'];
$horas1  = $_POST['hora1'];
$horas2  = $_POST['hora2'];
$adicional = $_POST['adicional'];
     
	if($id>0) {
			$queryLE = "update listaescala set login='$login',hora1='$horas1',hora2='$horas2',adicional='$adicional' where id=$id";
            $obj->executaQuery($queryLE); 
			echo "<script>alert('Dados alterados com sucesso!');</script>";     
			echo "<script> window.location.href = '../controle/confirmar_escala_horaextra.php' </script>";                  
	}else{
		echo "<script>alert('Problema na confirmação da escala!');</script>";                       
		echo "<script> window.location.href = '../controle/administrar_escala_horaextra.php' </script>";
	}
      $obj->closeVar($query); 
      $obj->closeQuery(); 
      $obj->closeConexaoGeral(); 
?>