<?php
//------------------------------------------
// Página implementada em : 20/07/2010
// por: Rodrigo Rigoni
// E-mail: rigoni_chz@hotmail.com
//------------------------------------------
?>

<script type="text/javascript">
	function verificaExclusao(){
		if(confirm('Tem Certeza Que Deseja Excluir a Data?')){
			return true;
		}else{
			return false;
		}		
	}
	function verificaForm(){		
		var form = document.getElementById('consulta');		
		document.getElementById('periodo1').disabled=false;		
		document.getElementById('periodo2').disabled=false;	
	}
</script>

<div class="centro">
	<div id="caminho_migalhas">intranet &gt;</div>
	<div id="titulo_pagina">editar calend&aacute;rio</div>
	<div id="margem_direita"><br>
		<div class="conteudo_abas">
			<div id="conteudo_localizar" style="display:inline">
				<form name="consulta" id="consulta" method="post" onsubmit="return verificaForm()">    
				<div class="texto_formulario">Período:</div>   
                <?
                //---------------------------------------
				//recupera datas passadas por paramentro
				//---------------------------------------
					if($_GET['dti'] == ""){
						$Tdti = $_POST['periodo1'];
						$Tdtf = $_POST['periodo2'];
					}else{
						$Tdti = $_GET['dti'];
						$Tdtf = $_GET['dtf'];
					}
				?>             
				<input id="periodo1" name="periodo1" value="<?=$Tdti?>" disabled="disabled" >&nbsp;<a id="calendar-trigger"><img  align="absmiddle" src="../layout/imagens/atualiza_btn_calendario.jpg" border="0"/></a>			
				<script>
                Calendar.setup({					
                    inputField : "periodo1",						 
                    trigger    : "calendar-trigger",
                    onSelect   : function() { this.hide() }
                });
                </script>&agrave;
                <input id="periodo2" name="periodo2" value="<?=$Tdtf?>" disabled="disabled" >&nbsp;<a id="calendar-trigger2"><img src="../layout/imagens/atualiza_btn_calendario.jpg" border="0" align="absmiddle"/></a>
                <script>
                Calendar.setup({					
                    inputField : "periodo2",						 
                    trigger    : "calendar-trigger2",
                    onSelect   : function() { this.hide() }
                });
                </script>
                <br />
				<br />
				<input type="image" src="../layout/imagens/intra_btn_localizar.png" name="btLoc" id="btLoc" value="btLoc"/>
                </form>
	        </div>
        </div>
		<?php
		
		if(isset($_POST['btLoc_x']) or (isset($_GET['pg']))){
		
		?>
        <div class="tag_result_busca">resultados da busca</div>
        <div class="container_5">        
			<div id="resultado">
            	   
                <div class="container_2">                      
                    <br>                    
					<?php
                    require_once("../scripts/php/funcoes.php");				
                    require_once("../scripts/php/paginacao.php");
                    
                    //---------------------------------------------------
                    // Dados passados pelo formulário para fazer a busca
                    //---------------------------------------------------
                    $V_entidade = $_SESSION['SuserEnt']; 
                    $V_dt_1 = $_POST['periodo1'];
                    $V_dt_2 = $_POST['periodo2'];			
                    $V_data_1 = explode("/",$V_dt_1, 3);
                    $V_data_2 = explode("/",$V_dt_2, 3);				
                    $V_data[0] = $V_data_1[2]."/".$V_data_1[1]."/".$V_data_1[0];
                    $V_data[1] = $V_data_2[2]."/".$V_data_2[1]."/".$V_data_2[0];							
                    
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
                    // busca completa de datas da entidade
                    //---------------------------------------
                    $numSql	  = "SELECT COUNT(*) FROM calendario WHERE cal_data >= '$V_data[0]' AND cal_data <= '$V_data[1]' AND cal_entidade_id = $V_entidade";
                    $txtsql   = "SELECT * FROM calendario WHERE cal_data >= '$V_data[0]' AND cal_data <= '$V_data[1]' AND cal_entidade_id = $V_entidade ORDER BY cal_data DESC";			
                    $Tcaminho =  "inicio.php?pagina=intracalcad&menu=".$_GET['menu']."";
                    
                    $TreturnSqlDat = $drive->pedido($txtsql);
                    $TreturnSqlNum = $drive->pedido($numSql);
    				
					$i=0;
                    while($Tcalen = pg_fetch_object($TreturnSqlDat)){
                        $V_data_2 = explode("-",$Tcalen->cal_data, 3);
                        $V_data = $V_data_2[2]."/".$V_data_2[1]."/".$V_data_2[0];
						if($Tcalen->cal_tipo == 0){
							$Ttipo = "<img src=\"../layout/imagens/ico_calendario_intranet.png\" alt=\"INTERNO\" title=\"INTERNO\" border=\"0\">";
						}else{
							$Ttipo = "<img src=\"../layout/imagens/ico_calendario_internet.png\" alt=\"EXTERNO\" title=\"EXTERNO\" border=\"0\">";
						}
						echo"
                        <div class=\"container_item_result\"> 
                        <table width=\"98%\">
                            <tr>                   
                                <td width=\"55\" valign=\"top\" align=\"right\">                   
                                    <a href=\"inicio.php?pagina=caledit&menu=".$_GET['menu']."&id=".$Tcalen->cal_id."\" class=\"toggleopacity\">                   
                                        <img src=\"../layout/imagens/atualiza_btn_editar.png\" alt=\"editar\" width=\"50\" height=\"18\" border=\"0\" align=\"absmiddle\" />                   
                                    </a>                             
                                </td>                           
                                <td width=\"55\" valign=\"top\">                           
                                    <form name=\"form\" method=\"post\">    
                                        <input type=\"hidden\" name=\"registro\" value=\"".$Tcalen->cal_id."\" />    
                                        <input name=\"btExcluir\" value=\"btExcluir\" id=\"btExcluir\" type=\"image\" src=\"../layout/imagens/atualiza_btn_excluir.png\" onclick=\"return verificaExclusao()\"/>    
                                    </form>                                    
                                </td>                   
                                <td width=\"470\" valign=\"middle\">                          	                  
                                    <span class=\"titulo_linkserv\">| ".$V_data."</span>                   
                                    &nbsp;-&nbsp; ".subString($Tcalen->cal_titulo, 50)."                   
                                </td> 
								<td width=\"20\" valign=\"middle\" align=\"right\">                          	                  
                                    ".$Ttipo."                   
                                </td>                   
                            </tr>                   
                        </table>                    
                        </div>";
                    $i++;
                    }
           
                    if($i == 0){
                        echo "<b>Nenhum Arquivo Encontrado.</b>";	
                    }
					echo "
						<br />
                        <div id=\"area_paginacao\">";
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
                    echo "</div>";
					?>
                </div>        	
            </div>				
        </div>          
		<?php } ?>
	</div>
</div><!-- fim coluna_C2 -->  
<?PHP
if (isset($_POST['btExcluir_x'])){

// ======================== exclui resgistro bd (CALENDARIO) ========================
		
		require_once("../scripts/php/funcoes_bd.php");
		$V_id = $_POST['registro'];
		$V_del = $drive->deleta("calendario","cal_id",$V_id);
		if ($V_del == true){
			echo"<script>alert(\"Data excluída com Sucesso!\");</script>";
			echo("<script>window.location = \"inicio.php?pagina=intracalcad&menu=".$_GET['menu']."\";</script>");
		}else{
			echo"<script>alert(\"Erro na exclusão da Data.\");</script>";
		}
				
// ======================== fim resgistro bd (CALENDARIO) ========================

}
?>