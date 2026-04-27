<?php
	ini_set('default_charset','UTF-8');

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
	

		
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<script type="text/javascript" src="scripts/jquery.min.js"></script> 
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
		<?php include("head/incHead.php");?>
<!-- fim inc head -->
</head>

<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">ATIVIDADE DISPONÍVEIS</legend>

    <table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
	<tr>
		<td width="29%" class="branco"><B>Atividade</B></td>
		<td width="39%" align="left" class="branco"><b>Informa&ccedil;&otilde;es Adicionais</b></td>	
		<td width="28%" align="left" class="branco"><B> Disponibilidade</B></td>
        <td width="2%" align="center" class="branco">&nbsp;</td>
		<td width="2%" align="center" class="branco">&nbsp;</td>
	</tr> 
	</table>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
	<?php
		$chavet = true;
		$query = "SELECT  id,data_cadastro, DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano, atividade, complemento,status, data FROM atividadeextra where status='S' order by id desc";
		$resultado = $obj->executaQuery($query);
		while ( $linha = mysql_fetch_array($resultado) )
		{		
		
			$id = $linha['id'];
			$local = $linha['atividade'];
			$tempo = $linha['tempo'];
			$complemento = $linha['complemento'];
			$status = $linha['status'];
			$dia = $linha['dia'];
			$mes = $linha['mes'];
			$ano = $linha['ano'];
	?>
		<tr bgColor="<?PHP if($chavet)
							{
								echo '#cccccc';
							}
							else{ 
								echo '#ffffff';
							} 
							$chavet=!$chavet;
						?>">
					
			<td width="29%" align="left" class="negrito"><? echo $local; ?></td>		
			<td width="39%" align="left" class="negrito"><? echo $complemento; ?></td>
            <td width="28%" align="left" class="negrito"><?php echo $dia." / ".$mes." / ".$ano; ?></td>
			<td width="2%" class="negrito" align="center"><A HREF="../classes/controleAddAtividadeExtra.php?id=<? echo $linha['id']; ?>&login=<? echo $login; ?>&status=add" border="0"><IMG SRC="imagens/true.png" ALT="Clic na imagem para fazer parte da escala" width="19" height="19"BORDER="0"></A></td>
			<td width="2%" class="negrito" align="center"><A HREF="../classes/controleAddAtividadeExtra.php?id=<? echo $linha['id']; ?>&login=<? echo $login; ?>&status=del" border="0"><IMG SRC="imagens/negado.png" ALT="Mais detalhes" width="19" height="19" BORDER="0"></A></td>
		</tr>
	
	<?php
		}
	?>
	</table>
	
	</fieldset>
	
	
	
	<fieldset>
		<legend class="cabecalho">CANDIDATOS QUE ESTÃO CONCORRENDO A ATIVIDADE</legend>
	
		<table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
		<tr>
			<td width="50%" align="left" class="branco"><B>Atividade</B></td>	
			<td width="50%" align="left" class="branco"><B>Candidatos</B></td>
		</tr> 
	</table>
	
	<table width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
	<?php
		$chave = true;
		$queryJ = "SELECT * FROM atividadeextra order by id desc ";
		$resultadoJ = $obj->executaQuery($queryJ);
		while ( $linhaJ = mysql_fetch_array($resultadoJ) )
		{		
			$id = $linhaJ['id'];
			$local = $linhaJ['atividade'];
	?>
		<div class="layer1">
		<tr bgColor="<?PHP if($chave)
							{
								echo '#cccccc';
							}
							else{ 
								echo '#ffffff';
							} 
							$chave=!$chave;
						?>">
			<td width="50%" align="left" class="negrito"><? echo $local; ?></td>
			<td width="50%" class="negrito" align="left"><p class="heading">Mais Detalhes</p>
					<div class="content">			
					<?PHP 
						$query = "SELECT login FROM controleatividadeextra where idatividade=$id order by id desc";
						GeraColunas(3, $query);
					?>  
					</div>
			</td>
		</tr>
	</div>
	<?php
		}
	?>
	</table>
	
	</fieldset>
	
	
	
	</td>
	</tr>
	</table>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
	  <tr>
		<td width="5%" align="right"><span class="negrito"><img src="imagens/true.png" alt="Clic na imagem para fazer parte da escala" width="19" height="19"border="0" /></span></td>
		<td width="95%" class="negrito">Caso queira participar da atividade, clique na imagem. </td>
	  </tr>
	  <tr>
		<td align="right"><span class="negrito"><img src="imagens/negado.png" alt="Clic na imagem para fazer parte da escala" width="19" height="19"border="0" /></span></td>
		<td class="negrito">Caso queira remover seu nome da lista, clique na imagem. </td>
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