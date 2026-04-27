<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	echo $matricula = $_GET['matricula'];
	
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataString.php");
	require ("../classes/trataArquivo.php");
	$objT = new trataArquivo;
	$conexao = new DB_mysql ;
	$objS = new trataString;

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

  <tr align="center" bgcolor="#666666">
    <th bgcolor="#666666" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->

	<fieldset>
	  <legend class="cabecalho">CONTROLE INFORMAÇÕES INSTITUCIONAL</legend>

    <table width="100%"  border="0">
      <tr>
        <td width="6%" align="center">&nbsp;</td>
        <td width="14%" align="center"><a href="javascript:POPUP('cadastro_local_trabalho.php?matricula=<? echo $matricula; ?>','750','650')"><img src="imagens/local_trabalho.png" width="60" height="60" border="0" title="ADICIONAR INFORMA&Ccedil;&Otilde;ES DO LOCAL DE TRABALHO" /></a></td>
        <td width="14%" align="center"><a href="javascript:POPUP('cadastro_notas.php?matricula=<? echo $matricula; ?>','750','650')"><img src="imagens/notas.png" width="60" height="60" border="0" title="ADICIONAR INFORMA&Ccedil;&Otilde;ES DAS NOTAS" /></a></td>
        <td width="15%" align="center"><a href="javascript:POPUP('cadastro_atividades_extras.php?matricula=<? echo $matricula; ?>','750','650')"><img src="imagens/bloco_notas.png" width="60" height="60" border="0" title="ADICIONAR ATIVIDADES EXTRAS" /></a></td>
        <td width="18%" align="center"><a href="anexar_documentos.php?matricula=<? echo $matricula; ?>"><img src="imagens/anexar.png" width="60" height="60" border="0" /></a></td>
        <td width="33%" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">Local de Trabalho</td>
        <td align="center" class="negrito">Notas</td>
        <td align="center" class="negrito">Projetos Apresentados</td>
        <td align="center" class="negrito">Anexar Documentos </td>
        <td align="center" class="negrito">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">&nbsp;</td>
        <td align="center" class="negrito">&nbsp;</td>
      </tr>
    </table>
</fieldset>
	
	<fieldset>
	<legend class="cabecalho">CADASTRO DE DOCUMENTO INSTITUCIONAL</legend>
	<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#006699">
	  <tr>
		<td width="4%" align="center" class="branco">Anexo</td>
		<td width="10%" align="center" class="branco">Matricula</td>
		<td width="86%" align="left" class="branco">Guarda</td>
	  </tr>
	</table>
	<table width="100%"  border="0" cellspacing="1" cellpadding="1">
	 <? 
	 	$path = $objT->getPath(14);
		$query = "SELECT * FROM guarda_gmf where matriclula=$matricula";
		$result = $conexao->executaQuery($query);
		while( $linha = mysql_fetch_array($result) )
		{
			$path = $objT->getPath(14).$linha['matricula']."/";
			$nomearquivo = $objT->retornaArquivo($path);
			$tamanhonomearquivo = strlen($nomearquivo);
		
			$id = $linha['id'];
			$matricula = $linha['matricula'];
			$login = $linha['login'];
			$nome = $linha['nome'];
	 ?> 
	  <tr>
		<td width="4%" align="center">
		<? if( $tamanhonomearquivo > 0 ){?>
				<A HREF="javascript:POPUP('mostrar_anexo.php?idMatricula=<?PHP echo $id; ?>','600','600')"><IMG SRC="imagens/anexo.jpg" title="Existe documentos cadastrada para este guarda" BORDER="0"></A>
		<?php }?>
		</td>
		<td width="10%" align="center"><? echo $matricula;?></td>
		<td width="86%"><a href="javascript:POPUP('cadastro_anexo_documento.php?idMatricula=<? echo $matricula; ?>','750','300')"><? echo '<font class="negrito">('.$login.'</font>) '.$nome;?></a></td>
	  </tr>
	  <?  
	  }
	  ?>
	</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>

<?php
$dir = $path;

//$dir = getenv('DOCUMENT_ROOT')."/central/controle/fotos/anexo/";//AQUI VC ALTERA O DIRETORIO 
function varre($dir,$filtro="",$nivel="")
{

   $diraberto = opendir($dir); 
   chdir($dir); 
   while($arq = readdir($diraberto)) { 
       if($arq == ".." || $arq == ".")continue; 
       $arr_ext = explode(";",$filtro);
       foreach($arr_ext as $ext) {
           $extpos = (strtolower(substr($arq,strlen($arq)-strlen($ext)))) == strtolower($ext);
           if ($extpos == strlen($arq) and is_file($arq))
               echo '<a href="#">'.$nivel.$arq."</a><br>"; 
       }
       if (is_dir($arq)) {
           echo $nivel. "<B>" .$arq."</B><br>"; 
           varre($arq,$filtro,$nivel."&nbsp;&nbsp;&nbsp;&nbsp;"); 
       }
   }
   chdir(".."); 
   closedir($diraberto); 
}

varre("$dir");

                ?>	
	</td>
  </tr>
</table>

	</fieldset>
	<!--fim adm-->
    </td>
  </tr>
</table>
</body>
</html>
