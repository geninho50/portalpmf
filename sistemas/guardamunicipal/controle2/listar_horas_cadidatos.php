<?php
   
   // Este primeiro header, corrigi o problema de acentuação dos caracteres.
	header('Content-Type: text/html; charset=iso-8859-1');
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
   include("incValidaSessao.php");
   $idsession = $_SESSION['idSESSION'];

   $idescala = (int)$_GET['idescala'];

   
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
    <td>
	<!-- inicio do adm -->
	<fieldset>
	<legend class="negrito">Desmonstrativo das horas realisadas</legend>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
	  <tr>
		<td width="45%" align="left" valign="top">
			
			<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8"  >
              <tr>
                <td width="51%" align="left" class="branco"><b>Guardas</b></td>
                <td width="25%" align="center" class="branco"><b>HORA 100%</b></td>
                <td width="24%" align="center" class="branco"><b>HORA 200%</b></td>
                </tr>
            </table>
			<?
						$query = "SELECT * from listaescala where idescala=$idescala order by login asc";
						$result = $obj->executaQuery($query);
						while($linha = mysql_fetch_array($result)){
							$hora1 = $linha['hora1'];
							$hora2 = $linha['hora2'];
							$login = $linha['login'];
			?>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
								<tr bgColor="#FFFFFF" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#FFFFFF'">
				 				 <td width="51%"><input name="login" type="text" value="<?php echo $login; ?>" readonly="readonly"/td>
								 <td width="25%" align="center"><input name="hora1" type="text" value="<?php echo $hora1; ?>" size="1" readonly="readonly"/></td>
								 <td width="24%" align="center"><input name="hora2" type="text" value="<?php echo $hora2; ?>" size="1"readonly="readonly" /></td>
							    </tr>
			  </table>
			<?
						}
			?>
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