<?php
// Este primeiro header, corrigi o problema de acentuação dos caracteres.
header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	   
include("incValidaSessao.php");
   $idsession = $_SESSION['idSESSION'];
   require ("../classes/DB_mysql.php");
   require ("../classes/trataArquivo.php");
   $obj = new DB_mysql;
   $objT = new trataArquivo;
   $conexao = $obj->conectarConf();
   
	$consulta = "SELECT * FROM guarda_gmf where id=$idsession";
	$resposta = $obj->executaQuery($consulta);
	$dados = mysql_fetch_array($resposta);
	if( $dados )
	{
		$matricula = $dados["matricula"];
		$loginTemp = $dados["login_usuario"];
		
		// Path
		$path = $objT->getPath(19).$matricula."/";
		$nomearquivo = $objT->retornaArquivo($path);
		$tamanhonomearquivo = strlen($nomearquivo);
	}
	$data_atual = date("Y-m-d");
	$mes_atual = substr($data_atual,5,2);
	if($mes_atual==1){$mes='JANEIRO';}
	if($mes_atual==2){$mes='FEVEREIRO';}
	if($mes_atual==3){$mes='MARÇO';}
	if($mes_atual==4){$mes='ABRIL';}
	if($mes_atual==5){$mes='MAIO';}
	if($mes_atual==6){$mes='JUNHO';}
	if($mes_atual==7){$mes='JULHO';}
	if($mes_atual==8){$mes='AGOSTO';}
	if($mes_atual==9){$mes='SETEMBRO';}
	if($mes_atual==10){$mes='OUTUBRO';}
	if($mes_atual==11){$mes='NOVEMBRO';}
	if($mes_atual==12){$mes='DEZEMBRO';}
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
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#666666">
    <th scope="col">
	<!-- ini menu -->
		<?php 
		$sql = "SELECT * FROM guarda_gmf where id=$idsession";
		$result = $obj->executaQuery($sql);
		$linha = mysql_fetch_array($result);
		if( $linha )
		{
			$login = $linha["login"];
			
			include("menu.php");
		}
		?>
    <!-- fim menu -->
	</th>
  </tr>
  <tr>
    <th scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th width="71%" align="left" valign="top">

      <!--inicio do caixa de entrada-->
      <fieldset>
        <legend class="fieldset">Lista de CI's cadastradas</legend>
        <table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
          <tr>
            <td width="8%" align="center" class="branco"><B>CI:</B></td>
            <td width="22%" align="center" class="branco"><B>Para:</B></td>
            <td width="60%" align="left" class="branco"><B>Assunto:</B></td>
            <td width="10%" align="center" class="branco"><B>Data:</B></td>
          </tr>
          </table>
        <table  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
          <?php 
			$chavee = true;
				$queryE = "SELECT id, DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano, de,tratamento,para,assunto FROM comunicacaointerna where de='$login'  order by data asc";
				$resultE = $obj->executaQuery($queryE);
				while( $linhaE = mysql_fetch_array($resultE) )
				{
					$id = $linhaE['id'];
					$de = $linhaE['de'];
					$tratamento = $linhaE['tratamento'];
					$para = $linhaE['para'];
					$assunto = $linhaE['assunto'];
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
            <td width="8%" align="center" class="negrito"><? echo $id;?></td>
            <td width="22%" align="center" class="negrito"><? echo $para;?></td>
            <td width="60%" align="left" class="negrito" ><a href="mostrar_recado.php?idrecado=<? echo $id; ?>"><font class="negrito"><? echo $assunto;?></font></a></td>
            <td width="10%" align="center" class="negrito"><? echo $dia.' / '.$mes.' / '.$ano; ?></td>
          </tr>
          <?php
				}
			?>
          </table>
      </fieldset>
      <!--fim do caixa de entrada-->
      
      <!--inicio itens enviados-->
      <fieldset>
        <legend class="fieldset">Lista de CI's recebidas </legend>
        <table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
          <tr>
            <td width="8%" align="center" class="branco"><B>CI:</B></td>
            <td width="22%" align="center" class="branco"><B>De:</B></td>
            <td width="60%" align="left" class="branco"><B>Assunto:</B></td>
            <td width="10%" align="center" class="branco"><B>Data:</B></td>
          </tr>
        </table>
        <table  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
          <?php 
			$data_atual = date("Y-m-d");
			$mes_atual = substr($data_atual,5,2);
			$ano_atual = substr($data_atual,0,4);
			
			$chaves = true;
			$queryE = "SELECT id, DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano, de,tratamento,para,assunto FROM comunicacaointerna where para='$login' and MONTH(data)='$mes_atual' and YEAR(data)='$ano_atual'";
			$resultE = $obj->executaQuery($queryE);
			
			while( $linhaE = mysql_fetch_array($resultE) )
			{
				$id = $linhaE['id'];
				$tratamento = $linhaE['tratamento'];
				$de = $linhaE['de'];
				$assunto = $linhaE['assunto'];
				$dia = $linhaE['dia'];
				$mes = $linhaE['mes'];
				$ano = $linhaE['ano'];
						
		?>
          <tr bgColor="<?PHP if($chaves)
								{
									echo '#cccccc';
								}
								else{ 
									echo '#ffffff';
								} 
								$chaves=!$chaves;
							?>">
            <td width="8%" align="center" class="negrito"><? echo $id;?></td>
            <td width="22%" align="center" class="negrito"><? echo $de;?></td>
            <td width="60%" align="left" class="negrito"><a href="mostrar_recado.php?idrecado=<? echo $id; ?>"><font class="negrito"><? echo $assunto;?></font></a></td>
            <td width="10%" align="center" class="negrito"><? echo $dia.' / '.$mes.' / '.$ano; ?></td>
          </tr>
          <?php
			}
		?>
        </table>
      </fieldset>
      <!--fim itens enviados-->	

    </th>
  </tr>
</table>
</body>
</html>
