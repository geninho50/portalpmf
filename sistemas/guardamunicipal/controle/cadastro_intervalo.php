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

	$query = "SELECT * FROM intervalo";
	$resultado = $obj->executaQuery($query);
	$linha = mysql_fetch_array($resultado);
	if( $linha > 0 )
	{
		$id = $linha["id"];
		$chave = $linha['chave'];
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
	<legend class="negrito">Cadastro Intervalo </legend>
	<form name="form1" method="post" action="../classes/controleIntervalo.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
	<table width="83%" height="53" border="0" cellpadding="1" cellspacing="1">

	 <tr>
	   <td width="21%" height="24" align="right" class="letra">Vizualizar:</td>
	   <td width="79%" align="left" valign="top" class="negrito">
	   <? 
		   if($chave==2)
		   {
	   ?>
	   			<input name="chave" type="checkbox" value="1">&nbsp;Habilitar
		<? 
			}else{ 
				if($chave==1)
				{
		?>
					<input name="chave" type="checkbox" value="2">&nbsp;Desabilitar
		<? 
				}
			}
		?>
		</td>
	 </tr>
	
	 <INPUT TYPE="hidden" NAME="id" value="<?echo $id;?>">	
	  <tr>
	    <td align="right">Data:      
	    <td>
		 <input type="text" value="<? echo $dataini;?>" readonly name="dataini" class="letra" size="12"/>
		  <a onClick="displayCalendar(document.forms[0].dataini,'yyyy-mm-dd',this)"> <img  src="images/calendario.gif" width='16' height='16' border='0' tille='Selecione a Data'></a>   
		</td>
	    </tr>
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
