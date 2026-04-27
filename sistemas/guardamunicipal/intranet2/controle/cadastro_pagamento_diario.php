<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataArquivo.php");
	require ("../classes/trataString.php");
	$conexao = new DB_mysql ;
	$objT = new trataArquivo;
	$objS = new trataString;
	$conexao->conectarConf();

	$sqlG = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultadoG = $conexao->executaQuery($sqlG);
	$linhaG = mysql_fetch_array($resultadoG);
	if( $linhaG )
	{
		$login = $linhaG["login"];
		$matriculagm4 = $linhaG["matricula"];
	}
	
		//Pega a data atual
    $data_atual = date("Y-m-d");
    $hora_atual = date("H:i:s");
	
	
	$matricula = $_POST['xmatricula'];
	$numtemp = $_POST['numeropagamento'];

	if($matricula==0){
		$matricula = $_GET['xmatricula'];
		$numtemp = $_GET['numeropagamento'];
	}

	$sqlO = "SELECT * FROM guarda_gmf where matricula=$matricula";
	$resultadoO = $conexao->executaQuery($sqlO);
	$linhaO = mysql_fetch_array($resultadoO);
	if( $linhaO )
	{
		$loginO = $linhaO["login"];
		// Path
		$path = $objT->getPath(19).$matricula."/";
		$nomearquivo = $objT->retornaArquivo($path);
		$tamanhonomearquivo = strlen($nomearquivo);
	}
	
	// Pega o ano da variavel $data_atual
   $ano_atual = substr($data_atual,0,4);
   // Pega o m�s da variavel $data_atual
   $mes_atual = substr($data_atual,5,2);
   // Pega o dia da variavel $data_atual
   $dia_atual = substr($data_atual,8,2);

	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="icon" type="image/png" href="imagens/icon.gif" />
<head>
<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->

</head>
<? /*
if ($numbers = getRandomNumbers(1, 1, 99999, false, SORT_ASC)) {
    $numeropagamento = implode(', ', $numbers);
} else {
    print 'A faixa de valores entre $min e $max deve ser igual ou superior à' .
        ' quantidade de números requisitados';
}
*/
?>
<body> 
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="58%" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">CADASTRO CAUTELA DE MATERIAL</legend>
	
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
	    <td width="21%" align="center" valign="middle">
        <?php 
			if( $tamanhonomearquivo > 0 )
			{
		?>
	          <br />
	          <br />
	          <img src="fotos/funcionario/<?php echo $matricula; ?>/<?php echo $matricula;?>.jpg" alt="" hspace="10" border="0" align="left" />
	          <?php
			}else{
				?>
	          <br />
	          <img src="imagens/photo.jpg" alt="" width="90" height="90" hspace="10" border="0" align="left" />
	          <?
			}
		?>
        </td>
	    <td width="79%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
	      <tr>
	        <td height="65" class="diario" align="center">CAUTELA DE MATERIAL DIÁRIO<BR>
	          DIA: <? echo $dia_atual.'-'.$mes_atual.'-'.$ano_atual; ?><br><br></td>
	        </tr>
	      <tr>
	        <td>
            
            <form name="form1" method="post" action="../classes/controlePagamentoDiario.php" onSubmit="return validaFormAll(this,'Pagar','Pagar')">
					<INPUT TYPE="hidden" name="cadastro" value="true">
				  <table width="100%" border="0" cellspacing="1" cellpadding="1">
		  			  <tr>
		  			    <td align="right" class="letra">N Pagamento:</td>
		  			    <td><input name="numeropagamento" id="numeropagamento" type="text" size="10" readonly="readonly" class="negrito" value="<? echo $numtemp;?>"/></td>
		  			    </tr>
                      <tr>
		  			    <td align="right" class="letra">GM4:</td>
		  			    <td><input name="xmatriculagm4" id="xmatriculagm4" readonly="readonly" class="negrito" type="text" size="10" value="<? echo $matriculagm4;?>"/><font class="letra"><? echo $login;?></font></td>
		  			    </tr>
		  			  <tr>
		  			    <td align="right" class="letra">Guarda:</td>
		  			    <td><input name="xmatriculaguarda" id="xmatriculaguarda" readonly="readonly" class="negrito" type="text" size="10" value="<? echo $matricula;?>"/><font class="letra"><? echo $loginO;?></font></td>
		  			    </tr>
		  			  <tr>
						  <td width="21%" align="right" class="letra">Digite o <B>Nome</B> do Material:</td>
						  <td width="79%">
                          <input name="xmaterial" id="xmaterial" type="text" size="60" class="negrito" autofocus value="<? echo $material;?>"/>
                          <input name="qtd" id="qtd" type="text" size="5" value="1"/>
                          </td>
		  			  </tr>
		  			  <tr>
						  <td align="right" width="21%">&nbsp;</td>
						  <td width="79%">
                          <input name="Submit" type="submit" class="letra" id="Pagar" value="Pagar" onclick="onClickButton(null,'Aguarde...','','Pagar')" /></td>
		  			  </tr>
				  </table>
				</form>
            
            </td>
	        </tr>
	      </table>
        </td>
	    </tr>
	  </table>

</fieldset>
	<!--fim adm-->	</td>
  </tr>
</table>
<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#006699">
  <tr>
    <td width="8%" class="branco" align="center">QTD</td>
    <td width="86%" class="branco">MATERIAL</td>
    <td width="6%" class="branco">&nbsp;</td>
  </tr>
</table>
<form name="form1" method="post" action="../classes/controleFinalizarPagamentoDiario.php" onSubmit="return validaFormAll(this,'Finalizar','Finalizar')">
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#cccccc" style="border-collapse:collapse">
    <?
		$chavet = true;
		$query = "select * from pagamentodiario where matricularetirada=$matricula and status=0 order by material asc";
		$resultado = $conexao->executaQuery($query);
		while($linha=mysql_fetch_array($resultado))
		{	
			$id = $linha['id'];
			$qtdretirado = $linha['qtdretirado'];
			$material = $linha['material'];
    ?>
  <tr bgColor="#FFFFFF" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#FFFFFF'">
    <td align="center" width="8%" class="negrito"><? echo $qtdretirado; ?></td>
    <td align="left" width="86%" class="negrito"><? echo $material; ?></td>
    <td width="6%" align="center"><a href="../classes/controleDeletarPagamentoDiario.php?chave=1&id=<? echo $id; ?>&numeropagamento=<? echo $numtemp?>&xmatriculagm4=<? echo $matriculagm4?>&xmatriculaguarda=<? echo $matricula?>" border="0"><img src="imagens/excluir.png" width="24" height="24" border="0" /></a></td>
  </tr>
  
  <?
		}
  ?>
</table>
<BR>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	 <tr>
		<td align="right" class="letra">N Pagamento:</td>
		<td><input name="numeropagamento" id="numeropagamento" type="text" size="10" class="negrito" readonly="readonly" value="<? echo $numtemp;?>"/></td>
	</tr>
     <tr>
	    <td align="right" class="letra">Guarda:</td>
	    <td><input name="xmatriculaguarda" id="xmatriculaguarda" readonly="readonly" class="negrito" type="text" size="10" value="<? echo $matricula;?>"/><font class="letra"><? echo $loginO;?></font></td>
	</tr>
  <tr>
    <td align="right" class="letra">Senha:</td>
    <td><input name="xsenha" id="xsenha" type="password" size="10" value="" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
	<td align="right" width="8%">&nbsp;</td>
	<td width="92%">
  	<input name="Submit" type="submit" class="letra" id="Finalizar" value="Finalizar" onclick="onClickButton(null,'Aguarde...','','Finalizar')" /></td>
  </tr>
</table>

</form>
</body>
</html>