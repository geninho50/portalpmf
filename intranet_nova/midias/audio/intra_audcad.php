<?php
//------------------------------------------
// Página implementada em : 26/05/2010
// por: Rodrigo Rigoni
// E-mail: rigoni_chz@hotmail.com
//------------------------------------------
?>

<script>
function verificaExclusao(){
	if(confirm('Tem certeza que deseja Excluir o Áudio?')){
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
<script language="JavaScript" src="../scripts/php/audioPlayer/audio-player.js"></script>
<div class="centro">
	<div id="caminho_migalhas">intranet &gt;</div>
	<div id="titulo_pagina">editar áudios</div>
	<div id="margem_direita"><br>
		
		<div class="conteudo_abas">  
			<form method="post" action="inicio.php?pagina=audcad&menu=<?=$_GET['menu']?>" onsubmit="return habilitaData()">
            <div id="conteudo_localizar" style="display:inline">
				Utilize as opções abaixo para acesar os áudios do repositório. Faça a pesquisa por palavra-chave (tag), data de postagem ou consulte a listagem completa de áudios.<br><br>
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
					
					
					// ---------- Padronização tamanho campo TAG ----------
					echo"
					<style type=\"text/css\">
						.jq_tags_editor
						{
							background-color:#FFF;
							border-color: #CCCCCC;
							width: 424px;
						}
					</style>";
					// ----------Fim Padronização tamanho campo TAG ----------					
					?>
					
					<input type="text" name="Ftags" class="tags" value="<?=$Ttags?>"/> De espaço após cada palavra, mesmo que seja apenas uma.<br /><br />               
                	
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
			$inicio = ($pg * 10) - 10; 
		
			//---------------------------------------
			// busca completa de áudios da entidade
			//---------------------------------------
			if(($_POST['Ftipo_busca'] == "completa") or ($_GET['tp'] == "cp")){				
				$numSql   = "SELECT COUNT(*) FROM midia WHERE midia_entidade_id = $TidEntidade AND midia_tipo = 1";
				$audSql   = "SELECT * FROM midia WHERE midia_entidade_id = $TidEntidade AND midia_tipo = 1 ORDER BY midia_data DESC LIMIT 10 OFFSET $inicio";
				$Tcaminho = "?pagina=audcad&menu=".$_GET['menu']."&tp=cp";
			}
			
			if(($_POST['Ftipo_busca'] == "personalizada") or ($_GET['tp'] == "ps")){		
				
				if(($_POST['Ftags'] != "") && ($_POST['Fdata2'] == "") or ($_GET['Gtags'] != "")  && ($_GET['dtf'] == "")){
					//------------------------------------------
					// busca personalizada, pesquisa por TAGS
					//------------------------------------------
					if($_GET['Gtags'] == ""){$Ttags = $_POST['Ftags'];}else{$Ttags = $_GET['Gtags'];}
					$TarrayTags  = $drive->arrayTags("midia_palavra_chave", $Ttags); 
					$numSql   	 = "SELECT COUNT(*) FROM midia WHERE midia_entidade_id = $TidEntidade AND midia_tipo = 1 AND $TarrayTags";
					$audSql  	 = "SELECT * FROM midia WHERE midia_entidade_id = $TidEntidade AND $TarrayTags AND midia_tipo = 1 ORDER BY midia_data DESC LIMIT 10 OFFSET $inicio";		
					$Tcaminho	 = "?pagina=audcad&menu=".$_GET['menu']."&tp=ps&Gtags=".$Ttags."";
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

					$numSql   	 = "SELECT COUNT(*) FROM midia WHERE midia_entidade_id = $TidEntidade AND midia_tipo = 1 AND midia_data >= '$TdataInicio' AND midia_data <= '$TdataFinal'";
					$audSql  	 = "SELECT * FROM midia WHERE midia_entidade_id = $TidEntidade AND midia_data >= '$TdataInicio' AND midia_data <= '$TdataFinal' AND midia_tipo = 1 ORDER BY midia_data DESC LIMIT 10 OFFSET $inicio";				
					$Tcaminho 	 = "?pagina=audcad&menu=".$_GET['menu']."&tp=ps&dti=".$Tdti."&dtf=".$Tdtf."";
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
					$Tcaminho		= "?pagina=audcad&menu=".$_GET['menu']."&tp=ps&Gtags=".$Ttags."&dti=".$Tdti."&dtf=".$Tdtf.""; 
				}				
			}

		$TreturnSqlAud = $drive->pedido($audSql);
		$TreturnSqlNum = $drive->pedido($numSql);
		?>
        <div class="tag_result_busca">resultados da busca</div>
		<div>
			<div class="container_2">  
                
					<div id='galeria_audios'>
                            <ul class='lista_audios'>
                   <br>
                   <?php
				   $i = 0;
				    //---------------------------------------
					// imprime lista de áudios encontrados
					//---------------------------------------
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
				  	<li>
					<form method=\"post\">
					<input type=\"hidden\" name=\"FidMid\" value=\"".$Taud->midia_id."\" />
					<div class=\"container\">".$retorno."</div>
					
					<div>
                        <span align=\"absmiddle\"><a href=\"?pagina=audedit&menu=".$_GET['menu']."&id=".$Taud->midia_id."\" class=\"toggleopacity\">
                        <img src=\"../layout/imagens/atualiza_btn_editar.png\" alt=\"editar\" width=\"50\" height=\"18\" border=\"0\" /></a></span> 
                        <span align=\"absmiddle\"><input type=\"image\" src=\"../layout/imagens/atualiza_btn_excluir.png\" name=\"btExcluir\" id=\"btExcluir\" value=\"btExcluir\"   onclick=\"return verificaExclusao()\" /></span> 
						&nbsp;<strong align=\"absmiddle\">".strip_tags($Taud->midia_legenda)."</strong>
                    </div>
					</form>
					</li>";
					$i++;
					}
					if($i == 0){
						echo "<b>Nenhum &Aacute;udio Encontrado.</b>";	
					}
					?>
                    
                    </ul>
                     </div>
                    
                    
                    <br class="clearfloat">
                    
                    <div id="area_paginacao">
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
			</div>
            <br class="clearfloat">
		</div>
        <?php } ?>  
	</div>
</div>

<?php
//----------------------------
// Exclusão do Áudio
//----------------------------

if(isset($_POST['btExcluir_x'])){
	
	$TidMid  = $_POST['FidMid'];
	$Tvalida = 0;
	//------------------------------------------------------------
	// verifica se o áudio esta sendo utilizado em alguma página
	//------------------------------------------------------------	
	$sqlMid		= "SELECT MID.*,PMID.* FROM midia AS MID
				  JOIN intranet_pagina_midias AS PMID ON MID.midia_id = PMID.intranet_midpagina_mid_id
				  WHERE MID.midia_id = $TidMid";	
	$Treturn	= $drive->pedido($sqlMid);
	$TverMid	= pg_fetch_object($Treturn);
	
	if($TverMid != false){
		$Tvalida = 1;
		echo"<script>alert(\"Não foi possível EXCLUIR o Áudio!\\n\\nEste Áudio está sendo utilizado em uma Página.\");</script>";
	}

	//------------------------------------------------------------
	// verifica se o áudio esta sendo utilizado em alguma notícia
	//------------------------------------------------------------
	$sqlNot		= "SELECT MID.*,NMID.* FROM midia AS MID
				  JOIN noticias_midia AS NMID ON MID.midia_id = NMID.nmidia_midia_id
				  WHERE MID.midia_id = $TidMid";	
	$Treturn	= $drive->pedido($sqlNot);
	$TverNot	= pg_fetch_object($Treturn);
	
	if($TverNot != false){
		$Tvalida = 1;
		echo"<script>alert(\"Não foi possível EXCLUIR o Áudio!\\n\\nEste Áudio está sendo utilizado em uma Notícia.\");</script>";
	}
	
	//------------------------------------------------------------
	// verifica se o áudio esta sendo utilizado em algum evento
	//------------------------------------------------------------
	$sqlEve		= "SELECT MID.*,EMID.* FROM imagens AS MID
				  JOIN eventos_midia AS EMID ON MID.midia_id = EMID.emidia_midia_id
				  WHERE MID.midia_id = $TidMid";	
	$Treturn	= $drive->pedido($sqlEve);
	$TverEve	= pg_fetch_object($Treturn);
	
	if($TverEve != false){
		$Tvalida = 1;
		echo"<script>alert(\"Não foi possível EXCLUIR o Áudio!\\n\\nEste Áudio está sendo utilizado em um Evento.\");</script>";
	}
	
	//-------------------------------------------------------------------------------
	// Se o áudio não estiver associado a nenhum outro registro - apaga o arquivo
	//-------------------------------------------------------------------------------
	if($Tvalida == 0){
		
		$sqlLoc 	= "SELECT * FROM midia WHERE midia_id = $TidMid ";
		$Tresult   = $drive->pedido($sqlLoc);
		$TobjMid 	= pg_fetch_object($Tresult);
					
		$sqlExc 	= "DELETE FROM midia WHERE midia_id = $TidMid ";
		$Tresult 	= $drive->pedido($sqlExc);
	
		if($Tresult){
			
			@unlink("../".$TobjMid->midia_link);

			echo("<script>alert('Áudio Excluido com Sucesso!')</script>");
		}else{	
			echo("<script>alert('Não Foi Possível Excluir o Áudio!\\n\\nErro no Servidor, tente novamente mais tarde.')</script>");
		}
	}
}
?> 

