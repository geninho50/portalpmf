<?php
	// Este primeiro header, corrigi o problema de acentuação dos caracteres.
	header('Content-Type: text/html; charset=iso-8859-1');
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataArquivo.php");
	require ("../classes/trataString.php");
	$objT = new trataArquivo;
	$objS = new trataString;
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
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
</table>
</fieldset>
<fieldset>
	<legend class="fieldset">Escala de Pontuacao </legend>
<table width="100%"  border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="8%" align="center" bgcolor="#006699" class="branco"><b>JANEIRO</b></td>
    <td width="8%" align="center" bgcolor="#006699" class="branco"><b>FEVEREIRO</b></td>
    <td width="8%" align="center" bgcolor="#006699" class="branco"><b>MAR&Ccedil;O</b></td>
    <td width="8%" align="center" bgcolor="#006699" class="branco"><b>ABRIL</b></td>
    <td width="8%" align="center" bgcolor="#006699" class="branco"><b>MAIO</b></td>
    <td width="8%" align="center" bgcolor="#006699" class="branco"><b>JUNHO</b></td>
    <td width="8%" align="center" bgcolor="#006699" class="branco"><b>JULHO</b></td>
    <td width="8%" align="center" bgcolor="#006699" class="branco"><b>AGOSTO</b></td>
    <td width="8%" align="center" bgcolor="#006699" class="branco"><b>SETEMBRO</b></td>
    <td width="8%" align="center" bgcolor="#006699" class="branco"><b>OUTUBRO</b></td>
    <td width="8%" align="center" bgcolor="#006699" class="branco"><b>NOVEMBRO</b></td>
    <td width="8%" align="center" bgcolor="#006699" class="branco"><b>DEZEMRO</b></td>
  </tr>
  <tr>
    <td align="center" class="negrito">12</td>
    <td align="center" class="negrito">11</td>
    <td align="center" class="negrito">10</td>
    <td align="center" class="negrito">04</td>
    <td align="center" class="negrito">03</td>
    <td align="center" class="negrito">06</td>
    <td align="center" class="negrito">07</td>
    <td align="center" class="negrito">01</td>
    <td align="center" class="negrito">02</td>
    <td align="center" class="negrito">05</td>
    <td align="center" class="negrito">08</td>
    <td align="center" class="negrito">09</td>
  </tr>
</table>
</fieldset>
<BR>
<table width="100%"  border="0" cellspacing="1" cellpadding="1">
  <?
  	$sqlG = "SELECT * FROM grupo";
	$resultG = $obj->executaQuery($sqlG);
	while( $linhaG = mysql_fetch_array($resultG))
	{
		$nome = $linhaG["nome"];
		$id = $linhaG['id'];
  ?>
   
    <tr>
      <td>
	  	<div class="layer1">
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td class="negrito"><p class="heading">&nbsp;&nbsp;&nbsp;&nbsp;<? echo $nome; ?></p>
			<div class="content">
				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				  <tr align="center" bgcolor="#006699">
					<td width="7%" bgcolor="#006699" class="branco">Colocacao</td>
					<td width="17%" bgcolor="#006699" class="branco">Guarda</td>
					<td width="11%" bgcolor="#006699" class="branco">2010</td>
					<td width="12%" bgcolor="#006699" class="branco">2011</td>
					<td width="12%" bgcolor="#006699" class="branco">2012</td>
					<td width="11%" bgcolor="#006699" class="branco">2013</td>
					<td width="11%" bgcolor="#006699" class="branco">Total</td>
					<td width="12%" bgcolor="#006699" class="branco">Antiguidade</td>
				  </tr>
				<?
						$cont=0;
						$queryF = "SELECT id,login,soma,antiguidade FROM usuario where grupo='$id' order by ordenar asc";
						$resultF = $obj->executaQuery($queryF);
						while($dados = mysql_fetch_array($resultF))
						{
							$cont++;
							$idusuario = $dados['id'];
							$login = $dados['login'];
							$soma = $dados['soma'];
							$antiguidade = $dados["antiguidade"];
							$sqlF = "SELECT id,login,grupo,ponto,mes,ano,dia,ponto FROM ferias where login='$login'";
							$resultadoF = $obj->executaQuery($sqlF);
							$linhaF = mysql_fetch_array($resultadoF);
							if( $linhaF )
							{
								$id = $linhaF["id"];
								$login1 = $linhaF["login"];
								$grupo = $linhaF["grupo"];
								$ponto = $linhaF["ponto"];
								$dia = $linhaF["dia"];
								$mes = $linhaF["mes"];
								$ano = $linhaF["ano"];
								
							?>
					  <tr align="center" bgColor="#FFFFFF" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#FFFFFF'">
						<td width="7%" height="18" class="negrito"><? echo $cont;?></td>
						<td width="17%" class="negrito"><? echo $login1; ?></td>
						<td width="11%" class="negrito">
						<?
							$sql2010 = "SELECT ponto FROM ferias where ano=2010 and grupo='$grupo' and login='$login1'";
							$resultado2010 = $obj->executaQuery($sql2010);
							$linha2010 = mysql_fetch_array($resultado2010);
							if( $linha2010 )
							{
								echo $ponto2010 = $linha2010["ponto"]; 
							}
						?>
						</td>
						<td width="12%" class="negrito"><?
							$sql2011 = "SELECT ponto FROM ferias where ano=2011 and grupo='$grupo' and login='$login1'";
							$resultado2011 = $obj->executaQuery($sql2011);
							$linha2011 = mysql_fetch_array($resultado2011);
							if( $linha2011 )
							{
								echo $ponto2011 = $linha2011["ponto"]; 
							}
						?></td>
						<td width="12%" class="negrito"><?
							$sql2012 = "SELECT ponto FROM ferias where ano=2012 and grupo='$grupo' and login='$login1'";
							$resultado2012 = $obj->executaQuery($sql2012);
							$linha2012 = mysql_fetch_array($resultado2012);
							if( $linha2012 )
							{
								echo $ponto2012 = $linha2012["ponto"]; 
							}
						?></td>
						<td width="11%" class="negrito"><?
							$sql2013 = "SELECT ponto FROM ferias where ano=2013 and grupo='$grupo' and login='$login1'";
							$resultado2013 = $obj->executaQuery($sql2013);
							$linha2013 = mysql_fetch_array($resultado2013);
							if( $linha2013 )
							{
								echo $ponto2013 = $linha2013["ponto"]; 
							}
						?></td>
						<td width="11%" class="negrito"><? echo $soma;?></td>
						<td width="12%" class="negrito"><? echo $antiguidade;?></td>
					  </tr>			
							<?
							}
						}
				?>
				</table>
			</div>
			</td>
		  </tr>
		</table>
	</div>
	  </td>
    </tr>
	

	
  <?
  }
  ?>
</table>
<br>
<? $anoTemp=2013; ?>
<fieldset>
	<legend class="fieldset">Cabarito de Ferias <? echo $anoTemp; ?> </legend>
<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#000000">
  <tr>
  	<td width="10%" align="center" bgcolor="#006699" class="branco"><b>SETORES</b></td>
    <td width="10%" align="center" bgcolor="#006699" class="branco"><b>JANEIRO</b></td>
    <td width="10%" align="center" bgcolor="#006699" class="branco"><b>FEVEREIRO</b></td>
    <td width="10%" align="center" bgcolor="#006699" class="branco"><b>MAR&Ccedil;O</b></td>
    <td width="10%" align="center" bgcolor="#006699" class="branco"><b>ABRIL</b></td>
    <td width="10%" align="center" bgcolor="#006699" class="branco"><b>MAIO</b></td>
    <td width="10%" align="center" bgcolor="#006699" class="branco"><b>JUNHO</b></td>
  </tr>
</table>
  <table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
    <?
  	
	$sqlG = "SELECT * FROM grupo";
	$resultG = $obj->executaQuery($sqlG);
	while( $linhaG = mysql_fetch_array($resultG))
	{
		$nome = $linhaG["nome"];
		$id = $linhaG['id'];
  	?>
	  <tr>
        <td width="10%" align="center" bgcolor="#cccccc" class="negrito"><? echo $nome; ?></td>
        <td width="10%" align="center" class="negrito">
		<?
			$sqlJ = "SELECT * FROM ferias where mes=1 and ano=$anoTemp and grupo=$id";
			$resultJ = $obj->executaQuery($sqlJ);
			while( $linhaJ = mysql_fetch_array($resultJ))
			{
				$idM = $linhaJ['id'];
				$loginM = $linhaJ['login'];
				$mesM = $linhaJ['mes'];
				$anoM = $linhaJ['ano'];
				$diaM = $linhaJ['dia'];
		?>
				<? echo '(Dia: '.$diaM.') '.$loginM.'<br>';?>
		<?
			}
		?>
		</td>
        <td width="10%" align="center" class="negrito">
		<?
			$sqlJ = "SELECT * FROM ferias where mes=2 and ano=$anoTemp and grupo=$id";
			$resultJ = $obj->executaQuery($sqlJ);
			while( $linhaJ = mysql_fetch_array($resultJ))
			{
				$idM = $linhaJ['id'];
				$loginM = $linhaJ['login'];
				$mesM = $linhaJ['mes'];
				$anoM = $linhaJ['ano'];
				$diaM = $linhaJ['dia'];
		?>
				<? echo '(Dia: '.$diaM.') '.$loginM.'<br>';?>
		<?
			}
		?>
		</td>
        <td width="10%" align="center" class="negrito">
		
		<?
			$sqlJ = "SELECT * FROM ferias where mes=3 and ano=$anoTemp and grupo=$id";
			$resultJ = $obj->executaQuery($sqlJ);
			while( $linhaJ = mysql_fetch_array($resultJ))
			{
				$idM = $linhaJ['id'];
				$loginM = $linhaJ['login'];
				$mesM = $linhaJ['mes'];
				$anoM = $linhaJ['ano'];
				$diaM = $linhaJ['dia'];
		?>
				<? echo '(Dia: '.$diaM.') '.$loginM.'<br>';?>
		<?
			}
		?>
		</td>
        <td width="10%" align="center" class="negrito">
		<?
			$sqlJ = "SELECT * FROM ferias where mes=4 and ano=$anoTemp and grupo=$id";
			$resultJ = $obj->executaQuery($sqlJ);
			while( $linhaJ = mysql_fetch_array($resultJ))
			{
				$idM = $linhaJ['id'];
				$loginM = $linhaJ['login'];
				$mesM = $linhaJ['mes'];
				$anoM = $linhaJ['ano'];
				$diaM = $linhaJ['dia'];
		?>
				<? echo '(Dia: '.$diaM.') '.$loginM.'<br>';?>
		<?
			}
		?>
		</td>
        <td width="10%" align="center" class="negrito">
		<?
			$sqlJ = "SELECT * FROM ferias where mes=5 and ano=$anoTemp and grupo=$id";
			$resultJ = $obj->executaQuery($sqlJ);
			while( $linhaJ = mysql_fetch_array($resultJ))
			{
				$idM = $linhaJ['id'];
				$loginM = $linhaJ['login'];
				$mesM = $linhaJ['mes'];
				$anoM = $linhaJ['ano'];
				$diaM = $linhaJ['dia'];
		?>
				<? echo '(Dia: '.$diaM.') '.$loginM.'<br>';?>
		<?
			}
		?>
		</td>
        <td width="10%" align="center" class="negrito">
		<?
			$sqlJ = "SELECT * FROM ferias where mes=6 and ano=$anoTemp and grupo=$id";
			$resultJ = $obj->executaQuery($sqlJ);
			while( $linhaJ = mysql_fetch_array($resultJ))
			{
				$idM = $linhaJ['id'];
				$loginM = $linhaJ['login'];
				$mesM = $linhaJ['mes'];
				$anoM = $linhaJ['ano'];
				$diaM = $linhaJ['dia'];
		?>
				<? echo '(Dia: '.$diaM.') '.$loginM.'<br>';?>
		<?
			}
		?>
		</td>
	  </tr>
	  
    <?
 	}
  	?>
</table>	

<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#000000">
  <tr>
  	<td width="10%" align="center" bgcolor="#006699" class="branco"><b>SETORES</b></td>
    <td width="10%" align="center" bgcolor="#006699" class="branco"><b>JULHO</b></td>
    <td width="10%" align="center" bgcolor="#006699" class="branco"><b>AGOSTO</b></td>
    <td width="10%" align="center" bgcolor="#006699" class="branco"><b>SETEMBRO</b></td>
    <td width="10%" align="center" bgcolor="#006699" class="branco"><b>OUTUBRO</b></td>
    <td width="10%" align="center" bgcolor="#006699" class="branco"><b>NOVEMBRO</b></td>
    <td width="10%" align="center" bgcolor="#006699" class="branco"><b>DEZEMRO</b></td>
  </tr>
</table>
  <table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
    <?
  	$sqlG = "SELECT * FROM grupo";
	$resultG = $obj->executaQuery($sqlG);
	while( $linhaG = mysql_fetch_array($resultG))
	{
		$nome = $linhaG["nome"];
		$id = $linhaG['id'];
  	?>
	  <tr>
        <td width="10%" align="center" bgcolor="#cccccc" class="negrito"><? echo $nome; ?></td>
        <td width="10%" align="center" class="negrito">
		<?
			$sqlJ = "SELECT * FROM ferias where mes=7 and ano=$anoTemp and grupo=$id";
			$resultJ = $obj->executaQuery($sqlJ);
			while( $linhaJ = mysql_fetch_array($resultJ))
			{
				$idM = $linhaJ['id'];
				$loginM = $linhaJ['login'];
				$mesM = $linhaJ['mes'];
				$anoM = $linhaJ['ano'];
				$diaM = $linhaJ['dia'];
		?>
				<? echo '(Dia: '.$diaM.') '.$loginM.'<br>';?>
		<?
			}
		?>
		</td>
        <td width="10%" align="center" class="negrito">
		<?
			$sqlJ = "SELECT * FROM ferias where mes=8 and ano=$anoTemp and grupo=$id";
			$resultJ = $obj->executaQuery($sqlJ);
			while( $linhaJ = mysql_fetch_array($resultJ))
			{
				$idM = $linhaJ['id'];
				$loginM = $linhaJ['login'];
				$mesM = $linhaJ['mes'];
				$anoM = $linhaJ['ano'];
				$diaM = $linhaJ['dia'];
		?>
				<? echo '(Dia: '.$diaM.') '.$loginM.'<br>';?>
		<?
			}
		?>
		</td>
        <td width="10%" align="center" class="negrito">
		<?
			$sqlJ = "SELECT * FROM ferias where mes=9 and ano=$anoTemp and grupo=$id";
			$resultJ = $obj->executaQuery($sqlJ);
			while( $linhaJ = mysql_fetch_array($resultJ))
			{
				$idM = $linhaJ['id'];
				$loginM = $linhaJ['login'];
				$mesM = $linhaJ['mes'];
				$anoM = $linhaJ['ano'];
				$diaM = $linhaJ['dia'];
		?>
				<? echo '(Dia: '.$diaM.') '.$loginM.'<br>';?>
		<?
			}
		?>
		</td>
        <td width="10%" align="center" class="negrito">
		<?
			$sqlJ = "SELECT * FROM ferias where mes=10 and ano=$anoTemp and grupo=$id";
			$resultJ = $obj->executaQuery($sqlJ);
			while( $linhaJ = mysql_fetch_array($resultJ))
			{
				$idM = $linhaJ['id'];
				$loginM = $linhaJ['login'];
				$mesM = $linhaJ['mes'];
				$anoM = $linhaJ['ano'];
				$diaM = $linhaJ['dia'];
		?>
				<? echo '(Dia: '.$diaM.') '.$loginM.'<br>';?>
		<?
			}
		?>
		</td>
        <td width="10%" align="center" class="negrito">
		<?
			$sqlJ = "SELECT * FROM ferias where mes=11 and ano=$anoTemp and grupo=$id";
			$resultJ = $obj->executaQuery($sqlJ);
			while( $linhaJ = mysql_fetch_array($resultJ))
			{
				$idM = $linhaJ['id'];
				$loginM = $linhaJ['login'];
				$mesM = $linhaJ['mes'];
				$anoM = $linhaJ['ano'];
				$diaM = $linhaJ['dia'];
		?>
				<? echo '(Dia: '.$diaM.') '.$loginM.'<br>';?>
		<?
			}
		?>
		</td>
        <td width="10%" align="center" class="negrito">
		<?
			$sqlJ = "SELECT * FROM ferias where mes=12 and ano=$anoTemp and grupo=$id";
			$resultJ = $obj->executaQuery($sqlJ);
			while( $linhaJ = mysql_fetch_array($resultJ))
			{
				$idM = $linhaJ['id'];
				$loginM = $linhaJ['login'];
				$mesM = $linhaJ['mes'];
				$anoM = $linhaJ['ano'];
				$diaM = $linhaJ['dia'];
		?>
				<? echo '(Dia: '.$diaM.') '.$loginM.'<br>';?>
		<?
			}
		?>
		</td>
	  </tr>
	  
    <?
 	}
  	?>
</table>	

</fieldset>

</body>
</html>

