<?php
	// Este primeiro header, corrigi o problema de acentuação dos caracteres.
header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	include("incValidaSessao.php");
	$idsession = $_SESSION['idSESSION'];
	$id = (int)$_GET['id'];
	if( $id > 0 )
	{
		// Pegou o Id
	}
	else
	{
		$id = $_POST['id'];
	}

	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$data = "";
	$horainicial = "";
	$horafinal = "";
	$local = "";
	$descricao = "";
	$qtdhoras = "";
	$email = "";
	
	if( $id > 0 )
	{		
		$query = "SELECT * FROM escalahoraextra where id=$id";
		$resultado = $obj->executaQuery($query);
		$linha = mysql_fetch_array($resultado);
		if( $linha > 0 )
		{
			$id = $linha["id"];
			$dataini = $linha["dataini"];
			$horainicial = $linha["horainicial"];
			$horafinal = $linha["horafinal"];
			$qtdhoras1 = $linha["qtdhoras1"];
			$qtdhoras2 = $linha["qtdhoras2"];
			$qtdguardas = $linha["qtdguardas"];
			$tempo = $linha["tempo"];
			$local = $linha["local"];
			$missao = $linha["missao"];
			$lanche = $linha["lanche"];
			$visivel = $linha["visivel"];
			$he = $linha["he"];
		}		
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
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
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!-- incio tela de cadastro -->
	<fieldset>
	<legend class="negrito">Cadastro Escala de Hora Extra</legend>
	<form name="form1" method="post" action="../classes/controleEscalaHoraExtra.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
	<table width="83%" height="290" border="0" cellpadding="1" cellspacing="1">
	 <tr>
	   <td height="24" align="right" class="letra">Status:</td>
	   <td><select name="yvisivel">
	     <option value="0">Selecione...</option>
		 <option value="1"<? if($visivel==1){?>selected<? }?>>OFFLINE</option>
      	 <option value="2" <? if($visivel==2){?>selected<? }?>>ONLINE</option> 
	     </select></td>
	   </tr>
	   <tr>
	   <td height="24" align="right" class="letra">Tipo:</td>
	   <td><select name="yhe">
	     <option value="0">Selecione...</option>
		 <option value="1"<? if($he==1){?>selected<? }?>>100%</option>
      	 <option value="2" <? if($he==2){?>selected<? }?>>200%</option> 
	     </select></td>
	   </tr>
	 <tr>
	   <td height="24" align="right" class="letra">Data:</td>
	   <td>
	   <input type="text" value="<? echo $dataini;?>" readonly name="dataini" class="stylo1" size="12"/>
		  <a onClick="displayCalendar(document.forms[0].dataini,'yyyy-mm-dd',this)"> <img  src="images/calendario.gif" width='16' height='16' border='0' tille='Selecione a Data'></a>   
	   </td>
	 </tr>
	 <tr>
	   <td height="24" align="right" class="letra">Semana:</td>
	   <td><select name="ysemana" class="select">
		 <option value="0">Selecione...</option>
		 <option value="Segunda-Feira">Segunda-Feira</option>
		 <option value="Terca-Feira">Terca-Feira</option>
		 <option value="Quarta-Feira">Quarta-Feira</option>
		 <option value="Quinta-Feira">Quinta-Feira</option>
		 <option value="Sexta-Feira">Sexta-Feira</option>
		 <option value="Sabado">Sabado</option>
		 <option value="Domingo">Domingo</option>
	   </select></td>
	 </tr>
	 <tr>
		<td width="21%" height="24" align="right" class="letra">Hora Inicial:<FONT COLOR="#FF0033">*</FONT></td>
		<td width="79%"><input name="xhorainicial" id="xhorainicial" type="text" size="12" value="<?echo $horainicial;?>" maxlength="8"  onkeypress="valida_horas(this)"/> 
		- - <span class="letra">Hora Final:<font color="#FF0033">*
		<input name="xhorafinal" id="xhorafinal" type="text" size="12" value="<?echo $horafinal;?>"  maxlength="8"  onkeypress="valida_horas(this)"/>
		</font></span></td>
	 </tr>
	 <tr>
		<td width="21%" height="24" align="right" class="letra">Qtd de Horas de 100%:<font color="#FF0033">*</font></td>
		<td width="79%"><input name="xqtdhoras1" id="xqtdhoras1" type="text" size="12" value="<?echo $qtdhoras1;?>" onkeypress="valida_horas(this)"/> 
		  - - <span class="letra">Qtd de Horas de 200%:<font color="#FF0033">*
		  <input name="xqtdhoras2" id="xqtdhoras2" type="text" size="12" value="<?echo $qtdhoras2;?>" onkeypress="valida_horas(this)"/>
		  </font></span></td>
	 </tr>
	  <tr>
		<td height="24" align="right" class="letra">Qtd de GM's:<FONT COLOR="#FF0033">*</FONT></td>
		<td><input name="xqtdguardas" id="xqtdguardas" type="text" size="12" value="<?echo $qtdguardas;?>"/></td>
	  </tr>
	  <tr>
		<td height="24" align="right" class="letra">Tempo Dispon&iacute;vel:</td>
		<td><input name="tempo" id="tempo" type="text" size="60" value="<?echo $tempo;?>"/></td>
	  </tr>
	  <tr>
		<td width="21%" height="24" align="right" class="letra">Evento:<FONT COLOR="#FF0033">*</FONT></td>
		<td width="79%"><input name="xlocal" id="xlocal" type="text" size="60" value="<?echo $local;?>"/></td>
	 </tr>
	  <tr>
		<td height="136" align="right" valign="top" class="letra">Miss&atilde;o:<FONT COLOR="#FF0033">*</FONT></td>
		<td valign="top"><textarea name="xmissao" cols="90" rows="10" ><?echo $missao;?></textarea></td>
	  </tr>
	  <tr>
		<td height="24" align="right" class="letra">J4:</td>
		<td><input name="lanche" id="lanche" type="text" size="60" value="<?echo $lanche;?>"/></td>
	  </tr>
	
	 <INPUT TYPE="hidden" NAME="id" value="<?echo $id;?>">	
		
	  <tr>	
		<td align="right">
		<td><input name="Submit" type="submit" class="botao" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />
		</td>
	  </tr>
	</table>
	</form>
	</fieldset>
<!-- fim tela de cadastro -->	
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
	if( $id > 0 )
	{
		$obj->closeQuery();
		$obj->closeConexaoGeral();
	}
?>
