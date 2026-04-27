<?php
    include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
   
   $idescala =  (int)$_POST['idescala'];
   
   if( $idescala == 0 )
   {
      $idescala = (int)$_GET['idescala'];
   }
   
   
   require ("../classes/DB_mysql.php");
   $obj = new DB_mysql;
   $conexao = $obj->conectarConf();
   
   //Pega a data atual
   $data_atual = date("Y-m-d");
   // Pega o ano da variavel $data_atual
   $ano_atual = substr($data_atual,0,4);
   // Pega o m�s da variavel $data_atual
   $mes_atual = substr($data_atual,5,2);
   // Pega o dia da variavel $data_atual
   $dia_atual = substr($data_atual,8,2);
    
	$query = "SELECT * FROM parametro";
	$resultado = $obj->executaQuery($query);
	while ( $linha = mysql_fetch_array($resultado) )
	{	
		$parametro = $linha['parametro'];
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
      <?php include("incHead.php");?>
<!-- fim inc head -->
</head>

<body>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#666666">
    <th bgcolor="#666666" scope="col">
	<?php 
		$sql = "SELECT * FROM guarda_gmf where id=$idsession";
		$resultado = $obj->executaQuery($sql);
		$linha = mysql_fetch_array($resultado);
		if( $linha )
		{
			$login = $linha["login"];
			
			include("menu.php");
		}
	?>
	</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	<table width="50%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="19%" valign="top">
	
	<fieldset>
	<legend class="letra">Resultado M&eacute;dia</legend>

    <table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
	<tr>
		<td width="53%" align="left" class="branco"><B>Nome</B></td>				
		<td width="23%" align="center" class="branco"><B> Hora</B></td>	
		<td width="24%" align="center" class="branco"><B> 100%</B></td>	
	</tr> 
</table>

<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
<?php
		/*$sqlU = "SELECT login FROM guarda_gmf ORDER BY login ASC";
		$resultU = $obj->executaQuery($sqlU);
		while ( $linhaU = mysql_fetch_array($resultU) )
		{	
			$login1 = $linhaU['login'];*/
		
			$sqlhora1 = "SELECT login, (select sum(hora1) FROM listaescala WHERE data BETWEEN '".$ano_atual."-01-01' AND '".$ano_atual."-".$parametro."-".$dia_atual."' and login=g.login) as horat1 from guarda_gmf g ORDER BY horat1 ASC";
			$resultadohora1 = $obj->executaQuery($sqlhora1);
			while ( $linhaH1 = mysql_fetch_array($resultadohora1) )
			{	
				  $login1 = $linhaH1['login'];
				  $hora1 = $linhaH1['horat1'];
				  $mediaH1 = $hora1/$parametro;
				  $media1 = number_format( $mediaH1, 2, ",", "." );
?>
			<tr bgColor="#FFFFFF" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#FFFFFF'">
				<td width="53%" align="left" class="letra"><? echo $login1; ?></td>		
			<td width="23%" class="letra" align="center"><? if($hora1==0){echo"0";}else{echo $hora1;} ?></td>
			<td width="24%" class="letra" align="center"><? echo $media1; ?></td>
			</tr>
<?php
			//}	
			}
?>
</table>
</fieldset>	

</td>
    <td width="19%" valign="top">
	
	<fieldset>
	<legend class="letra">Resultado M&eacute;dia</legend>

<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
	<tr>
		<td width="53%" align="left" class="branco"><B>Nome</B></td>				
		<td width="23%" align="center" class="branco"><B> Hora</B></td>	
		<td width="24%" align="center" class="branco"><B> 200%</B></td>	
	</tr> 
</table>

<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
<?php
		$sqlhora2 = "SELECT login, (select sum(hora2) FROM listaescala WHERE data BETWEEN '".$ano_atual."-01-01' AND '".$ano_atual."-".$parametro."-".$dia_atual."' and login=g.login) as horat2 from guarda_gmf g ORDER BY horat2 ASC";
		$resultadohora2 = $obj->executaQuery($sqlhora2);
		while ( $linhaH2 = mysql_fetch_array($resultadohora2) )
		{	
			  $login2 = $linhaH2['login'];
			  $hora2 = $linhaH2['horat2'];
			  $mediaH2 = $hora2/$parametro;
			  $media2 = number_format( $mediaH2, 2, ",", "." );
?>
	<tr bgColor="#FFFFFF" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#FFFFFF'">
		<td width="53%" align="left" class="letra"><? echo $login2; ?></td>		
	    <td width="23%" class="letra" align="center"><? if($hora2==0){echo"0";}else{echo $hora2;} ?></td>
		<td width="24%" class="letra" align="center"><? echo $media2; ?></td>
    </tr>
<?php
		}	
?>
</table>
</fieldset>
	</td>
  </tr>
</table>
	<!--fim adm-->
	</td>
  </tr>
</table>


</body>
</html>

<?php
   // Fechando as vari�veis de conex�o
   $obj->closeVar($conexao);
   $obj->closeVar($xBusca);
   $obj->closeVar($tamanho);
   $obj->closeVar($nvaloresencontrados);
   $obj->closeVar($query);
   $obj->closeVar($resultado);
   $obj->closeVar($linha);
   $obj->closeQuery();
   $obj->closeConexaoGeral();
?>