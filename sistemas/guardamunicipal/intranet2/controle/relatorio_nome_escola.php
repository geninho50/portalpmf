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
	require ("../classes/trataArquivo.php");
	$objT = new trataArquivo;
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultado = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$login = $linha["login"];
	}
	
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
	
	$xBusca = $_POST['xescola'];
	$datainicial = $_POST['xdataini'];
	$datafinal = $_POST['xdatafinal'];
	
	$arrayI = explode("-", $datainicial);
	$diai = $arrayI[2];
	$mesi = $arrayI[1];
	$anoi = $arrayI[0];
	
	$arrayF = explode("-", $datafinal);
	$diaf = $arrayF[2];
	$mesf = $arrayF[1];
	$anof = $arrayF[0];	

	$xBusca = trim($xBusca);
	$tamanho = strlen($xBusca);
	$nvaloresencontrados = 0;
	
	$queryE = "SELECT * FROM escolas where nome='$xBusca'";
	$resultE = $obj->executaQuery($queryE);
	$linhaE = mysql_fetch_array($resultE);
	if( $linhaE )
	{
		$id = $linhaE["id"];
	}
	
	function calcula_hora($inicio,$fim) {
		if (!is_array($inicio)) { $inicio = explode(":",$inicio); }
		if (!is_array($fim)) { $fim = explode(":",$fim); }
		$time_inicio    = (($inicio[0]*60)*60) + ($inicio[1]*60) + $inicio[2];
		$time_fim        = (($fim[0]*60)*60) + ($fim[1]*60) + $fim[2];
		$t[0] = floor(($time_fim - $time_inicio) / 60);
		$t[1] = floor((($time_fim - $time_inicio) / 60) / 60);
		$t[2] = $time_fim - $time_inicio;
		$h = $t[1];
		$m = $t[0] - ($t[1]*60);
		if ($m < 10) $m = "0$m";
			$s = $t[2] - (($h*60) + $m) * 60;
		if ($s < 10) $s = "0$s";
			$t[3] = "$h:$m:$s";
			// Array[0] = total em minutos ...
			// Array[1] = total em horas ...
			// Array[2] = total em segundos ...
			// Array[3] = retorna total h:m:s ...
			return $t[3];
	}
	
	$query = "select id,escola,guarda,guarda1,guarda2,guarda3,comunicante,vtr,descricao,tipo,hora_cadastro,DAY(data_cadastro) as dia,MONTH(data_cadastro) as mes,YEAR(data_cadastro) as ano from solicitacaoescola where data_cadastro between '$datainicial' and '$datafinal' and escola=$id order by data_cadastro desc";
	
	if( $tamanho > 0 )
	{
		$nvaloresencontrados = $obj->numregistros($query);
	}
	
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->

<body>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th>&nbsp;</th>
  </tr>
  <tr>
    <td colspan="2">
	<fieldset>
	<legend class="cabecalho">CONSULTAR POR ESCOLA</legend>
		<form name="form1" method="post" action="relatorio_nome_escola.php" enctype="multipart/form-data"  onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">
		
		<INPUT TYPE="hidden" name="cadastro" value="true">
		
		<table width="100%" border="0" cellspacing="1" cellpadding="1">
		<tr>
			<td width="13%" align="right" class="letra">Data Inicial: </td>
			<td width="87%" class="letra">
			  <input type="text" value="<? echo $dataini;?>" readonly name="xdataini" size="12"/>
			  <a onClick="displayCalendar(document.forms[0].xdataini,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a>
			  </td>
			</tr>		   
		    <tr>
		      <td align="right" class="letra">Data Final: </td>
		      <td align="left" class="letra"><input type="text" value="<? echo $datafinal;?>" readonly name="xdatafinal" size="12"/>
	          <a onclick="displayCalendar(document.forms[0].xdatafinal,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' alt='Selecione a data' /></a></td>
	        </tr>
		    <tr>
		      <td width="13%" align="right" class="letra">Escola: </td>
		      <td width="87%" align="left" class="letra">
		        <input type="text" name="xescola" id="xescola" size="60"/>
	          </td>
		    </tr>
	      <tr>
			<td align="right" class="letra">&nbsp;</td>
			<td align="left" class="letra"><input name="Pesquisar" type="submit" class="letra" id="Pesquisar" value="Pesquisar" onclick="onClickButton(null,'Aguarde...','','Pesquisar')" /></td>
			</tr>
		</table>
		
		
		
		</form>
	  </fieldset>

	</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<!--inicio adm-->

<?php
		if( $nvaloresencontrados > 0 )
		{
		?>
	  <fieldset>
	    <legend class="cabecalhos">RESCULTADO(s) <B><?echo $nvaloresencontrados;?></B> PARA <?echo $xBusca;?></legend>
		
		<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#006699">
			<tr>
				<td width="9%" align="center" class="branco"><B>Data</B></td>
				<td width="21%" align="left" class="branco"><B>Tipificação</B></td>				
				<td width="70%" align="left" class="branco"><B>Descrição</B> </td>
			</tr> 
		</table>
		
		<table width="100%" border="0" cellspacing="1" cellpadding="1">
		<?php
			$chavet = true;
			$resultado = $obj->executaQuery($query);
			$path = $objT->getPath(10);
			
			while ( $linha = mysql_fetch_array($resultado) )
			{
				// Path onde as Noticias sao cadastradas
				$path = $objT->getPath(10).$linha['id']."/";
				$nomearquivo = $objT->retornaArquivo($path);
				$tamanhonomearquivo = strlen($nomearquivo);
				
				$id = $linha['id'];
				$tipo = $linha['tipo'];
				$descricao = $linha['descricao'];
				$idescola = $linha['escola'];
				
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

				<td width="9%" align="center" class="negrito"><? echo $linha['dia'].' / '.$linha['mes'].' / '.$linha['ano']; ?></td>
				<td width="21%" align="left" class="negrito">
				<A HREF="javascript:POPUP('imprimir_ocorrencia_escola.php?idEscola=<?PHP echo $idescola; ?>','600','600')"><? echo $tipo; ?></A></td>		
				<td width="61%" class="negrito" align="left"><? echo $descricao; ?></td>
                <td width="9%" align="center" class="letra">
					<? if( $tamanhonomearquivo > 0 ){?>
							<A HREF="javascript:POPUP('mostrar_solicitacao.php?idEscola=<?PHP echo $id; ?>','600','600')"><IMG SRC="images/editor_texto.png" title="Existe imagem cadastrada para esse evento" width="20" height="20" BORDER="0"></A>
						<?php }?>
		
				</td>
		  </tr>
		<?php
			}
		?>
		</table>
</fieldset>
		<?php
			}
		
			if( $nvaloresencontrados == 0 && $tamanho > 0 )
			{
				
		?>
		<fieldset>
			<legend class="cabecalho">RESULTADO(s) <B><?echo $nvaloresencontrados;?></B> PARA <?echo $xBusca;?></legend>
		
		<table width="100%" border="0" cellspacing="1" cellpadding="1">
		
			<tr>
				<td width="100%" colspan="3" align="center" class="letra">Nenhuma ocorr&ecirc;ncia para <B><?echo $xBusca;?></B></td>
			</tr>
			
		</table>
		
		
		</fieldset>
		<?php	
			}
		?>


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
	// Fechando as variáveis de conexão
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