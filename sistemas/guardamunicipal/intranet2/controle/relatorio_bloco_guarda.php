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
	
	$guarda = $_POST['xGM1_1'];
	$status = $_POST['status'];
	
	$guarda = trim($guarda);
	$tamanho = strlen($guarda);
	$nvaloresencontrados = 0;
	
	if($status==2){
		$queryC = "SELECT * FROM bloco WHERE agente='$guarda' order by data_baixa desc";	
	}else{	
		$queryC = "SELECT * FROM bloco WHERE agente='$guarda' and status=$status order by data_baixa desc";
	}
	if( $tamanho > 0 )
	{
		$nvaloresencontrados = $obj->numregistros($queryC);
	}
	
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
	<fieldset>
	<legend class="cabecalho">CONSULTA BLOCO POR GUARDA</legend>
		<form name="form1" method="post" action="relatorio_bloco_guarda.php" enctype="multipart/form-data"  onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">
		
		<INPUT TYPE="hidden" name="cadastro" value="true">
		
		<table width="100%" border="0" cellspacing="1" cellpadding="1">
		    <tr>
		      <td width="10%" align="right" class="letra">Guarda:</td>
		      <td width="90%" align="left" class="letra"><input type="text" name="xGM1_1" id="xGM1_1" size="20" class="codigo"/></td>
	      </tr>
	        <tr>
	          <td align="right" class="letra">Status:</td>
	          <td align="left" class="letra">
              <select name="status" class="negrito">
                  <option value="2">TODOS...</option>
                  <option value="0">INATIVO</option>
                  <option value="1">ATIVO</option>
             </select>
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
<?
if($nvaloresencontrados > 0){
?>
<fieldset>
	<legend class="cabecalho">RETORNOU(s) <B><? echo $nvaloresencontrados;?></B> BLOCOS PARA O GUARDA <? echo $guarda;?>.</legend>

		<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#006699">
            <tr align="center">
              <td width="14%" class="branco"><b>Caixa</b> </td>
			  <td width="54%" align="center" class="branco"><b>Bloco</b></td>
			  <td width="13%" align="center" class="branco"><b>Data Baixa</b></td>
              <td width="13%" align="center" class="branco"><b>Data Fim</b></td>
			  <td width="6%" align="center" class="branco"><b>Status</b></td>
		  </tr>
	  </table>
		<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#cccccc" style="border-collapse: collapse">
		<?
			$chavet = true;
			$resultadoC = $obj->executaQuery($queryC);
			while( $linhaC = mysql_fetch_array($resultadoC) )
			{
				$id = $linhaC['id'];
				$idcaixa = $linhaC['idcaixa'];
				$numinicialbloco = $linhaC['numinicialbloco'];
				$guarda = $linhaC['guarda'];
				$agente = $linhaC['agente'];
				$data_fim = $linhaC['data_fim'];
				$data_baixa = $linhaC['data_baixa'];
				$status = $linhaC['status'];
				
				$sql = "select * from caixa where id=$idcaixa";
				$result = $obj->executaQuery($sql);
				if( $linha = mysql_fetch_array($result) )
				{
					$caixa = $linha['caixa'];
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
			<td width="14%" align="center" class="negrito"><? echo $caixa;?></td>
			<td width="54%" align="center" class="negrito"><? echo $numinicialbloco;?></td>
			<td width="13%" align="center" class="negrito"><? echo $data_baixa;?></td>
			<td width="13%" align="center" class="negrito"><? echo $data_fim;?></td>
			<td width="6%" align="center" class="negrito"><? 
				if($status==0){
			?>
			  <img src="imagens/atualiza.png" width="19" height="19" border="0" title="BLOCO ATIVO NO MOMENTO" />
			<?		
				}else{
					if($status==1){
			?>
			  		<img src="imagens/negado2.png" width="19" height="19" border="0" title="BLOCO JÁ FINALIZADO"/>
			<?						
					}	
				}
			?>
            </td>
		  </tr>
		 <?
		 		}
		 }
		 ?> 
</table>

</fieldset>
<?
}
if( $nvaloresencontrados == 0 && $tamanho > 0 ){
?>
<fieldset>
	<legend class="letra">RESULTADO(s) <B><?echo $nvaloresencontrados;?></B> PARA O GUARDA <? echo $guarda;?>.</legend>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
	<tr>
		<td width="100%" colspan="3" align="center" class="letra">Nenhum bloco para o Guarda <B> <? echo $guarda;?>.</B></td>
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