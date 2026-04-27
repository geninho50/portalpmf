<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" charset="UTF-8">
function show_confirm()
{
var r=confirm("Deseja realmente excluir?");
if (r==true)
  {
  return true;
  }
else
  {
  return false;
  }
}
</script>
</head>
<body>
<link rel="stylesheet" type="text/css" href="estilos.css">
<?php
	include "conecta.php";
	require("valida_qq_sessao.php");
	$op=$_GET["op"];
	$filtro=$_POST["filtro"];
	session_start();
	if ($op == 'a')
	{
		$_SESSION['filtro']='';
	}
	if ($op == 'v')
	{
		$sqlwhere=$_SESSION['sqlwhere'];
	}
//	echo "op";
//	echo $op;
//	echo "<br>";
//	echo "filtro";
//	echo $filtro;
//	echo "<br>";
//	echo $sqlwhere;
//	echo "<br>";
//	echo "ss op";
//	echo $_SESSION['op'];
//	echo "<br>";
//	echo "ss filtro";
//	echo $_SESSION['filtro'];

	if ($filtro == 'f')
	{
		$filtronumero=$_POST["numero"];
		$filtroplaca=$_POST["placa"];
		$filtroservico=$_POST["servico"];
		$filtronumordem=$_POST["numordem"];
		$filtropermissionario = str_replace("'","`",$_POST["permissionario"]);
		//$filtropermissionario=$_POST["permissionario"];
		$filtrofiscal=$_POST["fiscal"];
		$filtroterminal=$_POST["terminal"];
		$filtrostatus=$_POST["status"];
		$sqlwhere="";
		if ($filtronumero != '')
		{
			$sqlwhere=$sqlwhere." numero=".$filtronumero;
		}
		if ($filtroplaca != '')
		{
			if ($sqlwhere != "")
			{
				$sqlwhere=$sqlwhere.', ';
			}
			$sqlwhere=$sqlwhere." placa='".$filtroplaca."'";
		}
		if ($filtroservico != '')
		{
			if ($sqlwhere != "")
			{
				$sqlwhere=$sqlwhere.', ';
			}
			$sqlwhere=$sqlwhere." servico='".$filtroservico."'";
		}
		if ($filtronumordem != '')
		{
			if ($sqlwhere != "")
			{
				$sqlwhere=$sqlwhere.', ';
			}
			$sqlwhere=$sqlwhere." numordem='".$filtronumordem."'";
		}
		if ($filtropermissionario != '')
		{
			if ($sqlwhere != "")
			{
				$sqlwhere=$sqlwhere.', ';
			}
			$sqlwhere=$sqlwhere." permissionario='".$filtropermissionario."'";
		}
		if ($filtrofiscal != '')
		{
			if ($sqlwhere != "")
			{
				$sqlwhere=$sqlwhere.', ';
			}
			$sqlwhere=$sqlwhere." fiscal='".$filtrofiscal."'";
		}
		if ($filtroterminal != '')
		{
			if ($sqlwhere != "")
			{
				$sqlwhere=$sqlwhere.', ';
			}
			$sqlwhere=$sqlwhere." terminal='".$filtroterminal."'";
		}
		if ($filtrostatus != '')
		{
			if ($sqlwhere != "")
			{
				$sqlwhere=$sqlwhere.', ';
			}
			$sqlwhere=$sqlwhere." status='".$filtrostatus."'";
		}
		if ($sqlwhere == '')
		{
			$filtro='';
			$sqlwhere = "status='Aguardando'";
		}
		$_SESSION['sqlwhere']=$sqlwhere;
		$_SESSION['filtro']='f';
		
	}
	echo "<table width='400' align='center' border=0>";
	echo "<tr>";
	echo "<td align='center'><a class='sma' href='comunicainsform.php'>Nova Comunica&ccedil&atildeo</a></td>";
	echo "<td align='center'><a class='sma' href='comunicafiltro.php'>Filtrar Comunica&ccedil&otildees</a></td>";
	if ($op != 't')
	{
		echo "<td align='center'><a class='sma' href='comunicalista.php?op=t'>Listar Todas</a></td>";
	}
	if ($_SESSION['filtro'] == 'f' && $op == 't')
	{
		echo "<td><align='center'><a class='sma' href='comunicalista.php?op=v'>Voltar </a></td>";
	}
	elseif($op == 'v')
	{
		echo "<td><align='center'><a class='sma' href='comunicafiltro.php?'>Voltar </a></td>";
	}
	else
	{
		echo "<td><align='center'><a class='sma' href='javascript:window.history.go(-1)'>Voltar </a></td>";
	}
	echo "<td align='center'><font face='verdana' size='1'><a href='comunicalistaimp.php' target='_blank'>Imprimir </a></td>";
	echo "<td><align='center'><a class='sma' href='logout.php'>Sair</a></td>";
	echo "</tr>";
	if ($filtro == 'f' || $op  == 'v')
	{
		$sql = "SELECT * FROM comunica WHERE $sqlwhere ORDER BY id DESC";
		$_SESSION['sqlwhereimp']=$sqlwhere;
		if ($op == 'v')
		{
			$filtro='f';
		}
	}
	elseif ($op == 't')
	{
		$sql = "SELECT * FROM comunica ORDER BY id DESC";
		$_SESSION['sqlwhereimp']='1=1';
	} 
	else
	{

		$sql = "SELECT * FROM comunica WHERE status='Aguardando' ORDER BY id DESC";
		$_SESSION['sqlwhereimp']="status='Aguardando'";
	}
	$resultado=pg_query($sql);
	if($resultado != FALSE)
	{
		$linhas=pg_num_rows($resultado);	
		echo "<table width='400' align='center' border=4 bordercolor='#9ACD32'>";
		$corfundo="#FFFFFF";
		if($corfundo == "#EAE9DB")
		{
			$corfundo="#FFFFFF";
		}
		else
		{
			$corfundo="#EAE9DB";
		}
		echo "<tr bgcolor=$corfundo>";
		echo "<td align='center'><font face='verdana' size='1'><b>".utf8_encode('Nº'). "</b></font></td>";
		echo "<td align='center'><font face='verdana' size='1'><b>Data e Hora </b></font></td>";
		echo "<td align='center'><font face='verdana' size='1'><b>".utf8_encode('Serviço'). "</b></font></td>";
		echo "<td align='center'><font face='verdana' size='1'><b>Placa </b></font></td>";
		echo "<td align='center'><font face='verdana' size='1'><b>".utf8_encode('Nº Ordem'). "</b></font></td>";
		echo "<td align='center'><font face='verdana' size='1'><b>".utf8_encode('Permissionário'). "</b></font></td>";
		echo "<td align='center'><font face='verdana' size='1'><b>Fiscal </b></font></td>";
		echo "<td width='400' align='center'><font face='verdana' size='1'><b>".utf8_encode('*****Comunicação*****'). "</b></font></td>";
		echo "<td align='center'><font face='verdana' size='1'><b>Prazo</b></font></td>";
		echo "<td align='center'><font face='verdana' size='1'><b>Terminal</b></font></td>";
		echo "<td align='center'><font face='verdana' size='1'><b>".utf8_encode('Situação'). "</b></font></td>";
		echo "</tr>";
		for ($i=0; $i<$linhas; $i++)
		{
			$id=pg_result($resultado,$i,"id");
			$numero=pg_result($resultado,$i,"numero");
			$data=pg_result($resultado,$i,"datacom");
			$hora=pg_result($resultado,$i,"hora");
			$hora=substr($hora,0,8);
			$dia=substr($data,8,2);
			$mes=substr($data,5,2);
			$ano=substr($data,0,4);
			$dataformatada=$dia.'/'.$mes.'/'.$ano.' '.$hora;
			$servico=pg_result($resultado,$i,"servico");
			$placa=pg_result($resultado,$i,"placa");
			$numordem=pg_result($resultado,$i,"numordem");
			$permissionario=pg_result($resultado,$i,"permissionario");
			$fiscal=pg_result($resultado,$i,"fiscal");
			$comunicado=pg_result($resultado,$i,"comunicado");
			$prazo=pg_result($resultado,$i,"prazo");
			$terminal=pg_result($resultado,$i,"terminal");
			$status=pg_result($resultado,$i,"status");
			$encerrada_por=pg_result($resultado,$i,"encerrada_por");
			$nomeusuario='Teste nome do usuario';
			if($corfundo == "#EAE9DB")
			{
				$corfundo="#FFFFFF";
			}
			else
			{
				$corfundo="#EAE9DB";
			}
			echo "<tr bgcolor=$corfundo>";
			echo "<td align='center'><font face='verdana' size='1'>$numero</td>";
			echo "<td align='center'><font face='verdana' size='1'>$dataformatada</td>";
			echo "<td align='center'><font face='verdana' size='1'>$servico </td>";
			echo "<td align='center'><font face='verdana' size='1'>$placa </td>";
			echo "<td align='center'><font face='verdana' size='1'>$numordem </td>";
			echo "<td align='center'><a class='sma'>$permissionario </td>";
			echo "<td align='center'><a class='sma'>$fiscal </td>";
			echo "<td align='center'><a class='sma'>$comunicado </a></td>";
			echo "<td align='center'><font face='verdana' size='1'>$prazo </td>";
			echo "<td align='center'><font face='verdana' size='1'>$terminal </td>";
			if ($status == 'Encerrada')
			{
				echo "<td align='center'><font face='verdana' size='1'>$status $encerrada_por </span></td>";
			}
			else
			{
				echo "<td align='center'><font face='verdana' size='1'>$status </td>";
			}
			echo "<td align='center'><font face='verdana' size='1'><a href='comunicaedita.php?id=".$id."'>Alterar </a></td>";
//			echo "<td align='center'><font face='verdana' size='1'><a href='comunicaexclui.php?id=".$id."' onclick='return show_confirm()' value='Show a confirm box'>Excluir </a></td>";			
//			echo "<td align='center'><font face='verdana' size='1'><a href='javascript:window.history.go(-1)'>Voltar </a></td>";
//			echo "<td align='center'><font face='verdana' size='1'><font face='verdana'><a href='seleciona.php'>Nova Pesquisa </a></font></td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	echo "<table width='400' align='center' border=0";
	echo "<tr>";
	echo "<td align='center'><a class='sma' href='comunicainsform.php'>Nova Comunica&ccedil&atildeo</a></td>";
	echo "<td align='center'><a class='sma' href='comunicafiltro.php'>Filtrar Comunica&ccedil&otildees</a></td>";
	if ($op != 't')
	{
		echo "<td align='center'><a class='sma' href='comunicalista.php?op=t'>Listar Todas</a></td>";
	}
	if ($_SESSION['filtro'] == 'f' && $op == 't')
	{
		echo "<td><align='center'><a class='sma' href='comunicalista.php?op=v'>Voltar </a></td>";
	}
	elseif($op == 'v')
	{
		echo "<td><align='center'><a class='sma' href='comunicafiltro.php?'>Voltar </a></td>";
	}
	else
	{
		echo "<td><align='center'><a class='sma' href='javascript:window.history.go(-1)'>Voltar </a></td>";
	}
	echo "<td align='center'><font face='verdana' size='1'><a href='comunicalistaimp.php' target='_blank'>Imprimir </a></td>";
?>
<td><align="center"><a class='sma' href="logout.php">Sair</a></td>
</tr>
</body>
</html>