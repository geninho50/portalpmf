<div class="centro">
	<div id="caminho_migalhas">intranet &gt; mailing</div>
	<div id="titulo_pagina">cadastro de contatos</div>
	<?php
    if(!isset($_POST['btInclui_x'])){
	?>
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
			<form method="post">
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
                <a href="inicio.php?pagina=mailcategcad&menu=<?=$_GET['menu']?>">	
                    <img src="../layout/imagens/intra_btn_cancelar.png" border="0" align="absmiddle" />
                </a>  
			</form>
        </div>					
    </div>
    <?php
	}else{
		//-----------------------------------
		//Variavéis passadas pelo formulário
		//-----------------------------------
		$Tnome		 = strtoupper($_POST['Fnome']);
		$Ttipo		 = $_POST['Ftipo'];
		$Thierarquia = 0; 
		
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
			echo("<script>alert('Categoria incluida com Sucesso')</script>");	
			echo("<script>window.location = \"inicio.php?pagina=mailcateginclui&menu=".$_GET['menu']."\";</script>");
		}else{
			echo("<script>alert('Nao foi possivel incluir a Categoria')</script>");
			echo("<script>window.location = \"inicio.php?pagina=mailcateginclui&menu=".$_GET['menu']."\";</script>");
		}	
	}
	?>
</div> 