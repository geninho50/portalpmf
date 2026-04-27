<script>
function verificaForm(){
	document.getElementById('Fdata1').disabled=false;
	document.getElementById('Fdata2').disabled=false;
}
</script>
<?php
if(isset($_POST['btInclui_x'])){

	$Tpagina  = $_GET['idPag'];
	$TimgId   = $_POST['idImg'];
	$Tprinc	  = 0;
	$sqlImg1  = "INSERT INTO 
					intranet_pagina_imagens(
						intranet_imgpagina_id, 
						intranet_imgpagina_pag_id,
						intranet_imgpagina_img_id,
						intranet_imgpagina_principal
				)VALUES(
					default, 
					$Tpagina,
					$TimgId,
					'$Tprinc')";
	
	$TretImg  = $drive->pedido($sqlImg1);

	if ($TretImg == true){
		echo"<script>alert(\"Imagem incluida com Sucesso!\");</script>";			
		echo("<script>window.location = \"?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=imagens&sb=buscar\";</script>");
	}else{		
		echo"<script>alert(\"Não foi possível incluir a Imagens.\");</script>";
		echo("<script>window.location = \"?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=imagens&sb=buscar\";</script>");
	}
}
?>
<h1>Localizar Imagem do repositório de Mídia </h1>
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
	
	<input  type="text" id="Ftags" name="Ftags" class="ui-widget-content ui-corner-all" value="<?=$Ttags?>"/>De espa&ccedil;o ap&oacute;s cada palavra, mesmo que seja apenas uma.<br /><br />
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
	<input type="image" src="../layout/imagens/intra_btn_localizar.png" align="absmiddle" name="btLoc" id="btLoc" value="btLoc"/> 
	</form>
</div>
<?php
require_once("../scripts/php/funcoes.php");
require_once("../scripts/php/paginacao.php");			

$TidEntidade = $_SESSION['SuserEnt'];

if(!isset($_GET['pg'])){
	$pg = 1;
}else{
	$pg = $_GET['pg'];	
}	
$inicio = ($pg * 12) - 12;

if(!isset($_POST['btLoc_x'])){
	$numSql   = "SELECT COUNT(*) FROM imagens WHERE img_entidade_id = $TidEntidade";
	$imgSql   = "SELECT * FROM imagens WHERE img_entidade_id = $TidEntidade ORDER BY img_data DESC LIMIT 12 OFFSET $inicio";
	$Tcaminho = "?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=imagens&sb=buscar";	
}else{
	//-----------------------------------------
	// busca por TAGS
	//-----------------------------------------
	if(($_POST['Ftags'] != "") && ($_POST['Fdata2'] == "") or ($_GET['Gtags'] != "")  && ($_GET['dtf'] == "")){	
		if($_GET['Gtags'] == ""){$Ttags = $_POST['Ftags'];}else{$Ttags = $_GET['Gtags'];}
		$TarrayTags  = $drive->arrayTags("img_palavra_chave", $Ttags); 
		$numSql   	 = "SELECT COUNT(*) FROM imagens WHERE img_entidade_id = $TidEntidade AND $TarrayTags";
		$imgSql  	 = "SELECT * FROM imagens WHERE img_entidade_id = $TidEntidade AND $TarrayTags ORDER BY img_data DESC LIMIT 12 OFFSET $inicio";		
		$Tcaminho	 = "?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=imagens&sb=buscar&Gtags=".$Ttags."";
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
	
		$numSql   	 = "SELECT COUNT(*) FROM imagens WHERE img_entidade_id = $TidEntidade AND img_data >= '$TdataInicio' AND img_data <= '$TdataFinal'";
		$imgSql  	 = "SELECT * FROM imagens WHERE img_entidade_id = $TidEntidade AND img_data >= '$TdataInicio' AND img_data <= '$TdataFinal' ORDER BY img_data DESC LIMIT 12 OFFSET $inicio";				
		$Tcaminho 	 = "?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=imagens&sb=buscar&dti=".$Tdti."&dtf=".$Tdtf."";
	}		
	else 
	//--------------------------------------------------
	// busca por ambos, tags e data
	//---------------------------------------------------			
	if((($_POST['Ftags'] != "") or ($_GET['Gtags'] != "")) && (($_POST['Fdata2'] != "") or ($_GET['dtf'] != "")))
	{
		if($_GET['Tdti'] == ""){
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
			$TarrayTags  	= $drive->arrayTags("img_palavra_chave", $Ttags);
			$numSql			= "SELECT COUNT(*) FROM imagens WHERE img_entidade_id = $TidEntidade AND $TarrayTags AND img_data >= '$TdataInicio' AND img_data <= '$TdataFinal'";
			$imgSql			= "SELECT * FROM imagens WHERE img_entidade_id = $TidEntidade AND $TarrayTags AND img_data >= '$TdataInicio' AND img_data <= '$TdataFinal' ORDER BY img_data DESC LIMIT 10 OFFSET $inicio";
			$Tcaminho		= "?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=imagens&sb=buscar&dti=".$Tdti."&dtf=".$Tdtf."&Gtags=".$Ttags.""; 
	}								
}
//--------------------------------------------------------------------
$TreturnSqlImg = $drive->pedido($imgSql);
$TreturnSqlNum = $drive->pedido($numSql)
?>
<br><br><br>
<h1>Resultados Encontrados:</h1>

<div id='pagePequenaBotao2'>
	<div id='imagesPequenaBotao2'>
    	<ul class='galleryPequenaBotao2'>
			<?php
			$i = 0;
			while($Tarq = pg_fetch_object($TreturnSqlImg)){
				$Tdata 	  = explode("-", $Tarq->img_data);
				$TimpData = $Tdata[2]."/".$Tdata[1]."/".$Tdata[0];
														
				echo"
				<form method=\"post\">
				<input type=\"hidden\" name=\"idImg\" value=\"".$Tarq->img_id."\" />
				<li>
					<a href=\"../".$Tarq->img_link_v_alta."\" rel=\"lightbox\" title=\"".$Tarq->img_legenda."\">
						<img src=\"".$Tarq->img_link_v_pequena."\" border=\"0\" align=\"left\" class=\"galleryPequenaBotao_img2\" />
					</a><br><br><center>
						<input type=\"image\" src=\"../layout/imagens/atualiza_btn_incluir2.png\" name=\"btInclui\" id=\"btInclui\" value=\"btInclui\" align=\"absmiddle\" />
					</center>					
				</li>
				</form>";
				$i++;
			}
			if($i == 0){
				echo "<b>Nenhuma Imagem Encontrada.</b>";	
			}
			?>           
            	
		</ul>
	</div>
</div>

<br class="clearfloat">
<div id="area_paginacao">
<?php
if($i != 0){
// ========================= imprime numumero de paginas rodapé  ========================
	$numPagTotal = pg_fetch_object($TreturnSqlNum);
	echo "<p align=\"center\">";
	$TnumPag = $numPagTotal->count;
	if($TnumPag < 12){
		$TnumPag = 12;
	}
	mostra_paginas($TnumPag, $_GET['pg'], $Tcaminho, 12);
	echo "<p>";				
// ========================= fim imprime num de páginas  =========================
}	
?>
</div>