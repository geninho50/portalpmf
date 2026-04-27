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
	
	$query = "select id,numpagamento,matricularetirada,matriculagm4retirada,qtdretirado,horaretirada, DAY(dataretirada) as dia,MONTH(dataretirada) as mes,YEAR(dataretirada) as ano from pagamentodiario where status = 1 group by numpagamento order by matricularetirada desc";
	$nvaloresencontrados = $obj->numregistros($query);
	
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<META HTTP-EQUIV="REFRESH" CONTENT="10"; URL="devolucao_material_diario.php">
<head>
<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->

<body>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="58%" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
<?
if($nvaloresencontrados > 0){
?>
<fieldset>
	<legend class="negrito">Retornou <B><? echo $nvaloresencontrados;?></B> devolucao de material diario</legend>

    <table  width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#006699">
	<tr>
		<td width="24%" align="center" class="branco">&nbsp;</td>
		<td width="44%" align="left" class="branco"><B>Nome</B></td>
		<td width="32%" align="center" class="branco"><strong>Data / Hora</strong></td>
		</tr> 
</table>

<table width="100%" border="0" cellspacing="1" cellpadding="1">
<?php
	$chavet = true;
	$resultado = $obj->executaQuery($query);
	while ( $dados = mysql_fetch_array($resultado) )
	{		
			$id = $dados['id'];
			$matricularetirada = $dados['matricularetirada'];
			$matriculagm4retirada = $dados['matriculagm4retirada'];
			$qtdretirado = $dados['qtdretirado'];
			$horaretirada = $dados['horaretirada'];
			$numpagamento = $dados['numpagamento'];
			$dia = $dados['dia'];
			$mes = $dados['mes'];
			$ano = $dados['ano'];
			
			$queryL = "select * from guarda_gmf where matricula = $matricularetirada";
			$resultadoL = $obj->executaQuery($queryL);
			while ( $dadosL = mysql_fetch_array($resultadoL) )
			{		
					$login = $dadosL['login'];
			
			
?>
	<tr bgColor="<?PHP if($chavet)
						{
							echo '#cccccc';
						}
						else{ 
							echo '#ffffff';
						} 
						$chavet=!$chavet;
					?>" >
		<td width="24%" align="center" class="negrito"><a href="javascript:POPUP('listar_devolucao_material_diario.php?numpagamento=<? echo $numpagamento;?>','700','500')"><img src="imagens/receber.png" width="21" height="21" border="0" /></a></td>
		<td width="44%" align="left" class="negrito"><? echo $matricularetirada.' - '.$login; ?></td>
		<td width="32%" align="center" class="negrito"><? echo $dia.'-'.$mes.'-'.$ano.' / '.$horaretirada;?></td>
		</tr>

<?php
			}
	}
?>
	
</table>
</fieldset>
<?
}
if( $nvaloresencontrados == 0 ){
?>
<fieldset>
	<legend class="cabecalho">RESULTADO(s) <B><?echo $nvaloresencontrados;?></B> PARA DEVOLUÇÃO DE MATERIAL</legend>
    <table width="100%" border="0" cellspacing="1" cellpadding="1">
	<tr>
		<td width="100%" height="21" colspan="3" align="center" class="cabecalho"><b>NENHUM MATERIAL NA LISTA PARA SER DEVOLVIDO</B></td>
	</tr>	
</table>
</fieldset>
<?
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