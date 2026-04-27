<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
   
   include("incValidaSessao.php");
   $idsession = $_SESSION['idSESSION'];

  $dataTemp = $_GET['data'];
   
   require ("../classes/DB_mysql.php");
   require ("../classes/trataData.php");
   $objD = new trataData;
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
   // Pega o ano da variavel $data_atual
   $ano_atual = substr($data_atual,0,4);
   // Pega o m�s da variavel $data_atual
   $mes_atual = substr($data_atual,5,2);
   // Pega o dia da variavel $data_atual
   $dia_atual = substr($data_atual,8,2);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->

</head>

<body> 
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="100%" colspan="2">
	<!-- inicio do adm -->
	<fieldset>
	<legend class="cabecalho">RELATÓRIO QUANTITATIVO PODE DIA</legend>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="45%">
<form name="form1" action="" method="post" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="0"  >
  <tr>
     <td width="5%" align="left" class="branco">&nbsp;</td>
     <td width="95%" align="left">
		<!-- ini agenda -->
			<?php include("calAit.php"); ?>
		<!-- fim agenda  -->
	</td>
	</tr>
  <tr>
    <td align="left" class="branco">&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="branco">&nbsp;</td>
    <td align="left">Data da Consulta: <? $dataT = $objD->formataDataPInterface($dataTemp); echo $dataT;?> </td>
  </tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
  <tr>
	<td width="25%" valign="top">
	  <fieldset>
	    <legend class="cabacalho">GUARDA</legend>
	    <table width="50%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse">
		<?
			$chavet = true;
			$queryE = "select sum(quantidade) as qtd, login from receber_auto where data_cadastro='$dataTemp' group by login order by data_cadastro asc";
			$resultE = $obj->executaQuery($queryE);
			while($linhaE = mysql_fetch_array($resultE)):
				$loginJ =  $linhaE['login'];
				$qtd =  $linhaE['qtd'];
				
				$total = $total + $qtd;
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
			<td width="80%" align="center" class="negrito"><a href="javascript:POPUP('lista_aitdigitado.php?xlogin=<? echo $loginJ;?>&xdata=<? echo $dataTemp;?>','350','350')"><? echo $loginJ;?></a></td>
	        <td width="20%" align="center" class="negrito"><? echo $qtd;?></td>
	      <tr>
	    
	    <?
			endwhile
			?>
            </table>
            <br>
            <table width="50%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="80%" align="center" class="negrito">Total</td>
                <td width="20%" align="center" class="negrito"><? echo $total;?></td>
	     	<tr>
          </table>
          <br>
          <br>
          <br>
          <font class="negrito"><a href="relatorio_qtd_dia_imprimir.php?data=<? echo $dataTemp?>" target="_blank">versão para impressão</a></font>
	    </fieldset>
	  </td>
	</tr>
</table>

</form>	
</td>
    </tr>
</table>
	</fieldset>
	<!-- fim do adm -->
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