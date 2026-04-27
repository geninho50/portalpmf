<?php
ini_set('default_charset','UTF-8');
	
	// Este primeiro header, corrigi o problema de acentuação dos caracteres.
	ini_set('default_charset','UTF-8');
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
   
   $sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultado = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$login = $linha["login"];
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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<META HTTP-EQUIV="REFRESH" CONTENT="5"; URL="administrar_ocorrencia.php">
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #003366;
	font-size: 24px;
}
.style2 {color: #FFFFFF}
-->
</style>
<head>
<!-- ini inc head -->
		<?php include("head/incHeadCentral.php");?>
<!-- fim inc head -->
</head>
<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100%" colspan="2">
	<!--inicio adm-->
	
<table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="85%" align="center" valign="top">
	<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top">
          
		  <table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" style="border-collapse: collapse">
		  <tr>
			<th width="42%" align="left" valign="top" scope="col">
				<table width="100%" height="710"  >
					  <tr>
						<th align="center" valign="top" scope="col">
							<iframe height=250 width=100% src="controle_ocorrencias_aberto.php" scrolling="auto"></iframe><br>
							<iframe height=400 width=100% src="controle_ocorrencias_andamento.php" scrolling="auto"></iframe>
						</th>
					  </tr>
					  <tr>
						<td height="50" align="left" valign="top">
						<? include("controle_ocorrencias_blitz.php"); ?>
						</td>
					  </tr>
					</table>
			</th>
			<th width="58%" align="left" scope="col" valign="top" >
			
					<table width="100%" height="710"  >
					  <tr>
						<th align="center" valign="top" scope="col">
							<iframe height=580 width=100% src="controle_guarnicao_disponivel.php" scrolling="auto"></iframe>
						</th>
					  </tr>
					  <tr>
						<td height="120" align="center" valign="top">
						<? include("controle_guarnicao_indisponivel.php"); ?>
						</td>
					  </tr>
					</table>
				
			</th>
		  </tr>
		</table>
		<table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#cccccc" style="border-collapse: collapse">
		<tr>
		  <td width="58%"  class="fieldset" align="left">
			ESCOLAS EM ATENDIMENTO
		</td>
		</tr>
		<tr>
		  <td width="58%">
			<? include("controle_guarnicao_escola.php"); ?>
		  </td>
		</tr>
	  </table>		  </td>
      </tr>
    </table></td>
  </tr>
</table>


	<!--fim adm-->
	</td>
  </tr>
</table>

</body>
</html>
