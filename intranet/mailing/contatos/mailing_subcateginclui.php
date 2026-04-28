<?php
if(!isset($_POST['btInclui_x'])){
//------------------------------------------------------------------
//recupera o nome da entidade a qual o novo usuário será cadastrado
//------------------------------------------------------------------
$TcategoriaId = $_GET['catId'];
$sqlCategoria =  "SELECT * FROM mailing_categoria WHERE mailing_categoria_id = $TcategoriaId";
$TreturnCat	  = $drive->pedido($sqlCategoria);
$Tcategoria   = pg_fetch_object($TreturnCat);
?>
<div class="centro">
	<div id="caminho_migalhas">intranet &gt; mailing</div>
	<div id="titulo_pagina">cadastro de contatos</div>
	<div id="margem_direita">
    	<br />
		<div class="conteudo_abas">        
			<div class="container_item_result">
            	<h3>
                	<img src="../layout/imagens/intra_icon_categorias.png" alt="editar" border="0" align="absmiddle" /> 
                    <span>dados da categoria</span>
                </h3>
            </div>
            <br />
			<div class="texto_formulario">Categoria Pai: <font color="#1168A2"><?=$Tcategoria->mailing_categoria_nome?></font></div>
			<form method="post">
                <input type="hidden" name="FcatId" value="<?=$TcategoriaId?>" />
                <div class="texto_formulario">Nome:</div>
                <input name="Fnome" id="Fnome" type="text" class="componente_miolo" style="text-transform:uppercase;" maxlength="200" /><br>
                <script type="text/javascript">
					var Fnome = new LiveValidation('Fnome'); 
					Fnome.add( Validate.Presence, {failureMessage: "Obrigatório"} );  
				</script>
                <div class="texto_formulario">Tipo:</div>
                <input name="Ftipo" type="radio" value="1" checked="checked" />Pasta para Outras Categorias<br>
                <input name="Ftipo" type="radio" value="0" />Pasta de Contatos
                <br /><br /><br />
                <input type="image" src="../layout/imagens/intra_btn_salvar.png" name="btInclui" id="btInclui" value="brInclui" align="absmiddle" />
                <a href="inicio.php?pagina=mailsubcategcad&menu=<?=$_GET['menu']?>&catId=<?=$_GET['catId']?>">	
                    <img src="../layout/imagens/intra_btn_cancelar.png" border="0" align="absmiddle" />
                </a>  
			</form>                             
		</div>
	</div>
</div>  
<?php
}else{
	//-----------------------------------
	//Variavéis passadas pelo formulário
	//-----------------------------------
	$Tnome		 = strtoupper($_POST['Fnome']);
	$Ttipo		 = $_POST['Ftipo'];
	$Thierarquia = $_POST['FcatId']; 
	
	//----------------------
	//insere os dados no bd	
	//----------------------
	$sqlInsere	 = "INSERT INTO 
						mailing_categoria(
							mailing_categoria_id,
							mailing_categoria_nome,
							mailing_categoria_tipo,
							mailing_categoria_hierarquia
						)VALUES(
							 default,
							'$Tnome',
							 $Ttipo,
							 $Thierarquia)";
	$TresultIns	 = $drive->pedido($sqlInsere);
	
	if($TresultIns){
		echo("<script>alert('Sub-Categoria incluida com Sucesso')</script>");	
		echo("<script>window.location = \"inicio.php?pagina=mailsubcateginclui&menu=".$_GET['menu']."&catId=".$_GET['catId']."\";</script>");
	}else{
		echo("<script>alert('Nao foi possivel incluir a Sub-Categoria')</script>");
		echo("<script>window.location = \"inicio.php?pagina=mailsubcateginclui&menu=".$_GET['menu']."&catId=".$_GET['catId']."\";</script>");
	}
}
?>