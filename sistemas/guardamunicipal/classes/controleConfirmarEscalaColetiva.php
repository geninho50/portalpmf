<script type="text/javascript">
opener.location.reload();//Atualiza a página de origem que abriu esse pop-up
window.close();
</script>
<?php

require ("DB_mysql.php");
$obj = new DB_mysql();

$login = $_POST['login'];
$conf  = $_POST['conf'];
$idescala  = $_POST['idescala'];
$horas1  = $_POST['hora1'];
$horas2  = $_POST['hora2'];
$adicional  = $_POST['adicional'];

$tamanho = strlen($conf);
if(isset($conf)) {
   foreach($conf as $login => $value){
      if($tamanho > 0){
			$queryE = "update listaescala set hora1='$horas1', hora2='$horas2', adicional='$adicional' where idescala='$idescala' and login='$value'";
			$obj->executaQuery($queryE);
   	  } 
	  echo "<script>alert('Escala alterada com sucesso!');</script>";                       
	  echo "<script> window.location.href = '../controle/administrar_escala_horaextra.php' </script>";	
   }

   $obj->closeVar($queryE);      
   $obj->closeQuery();
   $obj->closeConexaoGeral();
}
?>