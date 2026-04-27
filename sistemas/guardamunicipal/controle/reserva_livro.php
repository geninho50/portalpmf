<?php
	// Este primeiro header, corrigi o problema de acentuação dos caracteres.
header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$result = $obj->executaQuery($sql);
	$linhaS = mysql_fetch_array($result);
	if( $linhaS )
	{
		$login = $linhaS["login"];
		$matricula = $linhaS["matricula"];
	}
	
	$idLivro =  (int)$_POST['idLivro'];
	if( $idLivro == 0 )
    {
       $idLivro = (int)$_GET['idLivro'];
    }
	
	if( $idLivro > 0 )
	{		
		$query = "SELECT * FROM livros where id=$idLivro";
		$resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");	
		$linha = mysql_fetch_array($resultado);
		
		$id = 0;
		$codigo = 0;
		$titulo = "";
		
		if( $linha )
		{
			$id = $linha["id"];
			$codigo = $linha["codigo"];
			$titulo = $linha["titulo"];
			
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
			include("menu.php");
	?>
	</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	<fieldset>
	<legend class="negrito">Reserva de Livros</legend>
<form name="form1" method="post" action="../classes/controleReservaLivro.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<table width="80%" border="0" cellspacing="1" cellpadding="1">

 <tr>
    <td width="19%" align="right" class="letra">Atendente:<FONT COLOR="#FF0033">*</FONT></td>
    <td width="81%"><input name="matricula" type="text" id="matricula" value="<?echo $matricula;?>" size="8" readonly/>
    <input name="login" type="text" id="login" value="<?echo $login;?>" size="30" readonly /></td>
 </tr>
 <tr>
   <td align="right" class="letra">&nbsp;</td>
   <td>&nbsp;</td>
 </tr>
 <tr>
    <td width="19%" align="right" class="letra">C&oacute;digo:<FONT COLOR="#FF0033">*</FONT></td>
    <td width="81%"><input name="codigo" type="text" id="codigo" value="<?echo $codigo;?>" size="20" maxlength="6" readonly/></td>
 </tr>
 <tr>
    <td width="19%" align="right" class="letra">T&iacute;tulo:<FONT COLOR="#FF0033">*</FONT></td>
    <td width="81%"><input name="titulo" type="text" id="titulo" value="<?echo $titulo;?>" size="70" readonly/></td>
 </tr>
 <tr>
   <td height="24" align="right" class="letra">Guarda:<font color="#FF0033">*</font></td>
   <td><select name="ylogin">
			  <option value="0">Selecionar...</option>
			  <?php 
				$queryU = "SELECT * FROM guarda_gmf order by login";
				$resultadoU = $obj->executaQuery($queryU);
				while($linhaU = mysql_fetch_array($resultadoU))
				{
					$log = $linhaU['login'];
			  ?>
						 <option value="<?php echo $log; ?>"><?php echo $log; ?></option>
			  <?php 
				} 
	  		  ?>
	    </select>
	</td>
 <tr>
   <td height="24" align="right" class="letra">Data da reserva:<FONT COLOR="#FF0033">*</FONT></td>
   <td>
   <input type="text" value="<? echo $dataini;?>" readonly name="dataini" class="stylo1" size="12"/>
  	  <a onClick="displayCalendar(document.forms[0].dataini,'yyyy-mm-dd',this)"> <img  src="images/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a>   
   </td>

 <INPUT TYPE="hidden" NAME="id" value="<?echo $id;?>">	

<?php
	$tamanhoadministrador = strlen($administrador);
	$tamanhonoticia = strlen($noticia);
	$tamanhoeducacao = strlen($educacao);
	$tamanhocomando = strlen($comando);
	$tamanhoguardas = strlen($guardas);
?>

	
 <tr height="2">
    <td align="left" class="letra" colspan="2">&nbsp;</td>
  </tr>

  <tr>	
    <td align="right">
    <td><input name="Submit" type="submit" id="Confirmar" class="botao" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />
	</td>
  </tr>
</table>

</form>
</fieldset>
	<!--fim adm-->
	</td>
  </tr>
</table>



</body>
</html>