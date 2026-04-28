<?php
//------------------------------------------
// Página implementada em : 26/05/2010
// por: Rodrigo Rigoni
// E-mail: rigoni_chz@hotmail.com
//------------------------------------------
?>
<script type="text/javascript">
function verificaExclusao(){
	if(confirm('Tem certeza que deseja EXCLUIR a Imagem?')){
		return true;
	}else{
		return false;
	}
}

function habilitaData(){
	document.getElementById('Fdata1').disabled=false;
	document.getElementById('Fdata2').disabled=false;
}
</script>

<div class="centro">
	<div id="caminho_migalhas">intranet &gt;</div>
	<div id="titulo_pagina">editar imagens</div>
	<div id="margem_direita"><br>
		   
        <div class="conteudo_abas">  
			<form method="post" action="inicio.php?pagina=imgcad&menu=<?=$_GET['menu']?>" onsubmit="return habilitaData()">
            <div id="conteudo_localizar" style="display:inline">
				
				<div class="texto_formulario"><input name="Ftipo_busca" type="radio" value="completa" <?php if(($_POST['Ftipo_busca'] == "completa")or($_GET['tp'] == "cp")or(!isset($_POST['Ftipo_busca']))){echo('checked="checked"'); $_POST['Fdata1'] = ""; $_POST['Fdata2'] = ""; $_POST['Ftags'] = ""; }?> />Listagem completa </div>
               	
				<div class="texto_formulario"><input name="Ftipo_busca" type="radio" value="personalizada" <?php if(($_POST['Ftipo_busca'] == "personalizada")or($_GET['tp'] == "ps")){echo('checked="checked"');}?> />Buscar por Palavra Chave ou Per&iacute;odo</div> 
            
                <div class="container_6">
                	
                    <?php
					
					// ---------- recupera tags ----------
					if($_GET['Gtags'] == ""){
						$Ttags = $_POST['Ftags'];
					}else{
						$Ttags = $_GET['Gtags'];
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
					
					<div class="container_tags">  
                    <input type="text" id="Ftags" name="Ftags" class="ui-widget-content ui-corner-all" value="<?=$Ttags?>"/>De espaço após cada palavra, mesmo que seja apenas uma.               
                	</div>
                    
                    <b>Per&iacute;odo:</b><br>
                	
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
                </div>
            	
           	 	&nbsp;<input type="image" src="../layout/imagens/intra_btn_localizar.png" align="absmiddle" name="btLoc" id="btLoc" value="btLoc" />               
				</div>
            </form>
		</div> 
		<?php 
		if(isset($_POST['btLoc_x']) or (isset($_GET['pg']))){	
			require_once("../scripts/php/funcoes.php");
			require_once("../scripts/php/paginacao.php");			
			
			$TidEntidade = $_SESSION['SuserEnt'];
		
			//-------------------------
			// controle de paginação
			//-------------------------
			if(!isset($_GET['pg'])){
				$pg = 1;
			}else{
				$pg = $_GET['pg'];	
			}	
			$inicio = ($pg * 12) - 12; 
			
			//---------------------------------------
			// busca completa de imagens da entidade
			//---------------------------------------
			if(($_POST['Ftipo_busca'] == "completa") or ($_GET['tp'] == "cp")){				
				$numSql   = "SELECT COUNT(*) FROM imagens WHERE img_entidade_id = $TidEntidade";
				$imgSql   = "SELECT * FROM imagens WHERE img_entidade_id = $TidEntidade ORDER BY img_data DESC LIMIT 12 OFFSET $inicio";
				$Tcaminho = "?pagina=imgcad&menu=".$_GET['menu']."&tp=cp";
			}
			
			if(($_POST['Ftipo_busca'] == "personalizada") or ($_GET['tp'] == "ps")){					
				
				if(($_POST['Ftags'] != "") && ($_POST['Fdata2'] == "") or ($_GET['Gtags'] != "")  && ($_GET['dtf'] == "")){	
					//------------------------------------------
					// busca personalizada, pesquisa por TAGS
					//------------------------------------------
					if($_GET['Gtags'] == ""){$Ttags = $_POST['Ftags'];}else{$Ttags = $_GET['Gtags'];}
					$TarrayTags  = $drive->arrayTags("img_palavra_chave", $Ttags); 
					$numSql   	 = "SELECT COUNT(*) FROM imagens WHERE img_entidade_id = $TidEntidade AND $TarrayTags";
					$imgSql  	 = "SELECT * FROM imagens WHERE img_entidade_id = $TidEntidade AND $TarrayTags ORDER BY img_data DESC LIMIT 12 OFFSET $inicio";		
					$Tcaminho	 = "?pagina=imgcad&menu=".$_GET['menu']."&tp=ps&Gtags=".$Ttags."";
				}else
					//--------------------------------------------------
					// busca personalizada, pesquisa intervalo de datas
					//--------------------------------------------------
				if(($_POST['Fdata2'] != "") && ($_POST['Ftags'] == "") or ($_GET['dtf'] != "")  && ($_GET['Gtags'] == "")){
					
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
					$numSql   	 = "SELECT COUNT(*) FROM imagens WHERE img_entidade_id = $TidEntidade AND img_data >= '$TdataInicio' AND img_data <= '$TdataFinal'";
					$imgSql  	 = "SELECT * FROM imagens WHERE img_entidade_id = $TidEntidade AND img_data >= '$TdataInicio' AND img_data <= '$TdataFinal' ORDER BY img_data DESC LIMIT 10 OFFSET $inicio";				
					$Tcaminho 	 = "?pagina=imgcad&menu=".$_GET['menu']."&tp=ps&dti=".$Tdti."&dtf=".$Tdtf."";
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
					$Tcaminho		= "?pagina=imgcad&menu=".$_GET['menu']."&tp=ps&Gtags=".$Ttags."&dti=".$Tdti."&dtf=".$Tdtf.""; 
				}								
			}

		$TreturnSqlImg = $drive->pedido($imgSql);
		$TreturnSqlNum = $drive->pedido($numSql);

		?>
			<div class="tag_result_busca">resultados da busca</div>
            <div>
				<div class="container_2">  
						<br>
						<div id='galeria_imagens'>
                            	<ul class='lista_imagens'>
                                
									<?php
                       				$i = 0;
									//---------------------------------------
									// imprime lista de imagens encontradas
									//---------------------------------------
                       				while($Tarq = pg_fetch_object($TreturnSqlImg)){
										$Tdata 	  = explode("-", $Tarq->img_data);
										$TimpData = $Tdata[2]."/".$Tdata[1]."/".$Tdata[0];
																				
										echo"
										<form method=\"post\">
										<input type=\"hidden\" name=\"FidImg\" value=\"".$Tarq->img_id."\" />
										<li><div class=\"container\">
											<a href=\"../".$Tarq->img_link_v_alta."\" rel=\"lightbox\" title=\"".$Tarq->img_legenda."\"><img src=\"".$Tarq->img_link_v_pequena."\" border=\"0\"></a>
											</div>
											
											<div>
											<center>
											 
											<span align=\"absmiddle\"><a href=\"?pagina=imgedit&menu=".$_GET['menu']."&id=".$Tarq->img_id."\" class=\"toggleopacity\"><img src=\"../layout/imagens/atualiza_btn_editar.png\" alt=\"editar\" width=\"50\" height=\"18\" border=\"0\"  /></a></span>
											<span align=\"absmiddle\"><input type=\"image\" src=\"../layout/imagens/atualiza_btn_excluir.png\" name=\"btExcluir\" id=\"btExcluir\" value=\"btExcluir\"  onclick=\"return verificaExclusao()\" /></span>												
											</center> 
											<br> 
												<strong>".$TimpData."</strong><br>
												".subString($Tarq->img_legenda,100)."   
											</div>
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
                      	
						<br class="clearfloat" />
						<br>
                        <div id="area_paginacao">
                        <?php
						if($i != 0){
						//-------------------------------------- 
						// imprime numumero de paginas rodapé  
						//--------------------------------------
							$numPagTotal = pg_fetch_object($TreturnSqlNum);
							echo "<p align=\"center\">";
							$TnumPag = $numPagTotal->count;
							if($TnumPag < 12){
								$TnumPag = 12;
							}
							mostra_paginas($TnumPag, $_GET['pg'], $Tcaminho, 12);
							echo "<p>";				
						}	
						?>
                	</div>
				</div>
			</div>
		</div>
        <?php } ?>  
	</div>
</div>

<?php
//----------------------------
// Exclusão da Imagem 
//----------------------------

if(isset($_POST['btExcluir_x'])){
	
	$TidImg  = $_POST['FidImg'];
	$Tvalida = 0;
	//------------------------------------------------------------
	// verifica se a imagem esta sendo utilizada em alguma página
	//------------------------------------------------------------	
	$sqlImg		= "SELECT IMG.*,PIMG.* FROM imagens AS IMG
				  JOIN intranet_pagina_imagens AS PIMG ON IMG.img_id = PIMG.intranet_imgpagina_img_id
				  WHERE IMG.img_id = $TidImg";	
	$Treturn	= $drive->pedido($sqlImg);
	$TverImg	= pg_fetch_object($Treturn);
	
	if($TverImg != false){
		$Tvalida = 1;
		echo"<script>alert(\"Não foi possível EXCLUIR a Imagem!\\n\\nEsta Imagem está sendo utilizada em uma Página.\");</script>";
	}
	
	//------------------------------------------------------------
	// verifica se a imagem esta sendo utilizada em alguma notícia
	//------------------------------------------------------------
	$sqlNot		= "SELECT IMG.*,NIMG.* FROM imagens AS IMG
				  JOIN noticias_imagens AS NIMG ON IMG.img_id = NIMG.ning_img_id
				  WHERE IMG.img_id = $TidImg";	
	$Treturn	= $drive->pedido($sqlNot);
	$TverNot	= pg_fetch_object($Treturn);
	
	if($TverNot != false){
		$Tvalida = 1;
		echo"<script>alert(\"Não foi possível EXCLUIR a Imagem!\\n\\nEsta Imagem está sendo utilizada em uma Notícia.\");</script>";
	}
	
	//------------------------------------------------------------
	// verifica se a imagem esta sendo utilizada em algum evento
	//------------------------------------------------------------
	$sqlEve		= "SELECT IMG.*,EIMG.* FROM imagens AS IMG
				  JOIN eventos_imagens AS EIMG ON IMG.img_id = EIMG.eimg_img_id
				  WHERE IMG.img_id = $TidImg";	
	$Treturn	= $drive->pedido($sqlEve);
	$TverEve	= pg_fetch_object($Treturn);
	
	if($TverEve != false){
		$Tvalida = 1;
		echo"<script>alert(\"Não foi possível EXCLUIR a Imagem!\\n\\nEsta Imagem está sendo utilizada em um Evento.\");</script>";
	}
	
	//-------------------------------------------------------------------------------
	// Se a imagem não estiver associada a nenhum outro registro - apaga os arquivos
	//-------------------------------------------------------------------------------
	if($Tvalida == 0){
		
		$sqlLoc 	= "SELECT * FROM imagens WHERE img_id = $TidImg ";
		$Tresult   = $drive->pedido($sqlLoc);
		$TobjImg 	= pg_fetch_object($Tresult);
					
		$sqlExc 	= "DELETE FROM imagens WHERE img_id = $TidImg ";
		$Tresult 	= $drive->pedido($sqlExc);
	
		if($Tresult){
			
			@unlink($TobjImg->img_link_v_alta);
			@unlink($TobjImg->img_link_v_media);
			@unlink($TobjImg->img_link_v_preview);
			@unlink($TobjImg->img_link_v_pequena);

			echo("<script>alert('Imagem Excluida com Sucesso!')</script>");
		}else{	
			echo("<script>alert('Não Foi Possível Excluir a Imagem!\\n\\nErro no Servidor, tente novamente mais tarde')</script>");
		}
	}
	
}
?> 