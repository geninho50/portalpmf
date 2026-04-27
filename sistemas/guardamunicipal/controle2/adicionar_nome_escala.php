<?php
   include("incValidaSessao.php");
   $idsession = $_SESSION['idSESSION'];

  $idescala =  (int)$_POST['idescala'];
   
   if( $idescala == 0 )
   {
      $idescala = (int)$_GET['idescala'];
	  $chave =  (int)$_GET['chave'];
   }
   
	if($chave == 1){
		$consulta='order by horat1 asc';   
	}else{
		if($chave == 2){
			$consulta='order by horat2 asc';   
		}else{
			$consulta='order by tempcandidatos.login asc';   
		}
	}
   
   require ("../classes/DB_mysql.php");
   $obj = new DB_mysql;
   $conexao = $obj->conectarConf();
   
   $chefe = "";
   $queryT = "SELECT chefe,auditado FROM listaescala where idescala='".$idescala."'";
   $resultT = $obj->executaQuery($queryT);
   if($linhaT = mysql_fetch_array($resultT)){
   	$chefe = $linhaT['chefe'];
	$auditado = $linhaT['auditado'];
   }
      
	     //Pega a data atual
   $data_atual = date("Y-m-d");
   // Pega o ano da variavel $data_atual
   $ano_atual = substr($data_atual,0,4);
   // Pega o m�s da variavel $data_atual
   $mes_atual = substr($data_atual,5,2);
   // Pega o dia da variavel $data_atual
   $dia_atual = substr($data_atual,8,2);
   
	$queryT = "SELECT * FROM escalahoraextra where id=$idescala";
	$resultadoT = $obj->executaQuery($queryT);
	while ( $linhaT = mysql_fetch_array($resultadoT) )
	{	
		$localT = $linhaT['local'];
	}
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
    <th bgcolor="#666666" scope="col">
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
	</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!-- inicio do adm -->
	<fieldset>
	<legend class="negrito">Adicionar Guarda a Escala de Hora Extra</legend>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="47%">
      <fieldset>
        <legend class="negrito"><? echo $localT; ?></legend>
  <form name="form1" action="../classes/controleAdicionarNomeEscala.php" method="post" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
  <br>
  <table border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td width="138" align="right" class="letra">Chefe de Guarni&ccedil;&atilde;o:</td>
      <td width="328"><input name="xchefe" type="text" value="<?php echo $chefe ?>" size="35" /></td>
      </tr>
    <tr>
      <td width="138" align="right" class="letra">Auditado por:</td>
      <td width="328"><input name="auditado" type="text" value="<?php echo $auditado ?>" size="35" /></td>
      </tr>
  </table>
    
  <table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8"  >
    <tr>
      <td width="5%" align="left" class="branco"><input name="checktodos" type="checkbox" /></td>
      <td width="33%" align="left" class="branco"><b>Guardas</b></td>
      <td width="12%" align="center" class="branco">100%</td>
      <td width="12%" align="center" class="branco"> 200%</td>
      <td width="22%" align="left" class="branco">Data</td>
      <td width="11%" align="left" class="branco">Escala</td>
      <td width="5%" align="center" class="branco">HE</td>
      </tr>
  </table>
    
  <?php 
   $queryE = "select * from guarda_gmf order by login";
   $resultE = $obj->executaQuery($queryE);
   
   while($linhaE = mysql_fetch_array($resultE)):
   
		$login =  $linhaE['login'];
		
		$query = "SELECT * FROM escalahoraextra where id='".$idescala."'";
		$result = $obj->executaQuery($query);
		while($linha = mysql_fetch_array($result)){
				$idescala = $linha['id'];
				$local = $linha['local'];
				
				$queryH = "select (SELECT sum(hora1) FROM listaescala where UPPER(login) like UPPER('$login') and MONTH(data)='".$mes_atual."')as temphora1, (SELECT sum(hora2) FROM listaescala where UPPER(login) like UPPER('$login') and MONTH(data)='".$mes_atual."')as temphora2 ";
				$resultH = $obj->executaQuery($queryH);
				$linhaH = mysql_fetch_array($resultH);
?>
  <table width="100%" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td width="5%"><input name="conf[]" type="checkbox" value="<?php echo $linhaE['login']; ?>"/></td>
      <td width="33%"><input name="login" type="text" value="<?php echo $linhaE['login']; ?>" readonly="readonly" /></td>
      <td width="12%"><input name="hora1" type="text" value="<?php echo $linha['qtdhoras1']; ?>" size="4" readonly="readonly"/></td>
      <td width="12%"><input name="hora2" type="text" value="<?php echo $linha['qtdhoras2']; ?>" size="4"readonly="readonly" /></td>
      <td width="22%"><input name="data" type="text" value="<?php echo $linha['data']; ?>" size="10" readonly="readonly"/></td>
      <td width="11%"><input name="idescala" type="text" value="<?php echo $linha['id']; ?>" size="1" readonly="readonly"/></td>
      <td width="5%" align="center"><input name="he" type="text" value="<?php echo $linha['he']; ?>" size="1" readonly="readonly"/></td>
      </tr>
  </table>
  <?php 
	}
   endwhile
?>
    
    
  <table width="100%"  border="0">
  <tr>   
    <td><input name="Submit" type="submit" class="botao" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />   </td>
    </tr>
    <tr>
      <td class="letra" align="center"><a href="javascript:history.back(1);">Voltar</a></td>
      </tr>
    
  </table>
  </form>
  </fieldset>	
</td>
    <td width="47%" valign="top">
      <div id="div1">
        <table width="84%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
          <tr>
            <td width="31%" align="left" class="branco">Candidatos a Escala</td>
            <td width="18%" align="center" class="branco">&nbsp;</td>
            <td width="17%" align="center" class="branco">&nbsp;</td>
            <td width="17%" align="center" class="branco">&nbsp;</td>
            <td width="17%" align="center" class="branco">&nbsp;</td>
            </tr>
          <tr>
            <td width="31%" align="left" class="branco"><b>Nome</b></td>
            <td width="18%" align="center" class="branco"><a href="adicionar_nome_escala.php?chave=1&idescala=<? echo $idescala;?>"><b>Soma 100%</b></a></td>
            <td width="17%" align="center" class="branco"><b>Escala</b></td>
            <td width="17%" align="center" class="branco"><a href="adicionar_nome_escala.php?chave=2&idescala=<? echo $idescala;?>"><b>Soma 200%</b></a></td>
            <td width="17%" align="center" class="branco"><b>Escala</b></td>
            </tr>
          </table>
        <table width="84%" border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
  <?php
		$sqlhora1 = "select tempcandidatos.login, sum(listaescala.hora1) as horat1, sum(listaescala.hora2) as horat2 from tempcandidatos inner join listaescala where tempcandidatos.idescala=$idescala and listaescala.login = tempcandidatos.login AND listaescala.data BETWEEN '".$ano_atual."-01-01' AND '".$ano_atual."-".$mes_atual."-".$dia_atual."' group by listaescala.login $consulta";
		$resultadohora1 = $obj->executaQuery($sqlhora1);
		while ( $linhaH1 = mysql_fetch_array($resultadohora1) )
		{	
			  $login1 = $linhaH1['login'];
			  $hora1 = $linhaH1['horat1'];
			  $hora2 = $linhaH1['horat2'];
			 
			  $queryS = "SELECT (select count(id) from listaescala where login='".$login1."' and MONTH(data)=$mes_atual AND YEAR(data)=$ano_atual and idescala>0 and he=1) as total1, (select count(id) from listaescala where login='".$login1."' and MONTH(data)=$mes_atual AND YEAR(data)=$ano_atual and idescala>0 and he=2) as total2";
			  $resultS = $obj->executaQuery($queryS);
			  while($linhaS = mysql_fetch_array($resultS)){
				$total1 = $linhaS['total1'];
				$total2 = $linhaS['total2'];
?>
          <tr bgColor="#FFFFFF" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#FFFFFF'">
            <td width="31%" align="left" class="letra"><? echo $login1; ?></td>		
            <td width="18%" class="letra" align="center"><? echo $hora1; ?></td>
            <td width="17%" class="letra" align="center"><? echo $total1; ?></td>
            <td width="17%" class="letra" align="center"><? echo $hora2; ?></td>
            <td width="17%" class="letra" align="center"><? echo $total2; ?></td>
            </tr>
  <?php
			  }
		}	
?>
  </table>
      </div>	</td>
    <td width="6%" valign="top">&nbsp;</td>
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