<?php
	include("incValidaSessao.php");
	$id = (int)$_GET['id'];
	if( $id > 0 )
	{
		// Pegou o Id
	}
	else
	{
		$id = $_POST['id'];
	}

	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$data = "";
	$horainicial = "";
	$horafinal = "";
	$local = "";
	$descricao = "";
	$qtdhoras1 = "";
	$qtdhoras2 = "";
	$qtdguardas = "";
	$email = "";
	
	if( $id > 0 )
	{		
		$query = "SELECT semana,DAY(h.data) as dia,MONTH(h.data) as mes,YEAR(h.data) as ano, h.horainicial, h.horafinal, h.qtdhoras1, h.qtdhoras2, h.qtdguardas, h.local, h.missao, h.tempo, h.lanche FROM escalahoraextra h where h.id=$id";
		$resultado = $obj->executaQuery($query);
	
		if( $linha = mysql_fetch_array($resultado) )
		{
			$semana = $linha["semana"];
			$horainicial = $linha["horainicial"];
			$horafinal = $linha["horafinal"];
			$qtdhoras1 = $linha["qtdhoras1"];
			$qtdhoras2 = $linha["qtdhoras2"];
			$qtdguardas = $linha["qtdguardas"];
			$local = $linha["local"];
			$missao = $linha["missao"];
			$dia = $linha['dia'];
			$mes = $linha['mes'];
			$ano = $linha['ano'];
			$tempo = $linha['tempo'];
			$lanche = $linha['lanche'];
		}		
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("incHead.php");?>
<!-- fim inc head -->
</head>

<body>

<fieldset>
	<legend class="letra">Resultado</legend>
	<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
  <tr>
    <td width="351" align="right" bgcolor="#006699" class="branco">Data:</td>
    <td width="881" align="left"  class="negrito"><?php echo $dia." / ".$mes." / ".$ano; ?></td>
  </tr>
  <tr>
    <td width="351" align="right" bgcolor="#006699" class="branco">Semana:</td>
    <td width="881" align="left"  class="negrito"><?php echo $semana; ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#006699" class="branco">Hora:</td>
    <td align="left"  class="negrito"><?php echo $horainicial; ?> ás <?php echo $horafinal; ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#006699" class="branco">Qtd de Horas: </td>
    <td align="left"  class="negrito"><?php echo $qtdhoras1; ?> de 100% e <?php echo $qtdhoras2; ?> de 200%</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#006699" class="branco">Qtd de Guardas: </td>
    <td align="left"  class="negrito"><?php echo $qtdguardas; ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#006699" class="branco">Evento:</td>
    <td align="left" class="negrito"><?php echo $local; ?></td>
  </tr>
  <tr>
    <td align="right" valign="top" bgcolor="#006699" class="branco">Missão:</td>
    <td align="left"  class="negrito"><?php echo $missao; ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#006699" class="branco">Tempo de publica&ccedil;&atilde;o:</td>
    <td align="left" class="negrito"><?php echo $tempo; ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#006699" class="branco">Lanche:</td>
    <td align="left" class="negrito"><?php echo $lanche; ?></td>
  </tr>
</table>

<table width="100%"  border="0">
  <tr>
    <td class="negrito" align="center"><a href='#fechar' onClick='self.close()'>Fechar</a></td>
  </tr>
</table>

</fieldset>

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