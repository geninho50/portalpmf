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
	<legend class="negrito">Resultado M&eacute;dia</legend>

    <table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
	<tr>
		<td width="53%" align="left" class="branco"><B>Nome</B></td>				
	</tr> 
</table>

<?php
		$consulta="select login from guarda_gmf where cargo='Guarda Municipal' ORDER BY login ASC";
		$retorn = $obj->executaQuery($consulta);
		$total = mysql_num_rows($retorn);
		while ( $lista = mysql_fetch_array($retorn) )
		{	
			$login = $lista['login'];
			
			$sql = "SELECT login, MONTH(data) as mes,sum(hora1) as horat1, sum(hora2) as horat2 FROM listaescala WHERE login='$login' and data BETWEEN '".$ano_atual."-01-01' AND '".$ano_atual."-".$mes_atual."-".$dia_atual."' GROUP BY login ";
			$result = $obj->executaQuery($sql);
				 echo "<table width=100% border=0 cellpadding=0 cellspacing=0 align=left>";
					$coluna = 3;
					if ($total>0) { 
						for($i=0;$i<=$total;$i++) { 
							if (($i%$coluna)==0) { 
								echo "</tr>"; //oque � isto? 
							} 
							echo '<td valign=top align=left>
									<table border=0 cellspacing=0 cellpadding=0 align=left>
										<tr>';
											if ( $dados = mysql_fetch_array($result) )
											{		
												  $login = $dados['login'];
												  $hora1 = $dados['horat1'];
												  $mestemp = $dados['mes'];
												  //$mediaH1 = $hora1/$parametro;
												  //$media1 = number_format( $mediaH1, 2, ",", "." );
												  $hora2 = $dados['horat2'];
												 // $mediaH2 = $hora2/$parametro;
												  //$media2 = number_format( $mediaH2, 2, ",", "." );
												  if($mestemp==9){
													$logintemp = $dados['login'];
												  }
												echo '<td bgcolor=';if($logintemp==$login){ echo'#cccccc';}else{ echo'#ffffff';} echo ' class=nome  width="150">'.$login.'</td> 
													  <td bgcolor=';if($logintemp==$login){ echo'#cccccc';}else{ echo'#ffffff';} echo ' align=center class=nome>('.$hora1.') ('.$hora2.')</td>';
											}
									echo'
											
										</tr>
									</table>
								</td> ';
						}
					} else {
					echo "Nenhum registro encontrado";
					}
					echo'</table>';
		}	
?>
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