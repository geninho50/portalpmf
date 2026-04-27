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
	$resultado = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$login = $linha["login"];
	}
	//Pega a data atual
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
	
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

	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<head>
<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->
</head>
</head>

<body>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="100%" colspan="2">
	<fieldset>
	<legend class="cabecalho">CONSULTA OCORRÊNCIA POR SETOR</legend>
		<form name="form1" method="post" action="relatorio_quantitativo_aitgm.php" enctype="multipart/form-data"  onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">
		
		<INPUT TYPE="hidden" name="cadastro" value="true">
		
		<table width="100%" border="0" cellspacing="1" cellpadding="1">
			<tr>
			  <td width="25%" align="right" class="letra">Data Inicial: </td>
			  <td width="13%" class="letra">
			    <input type="text" value="<? echo $dataini;?>" readonly name="xdataini" size="12" class="codigo"/>
			    <a onClick="displayCalendar(document.forms[0].xdataini,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a>
		      </td>
			  <td width="8%" align="right"><span class="letra">Data Final: </span></td>
			  <td width="54%">
			    <input type="text" value="<? echo $datafinal;?>" readonly name="xdatafinal" size="12" class="codigo"/>
			    <a onClick="displayCalendar(document.forms[0].xdatafinal,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a>
		      </td>
		    </tr>
		    <tr>
	          <td align="right" class="letra">&nbsp;</td>
	          <td align="right" class="letra">&nbsp;</td>
	          <td>&nbsp;</td>
	          <td><span class="letra">
	            <input name="Pesquisar" type="submit" class="botao" id="Pesquisar" value="Pesquisar" onclick="onClickButton(null,'Aguarde...','','Pesquisar')" />
              </span></td>
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
		if($datainicial!=''){
			include("relatorio_aitgm.php");
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