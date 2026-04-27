<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

	include("incValidaSessao.php");

    $idsession = $_SESSION['idSESSION'];
	//$idFuncionario = $_GET['idFuncionario'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataArquivo.php");
	require ("../classes/trataString.php");
	$conexao = new DB_mysql ;
	$objT = new trataArquivo;
	$objS = new trataString;
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultado = $conexao->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$login = $linha["login"];
	}
	//Pega a data atual
    $data_atual = date("Y-m-d");
    $hora_atual = date("H:i:s");
	
	$matricula = 0;
	$matricula = $_GET['matricula'];
	if( $matricula == 0 )
	{
		$matricula = $_POST['matricula'];
	}
	//$matricula=162949;	
	if( $matricula > 0 )
	{		
		$conexao->conectarConf();
		$query = "SELECT * FROM guarda_gmf where matricula=$matricula";
		$resultado = $conexao->executaQuery($query);
		$linhaG = mysql_fetch_array($resultado);
		
		if( $linhaG )
		{
			$id = $linhaG["id"];
			$logingm = $linhaG["login"];
			$nome = $linhaG["nome"];
			$sexo = $linhaG["sexo"];
			$status = $linhaG["status"];
			$nivel = $linhaG["nivel"];
			$cargo = $linhaG["cargo"];
			$cpf = $linhaG["cpf"];
			$rg = $linhaG["rg"];
			$cathabilitacao = $linhaG["cathab"];
			$datavenchab = $linhaG["datavenchab"];
			$datanascimento = $linhaG["datanasc"];
			$dataadmissao = $linhaG["dataadmim"];
			$numseriefunc = $linhaG["numseriefunc"];
			$numsinarm = $linhaG["numsinarm"];
			$email = $linhaG["email"];
			$foneresid = $linhaG["foneresid"];
			$fonecel1 = $linhaG["fonecel1"];
			$fonecel2 = $linhaG["fonecel2"];
			$nomepai = $linhaG["nomepai"];
			$nomemae = $linhaG["nomemae"];
			$estadocivil = $linhaG["estadocivil"];
			$nomeconjuge = $linhaG["nomeconj"];
			
			
			// Path
			$path = $objT->getPath(19).$matricula."/";
			$nomearquivo = $objT->retornaArquivo($path);
			$tamanhonomearquivo = strlen($nomearquivo);
		}
		
		$queryE = "SELECT * FROM endereco where matricula=$matricula";
		$resultadoE = $conexao->executaQuery($queryE);
		$linhaE = mysql_fetch_array($resultadoE);
		if( $linhaE )
		{
			$rua = $linhaE["rua"];
			$complemento = $linhaE["complemento"];
			$numero = $linhaE["numero"];
			$cep = $linhaE["cep"];
			$bairro = $linhaE["bairro"];
			$referencia = $linhaE["referencia"];
		}
		
		$queryF = "SELECT * FROM filhos where matricula=$matricula";
		$resultadoF = $conexao->executaQuery($queryF);
		$linhaF = mysql_fetch_array($resultadoF);
		if( $linhaF )
		{
			$filho1 = $linhaF["filho1"];
			$filho2 = $linhaF["filho2"];
			$filho3 = $linhaF["filho3"];
			$filho4 = $linhaF["filho4"];
			$filho5 = $linhaF["filho5"];
			$data1 = $linhaF["data1"];
			$data2 = $linhaF["data2"];
			$data3 = $linhaF["data3"];
			$data4 = $linhaF["data4"];
			$data5 = $linhaF["data5"];
			
		}
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
    <th width="100%" colspan="2">
		<!--topo--><!--topo-->
	</th>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<!--inicio adm-->
	<table width="540"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="130"><img src="imagens/pessoal_1.jpg" width="130" height="40" /></td>
    <td width="130"><a href="cadastro_usuario_recado.php?matricula=<? echo $matricula; ?>"><img src="imagens/recado_0.jpg" width="130" height="40" border="0" onMouseOver="this.src='imagens/recado_1.jpg'" onMouseOut="this.src='imagens/recado_0.jpg'" /></a></td>
    <td width="130"><a href="cadastro_usuario_saude.php?matricula=<? echo $matricula; ?>"><img src="imagens/saude_0.jpg"  width="130" height="40" border="0" onMouseOver="this.src='imagens/saude_1.jpg'" onMouseOut="this.src='imagens/saude_0.jpg'" /></a></td>
    <td width="150"><a href="cadastro_usuario_escolaridade.php?matricula=<? echo $matricula; ?>"><img src="imagens/escolaridade_0.jpg"  width="150" height="40" border="0" onMouseOver="this.src='imagens/escolaridade_1.jpg'" onMouseOut="this.src='imagens/escolaridade_0.jpg'" /></a></td>
	<td width="150"><a href="cadastro_usuario_profissional.php?matricula=<? echo $matricula; ?>"><img src="imagens/profissional_0.jpg"  width="150" height="40" border="0" onMouseOver="this.src='imagens/profissional_1.jpg'" onMouseOut="this.src='imagens/profissional_0.jpg'" /></a></td>
	<td width="150"><a href="cadastro_usuario_institucional.php?matricula=<? echo $matricula; ?>"><img src="imagens/institucional_0.jpg"  width="150" height="40" border="0" onMouseOver="this.src='imagens/institucional_1.jpg'" onMouseOut="this.src='imagens/institucional_0.jpg'" /></a></td>
  </tr>
</table>

<fieldset>
	<legend class="cabecalho">CADASTRO FUNCIONAL</legend>

<form name="form" action="../classes/controleUsuario.php" method="post" enctype="multipart/form-data"  onSubmit="return validaFormAll(this,'Continuar','Continuar')">

<table width="100%" border="0" cellspacing="1" cellpadding="1">

<!--dados da matricula-->
 <tr>
   <td align="right" class="letra">&nbsp;</td>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
   <td><?php 
			if( $tamanhonomearquivo > 0 )
			{
		?>
				<BR><BR><img src="fotos/funcionario/<?php echo $linha["matricula"]; ?>/<?php echo $linha["matricula"]?>_1.jpg" border="0" hspace="10" align="left">
		<?php
			}else{
				?>
					<BR><img src="imagens/foto.jpg" width="90" height="90" hspace="10" border="0" align="left">
			  <?
			}
		?></td>
 </tr>
 <tr>
    <td align="right" class="letra">Matricula:</td>
    <td><input name="matricula" type="text" readonly="readonly" class="negrito" maxlength="6" id="matricula" value="<? echo $matricula;?>" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/>
    <FONT COLOR="#FF0033" size="1">(N&uacute;meros sem o <B>D&iacute;gito</B>)</FONT></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
 </tr>
 
 <!--dados do nome-->
 <tr>
    <td width="18%" align="right" class="letra">Nome Completo:</td>
    <td width="33%"><input name="xnome" type="text" size="50" value="<? echo $nome;?>" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" class="negrito"/></td>
    <td width="13%" align="right" class="letra">N&iacute;vel:</td>
    <td width="36%"><input name="xnivel" type="text" id="xnivel" value="<? echo $nivel;?>" size="30" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" class="negrito"/></td>
 </tr> 

<!--dados do nome de guerra-->  
  <tr>
    <td width="18%" align="right" class="letra">Nome de Guerra:</td>
    <td width="33%"><input name="xlogin" type="text" id="xlogin" value="<? echo $logingm;?>" size="30" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" class="negrito"/></td>
    <td width="13%" align="right" class="letra">Sexo:</td>
    <td width="36%"><select name="ysexo" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
      <option value="0">Selecionar...</option>
	  <option value="MASCULINO"<? if($sexo=='MASCULINO'){?>selected<? }?>>MASCULINO</option>
      <option value="FEMININO" <? if($sexo=='FEMININO'){?>selected<? }?>>FEMININO</option> 
    </select></td>
  </tr>

<!--dados do cpf-->
 <tr>
   <td align="right" class="letra">CPF:</td>
   <td><input name="xcpf" type="text" id="xcpf" maxlength="11" class="negrito" onBlur="Verifica_campo_CPF(this)" value="<? echo $cpf;?>"/><FONT COLOR="#FF0033" size="1">(N&uacute;meros sem o <B>D&iacute;gito</B>)</FONT> </td>
   <td align="right" class="letra">RG:</td>
   <td><input name="xrg" type="text" id="xrg" class="negrito" maxlength="11" value="<? echo $rg;?>" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
  </tr>

 <!--dados da rua-->
  <tr>
    <td align="right" class="letra">Categ. Habilita&ccedil;&atilde;o: </td>
    <td><input name="xcathab" type="text" id="xcathab" class="negrito" value="<? echo $cathabilitacao;?>" size="5" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
    <td align="right" class="letra">Data de Venc. Hab.: </td>
    <td align="left">
    <input type="text" value="<? echo $datavenchab;?>" readonly name="xdatavenchab" class="negrito" size="12" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" />
		  <a onClick="displayCalendar(document.forms[0].xdatavenchab,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' tille='SELECIONE A DATA'></a> 

	</td>
  </tr>
  
  <!--dados da data de nascimento-->
  <tr>
    <td align="right" class="letra">Data de Nascimento: </td>
    <td align="left" valign="bottom">
    <input type="text" value="<? echo $datanascimento;?>" readonly name="xdatanasc" class="negrito" size="12" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" />
		  <a onClick="displayCalendar(document.forms[0].xdatanasc,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' tille='SELECIONE A DATA'></a> 
 	</td>
    <td align="right" class="letra">Data Admiss&atilde;o: </td>
    <td>
    <input type="text" value="<? echo $dataadmissao;?>" readonly name="xdataadmim" class="negrito" size="12" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" />
		  <a onClick="displayCalendar(document.forms[0].xdataadmim,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' tille='SELECIONE A DATA'></a> 

	</td>
  </tr>
  
  <tr>
    <td align="right" class="letra">N&ordm; S&eacute;rie Funcional: </td>
    <td><input name="xnumseriefunc" type="text" id="xnumseriefunc" value="<? echo $numseriefunc;?>" size="10" maxlength="4" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
    <td align="right" class="letra">N&ordm; Porte SINARM: </td>
    <td align="left"><input name="xnumsinarm" type="text" id="xnumsinarm" value="<? echo $numsinarm;?>" size="15" maxlength="12" class="negrito" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
  </tr>
  <tr>
    <td align="right" class="letra">Rua:</td>
    <td><input name="rua" type="text" id="rua" class="negrito" value="<? echo $rua;?>" size="50" onkeyup="converteUpper(this);" /></td>
    <td align="right" class="letra">Complemento:</td>
    <td align="left"><input name="complemento" type="text" class="negrito" id="complemento" value="<? echo $complemento;?>" size="30" onkeyup="converteUpper(this);" /></td>
  </tr>
  
 <!--dados do numero--> 
  <tr>
    <td align="right" class="letra">N&uacute;mero:</td>
    <td><input name="numero" type="text" id="numero" class="negrito" value="<? echo $numero;?>" size="5" maxlength="4" /></td>
    <td align="right" class="letra">Cep:</td>
    <td align="left"><input name="cep" type="text" id="cep" class="negrito" value="<? echo $cep;?>" size="15" maxlength="9"/></td>
  </tr>
  
 <!--dados do bairro-->
  <tr>
    <td align="right" valign="top" class="letra">Bairro:</td>
    <td valign="top"><input name="bairro" type="text" id="bairro" class="negrito" value="<? echo $bairro;?>" size="30" onkeyup="converteUpper(this);"/></td>
    <td align="right" valign="top" class="letra">Ponto de Refer&ecirc;ncia: </td>
    <td><textarea name="referencia" cols="40" rows="4" class="negrito" onkeyup="converteUpper(this);"><? echo $referencia;?></textarea></td>
  </tr>
  
 <!--dados da cidade-->
  <tr>
    <td align="right" class="letra">Estado:</td>
    <td>
	
	<select name="estado" class="negrito">
       <option value="0">Escolha um Estado</option>
        <?php
         mysql_connect("186.202.152.213", "autoescolavirt1", "mkstec8045");
         mysql_select_db("autoescolavirt1");
         
		 //mysql_connect("localhost", "root", "mkstec8045");
		 //mysql_select_db("central");
		 
         $sql = "SELECT * FROM tb_estados ORDER BY nome ASC";
         $qr = mysql_query($sql) or die(mysql_error());
         while($ln = mysql_fetch_assoc($qr)){
            echo '<option value="'.$ln['id'].'">'.$ln['nome'].'</option>';
         }
      ?>
        
    </select>
    </td>
	<td align="right" class="letra">Cidade:</td>
    <td>
	 <select name="cidade" class="negrito">
       <option value="0" disabled="disabled">Escolha um Estado Primeiro</option>
    </select>
    
	
  </tr>
  
 <!--dados do email-->
  <tr>
    <td align="right" class="letra">Email:</td>
    <td><input name="xemail" type="text" id="xemail" value="<? echo $email;?>" size="40" class="negrito" />
    <FONT COLOR="#FF0033" size="1">(Letras Min.)</FONT></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
 <!--dados do fone residencial-->
  <tr>
    <td align="right" class="letra">Fone Residencial: </td>
    <td><input name="foneresid" type="text" id="foneresid" OnKeyPress="formatar(this, '##-####-####')" class="negrito" value="<? echo $foneresid;?>" maxlength="12"/></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
 <!--dados do sangue-->
  <tr>
    <td align="right" class="letra">Fone Celular 1: </td>
    <td><input name="xfonecel1" type="text" id="xFoneCelular1" class="negrito" OnKeyPress="formatar(this, '##-####-####')" value="<? echo $fonecel1;?>" maxlength="12" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
    <td align="right" class="letra">Fone Celular 2: </td>
    <td><input name="fonecel2" type="text" class="negrito" id="FoneCelular2" OnKeyPress="formatar(this, '##-####-####')" value="<? echo $fonecel2;?>" maxlength="12"/></td>
  </tr>
  <tr>
    <td align="right" class="letra">Nome do Pai: </td>
    <td><input name="nomepai" type="text" id="nomepai" class="negrito" value="<? echo $nomepai;?>" size="50" onkeyup="converteUpper(this);"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="letra">Nome da M&atilde;e:</td>
    <td><input name="nomemae" type="text" id="nomemae" class="negrito" value="<? echo $nomemae;?>" size="50" onkeyup="converteUpper(this);"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="letra">Estado Civil: </td>
    <td><input name="estadocivil" type="text" id="estadocivil" class="negrito" value="<? echo $estadocivil;?>" size="15" onkeyup="converteUpper(this);"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" valign="top" class="letra">Nome Completo Conjuge: </td>
    <td valign="top"><input name="nomeconjuge" class="negrito" type="text" id="nomeconjuge" value="<? echo $nomeconjuge;?>" size="50" onkeyup="converteUpper(this);"/></td>
    <td align="right" valign="top">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="letra">Nome do Filho 1: </td>
    <td><input name="filho1" type="text" id="filho1" value="<? echo $filho1;?>" class="negrito" size="50" onkeyup="converteUpper(this);" /></td>
    <td align="right" class="letra">Data Nascimento  1: </td>
    <td>
	<input type="text" value="<? echo $data1;?>" readonly name="datanascfilho1" class="negrito" size="12"/>
		  <a onClick="displayCalendar(document.forms[0].datanascfilho1,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' tille='SELECIONE A DATA'></a>

	</td>
  </tr>
  <tr>
    <td align="right" class="letra">Nome do Filho 2: </td>
    <td><input name="filho2" type="text" id="filho2" class="negrito" value="<? echo $filho2;?>" size="50" onkeyup="converteUpper(this);" /></td>
    <td align="right" class="letra">Data Nascimento 2:</td>
    <td>
	<input type="text" value="<? echo $data2;?>" readonly name="datanascfilho2" class="negrito" size="12"/>
		  <a onClick="displayCalendar(document.forms[0].datanascfilho2,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' tille='SELECIONE A DATA'></a>
	</td>
  </tr>
  <tr>
    <td align="right" class="letra">Nome do Filho 3: </td>
    <td><input name="filho3" type="text" id="filho3" class="negrito" value="<? echo $filho3;?>" size="50" onkeyup="converteUpper(this);" /></td>
    <td align="right" class="letra">Data Nascimento 3:</td>
    <td>
	<input type="text" value="<? echo $data3;?>" readonly name="datanascfilho3" class="negrito" size="12"/>
		  <a onClick="displayCalendar(document.forms[0].datanascfilho3,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' tille='SELECIONE A DATA'></a>
	</td>
  </tr>
  <tr>
    <td align="right" class="letra">Nome do Filho 4: </td>
    <td><input name="filho4" type="text" id="filho4" class="negrito" value="<? echo $filho4;?>" size="50" onkeyup="converteUpper(this);" /></td>
    <td align="right" class="letra">Data Nascimento 4:</td>
    <td>
	<input type="text" value="<? echo $data4;?>" readonly name="datanascfilho4" class="negrito" size="12"/>
		  <a onClick="displayCalendar(document.forms[0].datanascfilho4,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' tille='SELECIONE A DATA'></a>
	</td>
  </tr>
  <tr>
    <td align="right" class="letra">Nome do Filho 5: </td>
    <td><input name="filho5" type="text" id="filho5" class="negrito" value="<? echo $filho5;?>" size="50" onkeyup="converteUpper(this);" /></td>
    <td align="right" class="letra">Data Nascimento 5:</td>
    <td>
	<input type="text" value="<? echo $data5?>" readonly name="datanascfilho5" class="negrito" size="12"/>
		  <a onClick="displayCalendar(document.forms[0].datanascfilho5,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' tille='SELECIONE A DATA'></a>
	</td>
  </tr>

  <tr>
    <td align="right" valign="top" class="letra">Foto:</td>
    <td>
	<input name="arquivo" size="52" type="file" class="negrito" />
	</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td><input name="Submit" type="submit" class="letra" id="Continuar" onClick="onClickButton(null,'Aguarde...','','Continuar')" value="Continuar" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

</table>
</form>
</fieldset>

<!--fim adm-->
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