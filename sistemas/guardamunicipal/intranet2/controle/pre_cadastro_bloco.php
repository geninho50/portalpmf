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
      $idcaixa = (int)$_GET['idEscola'];
   }

	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	require ("../classes/trataString.php");
	$objS = new trataString;
	require ("../classes/trataArquivo.php");
	$objT = new trataArquivo;

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
	<legend class="cabecalho">PRÉ CADASTRO DE BLOCO</legend>
        
        <table width="780" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
              <tr>
                <td width="58" align="center" class="branco">Caixa</td>
                <td width="62" align="center" class="branco">Limite</td>
                <td width="660" align="center" class="branco">Na Caixa</td>
              </tr>
          </table>
          
          <table width="780" border="0" cellspacing="1" cellpadding="1">
          <?
          	$query = "SELECT * FROM caixa";
			$resultado = $obj->executaQuery($query);
			while( $linha = mysql_fetch_array($resultado) )
			{
				$id = $linha["id"];
				$caixa = $linha["caixa"];
				$numbloco = $linha["numbloco"];
				
		  ?>
          
              <tr>
                <td width="58" height="110" align="center" background="imagens/caixa.jpg" class="negrito" l><a href="cadastro_bloco.php?idcaixa=<? echo $id;?>"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif" size="2"><b><? echo $caixa;?></b></font></a></td>
                <td width="62" align="center" class="negrito"><? echo $numbloco;?></td>
                <td width="660" align="center"> 
                <?
                
					$query = "SELECT * FROM bloco where idcaixa=$id";
					GeraColunasBloco(10, $query);
					/*$queryB = "SELECT count(idcaixa) as total FROM bloco where idcaixa=$id group by idcaixa";
					$resultadoB = $obj->executaQuery($queryB);
					$linhaB = mysql_fetch_array($resultadoB);
					if($linhaB)
					{
						$total = $linhaB['total'];
						echo '<font class="negrito">'.$total.'</font>';
					}*/
					?>
                </td>
            </tr>
            <?
            }  
			?>
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
