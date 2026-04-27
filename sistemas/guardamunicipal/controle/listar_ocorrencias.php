<?php
  // Este primeiro header, corrigi o problema de acentuação dos caracteres.
header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	 include("incValidaSessao.php");
	$idsession = $_SESSION['idSESSION'];
   require ("../classes/DB_mysql.php");
   $obj = new DB_mysql;
   $conexao = $obj->conectarConf();
   
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$result = $obj->executaQuery($sql);
	$linhaS = mysql_fetch_array($result);
	if( $linhaS )
	{
		$login = $linhaS["login"];
	}
   //Pega a data atual
   $data_atual = date("Y-m-d");
   // Pega o ano da variavel $data_atual
   $ano_atual = substr($data_atual,0,4);
   // Pega o m�s da variavel $data_atual
   $mes_atual = substr($data_atual,5,2);
   // Pega o dia da variavel $data_atual
   $dia_atual = substr($data_atual,8,2);
   
   $dia = $dia_atual+5;
   
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<script type="text/javascript" src="js/jquery.min.js"></script> 
		<script type="text/javascript">
		jQuery(document).ready(function() {
		  jQuery(".content").hide();
		  //toggle the componenet with class msg_body
		  jQuery(".heading").click(function()
		  {
			jQuery(this).next(".content").slideToggle(500);
		  });
		});
</script>
<head>
<!-- ini inc head -->
		<?php include("incHead.php");?>
<!-- fim inc head -->
</head>

<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#666666">
    <th scope="col">
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
	<!--inicio adm-->
	
<fieldset>
	<legend class="negrito">Painel de Ocorrencias </legend>
<table bgcolor="#006699"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
  <tr>
    <td width="34%" align="left" class="branco"><B>Assunto:</B></td>
    <td width="66%" align="left" class="branco"><B>Detalhes da Ocorr�ncia</B></td>
  </tr>
</table>
<table  width="100%" bordercolor="0" border="0" cellspacing="1" cellpadding="1">
<?php 
$chavee = true;
	$queryE = "SELECT id, DAY(datacadastro) as dia,MONTH(datacadastro) as mes,YEAR(datacadastro) as ano,assunto,texto FROM ocorrencia where DAY(data) > $dia_atual";
	$resultE = $obj->executaQuery($queryE);
	
	while( $linhaE = mysql_fetch_array($resultE) )
	{
		$id = $linhaE['id'];
		$assunto = $linhaE['assunto'];
		$texto = $linhaE['texto'];
		$dia = $linhaE['dia'];
		$mes = $linhaE['mes'];
		$ano = $linhaE['ano'];
				
?>
  <div class="layer1">
  <tr bgColor="<?PHP if($chavee)
						{
							echo '#cccccc';
						}
						else{ 
							echo '#ffffff';
						} 
						$chavee=!$chavee;
					?>">
    <td width="34%" align="left" class="negrito" ><a href="mostrar_ocorrencias.php?id=<? echo $id; ?>"><font class="negrito"><? echo $assunto;?></font></a></td>
    <td width="66%" align="left" class="negrito"><p class="heading">Mais Detalhes</p>
		<div class="content">
		
			<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
			 <tr>
				<td width="10%" align="right" bgcolor="#006699" class="branco"><b>Assunto:</b></td>
				<td width="90%" align="left"><? echo $assunto; ?></td>
			  </tr>
			  <tr>
				<td align="right" bgcolor="#006699" class="branco"><b>Texto:</b></td>
				<td align="left" valign="top"><? echo $texto; ?></td>
			  </tr>
			  <tr>
				<td align="right" bgcolor="#006699" class="branco"><b>Data:</b></td>
				<td align="left"><? echo $dia.' / '.$mes.' / '.$ano; ?></td>
			  </tr>
			</table>
		
		</div>	
	</td>
  </tr>
  </div>
    <?php
	}
?>
</table>
</fieldset>
<!--fim adm-->
</td>
</tr>
</table>
</body>
</html>
