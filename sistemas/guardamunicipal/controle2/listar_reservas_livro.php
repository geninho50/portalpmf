<?php
header('Content-Type: text/html; charset=iso-8859-1');
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
   // Pega o ano da variavel $data_atual
   $ano_atual = substr($data_atual,0,4);
   // Pega o mês da variavel $data_atual
   $mes_atual = substr($data_atual,5,2);
   // Pega o dia da variavel $data_atual
   $dia_atual = substr($data_atual,8,2);
   
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
  <tr>
    <td>
	<!--inicio adm-->
<fieldset>
	<legend class="negrito">Lista de Reservas de Livros </legend>
    <table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
  <tr>
    <td width="14%" align="left" class="branco"><B>Guarda:</B></td>
	<td width="9%" align="center" class="branco"><B>Codigo:</B></td>
    <td width="63%" align="left" class="branco"><B>Titulo:</B></td>
	<td width="12%" align="center" class="branco"><B>Data da Reserva:</B></td>
	<td width="2%" align="center" class="branco">&nbsp;</td>
  </tr>
</table>
<table  width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
<?php 
$chavee = true;
	$queryE = "SELECT id, DAY(datareserva) as dia,MONTH(datareserva) as mes,YEAR(datareserva) as ano,guardareserva,titulo,datareserva,codigolivro FROM reserva where datareserva >= '$data_atual' order by datareserva desc";
	$resultE = $obj->executaQuery($queryE);
	
	while( $linhaE = mysql_fetch_array($resultE) )
	{
		$idreserva = $linhaE['id'];
		$datareserva = $linhaE['datareserva'];
		$codigo = $linhaE['codigolivro'];
		$guarda = $linhaE['guardareserva'];
		$titulo = $linhaE['titulo'];
		$datareserva = $linhaE['datareserva'];
		$dia = $linhaE['dia'];
		$mes = $linhaE['mes'];
		$ano = $linhaE['ano'];

				
?>
  <tr bgColor="<?PHP if($chavee)
						{
							echo '#cccccc';
						}
						else{ 
							echo '#ffffff';
						} 
						$chavee=!$chavee;
					?>">
    <td width="14%" align="left" class="negrito" ><? echo $guarda;?></td>
	<td width="9%" align="center" class="negrito" ><? echo $codigo;?></td>
    <td width="63%" align="left" class="negrito"><? echo $titulo; ?></td>
	 <td width="12%" align="center" class="negrito"><? echo $dia.' / '.$mes.' / '.$ano; ?></td>
	 <td width="2%" align="center" class="negrito"><a href="javascript:POPUP('cadastro_pagamento_livro.php?idReserva=<? echo $idreserva;?>','700','350')"><img src="images/livro1.png" width="16" height="16" border="0" ALT="Pagamento de Livro"></a></td>
  </tr>
    <?php
	}
?>
</table>

</table>

</fieldset>
	<!--fim adm-->
	</td>
  </tr>
</table>

</body>
</html>
