<?php
   
   // Este primeiro header, corrigi o problema de acentuação dos caracteres.
	header('Content-Type: text/html; charset=iso-8859-1');
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
   include("incValidaSessao.php");
   $idsession = $_SESSION['idSESSION'];

   $id = (int)$_GET['id'];

   
   require ("../classes/DB_mysql.php");
   $obj = new DB_mysql;
   $conexao = $obj->conectarConf();
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
  <tr>
    <td>
	<!-- inicio do adm -->
	<fieldset>
	<legend class="negrito">Desmonstrativo das horas realisadas</legend>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
	  <tr>
		<td width="45%" align="left" valign="top">
			
			<form name="form1" action="../classes/controleAlterarNivel.php" method="post" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
			<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8"  >
              <tr>
                <td width="10%" align="left" class="branco">&nbsp;</td>
                <td width="30%" align="left" class="branco"><b>Nome</b></td>
                <td width="20%" align="center" class="branco"><b>Valor</b></td>
                </tr>
            </table>
			<?
						$query = "SELECT * from nivel where id=$id order by id asc";
						$result = $obj->executaQuery($query);
						while($linha = mysql_fetch_array($result)){
							$id = $linha['id'];
							$nome = $linha['nome'];
							$valor = $linha['valor'];
			?>
				<table width="100%" border="0" cellpadding="1" cellspacing="1">
								<tr bgColor="#FFFFFF" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#FFFFFF'">
				 				 <td width="10%"><input name="id" type="text" value="<?php echo $id; ?>" size="4" readonly="readonly"/td>
                                 <td width="30%" class="negrito" align="center"><?php echo $nome; ?></td>
								 <td width="20%" align="center"><input name="valor" type="text" value="<?php echo $valor; ?>" size="8"/></td>
							    </tr>
			  </table>
			<?
						}
			?>
            <table width="50%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="20%">&nbsp;</td>
                <td width="80%" align="left"><input name="Confirmar" type="submit" class="botao" id="Confirmar" onclick="onClickButton(null,'Aguarde...','','Continuar')" value="Confirmar" /></td>
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