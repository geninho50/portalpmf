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
	$data_atual = date("Y-m-d");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<head>
<!-- ini inc head -->
		<?php include("head/incHeadCentral.php");?>
<!-- fim inc head -->
</head>

<body>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="42%" align="left">&nbsp;</td>
    <td width="58%" align="right">&nbsp;</td>
  </tr>
</table>

			<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#006699">
              <tr align="center">
                <td width="75%" align="left" class="branco"><b>VTR</b></td>
                <td width="25%" align="left" class="branco">&nbsp;</td>
              </tr>
            </table>
			<?
					$queryC = "select * from guarnicao where status>0 and data_entrada='2015-03-16' order by vtr asc";
					$resultadoC = $obj->executaQuery($queryC);
					while( $linhaC = mysql_fetch_array($resultadoC) )
					{
							$idGuarnicao = $linhaC["id"];
							$vtr = $linhaC["vtr"];
							$guarda1 = $linhaC["guarda1"];
							$guarda2 = $linhaC["guarda2"];
							$guarda3 = $linhaC["guarda3"];
							$guarda4 = $linhaC["guarda4"];
							$guarda5 = $linhaC["guarda5"];
							$setor = $linhaC["setor"];
							$outros = $linhaC["outros"];
							$hora_entrada = $linhaC["hora_entrada"];
			?>
<table width="100%"  border="0" cellpadding="1" cellspacing="1">
					  <tr bgColor="#FFFFFF" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#FFFFFF'">
						<td width="75%" align="left" class="negrito">
						<? 
								if($guarda1 != '' ){echo '<font color="#FF0000"><I>setor '.$setor.' : </I></font>'.$vtr.' = '.$guarda1;}
								if($guarda2 != '' ){echo ' / '.$guarda2;}
								if($guarda3 != '' ){echo ' / '.$guarda3;}
								if($guarda4 != '' ){echo ' / '.$guarda4;}
								if($guarda5 != '' ){echo ' / '.$guarda5;}
								if($outros != '' ){echo ' - '.$outros;}
						?>
                        </td>
						
                        <form name="form" action="../classes/controleUsuario.php" method="post" enctype="multipart/form-data"  onSubmit="return validaFormAll(this,'OK','OK')">
                        <td width="25%" align="center" class="negrito">
                        <input name="xcodigo" type="text" class="negrito"  id="xcodigo" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" value="<? echo $matricula;?>" size="5"/><input name="Submit" type="submit" class="letra" id="OK" onClick="onClickButton(null,'Aguarde...','','OK')" value="OK" />
                        </form>
                        
                        </td>
					  </tr>
</table>

					<? } ?>
</body>
</html>

