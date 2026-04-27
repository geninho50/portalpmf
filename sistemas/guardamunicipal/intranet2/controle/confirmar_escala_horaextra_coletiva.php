<?php
   	ini_set('default_charset','UTF-8');

	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
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
   
	$queryE = "SELECT * FROM escalahoraextra where id=$idescala";
	$resultadoE = $obj->executaQuery($queryE);
	while( $linhaE = mysql_fetch_array($resultadoE) )
	{
		$local = $linhaE["local"];
	}
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
      <?php include("head/incHead.php");?>
<!-- fim inc head -->
</head>

<body>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#666666">
    <th bgcolor="#666666" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!-- inicio do adm -->

<fieldset>
	<legend class="cabecalho">CORFIRMAR ESCALA DE HORA EXTRA - <? echo $local;?></legend>
	
    
    <table width="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="63%" align="left" valign="top">
	
	<fieldset>
   <legend class="negrito"><? echo $local; ?></legend>
   <form name="form1" action="../classes/controleConfirmarEscalaColetiva.php" method="post" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
  <table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8"  >
    <tr>
      <td width="4%" align="center" class="branco"><input name="checktodos" type="checkbox" /></td>
      <td width="32%" align="left" class="branco"><b>Guardas</b></td>
      <td width="20%" align="center" class="branco">Hora 100%</td>
      <td width="18%" align="center" class="branco">Hora 200%</td>
      <td width="16%" align="center" class="branco">Adic. Noturno</td>
      <td width="10%" align="left" class="branco"><b>Escala</b></td>
      </tr>
  </table>
  <?php 
   		$adicional = 0;
		$queryE = "SELECT * FROM listaescala where idescala='".$idescala."'";
		$resultE = $obj->executaQuery($queryE);
		   while($linhaE = mysql_fetch_array($resultE)):
		   
				$id = $linhaE['id'];
				$idescala = $linhaE['idescala'];
				$login =  $linhaE['login'];
				$hora1 = $linhaE['hora1'];
				$hora2 = $linhaE['hora2'];
				$adicional = $linhaE['adicional'];
?>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
   
		<tr bgColor="#FFFFFF" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#FFFFFF'">
			<td width="3%" align="center"><input name="conf[]" type="checkbox" value="<?php echo $login; ?>"/></td>
            <td width="32%" align="center"><input name="login" type="text" value="<?php echo $login; ?>" size="20" readonly="readonly"></td> 
			<td width="21%" align="center"><input name="hora1" type="text" value="<?php echo $hora1; ?>" size="5"></td> 
			<td width="18%" align="center"><input name="hora2" type="text" value="<?php echo $hora2; ?>" size="5"></td> 
			<td width="16%" align="center"><input name="adicional" type="text" value="<?php echo $adicional; ?>" size="5"></td> 
			<td width="10%" align="center"><input name="idescala" type="text" value="<?php echo $idescala; ?>" size="3"  readonly="readonly"></td>
            </tr>
</table>
<?php 
  endwhile
?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>&nbsp;</td>
            <td align="left"><input name="Submit" type="submit" id="Confirmar" class="botao" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Continuar" />   </td>
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