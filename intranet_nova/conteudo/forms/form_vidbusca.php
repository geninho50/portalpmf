<script>
function verificaForm(){
	document.getElementById('Fdata1').disabled=false;
	document.getElementById('Fdata2').disabled=false;
}
</script>
<?php

if(isset($_POST['btInclui_x'])){
	$Tpagina  = $_GET['idPag'];
	$TmidId   = $_POST['idVid'];
	$sqlMid1  = "INSERT INTO 
					intranet_pagina_midias(
						intranet_midpagina_id, 
						intranet_midpagina_pag_id,
						intranet_midpagina_mid_id,
						intranet_midpagina_tipo
				)VALUES(
					default, 
					$Tpagina,
					$TmidId,
					0)";
	
	$TretMid  = $drive->pedido($sqlMid1);
	
	if ($TretMid == true){
		echo"<script>alert(\"Midia incluida com Sucesso!\");</script>";			
		echo("<script>window.location = \"?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=videos&sb=buscar\";</script>");
	}else{		
		echo"<script>alert(\"Não foi possível incluir a Midia.\");</script>";
		echo("<script>window.location = \"?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=videos&sb=buscar\";</script>");
	}
}
?>
<h1>Localizar Vídeo do repositório de Mídia </h1>
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
<?php
	require_once("../scripts/php/funcoes.php");
	require_once("../scripts/php/paginacao.php");			
	
	$TidEntidade = $_SESSION['SuserEnt'];
	
	if(!isset($_GET['pg'])){
		$pg = 1;
	}else{
		$pg = $_GET['pg'];	
	}	
	$inicio = ($pg * 9) - 9; 
	
if(!isset($_POST['btLoc_x'])){
	$numSql   = "SELECT COUNT(*) FROM midia WHERE midia_entidade_id = $TidEntidade AND midia_tipo = 0";
	$vidSql   = "SELECT * FROM midia WHERE midia_entidade_id = $TidEntidade AND midia_tipo = 0 ORDER BY midia_data DESC LIMIT 9 OFFSET $inicio";
	$Tcaminho = "?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=videos&sb=buscar";
}else{
	//-----------------------------------------
	// busca por TAGS
	//-----------------------------------------
	if(($_POST['Ftags'] != "") && ($_POST['Fdata2'] == "") or ($_GET['Gtags'] != "")  && ($_GET['dtf'] == "")){	
		if($_GET['Gtags'] == ""){$Ttags = $_POST['Ftags'];}else{$Ttags = $_GET['Gtags'];}
		$TarrayTags  = $drive->arrayTags("midia_palavra_chave", $Ttags); 
		$numSql   	 = "SELECT COUNT(*) FROM midia WHERE midia_entidade_id = $TidEntidade AND midia_tipo = 0 AND $TarrayTags";
		$vidSql  	 = "SELECT * FROM midia WHERE midia_entidade_id = $TidEntidade AND $TarrayTags AND midia_tipo = 0 ORDER BY midia_data DESC LIMIT 10 OFFSET $inicio";		
		$Tcaminho	 = "?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=videos&sb=buscar&Gtags=".$Ttags."";
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
		$numSql   	 = "SELECT COUNT(*) FROM midia WHERE midia_entidade_id = $TidEntidade AND midia_tipo = 0 AND midia_data >= '$TdataInicio' AND midia_data <= '$TdataFinal'";
		$vidSql  	 = "SELECT * FROM midia WHERE midia_entidade_id = $TidEntidade AND midia_data >= '$TdataInicio' AND midia_data <= '$TdataFinal' AND midia_tipo = 0 ORDER BY midia_data DESC LIMIT 10 OFFSET $inicio";				
		$Tcaminho 	 = "?pagina=pagedit&menu=".$_POST['menu']."&idPag=".$_GET['idPag']."&aba=videos&sb=buscar&dti=".$Tdti."&dtf=".$Tdtf."";
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
			$TarrayTags  	= $drive->arrayTags("midia_palavra_chave", $Ttags);
			$numSql			= "SELECT COUNT(*) FROM midia WHERE midia_entidade_id = $TidEntidade AND midia_tipo = 0 AND $TarrayTags AND midia_data >= '$TdataInicio' AND midia_data <= '$TdataFinal'";
			$vidSql			= "SELECT * FROM midia WHERE midia_entidade_id = $TidEntidade AND midia_data >= '$TdataInicio' AND midia_data <= '$TdataFinal' AND midia_tipo = 0 AND $TarrayTags ORDER BY midia_data DESC LIMIT 10 OFFSET $inicio";
			$Tcaminho		= "?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=videos&sb=buscar&dti=".$Tdti."&dtf=".$Tdtf."&Gtags=".$Ttags.""; 
	}								
}
//--------------------------------------------------------------------------------
$TreturnSqlVid = $drive->pedido($vidSql);
$TreturnSqlNum = $drive->pedido($numSql);
?>
<br><br><br>
<h1>Resultados Encontrados:</h1>
<div id='pagePequenaBotaoVideo'>
	<div id='imagesPequenaBotaoVideo'>
    	<ul class='galleryPequenaBotaoVideo'>
			<?php	
            $i = 0;
            while($Tvid = pg_fetch_object($TreturnSqlVid)){
                
                // ---------- Carrega Player de Vídeo ----------
                
                $width="172";					
                $height = "129";
                $player="../scripts/php/videoPlayer";
                $video ="http://portal.pmf.sc.gov.br/".$Tvid->midia_link;				
                $retorno=videoPlayer($video,$width,$height,$player);
                
                // ---------- Fim Carrega Player de Vídeo ----------					
                
                $Tdata 	  = explode("-", $Tvid->midia_data);
                $TimpData = $Tdata[2]."/".$Tdata[1]."/".$Tdata[0];
            echo"
			<form method=\"post\">
			<input type=\"hidden\" name=\"idVid\" value=\"".$Tvid->midia_id."\" />
            <li>
            	".$retorno."<br />
				<div style=\"padding-top:4px;\"></div>
                <center>
					<input type=\"image\" src=\"../layout/imagens/atualiza_btn_incluir2.png\" name=\"btInclui\" id=\"btInclui\" value=\"btInclui\" align=\"absmiddle\" />
                </center>
				<br />
				".$Tvid->midia_legenda."
            </li>
			</form>";
            $i++;
            }
            if($i == 0){
                echo "<b>Nenhum V&iacute;deo Encontrado.</b>";	
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
	if($TnumPag < 9){
		$TnumPag = 9;
	}
	mostra_paginas($TnumPag, $_GET['pg'], $Tcaminho, 10);
	echo "<p>";				
// ========================= fim imprime num de páginas  =========================
}	
?>
</div>


