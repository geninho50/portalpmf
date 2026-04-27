<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
  
   include("incValidaSessao.php");
   $idsession = $_SESSION['idSESSION'];
   $idescala =  (int)$_POST['idescala'];
   if( $idescala == 0 )
   {
      $idescala = (int)$_GET['idescala'];
   }
   
   require ("../classes/DB_mysql.php");
   $obj = new DB_mysql;
   $conexao = $obj->conectarConf();
      
	     //Pega a data atual
   $data_atual = date("Y-m-d");
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
<style>
.stilo1{ background-color:#cccccc;}<!--cinza-->
.stilo2{background-color:#cdc9c9;}<!--cinza escuro-->
.stilo3{background-color:#add8e6;}<!--azul-->
.stilo4{background-color:#98fb98;}<!--verde limão-->
.stilo5{background-color:#daa520;}<!--marom-->
.stilo6{background-color:#f4a460;}<!--laranja-->
.stilo7{background-color:#63b8ff;}<!--azul mais escuro-->
.stilo8{background-color:#ffec8b;}<!--amarelo-->
.stilo9{background-color:#ffa54f;}<!--laranja mais escuro-->
.stilo10{background-color:#ffc125;}<!--laranja intermediario-->
</style>



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
	<legend class="cabecalho">CADASTRO DE CHAMADA DIÁRIA</legend>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="45%">
<form name="form1" action="../classes/controleChamada.php" method="post" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
<br>
<table border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="138" align="right" class="letra">Chefe do Dia:</td>
    <td width="328">
	<select name="ychefe" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
	  <option value="0">Selecione...</option>
	  <option value="JOSUE">CHEFE DE SETOR JOSUE</option>
	  <option value="FERNADES">CHEFE DE OPERCACOES FERNANDES</option>
	  <option value="JOEL">CHEFE DE OPERCACOES JOEL</option>
	  <option value="FRANCO">CHEFE DE OPERCACOES FRANCO</option>
	  <option value="PEREIRA">CHEFE DE OPERCACOES PEREIRA</option>
	  <option value="LARISSA">CHEFE DE OPERCACOES LARISSA</option>
	  <option value="RAFAEL">CHEFE DE OPERCACOES RAFAEL</option>
	</select>
	</td>
  </tr>
  <tr>
    <td width="138" align="right" class="letra">Turno:</td>
    <td width="328">
	<select name="yturno" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
	  <option value="0">Selecione...</option>
	  <option value="1">MATUTINO</option>
	  <option value="2">VESPERTINO</option>
	</select>
	</td>
  </tr>
   <tr>
    <td width="138" align="right" class="letra">Data:</td>
    <td width="328">
<input type="text" value="<? echo $data;?>" readonly name="xdata" size="12" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/>
			<a onClick="displayCalendar(document.forms[0].xdata,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a>
	</td>
  </tr>
</table>

<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8"  >
  <tr>
     <td width="2%" align="left" class="branco">&nbsp;</td>
    <td width="98%" align="left" class="branco"><b>Guardas</b></td>
	</tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
  <tr>
	<td valign="top">
		<fieldset>
   			<legend class="negrito">MATUTINO</legend>
			<?
			$queryE = "select * from usuario where turno=1 order by turno asc, login asc";
			$resultE = $obj->executaQuery($queryE);
			while($linhaE = mysql_fetch_array($resultE)):
				$loginJ =  $linhaE['login'];
				$turno =  $linhaE['turno'];
				$chave =  $linhaE['chave'];
			?>
					<table width="100%"  border="0" cellspacing="0" cellpadding="0">
						<tr align="left">
							<td bgcolor="#CCCCCC" width="5%" align="center">
								<input name="conf[]" type="checkbox" value="<?php echo $linhaE['login']; ?>"/> 
							</td>
							<td width="42%" >
                            <input name="login" type="text" value="<?php echo $linhaE['login']; ?>" readonly="readonly" /> </td>
							<td width="58%" align="left">
							<? 
							$queryF = "select * from ferias where login = '$loginJ' and data_inicial <= '$data_atual' and data_final >= '$data_atual'";
							$resultF = $obj->executaQuery($queryF);
							$linhaF = mysql_fetch_array($resultF);
							if($linhaF){
								$idF=$linhaF['id'];
								$datai=$linhaF['data_inicial'];
								$dataf=$linhaF['data_final'];
								$atividade=$linhaF['atividade'];
								
								//if($data_atual>=$datai && $data_atual<=$dataf){
									if($atividade==0){echo'';}
									if($atividade==1){echo'<B><font color="#666666" size="2">FERIAS</font></B>';}
									if($atividade==2){echo'<B><font color="#4682B4" size="2">ATESTADO</font></B>';}
									if($atividade==3){echo'<B><font color="#cccccc" size="2">FOLGA</font></B>';}
									if($atividade==4){echo'<B><font color="#FF0000" size="2">DOACAO</font></B>';}
									if($atividade==5){echo'<B><font color="#ffa500" size="2">LICENCA GALA</font></B>';}
									if($atividade==6){echo'<B><font color="#cccccc" size="2">LICENCA NOJO</font></B>';}
									if($atividade==7){echo'<B><font color="#00bfff" size="2">LICENCA PATERNIDADE</font></B>';}
									if($atividade==8){echo'<B><font color="#ff00ff" size="2">LICENCA GESTACAO</font></B>';}
									if($atividade==9){echo'<B><font color="#ffff00" size="2">LICENCA NAO REMUNERADA</font></B>';}
									if($atividade==10){echo'<B><font color="#63b8ff" size="2">LICENCA PREMIA</font></B>';}
								//}
							}
							?>
							</td>
						<TR>
					</table>
			<?
			endwhile
			?>
		</fieldset>
	</td>
	<td valign="top">
		<fieldset>
  			<legend class="negrito">VESPERTINO</legend>
			<?
			$queryE = "select * from usuario where turno=2 order by turno asc, login asc";
			$resultE = $obj->executaQuery($queryE);
			while($linhaE = mysql_fetch_array($resultE)):
				$loginJ =  $linhaE['login'];
				$turno =  $linhaE['turno'];
				$chave =  $linhaE['chave'];
			?>
					<table width="100%"  border="0" cellspacing="0" cellpadding="0">
						<tr align="left">
							<td bgcolor="#CCCCCC" width="5%" align="center">
								<input name="conf[]" type="checkbox" value="<?php echo $linhaE['login']; ?>"/> 
							</td>
							<td width="42%" >
                            <input name="login" type="text" value="<?php echo $linhaE['login']; ?>" readonly="readonly" /> </td>
							<td width="58%" align="left">
							<? 
							$queryF = "select * from ferias where login = '$loginJ' and data_inicial <= '$data_atual' and data_final >= '$data_atual'";
							$resultF = $obj->executaQuery($queryF);
							$linhaF = mysql_fetch_array($resultF);
							if($linhaF){
								$idF=$linhaF['id'];
								$datai=$linhaF['data_inicial'];
								$dataf=$linhaF['data_final'];
								$atividade=$linhaF['atividade'];
								
								//if($data_atual>=$datai && $data_atual<=$dataf){
									if($atividade==0){echo'';}
									if($atividade==1){echo'<B><font color="#666666" size="2">FERIAS</font></B>';}
									if($atividade==2){echo'<B><font color="#4682B4" size="2">ATESTADO</font></B>';}
									if($atividade==3){echo'<B><font color="#cccccc" size="2">FOLGA</font></B>';}
									if($atividade==4){echo'<B><font color="#FF0000" size="2">DOACAO</font></B>';}
									if($atividade==5){echo'<B><font color="#ffa500" size="2">LICENCA GALA</font></B>';}
									if($atividade==6){echo'<B><font color="#cccccc" size="2">LICENCA NOJO</font></B>';}
									if($atividade==7){echo'<B><font color="#00bfff" size="2">LICENCA PATERNIDADE</font></B>';}
									if($atividade==8){echo'<B><font color="#ff00ff" size="2">LICENCA GESTACAO</font></B>';}
									if($atividade==9){echo'<B><font color="#ffff00" size="2">LICENCA NAO REMUNERADA</font></B>';}
									if($atividade==10){echo'<B><font color="#63b8ff" size="2">LICENCA PREMIA</font></B>';}
								//}
							}
							?>
							</td>
						<TR>
					</table>
			<?
			endwhile
			?>
		</fieldset>
	</td>
    <td valign="top">
		<fieldset>
   			<legend class="negrito">GRUPAMENTO ALFA</legend>
			<?
			$queryE = "select * from usuario where turno=3 order by turno asc, login asc";
			$resultE = $obj->executaQuery($queryE);
			while($linhaE = mysql_fetch_array($resultE)):
				$loginJ =  $linhaE['login'];
				$turno =  $linhaE['turno'];
				$chave =  $linhaE['chave'];
			?>
					<table width="100%"  border="0" cellspacing="0" cellpadding="0">
						<tr align="left">
							<td bgcolor="#CCCCCC" width="5%" align="center">
								<input name="conf[]" type="checkbox" value="<?php echo $linhaE['login']; ?>"/> 
							</td>
							<td width="42%" >
                            <input name="login" type="text" value="<?php echo $linhaE['login']; ?>" readonly="readonly" /> </td>
							<td width="58%" align="left">
							<? 
							$queryF = "select * from ferias where login = '$loginJ' and data_inicial <= '$data_atual' and data_final >= '$data_atual'";
							$resultF = $obj->executaQuery($queryF);
							$linhaF = mysql_fetch_array($resultF);
							if($linhaF){
								$idF=$linhaF['id'];
								$datai=$linhaF['data_inicial'];
								$dataf=$linhaF['data_final'];
								$atividade=$linhaF['atividade'];
								
								//if($data_atual>=$datai && $data_atual<=$dataf){
									if($atividade==0){echo'';}
									if($atividade==1){echo'<B><font color="#666666" size="2">FERIAS</font></B>';}
									if($atividade==2){echo'<B><font color="#4682B4" size="2">ATESTADO</font></B>';}
									if($atividade==3){echo'<B><font color="#cccccc" size="2">FOLGA</font></B>';}
									if($atividade==4){echo'<B><font color="#FF0000" size="2">DOACAO</font></B>';}
									if($atividade==5){echo'<B><font color="#ffa500" size="2">LICENCA GALA</font></B>';}
									if($atividade==6){echo'<B><font color="#cccccc" size="2">LICENCA NOJO</font></B>';}
									if($atividade==7){echo'<B><font color="#00bfff" size="2">LICENCA PATERNIDADE</font></B>';}
									if($atividade==8){echo'<B><font color="#ff00ff" size="2">LICENCA GESTACAO</font></B>';}
									if($atividade==9){echo'<B><font color="#ffff00" size="2">LICENCA NAO REMUNERADA</font></B>';}
									if($atividade==10){echo'<B><font color="#63b8ff" size="2">LICENCA PREMIA</font></B>';}
								///}
							}
							?>
							</td>
						<TR>
					</table>
			<?
			endwhile
			?>
		</fieldset>
	</td>
    <td valign="top">
		<fieldset>
        <legend class="negrito">GRUPAMENTO BRAVO</legend>
   			<?
			$queryE = "select * from usuario where turno=4 order by turno asc, login asc";
			$resultE = $obj->executaQuery($queryE);
			while($linhaE = mysql_fetch_array($resultE)):
				$loginJ =  $linhaE['login'];
				$turno =  $linhaE['turno'];
				$chave =  $linhaE['chave'];
			?>
					<table width="100%"  border="0" cellspacing="0" cellpadding="0">
						<tr align="left">
							<td bgcolor="#CCCCCC" width="5%" align="center">
								<input name="conf[]" type="checkbox" value="<?php echo $linhaE['login']; ?>"/> 
							</td>
							<td width="42%" >
                            <input name="login" type="text" class="negrito" value="<?php echo $linhaE['login']; ?>" readonly="readonly" /> </td>
							<td width="58%" align="left">
							<? 
							$queryF = "select * from ferias where login = '$loginJ' and data_inicial <= '$data_atual' and data_final >= '$data_atual'";
							$resultF = $obj->executaQuery($queryF);
							$linhaF = mysql_fetch_array($resultF);
							if($linhaF){
								$idF=$linhaF['id'];
								$datai=$linhaF['data_inicial'];
								$dataf=$linhaF['data_final'];
								$atividade=$linhaF['atividade'];
								
								//if($data_atual>=$datai && $data_atual<=$dataf){
									if($atividade==0){echo'';}
									if($atividade==1){echo'<B><font color="#666666" size="2">FERIAS</font></B>';}
									if($atividade==2){echo'<B><font color="#4682B4" size="2">ATESTADO</font></B>';}
									if($atividade==3){echo'<B><font color="#cccccc" size="2">FOLGA</font></B>';}
									if($atividade==4){echo'<B><font color="#FF0000" size="2">DOACAO</font></B>';}
									if($atividade==5){echo'<B><font color="#ffa500" size="2">LICENCA GALA</font></B>';}
									if($atividade==6){echo'<B><font color="#cccccc" size="2">LICENCA NOJO</font></B>';}
									if($atividade==7){echo'<B><font color="#00bfff" size="2">LICENCA PATERNIDADE</font></B>';}
									if($atividade==8){echo'<B><font color="#ff00ff" size="2">LICENCA GESTACAO</font></B>';}
									if($atividade==9){echo'<B><font color="#ffff00" size="2">LICENCA NAO REMUNERADA</font></B>';}
									if($atividade==10){echo'<B><font color="#63b8ff" size="2">LICENCA PREMIA</font></B>';}
								//}
							}
							?>
							</td>
						<TR>
					</table>
			<?
			endwhile
			?>
		</fieldset>
	</td>
  </tr>
</table>

<table width="100%"  border="0">
<tr>   
    <td align="center"><input name="Confirmar" type="submit" class="botao_chamada" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
  </tr>
<tr>
  <td align="center">&nbsp;</td>
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="18%" align="right" bgcolor="#8BC5F3" ><img src="imagens/ico_atencao.gif" width="22" height="21"></td>
    <td width="82%" align="left" bgcolor="#8BC5F3" class="branco">Os campos que mudarem para cor azul, sao cosiderados obrigatorios.</td>
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