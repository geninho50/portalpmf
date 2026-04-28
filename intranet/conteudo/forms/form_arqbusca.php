<script>
function verificaForm(){
	document.getElementById('Fdata1').disabled=false;
	document.getElementById('Fdata2').disabled=false;
}
</script>
<?php
if(isset($_POST['btInclui_x'])){
	$Tpagina  = $_GET['idPag'];
	$TarqId	  = $_POST['idArq'];
	$sqlOrd   = "SELECT * FROM intranet_pagina_arquivos WHERE intranet_arqpagina_pag_id = ".$_GET['idPag']."";
	$TredOrd  = $drive->pedido($sqlOrd);
	$TarqOrd  = pg_num_rows($TredOrd);
	$Tordem   = $TarqOrd + 1;
	$sqlArq1  = "INSERT INTO 
					intranet_pagina_arquivos(
						intranet_arqpagina_id, 
						intranet_arqpagina_pag_id,
						intranet_arqpagina_arq_id,
						intranet_arqpagina_ordem
				)VALUES(
					default, 
					$Tpagina,
					$TarqId,
					$Tordem)";

	$TretArq  = $drive->pedido($sqlArq1);
	
	if ($TretArq == true){
		echo"<script>alert(\"Arquivo incluido com Sucesso!\");</script>";			
		echo("<script>window.location = \"?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=arquivos&sb=buscar\";</script>");
	}else{		
		echo"<script>alert(\"Não foi possível incluir o Arquivo.\");</script>";
		echo("<script>window.location = \"?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=arquivos&sb=buscar\";</script>");
	}
}
?>
<h1>Localizar Arquivo do repositório de Mídia </h1>
<div class="container_1">
	<form method="post" onsubmit="return verificaForm()">
	palavra-chave: <br>   
    <?php 
	if($_GET['Gtags'] == ""){$Ttags = $_POST['Ftags'];}else{$Ttags = $_GET['Gtags'];}//recupera tags 
					
	// recupera datas
	if($_GET['dti'] == ""){
		$Tdti = $_POST['Fdata1'];
		$Tdtf = $_POST['Fdata2'];
	}else{
		$Tdti = $_GET['dti'];
		$Tdtf = $_GET['dtf'];
	}
		
	?>
	
	<input type="text" id="Ftags" name="Ftags" class="ui-widget-content ui-corner-all" value="<?=$Ttags?>"/>De espa&ccedil;o ap&oacute;s cada palavra, mesmo que seja apenas uma.<br /><br />
	período:<br>
	<input name="Fdata1" id="Fdata1" type="text" class="componente_miolo_menor" disabled="disabled" value="<?=$Tdti?>" />
    <a id="calendar-trigger"><img  align="absmiddle" src="../layout/imagens/atualiza_btn_calendario.jpg" border="0"/></a>
    
    <script>
        Calendar.setup({					
            inputField : "Fdata1",						 
            trigger    : "calendar-trigger",
            onSelect   : function() { this.hide() }
        });
    </script>
    &nbsp;at&eacute;&nbsp; 
    <input name="Fdata2" id="Fdata2" type="text" class="componente_miolo_menor" disabled="disabled" value="<?=$Tdtf?>"/>
    <a id="calendar-trigger-2"><img  align="absmiddle" src="../layout/imagens/atualiza_btn_calendario.jpg" border="0"/></a>
        
    <script>
        Calendar.setup({					
            inputField : "Fdata2",						 
            trigger    : "calendar-trigger-2",
            onSelect   : function() { this.hide() }
        });
    </script>
    <br /><br />
	<input type="image" src="../layout/imagens/intra_btn_localizar.png" align="absmiddle" name="btLoc" id="btLoc" value="btLoc" /> 
	</form>
</div>
<br><br><br>
<?php 
	require_once("../scripts/php/funcoes.php");
	require_once("../scripts/php/paginacao.php");			
	
	$TidEntidade = $_SESSION['SuserEnt'];

	if(!isset($_GET['pg'])){
		$pg = 1;
	}else{
		$pg = $_GET['pg'];	
	}	
	$inicio = ($pg * 10) - 10; 

if(!isset($_POST['btLoc_x'])){	
	$numSql   = "SELECT COUNT(*) FROM arquivos WHERE arq_entidade_id = $TidEntidade";
	$arqSql   = "SELECT * FROM arquivos WHERE arq_entidade_id = $TidEntidade ORDER BY arq_nome LIMIT 10 OFFSET $inicio";
	$Tcaminho = "?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=arquivos&sb=buscar";
}else{
	//-----------------------------------------
	// busca por TAGS
	//-----------------------------------------
	if(($_POST['Ftags'] != "") && ($_POST['Fdata2'] == "") or ($_GET['Gtags'] != "")  && ($_GET['dtf'] == "")){	
		if($_GET['Gtags'] == ""){$Ttags = $_POST['Ftags'];}else{$Ttags = $_GET['Gtags'];}
		$TarrayTags  = $drive->arrayTags("arq_palavra_chave", $Ttags); 
		$numSql   	 = "SELECT COUNT(*) FROM arquivos WHERE arq_entidade_id = $TidEntidade AND $TarrayTags";
		$arqSql  	 = "SELECT * FROM arquivos WHERE arq_entidade_id = $TidEntidade AND $TarrayTags ORDER BY arq_nome ASC LIMIT 10 OFFSET $inicio";		
		$Tcaminho	 = "?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=arquivos&sb=buscar&Gtags=".$Ttags."";
	}else
	//--------------------------------------------------
	// busca personalizada, pesquisa intervalo de datas
	//--------------------------------------------------
	if(($_POST['Fdata2'] != "") && ($_POST['Ftags'] == "") or ($_GET['dtf'] != "")  && ($_GET['Gtags'] == "")){
		if($_GET['dti'] == ""){
			$TdataInicio = inverteDate($_POST['Fdata1']);
			$Tdti = $_POST['Fdata1'];
			$TdataFinal = inverteDate($_POST['Fdata2']);
			$Tdtf = $_POST['Fdata2'];
		}else{
			$TdataInicio = inverteDate($_GET['dti']);
			$Tdti = $_GET['dti'];
			$TdataFinal = inverteDate($_GET['dtf']);
			$Tdtf = $_GET['dtf'];
		}

		$numSql   	 = "SELECT COUNT(*) FROM arquivos WHERE arq_entidade_id = $TidEntidade AND arq_data >= '$TdataInicio' AND arq_data <= '$TdataFinal'";
		$arqSql  	 = "SELECT * FROM arquivos WHERE arq_entidade_id = $TidEntidade AND arq_data >= '$TdataInicio' AND arq_data <= '$TdataFinal' ORDER BY arq_data ASC LIMIT 10 OFFSET $inicio";				
		$Tcaminho 	 = "?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=arquivos&sb=buscar&dti=".$Tdti."&dtf=".$Tdtf."";
	}
	else 
	//--------------------------------------------------
	// busca por ambos, tags e data
	//---------------------------------------------------			
	if((($_POST['Ftags'] != "") or ($_GET['Gtags'] != "")) && (($_POST['Fdata2'] != "") or ($_GET['dtf'] != "")))
	{
		if($_GET['dti'] == ""){
			$TdataInicio = inverteDate($_POST['Fdata1']);
			$Tdti = $_POST['Fdata1'];
			$TdataFinal = inverteDate($_POST['Fdata2']);
			$Tdtf = $_POST['Fdata2'];
		}else{
			$TdataInicio = inverteDate($_GET['dti']);
			$Tdti = $_GET['dti'];
			$TdataFinal = inverteDate($_GET['dtf']);
			$Tdtf = $_GET['dtf'];
		}
		if($_GET['Gtags'] == ""){$Ttags = $_POST['Ftags'];}else{$Ttags = $_GET['Gtags'];}
			$TarrayTags  	= $drive->arrayTags("arq_palavra_chave", $Ttags);
			$numSql			= "SELECT COUNT(*) FROM arquivos WHERE arq_entidade_id = $TidEntidade AND $TarrayTags AND arq_data >= '$TdataInicio' AND arq_data <= '$TdataFinal'";
			$arqSql			= "SELECT * FROM arquivos WHERE arq_entidade_id = $TidEntidade AND $TarrayTags AND arq_data >= '$TdataInicio' AND arq_data <= '$TdataFinal' ORDER BY arq_data DESC LIMIT 10 OFFSET $inicio";
			$Tcaminho		= "?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=arquivos&sb=buscar&dti=".$Tdti."&dtf=".$Tdtf."&Gtags=".$Ttags.""; 
	}			
}
// ------------------------------------------------------------------
	$TreturnSqlArq = $drive->pedido($arqSql);
	$TreturnSqlNum = $drive->pedido($numSql);
?>
<h1>Resultados Encontrados: </h1>
<table width="510" border="0" cellspacing="0" cellpadding="0">
	
	<?php
    $i = 0;
    while($Tarq = pg_fetch_object($TreturnSqlArq)){
    echo"
	<form method=\"post\">	
	<input type=\"hidden\" name=\"idArq\" value=\"".$Tarq->arq_id."\" />
    <tr>
		<td width=\"330\" class=\"result_busca_admB\"><strong>".$Tarq->arq_nome."</strong></td>
		<td width=\"180\" class=\"result_busca_admB\"
			<input type=\"image\" src=\"../layout/imagens/atualiza_btn_incluir2.png\" name=\"btInclui\" id=\"btInclui\" value=\"btInclui\"align=\"absmiddle\" />
            <a href=\"../".$Tarq->arq_link."\">
			<img src=\"../layout/imagens/atualiza_btn_download3.png\" border=\"0\" align=\"absmiddle\" />   
			</a> 
		</td>
	</tr>
	</form>";
	$i++;
	}
	if($i == 0){
		echo "<b>Nenhum Arquivo encontrado.</b>";	
	}
	?>   
</table>
<br class="clearfloat">
<div id="area_paginacao">
<?php
if($i != 0){
// ========================= imprime numumero de paginas rodapé  ========================
	$numPagTotal = pg_fetch_object($TreturnSqlNum);
	echo "<p align=\"center\">";
	$TnumPag = $numPagTotal->count;
	if($TnumPag < 10){
		$TnumPag = 10;
	}
	mostra_paginas($TnumPag, $_GET['pg'], $Tcaminho, 10);
	echo "<p>";				
// ========================= fim imprime num de páginas  =========================
}	
?>
</div>