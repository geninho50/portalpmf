<?php
require_once("../scripts/php/funcoes_bd.php"); // classe de conecxão com o bd
$drive->conecta(); // faz a conecxão com o bd

//-----------------------------
// Select Entidades PREFEITURA
//-----------------------------
$sql = "SELECT entidade_linha_1, entidade_id FROM entidades WHERE entidade_tipo = 0 AND entidade_excluida = 'f' AND entidade_id <> 0 ORDER BY entidade_linha_1";
$TentidadesPrefeitura = $drive->pedido($sql);	

//-----------------------------------------
// Select Entidades SECRATARIAS MUNICIPAIS 
//-----------------------------------------
$sql2 = "SELECT entidade_linha_1, entidade_id FROM entidades WHERE entidade_tipo = 4 AND entidade_excluida = 'f' ORDER BY entidade_linha_1";
$TentidadesMunicipais = $drive->pedido($sql2);	

//-----------------------------------------
// Select Entidades SECRETARIAS EXECUTIVAS 
//-----------------------------------------	
$sql3 = "SELECT entidade_linha_1, entidade_id FROM entidades WHERE entidade_tipo = 5 AND entidade_excluida = 'f' ORDER BY entidade_linha_1";
$TentidadesExecutivas = $drive->pedido($sql3);

//-----------------------------------------
// Select Entidades SECRETARIAS EXECUTIVAS 
//-----------------------------------------	
$sql4 = "SELECT entidade_linha_1, entidade_id FROM entidades WHERE entidade_tipo = 6 AND entidade_excluida = 'f' ORDER BY entidade_linha_1";
$TentidadesOrgaos = $drive->pedido($sql4);

//-----------------------------------------
// Select Entidades SUPERINTEND�NCIAS 
//-----------------------------------------	
$sql8 = "SELECT entidade_linha_1, entidade_id FROM entidades WHERE entidade_tipo = 8 AND entidade_excluida = 'f' ORDER BY entidade_linha_1";
$TentidadesSuperintendencia = $drive->pedido($sql8);

//-----------------------------------------
// Select Entidades CONSELHO
//-----------------------------------------	
$sql9 = "SELECT entidade_linha_1, entidade_id FROM entidades WHERE entidade_tipo = 9 AND entidade_excluida = 'f' ORDER BY entidade_linha_1";
$TentidadesConselho = $drive->pedido($sql9);

//----------------
// Select EVENTOS
//----------------	
$sql5 = "SELECT entidade_linha_1, entidade_id FROM entidades WHERE entidade_tipo = 7 AND entidade_excluida = 'f' ORDER BY entidade_linha_1";
$TentidadesEventos = $drive->pedido($sql5);	

//----------------
// Select Excluídos
//----------------	
$sql6 = "SELECT entidade_nome, entidade_id FROM entidades WHERE entidade_excluida = 't' ORDER BY entidade_nome";
$TentidadesExcluidas = $drive->pedido($sql6);	
?>

<div class="centro">	
    <div id="caminho_migalhas">intranet &gt;</div>	
    <div id="titulo_pagina">consultar entidades</div>	
    <div id="margem_direita"><br>	
    	<div class="conteudo_abas">	
    		<div id="conteudo_listagem" style="display:inline">              
                <?php 				
				//--------------------------------------------
				// Imprime entidades principais da prefeitura
				//--------------------------------------------
				echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
						 <tr>	
						 	<td width=\"620\" height=\"20\" colspan=\"3\" class=\"container_item_result\"><h4>Prefeitura</h4></td>
						 </tr>";
					
				while($Tprefeitura = pg_fetch_object($TentidadesPrefeitura)){
					echo "<tr>
							<td width=\"520\" class=\"container_item_result\">
							<span class=\"titulo_linkserv\">".$Tprefeitura->entidade_linha_1."</span>
							</td>
							<td width=\"50\" class=\"container_item_result\" align=\"right\">
								<a href=\"?pagina=entedit&menu=".$_GET['menu']."&id=".$Tprefeitura->entidade_id."\" class=\"toggleopacity\"><img src=\"../layout/imagens/atualiza_btn_editar.png\" alt=\"editar\" width=\"50\" height=\"18\" border=\"0\" align=\"absmiddle\" /></a>
							</td>
							<td width=\"50\" class=\"container_item_result\" align=\"left\">
								<form  method=\"post\">
									<input type=\"hidden\" name=\"FidEntidade\" value=\"".$Tprefeitura->entidade_id."\" />
									<input name=\"btExcluir\" value=\"excluir\" id=\"btExcluir\" type=\"image\" src=\"../layout/imagens/atualiza_btn_excluir.png\" onclick=\"return verificaExclusao()\">
								</form>
							</td>
						</tr>";
				}

				echo "</table><br />";
				
				//-----------------------------------
				// Imprime as Secretarias Municipais
				//-----------------------------------				
				echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
						 <tr>	
						 	<td width=\"620\" height=\"20\" colspan=\"3\" class=\"container_item_result\"><br><h4>Secretarias Municipais</h4></td>
						 </tr>";
					
				while($Tmunicipais = pg_fetch_object($TentidadesMunicipais)){
					echo "<tr>
							<td width=\"520\" class=\"container_item_result\">
							<span class=\"titulo_linkserv\">".$Tmunicipais->entidade_linha_1."</span>
							</td>
							<td width=\"50\" class=\"container_item_result\" align=\"right\">
								<a href=\"?pagina=entedit&menu=".$_GET['menu']."&id=".$Tmunicipais->entidade_id."\" class=\"toggleopacity\"><img src=\"../layout/imagens/atualiza_btn_editar.png\" alt=\"editar\" width=\"50\" height=\"18\" border=\"0\" align=\"absmiddle\" /></a>
							</td>
							<td width=\"50\" class=\"container_item_result\" align=\"left\">
								<form  method=\"post\">
									<input type=\"hidden\" name=\"FidEntidade\" value=\"".$Tmunicipais->entidade_id."\" />
									<input name=\"btExcluir\" value=\"excluir\" id=\"btExcluir\" type=\"image\" src=\"../layout/imagens/atualiza_btn_excluir.png\" onclick=\"return verificaExclusao()\">
								</form>
							</td>
						</tr>";
				}

				echo "</table><br />";
				
				//-----------------------------------
				// Imprime as Secretarias Executivas
				//-----------------------------------				
				echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
						 <tr>	
						 	<td width=\"620\" height=\"20\" colspan=\"3\" class=\"container_item_result\"><br><h4>Secretarias Executivas</h4></td>
						 </tr>";
					
				while($Texecutivas = pg_fetch_object($TentidadesExecutivas)){
					echo "<tr>
							<td width=\"520\" class=\"container_item_result\">
							<span class=\"titulo_linkserv\">".$Texecutivas->entidade_linha_1."</span>
							</td>
							<td width=\"50\" class=\"container_item_result\" align=\"right\">
								<a href=\"?pagina=entedit&menu=".$_GET['menu']."&id=".$Texecutivas->entidade_id."\" class=\"toggleopacity\"><img src=\"../layout/imagens/atualiza_btn_editar.png\" alt=\"editar\" width=\"50\" height=\"18\" border=\"0\" align=\"absmiddle\" /></a>
							</td>
							<td width=\"50\" class=\"container_item_result\" align=\"left\">
								<form  method=\"post\">
									<input type=\"hidden\" name=\"FidEntidade\" value=\"".$Texecutivas->entidade_id."\" />
									<input name=\"btExcluir\" value=\"excluir\" id=\"btExcluir\" type=\"image\" src=\"../layout/imagens/atualiza_btn_excluir.png\" onclick=\"return verificaExclusao()\">
								</form>
							</td>
						</tr>";
				}

				echo "</table><br />";

				//-----------------------------------
				// Imprime as Superintend�ncia
				//-----------------------------------				
				echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
						 <tr>	
						 	<td width=\"620\" height=\"20\" colspan=\"3\" class=\"container_item_result\"><br><h4>Superintend&ecirc;ncias</h4></td>
						 </tr>";
					
				while($Tsuperintendencia = pg_fetch_object($TentidadesSuperintendencia)){
					echo "<tr>
							<td width=\"520\" class=\"container_item_result\">
							<span class=\"titulo_linkserv\">".$Tsuperintendencia->entidade_linha_1."</span>
							</td>
							<td width=\"50\" class=\"container_item_result\" align=\"right\">
								<a href=\"?pagina=entedit&menu=".$_GET['menu']."&id=".$Tsuperintendencia->entidade_id."\" class=\"toggleopacity\"><img src=\"../layout/imagens/atualiza_btn_editar.png\" alt=\"editar\" width=\"50\" height=\"18\" border=\"0\" align=\"absmiddle\" /></a>
							</td>
							<td width=\"50\" class=\"container_item_result\" align=\"left\">
								<form  method=\"post\">
									<input type=\"hidden\" name=\"FidEntidade\" value=\"".$Tsuperintendencia->entidade_id."\" />
									<input name=\"btExcluir\" value=\"excluir\" id=\"btExcluir\" type=\"image\" src=\"../layout/imagens/atualiza_btn_excluir.png\" onclick=\"return verificaExclusao()\">
								</form>
							</td>
						</tr>";
				}

				echo "</table><br />";

				//-----------------------------------
				// Imprime as Conselho
				//-----------------------------------				
				echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
						 <tr>	
						 	<td width=\"620\" height=\"20\" colspan=\"3\" class=\"container_item_result\"><br><h4>Conselhos</h4></td>
						 </tr>";
					
				while($Tconselho = pg_fetch_object($TentidadesConselho)){
					echo "<tr>
							<td width=\"520\" class=\"container_item_result\">
							<span class=\"titulo_linkserv\">".$Tconselho->entidade_linha_1."</span>
							</td>
							<td width=\"50\" class=\"container_item_result\" align=\"right\">
								<a href=\"?pagina=entedit&menu=".$_GET['menu']."&id=".$Tconselho->entidade_id."\" class=\"toggleopacity\"><img src=\"../layout/imagens/atualiza_btn_editar.png\" alt=\"editar\" width=\"50\" height=\"18\" border=\"0\" align=\"absmiddle\" /></a>
							</td>
							<td width=\"50\" class=\"container_item_result\" align=\"left\">
								<form  method=\"post\">
									<input type=\"hidden\" name=\"FidEntidade\" value=\"".$Tconselho->entidade_id."\" />
									<input name=\"btExcluir\" value=\"excluir\" id=\"btExcluir\" type=\"image\" src=\"../layout/imagens/atualiza_btn_excluir.png\" onclick=\"return verificaExclusao()\">
								</form>
							</td>
						</tr>";
				}

				echo "</table><br />";

				//---------------------------------
				// Imprime os Órgãos da Prefeitura
				//---------------------------------				
				echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
						 <tr>	
						 	<td width=\"620\" height=\"20\" class=\"container_item_result\" colspan=\"3\"><br><h4>&Oacute;rg&atilde;os</h4></td>
						 </tr>";
					
				while($Torgaos = pg_fetch_object($TentidadesOrgaos)){
					echo "<tr>
							<td width=\"520\" class=\"container_item_result\">
							<span class=\"titulo_linkserv\">".$Torgaos->entidade_linha_1."</span>
							</td>
							<td width=\"50\" class=\"container_item_result\" align=\"right\">
								<a href=\"?pagina=entedit&menu=".$_GET['menu']."&id=".$Torgaos->entidade_id."\" class=\"toggleopacity\"><img src=\"../layout/imagens/atualiza_btn_editar.png\" alt=\"editar\" width=\"50\" height=\"18\" border=\"0\" align=\"absmiddle\" /></a>
							</td>
							<td width=\"50\" class=\"container_item_result\" align=\"left\">
								<form  method=\"post\">
									<input type=\"hidden\" name=\"FidEntidade\" value=\"".$Torgaos->entidade_id."\" />
									<input name=\"btExcluir\" value=\"excluir\" id=\"btExcluir\" type=\"image\" src=\"../layout/imagens/atualiza_btn_excluir.png\" onclick=\"return verificaExclusao()\">
								</form>
							</td>
						</tr>";
				}

				echo "</table><br />";
				
				//-----------------------------
				// Imprime os sites de Eventos
				//-----------------------------				
				echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
						 <tr>	
						 	<td width=\"620\" height=\"20\" class=\"container_item_result\" colspan=\"3\"><br><h4>Eventos</h4></td>
						 </tr>";
						
				while($Teventos = pg_fetch_object($TentidadesEventos)){
					echo "<tr>
							<td width=\"520\" class=\"container_item_result\">
							<span class=\"titulo_linkserv\">".$Teventos->entidade_linha_1."</span>
							</td>
							<td width=\"50\" class=\"container_item_result\" align=\"right\">
								<a href=\"?pagina=entedit&menu=".$_GET['menu']."&id=".$Teventos->entidade_id."\" class=\"toggleopacity\"><img src=\"../layout/imagens/atualiza_btn_editar.png\" alt=\"editar\" width=\"50\" height=\"18\" border=\"0\" align=\"absmiddle\" /></a>
							</td>
							<td width=\"50\" class=\"container_item_result\" align=\"left\">
								<form  method=\"post\">
									<input type=\"hidden\" name=\"FidEntidade\" value=\"".$Teventos->entidade_id."\" />
									<input name=\"btExcluir\" value=\"excluir\" id=\"btExcluir\" type=\"image\" src=\"../layout/imagens/atualiza_btn_excluir.png\" onclick=\"return verificaExclusao()\">
								</form>
							</td>
						</tr>";
				}

				echo "</table><br />";
				
				//----------------------------
				// Imprime os sites Excluídos
				//----------------------------				
				echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
						 <tr>	
						 	<td width=\"620\" height=\"20\" class=\"container_item_result\" colspan=\"3\"><br><h4>Entidades Exclu&iacute;das</h4></td>
						 </tr>";
						
				while($Texcluidas = pg_fetch_object($TentidadesExcluidas)){
					echo "<tr>
							<td width=\"520\" class=\"container_item_result\">
							<span class=\"titulo_linkserv\"><font color=\"#FF0000\">".$Texcluidas->entidade_nome."</font></span>
							</td>
							<td width=\"50\" class=\"container_item_result\" align=\"right\">
								<a href=\"?pagina=entedit&menu=".$_GET['menu']."&id=".$Texcluidas->entidade_id."\" class=\"toggleopacity\"><img src=\"../layout/imagens/atualiza_btn_editar.png\" alt=\"editar\" width=\"50\" height=\"18\" border=\"0\" align=\"absmiddle\" /></a>
							</td>
							<td width=\"50\" class=\"container_item_result\" align=\"left\">
								<form  method=\"post\">
									<input type=\"hidden\" name=\"FidEntidade\" value=\"".$Texcluidas->entidade_id."\" />
									<input name=\"btExcluir\" value=\"excluir\" id=\"btExcluir\" type=\"image\" src=\"../layout/imagens/atualiza_btn_excluir.png\" onclick=\"return verificaExclusao()\">
								</form>
							</td>
						</tr>";
				}

				echo "</table>";
                ?>			
            </div>
    	</div>	
    </div>
</div>

<script language="javascript">

function verificaExclusao(){
	if(confirm('Tem Certeza Que Deseja Excluir a Entidade?')){
		return true;
	}else{
		return false;
	}
}
</script>

<?php
//----------------------------------------------------------
// verifica se foi solicitado a exclusão de alguma entidade
//----------------------------------------------------------
if(isset($_POST["btExcluir_x"])){
	$TidEntidade = $_POST['FidEntidade'];

	require_once("../scripts/php/funcoes_bd.php");		
	$drive->conecta(); // faz a conexão com o bd
	
	//----------------------------------------------------------
	// verifica se a entidade q esta sendo excluída possui site
	// se possui então apaga o site
	//----------------------------------------------------------
	$sqlEnt 	= "SELECT * FROM entidades WHERE entidade_id = $TidEntidade";
	$TreturnEnt = $drive->pedido($sqlEnt);
	$Tentidade  = pg_fetch_object($TreturnEnt);
	
	switch((int)$Tentidade->entidade_tipo){
		case 7  : $tipoSite = "sites";
		break;
		default : $tipoSite = "entidades";
	}
	
	if($Tentidade->entidade_path != ""){
		if((int)$Ttipo != 7){
			$deletarsistema   = @unlink("../".$tipoSite."/".$Tentidade->entidade_path."/sistema.php");
			$deletarconsultas = @unlink("../".$tipoSite."/".$Tentidade->entidade_path."/consultas.php");
		}
		$deletarindex     = @unlink("../".$tipoSite."/".$Tentidade->entidade_path."/index.php");
		$deletarbanner    = @unlink("../".$tipoSite."/".$Tentidade->entidade_path."/Banner.swf");
		$deletarpasta     = @rmdir("../".$tipoSite."/".$Tentidade->entidade_path."/");		
	}
	$Tsite 		= "";
	$TflagSite  = 0;

	//--------------------------------------------------------------------------------------------------
	// Faz a exclusão LÓGICA da entidade
	// OBS.: Nuca fazer a exclusão FÝSICA, devido a todos os arquivos que foram postados nesta entidade
	//--------------------------------------------------------------------------------------------------
	$sqlExclui = "UPDATE 
						entidades
				  SET 					  	
						entidade_excluida 	= 't',
						entidade_path 		= '$Tsite',
						entidade_flag_site  = $TflagSite
				  WHERE
				  		entidade_id = $TidEntidade";
	$TdeletaRegistro = $drive->pedido($sqlExclui);
	
	$drive->close(); // fecha conexão com o bd
	
	if ($TdeletaRegistro == true){		
		echo"<script>alert(\"Entidade excluida com Sucesso!\");</script>";
		echo("<script>window.location = \"?pagina=entcad&menu=".$_GET['menu']."\"</script>");		
	}else{		
		echo"<script>alert(\"Não foi possível excluir a Entidade.\");</script>";
		echo("<script>window.location = \"?pagina=entcad&menu=".$_GET['menu']."\"</script>");
	}

}

?>