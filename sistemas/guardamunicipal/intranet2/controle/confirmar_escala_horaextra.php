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
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<!-- inicio do adm -->
	<fieldset>
	<legend class="cabecalho">CONFIRMAR ESCOLA DE HORA EXTRA - <? echo $local;?></legend>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="63%" align="left" valign="top">
	
	<fieldset>
   <legend class="negrito"><? echo $local; ?></legend>
  <table width="50%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8"  >
    <tr>
      <td width="38%" align="left" class="branco"><b>Guardas</b></td>
      <td width="16%" align="center" class="branco">Hora 100%</td>
      <td width="16%" align="center" class="branco">Hora 200%</td>
      <td width="22%" align="center" class="branco">Adic. Noturno</td>
      <td width="4%" align="center" class="branco"></td>
      <td width="4%" align="center" class="branco"></td>
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
<table width="50%" border="0" cellpadding="1" cellspacing="1">
   
		<tr bgColor="#FFFFFF" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#FFFFFF'">
			<td width="38%" align="center" class="negrito"><?php echo $login; ?></td> 
			<td width="16%" align="center" class="negrito"><?php echo $hora1; ?></td> 
			<td width="16%" align="center" class="letra"><?php echo $hora2; ?></td> 
			<td width="22%" align="center"><?php echo $adicional; ?></td> 
            <td width="4%" align="center" class="branco"><a href="javascript:POPUP('alterar_horas_cadidatos.php?idescala=<?php echo $idescala; ?>&login=<? echo $login;?>','500','150')"><img src="imagens/atualizar.png" width="21" height="21" border="0" title="ALTERAR HORA"></a>
            </td>
            <td width="4%" align="center" class="branco"><a href="../classes/controleExcluirCandidato.php?id=<?PHP echo $id; ?>&idescala=<?PHP echo $idescala; ?>"><img src="imagens/excluir.png" width="21" height="21" border="0" title="EXCLUIR DA LISTA"></a></td>
        </tr>
</table>
<?php 
  endwhile
?>
    </fieldset>
	
	</td>
    </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
    </table>
</fieldset>
	<!-- fim do adm -->
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><a href="../classes/controleConcluirEscala.php?idescala=<?php echo $idescala; ?>"><img src="imagens/concluir_escala.jpg" border="0"></a></td>
  </tr>
  <tr>
    <td width="8%">&nbsp;</td>
    <td width="92%"><a href="javascript:POPUP('confirmar_escala_horaextra_coletiva.php?idescala=<?php echo $idescala; ?>','600','600')" title="ALTERAR HORA COLETIVA">Confimacao de Hora Coletiva</a></td>
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