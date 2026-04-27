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
    <th colspan="2" scope="col">
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
    <th colspan="2" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td width="29%" align="center" valign="top" scope="col"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th align="center">&nbsp;</th>
      </tr>
      <tr>
        <td align="center"><img src="images/logo.png">
		<!-- ini menu -->
			<?php //include("calendario.html");?>
    	<!-- fim menu -->
		</td>
      </tr>
      <tr>
        <td align="center">
		<!-- ini menu -->
		<?
		$query = "select MAX(id) as id from conexao_gmf";
		$resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");	
		while ($linha=mysql_fetch_array($resultado))
		{
			$id = $linha['id'];
		}
		$idTemp = $id - 1;
		$query2 = "select data from conexao_gmf where id=$idTemp";
		$resultado2 = mysql_query($query2) or die ("Não foi possível realizar a consulta ao banco de dados");	
		$linha2=mysql_fetch_array($resultado2);
		if($linha2)
		{
			$data = $linha2['data'];
			
		}
		?>
    <!-- fim menu -->
		<br>
		<font color="#006699">Voc&ecirc; logou como <b><? echo $loginTemp; ?><br></b><br>
		<br>
		Seu &uacute;ltimo acesso foi:<br>
		<b><? echo $data;?></b></font></td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="center">
		
		</td>
      </tr>
      <tr>
        <td align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <th width="35%" scope="col">&nbsp;</th>
            <th width="65%" align="center" scope="col">
			<?php 
			if( $tamanhonomearquivo > 0 )
			{
		?>
				<BR><img src="fotos/funcionario/<?php echo $matricula; ?>/<?php echo $matricula?>_1.jpg" border="0" hspace="10" align="left">
		<?php
			}
			else{
				?>
					<BR><img src="images/foto.jpg" width="120" height="112" hspace="10" border="0" align="left">
			  <?
			}
		?>
			</th>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="center"><font color="#006699">Anivesariantes do m&ecirc;s de <B><? echo $mes; ?></B></font></td>
      </tr>
      <tr>
        <td align="center">&nbsp;		  </td>
      </tr>
      <tr>
        <td align="center">
		<table width="71%" border="0" cellspacing="1" cellpadding="1">
          <?
			$consult = "select DAY(datanasc) as dia,MONTH(datanasc) as mes,YEAR(datanasc) as ano,matricula, login, datanasc from guarda_gmf where MONTH(datanasc)=$mes_atual order by DAY(datanasc) asc";
			$resultados = $obj->executaQuery($consult);
			while($dado = mysql_fetch_array($resultados))
			{
				$matricula = $dado['matricula'];
				$data_nac = $dado['datanasc'];
				$nome = $dado['login'];
				$dia = $dado['dia'];
				$mes = $dado['mes'];
				$ano = $dado['ano'];
				
				$path = $objT->getPath(19).$matricula."/";
				$nomearquivo = $objT->retornaArquivo($path);
				$tamanhonomearquivo = strlen($nomearquivo);
				
				if( $tamanhonomearquivo > 0 )
				{
		?>
          <tr>
            <td align="right" width="47" height="50"><img src="fotos/funcionario/<?php echo $matricula; ?>/<?php echo $matricula?>_2.jpg" border="0" hspace="10" align="left"></td>
            <td width="179"><? echo '<font color="#006699">'.$nome.'</font><font color=#333333> - <b>'.$dia.' / '.$mes.' / '.$ano.'</b></font>';?></td>
          </tr>
          <?php
				}
				else{
		?>
          <tr>
            <td align="right" width="47" height="50"><img src="fotos/foto.jpg" width="50" height="47" hspace="10" border="0" align="left"></td>
            <td><? echo '<font color="#006699">'.$nome.'</font><font color=#333333> - <b>'.$dia.' / '.$mes.' / '.$ano.'</b></font>';?></td>
          </tr>
          <?
				}
			}
		?>
        </table>
		</td>
      </tr>
    </table>

	</td>
    <th width="71%" align="left" valign="top">
	<!--painel de recado-->
		<fieldset>
		<legend class="fieldset">Painel de Recado </legend>
			<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
			<?PHP 
			$chavet = true;
			 $queryE = "SELECT id, DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano, nome, texto FROM recado order by id desc";
			   $resultE = $obj->executaQuery($queryE);
			   while($linhaE = mysql_fetch_array($resultE)):
			   
					$id = $linhaE['id'];
					$nome =  $linhaE['nome'];
					$texto =  $linhaE['texto'];
					$dia = $linhaE['dia'];
					$mes = $linhaE['mes'];
					$ano = $linhaE['ano'];
			?>
			
			  <tr bgColor="<?PHP if($chavet)
									{
										echo '#cccccc';
									}
									else{ 
										echo '#ffffff';
									} 
									$chavet=!$chavet;
								?>">
			   <td width="11%" align="center" class="negrito"> <?PHP echo $dia.' / '.$mes.' / '.$ano; ?></td>
			   <td width="24%" align="left" class="negrito"><?PHP echo $nome; ?></td>
			   <td width="65%" align="left" class="negrito"><?PHP echo $texto; ?></td>
			  </tr>
			
			
			<?PHP
					 endwhile
					
			?>
			</table>
		</fieldset>
	<!--fim do painel de recado-->
	
	<!--inicio do caixa de entrada-->
		<fieldset>
		<legend class="fieldset">Caixa de Entrada de <? echo $login;?> </legend>
			<table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
			  <tr>
				<td width="17%" align="left" class="branco"><B>De:</B></td>
				<td width="67%" align="left" class="branco"><B>Assunto:</B></td>
				<td width="10%" align="center" class="branco"><B>Data:</B></td>
				<td width="6%" align="center">&nbsp;</td>
			  </tr>
			</table>
			<table  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
			<?php 
			$chavee = true;
				$queryE = "SELECT id, DAY(datacadastro) as dia,MONTH(datacadastro) as mes,YEAR(datacadastro) as ano, de,para,assunto FROM recadodireto where statusexcluir=0 and para='$login'";
				$resultE = $obj->executaQuery($queryE);
				
				while( $linhaE = mysql_fetch_array($resultE) )
				{
					$id = $linhaE['id'];
					$de = $linhaE['de'];
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
				<td width="17%" align="left" class="negrito"><? echo $de;?></td>
				<td width="67%" align="left" class="negrito" ><a href="mostrar_recado.php?idrecado=<? echo $id; ?>"><font class="negrito"><? echo $assunto;?></font></a></td>
				<td width="10%" align="center" class="negrito"><? echo $dia.' / '.$mes.' / '.$ano; ?></td>
				<td width="6%" align="center"><a href="../classes/controleRecadoDireto.php?idRecado=<? echo $id; ?>&acao=excluir"><font class="negrito">Excluir</a></font></td>
			  </tr>
				<?php
				}
			?>
			</table>
	</fieldset>
	<!--fim do caixa de entrada-->
	
	<!--inicio itens enviados-->
	<fieldset>
	<legend class="fieldset">Itens Enviados </legend>
		<table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
		  <tr>
			<td width="18%" align="left" class="branco"><B>Para:</B></td>
			<td width="67%" align="left" class="branco"><B>Assunto:</B></td>
			<td width="11%" align="center" class="branco"><B>Data:</B></td>
		  </tr>
		</table>
		<table  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
		<?php 
			$data_atual = date("Y-m-d");
			$mes_atual = substr($data_atual,5,2);
			$ano_atual = substr($data_atual,0,4);
			
			$chaves = true;
			$queryE = "SELECT id, DAY(datacadastro) as dia,MONTH(datacadastro) as mes,YEAR(datacadastro) as ano, de,para,assunto FROM recadodireto where de='$login' and MONTH(datacadastro)='$mes_atual' and YEAR(datacadastro)='$ano_atual'";
			$resultE = $obj->executaQuery($queryE);
			
			while( $linhaE = mysql_fetch_array($resultE) )
			{
				$id = $linhaE['id'];
				$para = $linhaE['para'];
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
			<td width="18%" align="left" class="negrito"><? echo $para;?></td>
			<td width="67%" align="left" class="negrito"><a href="mostrar_recado.php?idrecado=<? echo $id; ?>"><font class="negrito"><? echo $assunto;?></font></a></td>
			<td width="11%" align="center" class="negrito"><? echo $dia.' / '.$mes.' / '.$ano; ?></td>
		  </tr>
			<?php
			}
		?>
		</table>
	</fieldset>
	<!--fim itens enviados-->	
	<br><br><br><br><br><br>
	<? 
		$queryE = "SELECT * FROM guarda_gmf where login='$loginTemp'";
		$resultE = $obj->executaQuery($queryE);
		$linhaE = mysql_fetch_array($resultE);
		if($linhaE){
	?>
	<fieldset>
	<legend class="fieldset">Informacoes de Seguranca.</legend>
		<table>
		<tr>
			<td width="18%" align="left" class="negrito"><font size="2">Ola, informamos que seu login de acesso ao INTRANET e igual ao seu nome de Guerra.<br> 
			Para sua maior seguranca, solicitamos que efetue a troca no login de acesso no menu Guarda Online -> Alterar Login de Acesso.<br>
			A elaboracao do novo login de acesso fica a criterio do usuario.</font></td>
		 </tr>
		 </table>
	</fieldset>
	<?
		}
		else{}
	?>
	</th>
  </tr>
</table>
</body>
</html>
