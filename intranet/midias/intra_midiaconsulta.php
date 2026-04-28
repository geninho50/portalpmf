<script>
function verificaForm(){
	document.getElementById('Fdata1').disabled=false;
	document.getElementById('Fdata2').disabled=false;
}
</script>
<div class="centro">
	<div id="caminho_migalhas">intranet &gt;</div>
	<div id="titulo_pagina">consultar mídias</div>
	<div>
    
		
        
         <div id="coluna_intranet_unica">
       <div class="box_busca">
        
        
		<form method="post" action="inicio.php?pagina=midias&menu=<?=$_GET['menu']?>" onsubmit="return verificaForm()">		<span class="texto_formulario">Tipo de Mídia:</span>
		<input name="Ftipo_midia" type="radio" value="imagens" <?php if($_POST['Ftipo_midia']=='imagens' || !isset($_POST['Ftipo_midia'])){ echo "checked=\"checked\""; } ?> />Imagens
		<input name="Ftipo_midia" type="radio" value="videos"  <?php if($_POST['Ftipo_midia']=='videos'){ echo "checked=\"checked\"";}?>/>Vídeos
		<input name="Ftipo_midia" type="radio" value="audios"  <?php if($_POST['Ftipo_midia']=='audios'){ echo "checked=\"checked\"";}?>/>Áudios
		<input name="Ftipo_midia" type="radio" value="arquivos"  <?php if($_POST['Ftipo_midia']=='arquivos'){ echo "checked=\"checked\"";}?>/>Arquivos
		<hr size="1" noshade="noshade" width="460" align="left" color="#CCCCCC">

		<div class="texto_formulario">
        <input name="Ftipo_busca" type="radio" value="completa" 
		<?php 
			if(($_POST['Ftipo_busca'] == "completa")or($_GET['tp'] == "cp")or(!isset($_POST['Ftipo_busca'])))
			{
				echo('checked="checked"'); 
			}?> 
        />Listagem completa 
        </div>
        
		<div class="texto_formulario">
        	<input name="Ftipo_busca" type="radio" value="personalizada" 
				<?php if(($_POST['Ftipo_busca'] == "personalizada")or($_GET['tp'] == "ps"))
				{
					echo('checked="checked"');
				}?> 
            />Buscar por:
		</div>

		<div class="container_6">
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
			<input type="text" id="Ftags" name="Ftags" class="ui-widget-content ui-corner-all" value="<?=$_POST['Ftags']?>"/>De espaço após cada palavra, mesmo que seja apenas uma.<br />
            
			<b>período:</b><br>
			<input name="Fdata1" id="Fdata1" type="text" class="componente_miolo_menor" disabled="disabled" value="<?=$Tdti?>"/>
                	<a id="calendar-trigger"><img  align="absmiddle" src="../layout/imagens/atualiza_btn_calendario.jpg" border="0"/></a>

					<script>
                        Calendar.setup({
                            inputField : "Fdata1",
                            trigger    : "calendar-trigger",
                            onSelect   : function() { this.hide() }
                        });
                    </script>
                	a
                    <input name="Fdata2" id="Fdata2" type="text" class="componente_miolo_menor" disabled="disabled" value="<?=$Tdtf?>"/>
                    <a id="calendar-trigger-2"><img  align="absmiddle" src="../layout/imagens/atualiza_btn_calendario.jpg" border="0"/></a>

                    <script>
                        Calendar.setup({
                            inputField : "Fdata2",
                            trigger    : "calendar-trigger-2",
                            onSelect   : function() { this.hide() }
                        });
                    </script>
                <input type="image" src="../layout/imagens/intra_btn_localizar.png" align="absmiddle" name="btLoc" id="btLoc" value="btLoc" />
			</div>
         </form>
	
    
     </div><!-- fim coluna_home_1 -->
     
        
    
    
    
    
    <?php
if(isset($_POST['btLoc_x']) or (isset($_GET['pg']))){
	require_once("../scripts/php/funcoes.php");
	require_once("../scripts/php/paginacao.php");
	if(isset($_POST['btLoc_x']))
	{
		$tipo=$_POST['Ftipo_midia'];
	}
	else if(isset($_GET['tipo']))
	{
		$tipo=$_GET['tipo'];	
	}		
	//################################## VIDEOS #########################################
	if($tipo == 'videos'){
		$TidEntidade = $_SESSION['SuserEnt'];
			if(!isset($_GET['pg'])){
				$pg = 1;
			}else{
				$pg = $_GET['pg'];
			}
			$inicio = ($pg * 9) - 9;
			//================================= busca completa ===============================
			if(($_POST['Ftipo_busca'] == "completa") or ($_GET['tp'] == "cp")){
				$numSql   = "SELECT COUNT(*) FROM midia WHERE midia_entidade_id = $TidEntidade AND midia_tipo = 0";
				$vidSql   = "SELECT * FROM midia WHERE midia_entidade_id = $TidEntidade AND midia_tipo = 0 ORDER BY midia_data DESC LIMIT 9 OFFSET $inicio";
				$Tcaminho = "?pagina=midias&menu=".$_GET['menu']."&tp=cp&tipo=$tipo";
			}
			//================================= busca personalizada =============================
			if(($_POST['Ftipo_busca'] == "personalizada") or ($_GET['tp'] == "ps")){
				//----------------------------------------
				// busca por TAGS de busca
				//----------------------------------------
				if(($_POST['Ftags'] != "") && ($_POST['Fdata2'] == "") or ($_GET['Gtags'] != "")  && ($_GET['dtf'] == "")){
					
					if($_GET['Gtags'] == "")
					{
						$Ttags = $_POST['Ftags'];
					}
					else
					{
						$Ttags = $_GET['Gtags'];
					}
					$TarrayTags  = $drive->arrayTags("midia_palavra_chave", $Ttags);
					$numSql   	 = "SELECT COUNT(*) FROM midia WHERE midia_entidade_id = $TidEntidade AND midia_tipo = 0 AND $TarrayTags";
					$vidSql  	 = "SELECT * FROM midia WHERE midia_entidade_id = $TidEntidade AND $TarrayTags AND midia_tipo = 0 ORDER BY midia_data DESC LIMIT 10 OFFSET $inicio";
					$Tcaminho	 = "?pagina=midias&menu=2&tp=ps&Gtags=".$Ttags."&tipo=$tipo";
				}else
				//--------------------------------------------
				// busca por DATA
				//--------------------------------------------
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
					$Tcaminho 	 = "?pagina=midias&menu=".$_GET['menu']."&tp=ps&dti=".$Tdti."&dtf=".$Tdtf."&tipo=$tipo";
				}
				else 
				//------------------------------------------------
				// busca por ambos, tags e data
				//------------------------------------------------	
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
					$TarrayTags  	= $drive->arrayTags("midia_palavra_chave", $Ttags);
					$numSql			= "SELECT COUNT(*) FROM midia WHERE midia_entidade_id = $TidEntidade AND midia_tipo = 0 AND $TarrayTags AND midia_data >= '$TdataInicio' AND midia_data <= '$TdataFinal'";
					$vidSql			= "SELECT * FROM midia WHERE midia_entidade_id = $TidEntidade AND midia_data >= '$TdataInicio' AND midia_data <= '$TdataFinal' AND midia_tipo = 0 AND $TarrayTags ORDER BY midia_data DESC LIMIT 9 OFFSET $inicio";
					$Tcaminho		= "?pagina=midias&menu=".$_GET['menu']."&tp=ps&Gtags=".$Ttags."&dti=".$Tdti."&dtf=".$Tdtf."&tipo=$tipo"; 
				}			
			}
		//===================== retornos =====================
		$TreturnSqlVid = $drive->pedido($vidSql);
		$TreturnSqlNum = $drive->pedido($numSql);
		$i = 0;
		?>
        
        <div class="tag_result_busca">resultados da busca</div>
        <div class=\"resultado_consultas\">
					<div id='galeria_videos'>
                            <ul class='lista_videos'>
        <?php
		while($linha = pg_fetch_object($TreturnSqlVid)){
		  // ---------- Carrega Player de Vídeo ----------

						$width="172";
						$height = "129";
						$player="../scripts/php/videoPlayer";
						$video ="http://portal.pmf.sc.gov.br/".$linha->midia_link;
						$retorno=videoPlayer($video,$width,$height,$player);

		// ---------- Fim Carrega Player de Vídeo ----------
			$Tdata 	  = explode("-", $linha->midia_data);
			$TimpData = $Tdata[2]."/".$Tdata[1]."/".$Tdata[0];
			
			echo"
				<li><div class=\"container\">".$retorno."
				</div>
				
				<div>
				<a href=\"../".$linha->midia_link."\"><img src=\"../layout/imagens/atualiza_btn_download3.png\"      
				width=\"98\" height=\"19\" border=\"0\" /></a><br>
				<strong>".$TimpData."</strong><br />".$linha->midia_legenda."
				</div>
				</li>";			
			
			$i++;
		}
		if($i == 0){
			echo "<b>Nenhum Arquivo encontrado.</b>";
		}
		?>
						</ul>
                     </div>
                 
			<br class="clearfloat" />
			
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
                        mostra_paginas($TnumPag, $_GET['pg'], $Tcaminho,9);
                        echo "<p>";
// ========================= fim imprime num de páginas  =========================
		}
	?>
    <br />
</div></div>
    <?php
	}
?>



<?php
//###################################### AUDIOS #######################################
if($tipo == 'audios'){
	$TidEntidade = $_SESSION['SuserEnt'];
		if(!isset($_GET['pg'])){
			$pg = 1;
		}else{
			$pg = $_GET['pg'];
		}
		$inicio = ($pg * 10) - 10;
		//============================= busca completa ==================================
		if(($_POST['Ftipo_busca'] == "completa") or ($_GET['tp'] == "cp")){
				$numSql   = "SELECT COUNT(*) FROM midia WHERE midia_entidade_id = $TidEntidade AND midia_tipo = 1";
				$audSql   = "SELECT * FROM midia WHERE midia_entidade_id = $TidEntidade AND midia_tipo = 1 ORDER BY midia_data DESC LIMIT 10 OFFSET $inicio";
				$Tcaminho = "?pagina=midias&menu=".$_GET['menu']."&tp=cp&tipo=$tipo";
		}
		//============================= busca personalizada =============================
		if(($_POST['Ftipo_busca'] == "personalizada") or ($_GET['tp'] == "ps")){
			//-----------------------------------------
			// busca por TAGS
			//-----------------------------------------
			if(($_POST['Ftags'] != "") && ($_POST['Fdata2'] == "") or ($_GET['Gtags'] != "")  && ($_GET['dtf'] == "")){
				if($_GET['Gtags'] == ""){$Ttags = $_POST['Ftags'];}else{$Ttags = $_GET['Gtags'];}
				$TarrayTags  = $drive->arrayTags("midia_palavra_chave", $Ttags);
				$numSql   	 = "SELECT COUNT(*) FROM midia WHERE midia_entidade_id = $TidEntidade AND midia_tipo = 1 AND $TarrayTags";
				$audSql  	 = "SELECT * FROM midia WHERE midia_entidade_id = $TidEntidade AND $TarrayTags AND midia_tipo = 1 ORDER BY midia_data DESC LIMIT 10 OFFSET $inicio";
				$Tcaminho	 = "?pagina=midias&menu=".$_GET['menu']."&tp=ps&Gtags=".$Ttags."&tipo=$tipo";
			}else
			//------------------------------------------
			// busca por DATA
			//------------------------------------------
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
				$numSql   	 = "SELECT COUNT(*) FROM midia WHERE midia_entidade_id = $TidEntidade AND midia_tipo = 1 AND midia_data >= '$TdataInicio' AND midia_data <= '$TdataFinal'";
				$audSql  	 = "SELECT * FROM midia WHERE midia_entidade_id = $TidEntidade AND midia_data >= '$TdataInicio' AND midia_data <= '$TdataFinal' AND midia_tipo = 1 ORDER BY midia_data DESC LIMIT 10 OFFSET $inicio";
				$Tcaminho 	 = "?pagina=midias&menu=".$_GET['menu']."&tp=ps&dti=".$Tdti."&dtf=".$Tdtf."&tipo=$tipo";
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
				$numSql			= "SELECT COUNT(*) FROM midia WHERE midia_entidade_id = $TidEntidade AND midia_tipo = 1 AND $TarrayTags AND midia_data >= '$TdataInicio' AND midia_data <= '$TdataFinal'";
				$audSql			= "SELECT * FROM midia WHERE midia_entidade_id = $TidEntidade AND midia_data >= '$TdataInicio' AND midia_data <= '$TdataFinal' AND midia_tipo = 1 AND $TarrayTags ORDER BY midia_data DESC LIMIT 10 OFFSET $inicio";
				$Tcaminho		= "?pagina=midias&menu=".$_GET['menu']."&tp=ps&Gtags=".$Ttags."&dti=".$Tdti."&dtf=".$Tdtf."&tipo=$tipo"; 
				}				
			}
			$TreturnSqlAud = $drive->pedido($audSql);
			$TreturnSqlNum = $drive->pedido($numSql);
			$i = 0;
			echo"<div class=\"tag_result_busca\">resultados da busca</div><div class=\"resultado_consultas\">";
			echo" <div id='galeria_audios'><ul class='lista_audios'>";
			while($Taud = pg_fetch_object($TreturnSqlAud)){
				// ---------- Carrega Player de Áudio ----------

						$nomeMidia 	= $Taud->midia_link;
						$width		="290";
						$height 	= "24";
						$player		="../scripts/php/audioPlayer";
						$audio  	="http://portal.pmf.sc.gov.br/".$Taud->midia_link;
						$retorno	= audioPlayer($audio,$width,$height,$player);

				// ---------- Fim Carrega Player de Áudio ----------

				echo"
					<li><div class=\"container\">".$retorno."</div>
						<div><a href=\"../".$Taud->midia_link."\"><img src=\"../layout/imagens/atualiza_btn_download3.png\" width=\"98\" height=\"19\" border=\"0\" align=\"absmiddle\" /></a>&nbsp;<strong align=\"absmiddle\">".strip_tags($Taud->midia_legenda)."</strong></div> 
					</li>";
				$i++;
			}
			echo"</ul></div></div>";
			if($i == 0){
				echo "<b>Nenhum Arquivo encontrado.</b>";
			}
	?>
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
                        mostra_paginas($TnumPag, $_GET['pg'], $Tcaminho,10);
                        echo "<p>";
// ========================= fim imprime num de páginas  =========================
		}

?>
		<br />
		</div>

<?php }
//#################################### IMAGENS #####################################
	if($tipo == 'imagens'){

			$TidEntidade = $_SESSION['SuserEnt'];

			if(!isset($_GET['pg'])){
				$pg = 1;
			}else{
				$pg = $_GET['pg'];
			}
			$inicio = ($pg * 12) - 12;
			//================================= busca completa =================================
			if(($_POST['Ftipo_busca'] == "completa") or ($_GET['tp'] == "cp")){
				$numSql   = "SELECT COUNT(*) FROM imagens WHERE img_entidade_id = $TidEntidade";
				$imgSql   = "SELECT * FROM imagens WHERE img_entidade_id = $TidEntidade ORDER BY img_data DESC LIMIT 12 OFFSET $inicio";
				$Tcaminho = "?pagina=midias&menu=".$_GET['menu']."&tp=cp&tipo=$tipo";
			}
			//================================ busca personalizada ===========================
			if(($_POST['Ftipo_busca'] == "personalizada") or ($_GET['tp'] == "ps")){
				//-------------------------------------
				// busca por TAGS 
				//-------------------------------------
				if(($_POST['Ftags'] != "") && ($_POST['Fdata2'] == "") or ($_GET['Gtags'] != "")  && ($_GET['dtf'] == "")){
					if($_GET['Gtags'] == "")
					{
						$Ttags = $_POST['Ftags'];
					}
					else
					{
						$Ttags = $_GET['Gtags'];
					}
					$TarrayTags  = $drive->arrayTags("img_palavra_chave", $Ttags);
					$numSql   	 = "SELECT COUNT(*) FROM imagens WHERE img_entidade_id = $TidEntidade AND $TarrayTags";
					$imgSql  	 = "SELECT * FROM imagens WHERE img_entidade_id = $TidEntidade AND $TarrayTags ORDER BY img_data DESC LIMIT 10 OFFSET $inicio";
					$Tcaminho	 = "?pagina=midias&menu=".$_GET['menu']."&tp=ps&Gtags=".$Ttags."&tipo=$tipo";
				}else
				//-----------------------------------------
				// busca por DATA
				//-----------------------------------------
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
					$imgSql  	 = "SELECT * FROM imagens WHERE img_entidade_id = $TidEntidade AND img_data >= '$TdataInicio' AND img_data <= '$TdataFinal' ORDER BY img_data DESC LIMIT 10 OFFSET $inicio";
					$Tcaminho 	 = "?pagina=midias&menu=".$_GET['menu']."&tp=ps&dti=".$Tdti."&dtf=".$Tdtf."&tipo=$tipo";
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
					$Tcaminho		= "?pagina=midias&menu=".$_GET['menu']."&tp=ps&Gtags=".$Ttags."&dti=".$Tdti."&dtf=".$Tdtf."&tipo=$tipo"; 
				}								
			}

		$TreturnSqlImg = $drive->pedido($imgSql);
		$TreturnSqlNum = $drive->pedido($numSql);
		?>
        <div class="tag_result_busca">resultados da busca</div>
        <div class="resultado_consultas">
					<div id='galeria_imagens'>
                            <ul class='lista_imagens'>
        <?php
		$i = 0;
        	while($Tarq = pg_fetch_object($TreturnSqlImg)){
				$Tdata 	  = explode("-", $Tarq->img_data);
				$TimpData = $Tdata[2]."/".$Tdata[1]."/".$Tdata[0];

				echo"
				<li><div class=\"container\">
				<a href=\"../".$Tarq->img_link_v_alta."\" rel=\"colorbox-galeria\"><img src=\"".$Tarq->img_link_v_pequena."\" border=\"0\"></a>
				</div>
				
				<div><center>
					<a href=\"../".$Tarq->img_link_v_alta."\" title=\"".$Tarq->img_legenda."\"><img src=\"../layout/imagens/atualiza_btn_download3.png\" width=\"98\" border=\"0\" height=\"19\" align=\"absmiddle\" /></a>
					</center><br>
				
					<strong>".$TimpData."</strong><br>
					".substr($Tarq->img_legenda,0,80)."
				</div>
				</li>";
				$i++;
			}
			if($i == 0){
				echo "<b>Nenhum Arquivo encontrado.</b>";
			}
		?>
						</ul>
                     </div>
                 
			<br class="clearfloat" />
			
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
							mostra_paginas($TnumPag, $_GET['pg'], $Tcaminho,12);
							echo "<p>";
// ========================= fim imprime num de páginas  =========================
						}
						?>
             </div>
		</div>
<?php
}
//################################# ARQUIVOS #######################################
	if($tipo == 'arquivos'){
			$TidEntidade = $_SESSION['SuserEnt'];
			//$TidEntidade = $_SESSION[''];
			if(!isset($_GET['pg'])){
				$pg = 1;
			}else{
				$pg = $_GET['pg'];
			}
			$inicio = ($pg * 10) - 10;
			//============================= busca completa ==============================
			if(($_POST['Ftipo_busca'] == "completa") or ($_GET['tp'] == "cp")){
				$numSql   = "SELECT COUNT(*) FROM arquivos WHERE arq_entidade_id = $TidEntidade";
				$arqSql   = "SELECT * FROM arquivos WHERE arq_entidade_id = $TidEntidade ORDER BY arq_nome LIMIT 10 OFFSET $inicio";
				$Tcaminho = "?pagina=midias&menu=".$_GET['menu']."&tp=cp&tipo=$tipo";
			}
			//============================= busca personalizada ==========================
			if(($_POST['Ftipo_busca'] == "personalizada") or ($_GET['tp'] == "ps")){
				//------------------------------------
				// busca por TAGS
				//------------------------------------
				if(($_POST['Ftags'] != "") && ($_POST['Fdata2'] == "") or ($_GET['Gtags'] != "")  && ($_GET['dtf'] == "")){
					if($_GET['Gtags'] == ""){$Ttags = $_POST['Ftags'];}else{$Ttags = $_GET['Gtags'];}
					$TarrayTags  = $drive->arrayTags("arq_palavra_chave", $Ttags);
					$numSql   	 = "SELECT COUNT(*) FROM arquivos WHERE arq_entidade_id = $TidEntidade AND $TarrayTags";
					$arqSql  	 = "SELECT * FROM arquivos WHERE arq_entidade_id = $TidEntidade AND $TarrayTags ORDER BY arq_nome ASC LIMIT 10 OFFSET $inicio";
					$Tcaminho	 = "?pagina=midias&menu=".$_GET['menu']."&tp=ps&Gtags=".$Ttags."&tipo=$tipo";
				}else
				//-------------------------------------
				// busca por DATA
				//-------------------------------------
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
					$arqSql  	 = "SELECT * FROM arquivos WHERE arq_entidade_id = $TidEntidade AND arq_data >= '$TdataInicio' AND arq_data <= '$TdataFinal' ORDER BY arq_data DESC LIMIT 10 OFFSET $inicio";
					$Tcaminho 	 = "?pagina=midias&menu=".$_GET['menu']."&tp=ps&dti=".$Tdti."&dtf=".$Tdtf."&tipo=$tipo";
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
					$Tcaminho		= "?pagina=midias&menu=".$_GET['menu']."&tp=ps&Gtags=".$Ttags."&dti=".$Tdti."&dtf=".$Tdtf."&tipo=$tipo"; 
				}			
			}
		//================= retornos ==================
		$TreturnSqlArq = $drive->pedido($arqSql);
		$TreturnSqlNum = $drive->pedido($numSql);
		$i = 0;
		echo"<div class=\"resultado_consultas\"><div class=\"tag_result_busca\">resultados da busca</div>
		<table width=\"670\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
		";
		while($Tarq = pg_fetch_object($TreturnSqlArq)){

			echo '
			    <tr>
				<td width="570" class="container_item_result">
					<span class="titulo_linkserv">'.$Tarq->arq_nome.'</span>
				</td><td width="100" class="container_item_result">	
					<a href="../'.$Tarq->arq_link.'"><img src="../layout/imagens/atualiza_btn_download3.png" width="98" height="19" border="0" /></a><br>
				</td>
				</tr> ';
 			$i++;
		}
		echo"</table></div>";
		if($i == 0){
			echo "<b>Nenhum Arquivo encontrado.</b>";
		}
?>
			
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
							mostra_paginas($TnumPag, $_GET['pg'], $Tcaminho,10);
							echo "<p>";
// ========================= fim imprime num de páginas  =========================
	}
?>
</div>
<?php
		}
	}
	?>
	</div>
    </div>
</div><!-- fim coluna_C2 -->


