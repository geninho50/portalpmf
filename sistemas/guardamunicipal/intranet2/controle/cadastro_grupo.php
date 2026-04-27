<?php
ini_set('default_charset','UTF-8');

// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
   include("incValidaSessao.php");
   $idsession = $_SESSION['idSESSION'];
   $idcaixa =  (int)$_POST['idcaixa'];
   if( $idcaixa == 0 )
   {
      $idcaixa = (int)$_GET['idcaixa'];
   }

	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	require ("../classes/trataString.php");
	$objS = new trataString;
	require ("../classes/trataArquivo.php");
	$objT = new trataArquivo;

	if( $idcaixa > 0 )
	{		
		$query = "SELECT * FROM caixa where id=$idcaixa";
		$resultado = $obj->executaQuery($query);
		$linha = mysql_fetch_array($resultado);
		if( $linha )
		{
			$id = $linha["id"];
			$caixa = $linha["caixa"];
			$numbloco = $linha["numbloco"];
		}	
	}
	
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
    <td width="200%" colspan="2">
	<!-- inicio do adm -->
	<fieldset>
	<legend class="cabecalho">CADASTRO DE GRUPO</legend>
    <form name="form1" method="post" action="../classes/controleGrupo.php" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

		<table width="100%" border="0" cellspacing="1" cellpadding="1">
              <tr>
              <td width="12%" align="right" valign="top" class="letra">Grupo:</td>
          <td width="88%"><input type="text" class="negrito" name="xgrupo" id="xgrupo" size="30" value="<? echo $grupo;?>" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
        </tr>
		    <tr height="2">
			<td colspan="2" align="left" class="letra">&nbsp;</td>
		  </tr>
		<input name="idcaixa" type="hidden" value="<? echo $idcaixa;?>"/>
		  <tr>	
			<td align="right">
			<td><input name="Submit" type="submit" class="letra" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />
			</td>
		  </tr>
		</table>
		</form>
		</fieldset>
	<!-- fim do adm -->
	
	</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="18%" align="right" bgcolor="#8BC5F3" ><img src="imagens/ico_atencao.gif" width="22" height="21"></td>
    <td width="82%" align="left" bgcolor="#8BC5F3" class="branco">Os campos que mudarem para cor azul, sao cosiderados obrigatorios.</td>
  </tr>
</table>
<br>
<fieldset>
<legend class="cabecalho">VIZUALIZAR LISTA DE GRUPO</legend>
        
        <table width="300" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
              <tr>
                <td width="85%" align="center" class="branco">GRUPO</td>
                <td width="15%" align="center" class="branco">EXCLUIR</td>
              </tr>
          </table>
          
         <table width="300" border="1" cellpadding="1" cellspacing="1" bordercolor="#000000" style="border-collapse:collapse">
              <? 
                    $query = "SELECT * FROM grupo order by id";
				    $result = $obj->executaQuery($query);
					while( $linhaG = mysql_fetch_array($result))
					{
						$idgrupo = $linhaG["id"];
						$nome = $linhaG["nome"];
               ?>
              <tr>
                <td width="85%" align="left"class="negrito"><? echo $nome;?></td>
                <td width="15%" align="center"class="negrito"><a href="../classes/controleGrupo.php?idgrupo=<? echo $idgrupo; ?>"><img src="imagens/lixeira.jpg" width="16" height="20" border="0" /></a></td>
              </tr>
              <?
              		}
			  ?>
          </table>
          
					
  
</fieldset>

</body>
</html>

<?php
	// Fechando as vari�veis de conex�o
	$obj->closeVar($query);
	$obj->closeVar($resultado);
	$obj->closeVar($linha);
	$obj->closeVar($id);
	$obj->closeVar($nomeCategoria);
	if( $id > 0 )
	{
		$obj->closeQuery();
		$obj->closeConexaoGeral();
	}
?>
