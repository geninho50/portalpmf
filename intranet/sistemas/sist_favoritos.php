<script>
function verificaExclusao(){
	if(confirm('Tem certeza que deseja Excluir?')){
		return true;
	}else{
		return false;
	}
}

</script>

<?php
//###################### faz a remoção do favorito #####################
if(isset($_POST['btExcluir_x'])){
	$TremoveId=$_POST['removeid'];
	$TremoveSql="DELETE FROM intranet_favoritos WHERE intranet_favoritos_id=$TremoveId";
	$Tretorno=$drive->pedido($TremoveSql);
	if($Tretorno == true){
		echo"<script>alert(\" Seu favorito foi excluido com sucesso!\");</script>";
		echo("<script>window.location = \"inicio.php?pagina=sistfavs&menu=".$_GET['menu']."\";</script>");	
	}else{
		echo"<script>alert(\"Nao foi possivel excluir o favorito!\");</script>";
		echo("<script>window.location = \"inicio.php?pagina=sistfavs&menu=".$_GET['menu']."\";</script>");		
	}
}else{
?>
<div class="centro">
	<div id="caminho_migalhas">intranet &gt;</div>
	<div id="titulo_pagina">meus favoritos</div>
	<div>
    
		<div id="coluna_intranet_unica">
<?php

require_once("../scripts/php/funcoes.php");
require_once("../scripts/php/paginacao.php");
$TuserId=$_SESSION['SuserId'];
//######### verifica se foi enviado o id para inserção #############
if(isset($_GET['id'])){
	$Tid=$_GET['id'];
	//##################### insere nos favoritos ######################
	$TfavSql="INSERT INTO intranet_favoritos
				(
				 intranet_favoritos_id,
				 intranet_favoritos_user_id,
				 intranet_favoritos_sistema_id
				)
			VALUES
				(
				 default,
				 $TuserId,
				 $Tid
				 )";
	//------------------ retorno --------------------
	$Tretorno=$drive->pedido($TfavSql);
	if($Tretorno == true){
			echo"<script>alert(\" Seu favorito foi incluido!\");</script>";
			echo("<script>window.location = \"inicio.php?pagina=sistfavs&menu=".$_GET['menu']."\";</script>");	
		}else{
			echo"<script>alert(\"Nao foi possivel incluir o favorito!\");</script>";
			echo("<script>window.location = \"inicio.php?pagina=sistconsulta&menu=".$_GET['menu']."\";</script>");
		}
		//########################### mostra os favoritos ###########################
		$TfavIdSql = "SELECT * FROM intranet_favoritos LEFT JOIN intranet_sistemas ON intranet_favoritos_sistema_id=intranet_sistemas_id";
		//--------------- retorno ----------------------
		$TretornoFav = $drive->pedido($TfavIdSql);
		
		echo '<table width="680" border="0" cellspacing="0" cellpadding="0">';
		while($linha=pg_fetch_object($TretornoFav)){
			//--------------------verifica se esta disponivel na intranet -------------
			if($linha->intranet_sistemas_exibirweb=='t'){
			echo "
				<tr>
					<form method=\"post\">
					<td valign=\"top\" width=\"490\" class=\"result_busca_intranet\"><span class=\"titulo_linkserv\">".$linha->intranet_sistemas_nome."</span></td>
					<td valign=\"middle\" width=\"190\" class=\"result_busca_intranet\">&nbsp;
					<a href=\"".$linha->intranet_sistemas_endereco."\"><img src=\"../layout/imagens/intra_btn_acessar.png\" alt=\"online\" border=\"0\" align=\"left\" /></a>
					<input type=\"image\" src=\"../layout/imagens/intra_btn_remove_fav.png\" name=\"btExcluir\" id=\"btExcluir\" value=\"btExcluir\"  align=\"absmiddle\" onclick=\"return verificaExclusao()\" />
					<input type=\"hidden\" name=\"removeid\" value=\"".$linha->intranet_favoritos_id."\">
					</td>
					</form>
				</tr>
			    ";
			//----------------- nao disponiveis na intranet----------------
			}else{
			echo "
				<tr>
					<form method=\"post\">
					<td valign=\"top\" width=\"490\" class=\"result_busca_intranet\"><span class=\"titulo_linkserv\">".$linha->intranet_sistemas_nome."</span></td>
					<td valign=\"middle\" width=\"190\" class=\"result_busca_intranet\">&nbsp;
					<input type=\"image\" src=\"../layout/imagens/intra_btn_remove_fav.png\" name=\"btExcluir\" id=\"btExcluir\" value=\"btExcluir\"  align=\"absmiddle\" onclick=\"return verificaExclusao()\" />
					<input type=\"hidden\" name=\"removeid\" value=\"".$linha->intranet_favoritos_id."\">
					</td>
					</form>
				</tr>
				";
			}
		}
		echo '</table>';
//################# somente mostra os favoritos ##############	
}else{	
	
		$TfavIdSql = "SELECT * FROM intranet_favoritos LEFT JOIN intranet_sistemas ON intranet_favoritos_sistema_id=intranet_sistemas_id WHERE intranet_favoritos_user_id=$TuserId";
		//----------retorno--------------
		$TretornoFav = $drive->pedido($TfavIdSql);
		echo '<table width="680" border="0" cellspacing="0" cellpadding="0">';
		$i=0;
		while($linha=pg_fetch_object($TretornoFav)){
			//----------verifica se esta disponivel na intranet---------
			if($linha->intranet_sistemas_exibirweb=='t'){
			echo "
				<tr>
					<form method=\"post\">
					<td valign=\"top\" width=\"505\" class=\"result_busca_intranet\"><span class=\"titulo_linkserv\">".$linha->intranet_sistemas_nome."</span></td>
					<td valign=\"middle\" width=\"60\" class=\"result_busca_intranet\">
					<a href=\"".$linha->intranet_sistemas_endereco."\"><img src=\"../layout/imagens/intra_btn_acessar.png\" alt=\"online\" border=\"0\" align=\"left\" /></a>
					</td>
					<td valign=\"middle\" width=\"115\" class=\"result_busca_intranet\">
					<input type=\"image\" src=\"../layout/imagens/intra_btn_remove_fav.png\" name=\"btExcluir\" id=\"btExcluir\" value=\"btExcluir\"  align=\"absmiddle\" onclick=\"return verificaExclusao()\" />
					<input type=\"hidden\" name=\"removeid\" value=\"".$linha->intranet_favoritos_id."\">
					</td>
					</form>
				</tr>
				";
			$i++;
			//---------- não disponiveis na intranet------------
			}else{
			echo "
				<tr>
					<form method=\"post\">
					<td valign=\"top\" width=\"505\" class=\"result_busca_intranet\"><span class=\"titulo_linkserv\">".$linha->intranet_sistemas_nome."</span></td>
					
					<td valign=\"middle\" width=\"60\" class=\"result_busca_intranet\">&nbsp;</td>
					<td valign=\"middle\" width=\"115\" class=\"result_busca_intranet\">
					<input type=\"image\" src=\"../layout/imagens/intra_btn_remove_fav.png\" name=\"btExcluir\" id=\"btExcluir\" value=\"btExcluir\"  align=\"absmiddle\" onclick=\"return verificaExclusao()\" />
					<input type=\"hidden\" name=\"removeid\" value=\"".$linha->intranet_favoritos_id."\">
					</td>
					</form>
				</tr>
				";
			$i++;
			}
		}
		echo '</table>';
		if($i==0){
			echo'Voc&ecirc; n&atilde;o possui nenhum Sistema na sua lista de favoritos. <br ><br>
			<a href="inicio.php?pagina=sistconsulta&menu='.$_GET['menu'].'"><img src="../layout/imagens/intra_btn_inclui_fav.png" border="0"/></a>';
		}
		
}
?>     

 </div><!-- fim coluna_home_1 -->
     
  
    
     <br class="clearfloat">

             
	</div>
</div><!-- fim coluna_C2 -->           
<?php } ?>