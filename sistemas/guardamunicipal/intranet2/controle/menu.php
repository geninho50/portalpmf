<?
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

	include("incValidaSessao.php");
	$bAdm = false;
	$bPlanejamento = false;
	$bChefia = false;
	$bGuarda = false;
	$bSetorPessoal = false;
	$bRondaEscolar = false;
	$bDigitacao = false;
	$bCentral = false;
	$bDigital = false;
	$bLogisitca= false;
	
	$id = $_SESSION["idSESSION"];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataArquivo.php");
	require ("../classes/trataString.php");
	$obj = new DB_mysql ;
	$objT = new trataArquivo;
	$objS = new trataString;
	$conexao = $obj->conectarConf();		
	$query = "SELECT * from guarda_gmf where id=$id";
	$resultado = $obj->executaQuery($query);	
	if ( $linha = mysql_fetch_array($resultado) )
	{
		if( strlen($linha['administrador']) > 0 && $linha['administrador']=='S' )
		{
			$bAdm = true;
		}
		if( strlen($linha['planejamento']) > 0 && $linha['planejamento']=='S' )
		{
			$bPlanejamento = true;
		}
		if( strlen($linha['chefia']) > 0 && $linha['chefia']=='S' )
		{
			$bChefia = true;
		}
		if( strlen($linha['guardaonline']) > 0 && $linha['guardaonline']=='S' )
		{
			$bGuarda = true;
		}
		if( strlen($linha['setorpessoal']) > 0 && $linha['setorpessoal']=='S' )
		{
			$bSetorPessoal = true;
		}
		if( strlen($linha['rondaescolar']) > 0 && $linha['rondaescolar']=='S' )
		{
			$bRondaEscolar = true;
		}
		if( strlen($linha['digitacao']) > 0 && $linha['digitacao']=='S' )
		{
			$bDigitacao = true;
		}
		if( strlen($linha['central']) > 0 && $linha['central']=='S' )
		{
			$bCentral = true;
		}
		if( strlen($linha['digital']) > 0 && $linha['digital']=='S' )
		{
			$bDigital = true;
		}
		if( strlen($linha['logistica']) > 0 && $linha['logistica']=='S' )
		{
			$bLogistica = true;
		}
		
		$id = $linha["id"];
		$login = $linha["login"];
		$matricula = $linha["matricula"];
		// Path
		$path = $objT->getPath(19).$matricula."/";
		$nomearquivo = $objT->retornaArquivo($path);
		$tamanhonomearquivo = strlen($nomearquivo);
	}
	
	$data_atual = date("Y-m-d");
	$mes_atual = substr($data_atual,5,2);
	if($mes_atual==1){$mes='JANEIRO';}
	if($mes_atual==2){$mes='FEVEREIRO';}
	if($mes_atual==3){$mes='MARCO';}
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<html>
<head>

<title>GMF (MENU)</title>
<script src="menu/xtree.js"></script>
<link type="text/css" rel="stylesheet" href="menu/xtree.css">

<STYLE TYPE="text/css">
	a {
		color: black;
		font-size:9pt;
		font-weight: bold;
		font:Calibri, "Britannic Bold";
		text-decoration: none;
	}
	a:hover {
		color: #666;
		text-decoration: underline;
	}
	a:active {
		background: highlight;
		color: highlighttext;
		text-decoration: none;
	}
.style1 {
	font-family: Calibri, "Britannic Bold";
	font-size: 12px;
	color: #333333;
}
</STYLE>
<script src="menu/tree.js"></script>
</head>

<body>
<TABLE width="100%" height="100%" align="center" style="border: 1px dotted #666;">
<TR width="100%" height="100%" valign="top">
	<TD width="100%" height="100%">

<SCRIPT LANGUAGE="JavaScript">
<!--
	// <-- Mensagem de confirmação de saída do ambiente de administração
	function Logout(link)
	{
		document.ReturnValue=confirm('Deseja Sair do Ambiente de Administração ?');
		if (document.ReturnValue)
		{
			location = ''+link;
		}
	}
	// <-- Setando as Permissões com true ou false para os Componentes e para o Administrador do Portal
	setAdm(<?php if($bAdm){ echo 'true'; }?>);
	setPlanejamento(<?php if($bPlanejamento){ echo 'true'; }?>);
	setChefia(<?php if($bChefia){ echo 'true'; }?>);
	setGuarda(<?php if($bGuarda){ echo 'true'; }?>);
	setSetorPessoal(<?php if($bSetorPessoal){ echo 'true'; }?>);
	setRondaEscolar(<?php if($bRondaEscolar){ echo 'true'; }?>);
	setDigitacao(<?php if($bDigitacao){ echo 'true'; }?>);
	setCentral(<?php if($bCentral){ echo 'true'; }?>);
	setDigital(<?php if($bDigital){ echo 'true'; }?>);
	setLogistica(<?php if($bLogistica){ echo 'true'; }?>);

	// <-- Criando o Menu de Acordo com as Permissões setadas anteriormente
	criaMenu();
	// -->
//-->
</SCRIPT>
</TD>
</tr>
</TABLE>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
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
		<font color="#006699" face="Calibri, Britannic Bold" size="2">Bem vindo <b><? echo $login; ?></b>
		<br>
		Seu último acesso foi:<br>
		<b><? echo $data;?></b></font></td>
      </tr>
      <tr>
        <td align="center">
		
		</td>
      </tr>
      <tr>
        <td align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <th width="19%" scope="col">&nbsp;</th>
            <th width="81%" align="center" scope="col">
			<?php 
			if( $tamanhonomearquivo > 0 )
			{
		?>
				<BR><img src="fotos/funcionario/<?php echo $matricula; ?>/<?php echo $matricula?>_1.jpg" border="0" hspace="10" align="left">
		<?php
			}
			else{
				?>
					<BR><img src="imagens/foto.jpg" width="120" height="112" hspace="10" border="0" align="left">
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
        <td align="center"><font color="#006699" face="Calibri, Britannic Bold" size="2">Anivesariantes do mês de <B><? echo $mes; ?></B></font></td>
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
            <td width="179"><? echo '<font color="#006699" face="Calibri, Britannic Bold" size="2">'.$nome.'</font><font color=#333333 face="Calibri, Britannic Bold" size="2"><br> Dia: '.$dia.'</b></font>';?></td>
          </tr>
          <?php
				}
				else{
		?>
          <tr>
            <td align="right" width="47" height="50"><img src="fotos/foto.jpg" width="50" height="50" hspace="10" border="0" align="left"></td>
            <td><? echo '<font color="#006699" face="Calibri, Britannic Bold" size="2">'.$nome.'</font><font color=#333333 face="Calibri, Britannic Bold" size="2"><br>Dia: '.$dia.'</b></font>';?></td>
          </tr>
          <?
				}
			}
		?>
        </table>
		</td>
      </tr>
    </table>

</body>
</html>

<?php
	// Fechando as variáveis de conexão
	$obj->closeVar($bAdm);
	$obj->closeVar($bPlanejamento);
	$obj->closeVar($id);
	$obj->closeVar($query);
	$obj->closeVar($conexao);
	$obj->closeVar($linha);
	$obj->closeVar($resultado);
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>