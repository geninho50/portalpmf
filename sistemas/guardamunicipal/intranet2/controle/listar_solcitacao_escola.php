<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataArquivo.php");
	$objT = new trataArquivo;
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();

	$idEscola = $_POST['idEscola'];
	$ano = $_POST['yano'];
	if( $idEscola == 0 )
	{
		$idEscola = $_GET['idEscola'];
		$ano = $_GET['yano'];
	}
	
	$nvaloresencontrados = 0;	
	$query = "SELECT * FROM escolas where id=$idEscola order by nome asc";
	if( $idEscola > 0 )
	{
		$nvaloresencontrados = $obj->numregistros($query);
	}
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultado = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$login = $linha["login"];
	}
	
	   //Pega a data atual
   $data_atual = date("Y-m-d");
   // Pega o ano da variavel $data_atual
   $ano_atual = substr($data_atual,0,4);
   // Pega o m�s da variavel $data_atual
   $mes_atual = substr($data_atual,5,2);
   // Pega o dia da variavel $data_atual
   $dia_atual = substr($data_atual,8,2);
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<head>

<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->

</head>

<body> 
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100%" colspan="2">
	<!-- inicio do adm -->
		<?php
			if( $nvaloresencontrados > 0 )
			{
		?>
		<fieldset>
			<legend class="cabecalho">RESULTADO <B><?echo $nvaloresencontrados;?></B> PARA <?echo $xBusca;?></legend>
		
		<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
			<tr>
				<td width="85%" align="left" class="branco"><B>Nome da Escola</B></td>				
				<td width="15%" align="center" class="branco">Ocorrencias</td>
			</tr> 
		</table>
		
		<table width="100%" border="0" cellspacing="1" cellpadding="1">
		<?php
			$chavet = true;
			$resultado = $obj->executaQuery($query);
			
			$path = $objT->getPath(10);
			
			while ( $linha = mysql_fetch_array($resultado) )
			{
				// Path onde as Noticias sao cadastradas
				$path = $objT->getPath(10).$linha['id']."/";
				$nomearquivo = $objT->retornaArquivo($path);
				$tamanhonomearquivo = strlen($nomearquivo);
				
				$id = $linha['id'];
				
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

				<td width="85%" align="left" class="negrito"><? echo $linha['nome']; ?></td>		
				<td width="15%" class="letra" align="center"><A HREF="cadastro_ocorrencia_escola.php?idEscola=<? echo $linha['id']; ?>" border="0"><IMG SRC="imagens/editor_texto.png" WIDTH="20" HEIGHT="20" BORDER="0" title="ADICIONAR SOLITACAO PARA A ESCOLA"></A></td>
			</tr>
		<?php
			}
		?>
		</table>
</fieldset>
		<?php
			}

		
		?>
    	<form name="form" action="listar_solcitacao_escola.php" method="post" enctype="multipart/form-data"  onSubmit="return validaFormAll(this,'Consultar','Consultar')">
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="5%">&nbsp;</td>
            <td width="5%"><input name="idEscola" type="text" class="codigo" id="idEscola" value="<? echo $idEscola;?>" size="2" readonly="readonly"/></td>
            <td width="15%" align="left">
            <select name="yano" class="negrito">
                  <option value="0">SELECIONAR ANO...</option>
                  <option value="2013">2013</option>
                  <option value="2014">2014</option>
                  <option value="2015">2015</option>
                  <option value="2016">2016</option>
                  <option value="2017">2017</option>
                  <option value="2018">2018</option>
                  <option value="2019">2019</option>
                  <option value="2020">2020</option>
             </select>
            </td>
            <td width="75%"><input name="Submit" type="submit" class="letra" id="Consultar" onClick="onClickButton(null,'Aguarde...','','Consultar')" value="Consultar" /></td>
          </tr>
        </table>

        
        <fieldset>
			<legend class="cabecalho">OCORRÊNCIA</legend>
            <table width="100%" border="1" bordercolor="#999999" cellspacing="1" cellpadding="1" style="border-collapse:collapse">
            	<tr>
					<td width="10%" bgcolor="#CCCCCC" align="left" class="negrito"><B> Ano <? echo $ano;?></B></td>
                    <td width="90%" align="center" class="branco">
        <?
					$query = "SELECT * FROM solicitacaoescola where year(data_cadastro)=$ano and escola=$idEscola order by year(data_cadastro) asc";
					$resultado = $obj->executaQuery($query);
					while ( $linhaM = mysql_fetch_array($resultado) )
					{
		?>
                   		<table width="100%">
                   			 <tr>
                                <td bgcolor="#CCCCCC" width="91%" align="left" class="negrito" title="VIZUALIZAR A OCORRÊNCIA">
                                <A HREF="javascript:POPUP('imprimir_ocorrencia_escola.php?idEscola=<? echo $idEscola;?>','700','300')"><? echo $linhaM['tipo']; ?> -- <? echo $linhaM['data_cadastro']; ?></A></td>
                                <td bgcolor="#CCCCCC" width="9%" align="center" class="negrito"><a href="cadastro_arquivo_escola.php?id=<? echo $linhaM['id'];?>"><img src="imagens/anexar.png" width="21" height="21" border="0" title="ADICIONAR DOCUMENTO A OCORRÊNCIA"></a></td>				
                             </tr>
		<?
							// Path onde as Noticias sao cadastradas
							$path = $objT->getPath(10).$linhaM['id']."/";
							$nomearquivo = $objT->retornaArquivo($path);
							$tamanhonomearquivo = strlen($nomearquivo);
							$dh = opendir($path); 
							while (false !== ($filename = readdir($dh))) { 
								if (substr($filename,-4) == ".pdf" || substr($filename,-4) == ".jpg") {
		?>
                                <tr>
                                    <td width="91%" align="left" class="negrito">
                                      <li> <A HREF="javascript:POPUP('fotos/escola/<? echo $linhaM['id']; ?>/<?PHP echo $filename; ?>','600','600')"><? echo $filename; ?><? echo $tipo; ?></A></li>
                 					</td>	
                				</tr>
        <?
               					}
							}
		?>
        				</table>
        <? 
					}
		?>
           	 	  </td>				
				</tr>
             </table>

        </fieldset>
        </form>
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