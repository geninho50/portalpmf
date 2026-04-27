<script>
function verificaExclusao(){
	if(confirm('Tem certeza que deseja Excluir a página?')){
		return true;
	}else{
		return false;
	}
}

function verificaForm(){
	document.getElementById('Fdata1').disabled=false;
	document.getElementById('Fdata2').disabled=false;
}
</script>
<form method="post" onsubmit="return verificaForm()">
<div id="conteudo_localizar">
	<?php
    // ---------- recupera titulo ----------
	if($_GET['Gtit'] == ""){
		$Ttitulo = $_POST['Ftitulo'];
	}else{
		$Ttitulo = $_GET['Gtit'];
	} 
	
	// ---------- recupera datas ----------
	if($_GET['dti'] == ""){
		$Tdti = $_POST['Fdata1'];
		$Tdtf = $_POST['Fdata2'];
	}else{
		$Tdti = $_GET['dti'];
		$Tdtf = $_GET['dtf'];
	}
	?>
    Utilize as opções abaixo para acesar as p&aacute;ginas cadastradas. Faça a pesquisa por per&iacute;odo ou t&iacute;tulo da p&aacute;gina desejada. <br />
	<div class="texto_formulario">Período:</div>
	<input name="Fdata1" id="Fdata1" type="text" class="componente_miolo_menor" disabled="disabled" value="<?=$Tdti?>" />
	<a id="calendar-trigger"><img  align="absmiddle" src="../layout/imagens/atualiza_btn_calendario.jpg" border="0"/></a>
	
	<script>
		Calendar.setup({					
			inputField : "Fdata1",						 
			trigger    : "calendar-trigger",
			onSelect   : function() { this.hide() }
		});
	</script>
	a 
	<input name="Fdata2" id="Fdata2" type="text" class="componente_miolo_menor" disabled="disabled" value="<?=$Tdtf?>" />
	<a id="calendar-trigger2"><img  align="absmiddle" src="../layout/imagens/atualiza_btn_calendario.jpg" border="0"/></a>
	
	<script>
		Calendar.setup({					
			inputField : "Fdata2",						 
			trigger    : "calendar-trigger2",
			onSelect   : function() { this.hide() }
		});
	</script>
	
	<div class="texto_formulario">Título da Página:</div>
	<input name="Ftitulo" type="text" class="componente_miolo" maxlength="100" value="<?=$Ttitulo?>" /><br>

	<br>
	<input type="image" src="../layout/imagens/intra_btn_localizar.png" name="btLoc" id="btLoc" value="btLoc" />         
</div>
</form>
</div>
<div class="container_5">
<?php 
if (isset($_POST['btLoc_x'])){
	require_once("../scripts/php/funcoes.php");
	require_once("../scripts/php/paginacao.php");
	$TentId  = $_SESSION['SuserEnt'];
	
	//-------------------------
	// controle de paginação
	//-------------------------
	if(!isset($_GET['pg'])){
		$pg = 1;
	}else{
		$pg = $_GET['pg'];	
	}	
	$inicio = ($pg * 10) - 10; 
	
	if(empty($_POST['Ftitulo'])){
	
		if($_GET['dti'] == ""){
			$TdataInicio = inverteDate($_POST['Fdata1']);
			$Tdti 		 = $_POST['Fdata1'];
			$TdataFinal  = inverteDate($_POST['Fdata2']);
			$Tdtf 	  	 = $_POST['Fdata2'];
		}else{
			$TdataInicio = inverteDate($_GET['dti']);
			$Tdti 		 = $_GET['dti'];
			$TdataFinal  = inverteDate($_GET['dtf']);
			$Tdtf 		 = $_GET['dtf'];
		}

		$numSql   = "SELECT COUNT(*) FROM intranet_pagina WHERE intranet_pagina_data >= '$TdataInicio' AND intranet_pagina_data <= '$TdataFinal'";
		$sqlLoc   = "SELECT * FROM intranet_pagina WHERE intranet_pagina_data >= '$TdataInicio' AND intranet_pagina_data <= '$TdataFinal' ORDER BY intranet_pagina_data ASC LIMIT 10 OFFSET $inicio";	
		$Tcaminho = "?pagina=pagcad&menu=".$_GET['menu']."&aba=localizar&dti=".$Tdti."&dtf=".$Tdtf."";
	}else{
		$Ttitulo  = $_POST['Ftitulo'];
		$numSql   = "SELECT COUNT(*) FROM intranet_pagina WHERE intranet_pagina_titulo ILIKE '%$Ttitulo%'";
		$sqlLoc   = "SELECT * FROM intranet_pagina WHERE intranet_pagina_titulo ILIKE '%$Ttitulo%' ORDER BY intranet_pagina_titulo ASC LIMIT 10 OFFSET $inicio";	
		$Tcaminho = "?pagina=pagcad&menu=".$_GET['menu']."&aba=localizar&Gtit=".$Ttitulo."";
	}			
	
	$Treturn = $drive->pedido($sqlLoc);
	$TreturnSqlNum = $drive->pedido($numSql);
	
?>
	<div class="tag_result_busca">resultados da busca</div>
		<div class="container_2">  
			
			<?php
			$i=0;
			while($Tloc = pg_fetch_object($Treturn)){
			
			echo"
				<form method=\"post\">
				<input type=\"hidden\" name=\"idPagina\" value=\"".$Tloc->intranet_pagina_id."\" />
				<div class=\"container_item_result\">
					<span class=\"titulo_linkserv\">".$Tloc->intranet_pagina_titulo."</span><br>
						".substr($Tloc->intranet_pagina_texto, 0, 150)." ...               
					<br />
					<a href=\"inicio.php?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$Tloc->intranet_pagina_id."\"><img src=\"../layout/imagens/atualiza_btn_editar.png\" alt=\"editar\" width=\"50\" height=\"18\" border=\"0\" align=\"absmiddle\" /></a>
					<input type=\"image\" src=\"../layout/imagens/atualiza_btn_excluir.png\" name=\"btExc\" id=\"btExc\" value=\"btExc\" align=\"absmiddle\" onclick=\"return verificaExclusao()\" />
				</div>
				</form>";
			$i++;
			}                                                                                          
			?>
			<br>
            <?php
            if($i != 0){
                //-------------------------------------- 
                // imprime numumero de paginas rodapé  
                //--------------------------------------
                $numPagTotal = pg_fetch_object($TreturnSqlNum);
                echo "<p align=\"center\">";
                $TnumPag = $numPagTotal->count;
                if($TnumPag < 10){
                    $TnumPag = 10;
                }
                mostra_paginas($TnumPag, $_GET['pg'], $Tcaminho, 10);
                echo "<p>";				
            }
			?>
		
	</div>
<?php
}

if(isset($_POST['btExc_x'])){
//------------------------------
// exclui a página
//------------------------------

	$TidPag		= $_POST['idPagina'];

	//------------------------------
	// Verifica arquivos
	//------------------------------ 
	
	$sqlArqPes 	= "SELECT * FROM intranet_pagina_arquivos WHERE intranet_arqpagina_pag_id = $TidPag";
	$TreturnArq = $drive->pedido($sqlArqPes); 
	
	while($TverArq = pg_fetch_object($TreturnArq)){
		$TarqId	   = $TverArq->intranet_arqpagina_id;
		$sqlDelArq = "DELETE FROM intranet_pagina_arquivos WHERE intranet_arqpagina_id = $TarqId";
		$TretDel   = $drive->pedido($sqlDelArq);
	}
	
	//------------------------------
	// Verifica imagens
	//------------------------------ 
	
	$sqImgPes 	= "SELECT * FROM intranet_pagina_imagens WHERE intranet_imgpagina_pag_id = $TidPag";
	$TreturnImg = $drive->pedido($sqImgPes); 
	
	while($TverImg = pg_fetch_object($TreturnImg)){
		$TimgId	   = $TverImg->intranet_imgpagina_id;
		$sqlDelImg = "DELETE FROM intranet_pagina_imagens WHERE intranet_imgpagina_id = $TimgId";
		$TretDel   = $drive->pedido($sqlDelImg);
	}
	
	//------------------------------
	// Verifica midias
	//------------------------------ 
	
	$sqlMidPes 	= "SELECT FROM intranet_pagina_midias WHERE intranet_midpagina_pag_id = $TidPag";
	$TreturnMid = $drive->pedido($sqlMidPes); 
	
	while($TverMid = pg_fetch_object($TreturnMid)){
		$TmidId	   = $TverMid->intranet_arqpagina_id;
		$sqlDelMid = "DELETE FROM intranet_pagina_midias WHERE intranet_midpagina_id = $TmidId";
		$TretDel   = $drive->pedido($sqlDelMid);
	}
	
	$sqlExcPag 	= "DELETE FROM intranet_pagina WHERE intranet_pagina_id = $TidPag";
	$TretDel    = $drive->pedido($sqlExcPag);
	
	if($TretDel){
		echo("<script>alert('Página Excluida com Sucesso!')</script>");
		echo("<script>window.location = \"inicio.php?pagina=pagcad&menu=".$_GET['menu']."&aba=localizar\"</script>");
	}else{	
		echo("<script>alert('Não Foi Possível Excluir a Página!\\n\\nErro no Servidor, tente novamente mais tarde.')</script>");
		echo("<script>window.location = \"inicio.php?pagina=pagcad&menu=".$_GET['menu']."&aba=localizar\"</script>");
	}
}
?>	