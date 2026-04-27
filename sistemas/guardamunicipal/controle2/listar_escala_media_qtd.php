<?php
   
   // Este primeiro header, corrigi o problema de acentuação dos caracteres.
	header('Content-Type: text/html; charset=iso-8859-1');
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
   include("incValidaSessao.php");
   $idsession = $_SESSION['idSESSION'];

   $chave = (int)$_GET['chave'];

   
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
  <tr>
    <th bgcolor="#666666">
	<!-- ini menu -->
		<?php 
		$sql = "SELECT * FROM guarda_gmf where id=$idsession";
		$result = $obj->executaQuery($sql);
		$linha = mysql_fetch_array($result);
		if( $linha )
		{
			$login = $linha["login"];
			
			include("menu.php");
		}
		?>
    <!-- fim menu -->
	</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!-- inicio do adm -->
	<fieldset>
	<legend class="negrito">Desmonstrativo das medias de hora extra</legend>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
	  <tr>
		<td width="45%" align="left" valign="top">
			
		<fieldset>
		<legend class="negrito">Lista da Media Geral e Quantidade de Hora</legend>
			<form name="form1" action="../classes/controleMontarEscala.php" method="post" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
			<br>
			<br>
		
			<table width="52%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8"  >
              <tr>
                <td width="27%" align="left" class="branco"><b>Guardas</b></td>
                <td width="22%" align="center" class="branco"><b>QTD ESCALA 100%</b></td>
                <td width="21%" align="center" class="branco"><b>QTD ESCALA 200%</b></td>
                <td width="15%" align="center" class="branco"><a href="listar_escala_media_qtd.php?chave=1"><b>SOMA 100%</b></a></td>
                <td width="15%" align="center" class="branco"><a href="listar_escala_media_qtd.php?chave=2"><b>SOMA 200%</b></a></td>
                </tr>
            </table>
			<?
					if($chave==1){
							$query = "SELECT sum(listaescala.hora1) as horat1,sum(listaescala.hora2) as horat2,guarda_gmf.login from listaescala inner join guarda_gmf where listaescala.login=guarda_gmf.login and data BETWEEN '".$ano_atual."-01-01' AND '".$ano_atual."-".$mes_atual."-31' group by login order by horat1 asc";
						}else{
							if($chave==2){
								$query = "SELECT sum(listaescala.hora1) as horat1,sum(listaescala.hora2) as horat2,guarda_gmf.login from listaescala inner join guarda_gmf where listaescala.login=guarda_gmf.login and data BETWEEN '".$ano_atual."-01-01' AND '".$ano_atual."-".$mes_atual."-31' group by login order by horat2 asc";
							}else{
								$query = "SELECT sum(listaescala.hora1) as horat1,sum(listaescala.hora2) as horat2,guarda_gmf.login from listaescala inner join guarda_gmf where listaescala.login=guarda_gmf.login and data BETWEEN '".$ano_atual."-01-01' AND '".$ano_atual."-".$mes_atual."-31' group by login";
							}
						}
						$result = $obj->executaQuery($query);
						while($linha = mysql_fetch_array($result)){
							$hora1 = $linha['horat1'];
							//$mediaH1 = $hora1/$parametro;
							//$media1 = number_format( $mediaH1, 2, ",", "." );
							
							$hora2 = $linha['horat2'];
							//$mediaH2 = $hora2/$parametro;
							//$media2 = number_format( $mediaH2, 2, ",", "." );
							
							$loginTemp = $linha['login'];
							
							$query2 = "SELECT (select count(id) from listaescala where login='$loginTemp' and MONTH(data)=$mes_atual AND YEAR(data)=$ano_atual and idescala>0 and he=1) as total1, (select count(id) from listaescala where login='$loginTemp' and MONTH(data)=$mes_atual AND YEAR(data)=$ano_atual and idescala>0 and he=2) as total2";
							$result2 = $obj->executaQuery($query2);
							while($linha2 = mysql_fetch_array($result2)){
								$total1 = $linha2['total1'];
								$total2 = $linha2['total2'];
			?>
<table width="52%" border="0" cellpadding="1" cellspacing="1">
								<tr bgColor="#FFFFFF" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#FFFFFF'">
				 				 <td width="27%"><input name="login" type="text" value="<?php echo $loginTemp; ?>" readonly="readonly"/td>
								 <td width="22%" align="center"><input name="hora1" type="text" value="<?php echo $total1; ?>" size="1" readonly="readonly"/></td>
								 <td width="21%" align="center"><input name="hora2" type="text" value="<?php echo $total2; ?>" size="1"readonly="readonly" /></td>
								 <td width="15%" align="center"><input name="media1" type="text" value="<?php echo $hora1; ?>" size="1" readonly="readonly"/></td>
								 <td width="15%" align="center"><input name="media2" type="text" value="<?php echo $hora2; ?>" size="1"readonly="readonly" /></td>
							    </tr>
			  </table>
			<?
							}
						}
			?>
			<table width="100%"  border="0">
			<tr>   
				<td><input name="Submit" type="submit" id="Confirmar" class="botao" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Continuar" />   </td>
			  </tr>
			  <tr>
				<td class="letra" align="center"><a href="javascript:history.back(1);">Voltar</a></td>
			  </tr>
			</table>
			</form>
			</fieldset>
			</td>
			</tr>
	</table>
	</fieldset>
	<!-- fim do adm -->
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