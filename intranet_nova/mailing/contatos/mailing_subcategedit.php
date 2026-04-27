<?php
if(!isset($_POST['btAltera_x'])){
$TcatId		= $_GET['catId'];
$sqlBusca	= "SELECT * FROM mailing_categoria WHERE mailing_categoria_id = $TcatId";
$TresultBs	= $drive->pedido($sqlBusca);
$Tcategoria = pg_fetch_object($TresultBs);
?>
<div class="centro">
	<div id="caminho_migalhas">intranet &gt; mailing</div>
	<div id="titulo_pagina">cadastro de contatos</div>
	<div id="margem_direita">
    	<br />
		<div class="conteudo_abas">        
			<form method="post">
            	<input type="hidden" name="FcatId" value="<?=$_GET['catId']?>" />
                <div class="container_item_result">
                    <h3>
                        <img src="../layout/imagens/intra_icon_categorias.png" alt="editar" border="0" align="absmiddle" />
                        <span>dados da categoria</span>
                    </h3>
                </div>
                <br />
                <div class="texto_formulario">Nome:</div>
                <input name="Fnome" id="Fnome" type="text" class="componente_miolo" style="text-transform:uppercase;" maxlength="200" value="<?=$Tcategoria->mailing_categoria_nome?>" /><br>
                <script type="text/javascript">
					var Fnome = new LiveValidation('Fnome'); 
					Fnome.add( Validate.Presence, {failureMessage: "Obrigatório"} );  
				</script>
                <br /><br />
            	<input type="image" src="../layout/imagens/intra_btn_salvar.png" name="btAltera" id="btAltera" value="btAltera" align="absmiddle" />
                <a href="inicio.php?pagina=mailcategcad&menu=8"><img src="../layout/imagens/intra_btn_cancelar.png" border="0" align="absmiddle" /></a>                             
			</form>
        </div>
	</div>
</div>  
<?php
}else{
	//-------------------------------
	//dados passados pelo formulário
	//-------------------------------
	$TcatId 	= $_POST['FcatId'];
 	$Tnome  	= strtoupper($_POST['Fnome']);	
	$sqlUpdate 	= "UPDATE mailing_categoria	SET mailing_categoria_nome = '$Tnome' WHERE mailing_categoria_id = $TcatId";
	$TreturnUp	= $drive->pedido($sqlUpdate);
	if($TreturnUp){
		echo"<script>alert(\"Categoria Editada com Sucesso!\");</script>";
		echo("<script>window.location = \"inicio.php?pagina=mailsubcategedit&menu=".$_GET['menu']."&catId=".$TcatId."\";</script>");
	}else{
		echo"<script>alert(\"Nao foi possivel Editar a Categoria!\");</script>";
		echo("<script>window.location = \"inicio.php?pagina=mailsubcategedit&menu=".$_GET['menu']."&catId=".$TcatId."\";</script>");
	}	
}
?>