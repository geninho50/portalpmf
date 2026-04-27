<?php

$verIncluir = false;
require ("DB_mysql.php");
$obj = new DB_mysql();

$login = $_POST['login'];
$conf  = $_POST['conf'];
$idescala  = $_POST['idescala'];
$horas1  = $_POST['hora1'];
$horas2  = $_POST['hora2'];
$data  = $_POST['data'];
$chefe  = $_POST['xchefe'];
$auditado  = $_POST['auditado'];

$tamanho = strlen($conf);
if(isset($conf)) {

   foreach($conf as $login => $value){
      /*$query = "SELECT * FROM nomeescala WHERE login = '".$value."'";
	  $resultado = $obj->executaQuery($query);
      if ($linha = mysql_fetch_array($resultado)){
         $id    = $linha['id'];
         $login = $linha['login'];
      }*/

      //e então você insere na tabela
      if($tamanho > 0){
	  		/*$queryE = "SELECT * FROM nomes WHERE login = '".$login."'";
			$resultadoE = $obj->executaQuery($queryE);
			$linhaE = mysql_fetch_array($resultadoE);
			if($linhaE != ''){
		    	$idT = $linhaE['idescala'];
         		$loginT = $linhaE['login'];
			
					if (strcmp($loginT, $value) == 0 && $idT == $idS){
					  echo 'Guarda já cadastro para essa escala. ';
					}
					else{*/
							//$query = "UPDATE candidatos set chefe='$chefe', hora1 = hora1+'$horas1',hora2 = hora2+'$horas2',data='$data',auditado='$auditado' where idescala='$idescala' and login='$value'";
							$query = "insert into listaescala(idescala,login,data,hora1,hora2,chefe,auditado,chave) values('$idescala','$value','$data','$horas1','$horas2','$chefe','$auditado',0)";
							$obj->executaQuery($query);
							
							$queryE = "update escalahoraextra set status='N' where id='$idescala'";
							$obj->executaQuery($queryE);
							// excluir candidatos
							$query = "DELETE FROM candidatos where idescala='$idescala'";
							$obj->executaQuery($query);
							
						$verIncluir = true;

					/*}
		  	}
			else{
				$query = "INSERT INTO nomes(idescala,login,data,horas) VALUES ('$id','$login',CURRENT_DATE(), '0')";
							$obj->executaQuery($query);
						$verIncluir = true;
			}*/
   	  } 
   }

   $obj->closeVar($query);      
   $obj->closeQuery();
   $obj->closeConexaoGeral();
	
	// Redireciona
	if( $verIncluir == false )
	{
		echo 'Não foi possível efetuar o cadastro.';
	}
	else
	{
		header ("Location:../adm/busca_escala_horaextra.php");
	}
}
?>