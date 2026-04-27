<?php
//------------------------------------------
// Página implementada em : 21/05/2010
// por: Rodrigo Rigoni
// E-mail: rigoni_chz@hotmail.com
//------------------------------------------

if(!isset($_POST['btEdit_x'])){
		
	$TarqId = $_GET['id'];
	$sql 	= "SELECT * FROM arquivos WHERE arq_id = $TarqId";
	$Tresult = $drive->pedido($sql);
	$Tarq = pg_fetch_object($Tresult);
?>
	<form method="post">
    <input type="hidden" name="id" value="<?=$TarqId?>" />
    <br />
    <a href="../<?=$Tarq->arq_link?>">
	<img src="../layout/imagens/atualiza_btn_download2.png" border="0"/></a>
	<br /><br />		
	<div class="texto_formulario">Título:</div>
	<input name="Ftitulo" type="text" class="componente_miolo" maxlength="200" value="<?=$Tarq->arq_nome?>" /><br>           
	<div class="texto_formulario">Descrição:</div>
	<label>
	<textarea name="Fdescricao" class="componente_miolo" cols="45" rows="7"><?=strip_tags($Tarq->arq_descricao)?></textarea>
	</label>
	<br>  
	<div class="texto_formulario">Tags de Busca:</div>
	<input type="text" id="Ftags" name="Ftags" class="ui-widget-content ui-corner-all" value="<?=$Tarq->arq_palavra_chave?>"/>         
	<br>
	<input type="image" src="../layout/imagens/intra_btn_salvar.png" name="btEdit" id="btEdit" value="btEdit" />
    </form>
<?php
}else{
	$TarqId 	= $_POST['id'];
	$Tnome 		= $_POST['Ftitulo'];
	$Tdescricao	= $_POST['Fdescricao'];
	$Ttags 		= $_POST['Ftags'];
	
	$sql 		= "UPDATE
						arquivos
				   SET
				 		arq_nome = '$Tnome',
						arq_descricao = '$Tdescricao',
						arq_palavra_chave = '$Ttags'
					WHERE
						arq_id = $TarqId";
		
	$Tresult = $drive->pedido($sql);
	
		//-------------------------------------------
		// Verifica de qual notícia partiu a inserção
		//-------------------------------------------
		
		if($_GET['pagina'] == "edtnot"){	
			$Tcaminho = "inicio.php?pagina=edtnot&menu=".$_GET['menu']."&idNot=".$_GET['idNot']."&aba=arquivos";
		}else{
			$Tcaminho = "inicio.php?pagina=arqedit&menu=".$_GET['menu']."&id=".$_GET['id']."";
		}
		
		//-------------------------------------------
		// Verifica de qual pagina partiu a inserção
		//-------------------------------------------
		
		if($_GET['pagina'] == "pagedit"){	
			$Tcaminho = "inicio.php?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=arquivos";
		}else{
			$Tcaminho = "inicio.php?pagina=arqedit&menu=".$_GET['menu']."&id=".$_GET['id']."";
		}
		
		//-------------------------------------------
		// Final de verificação
		//-------------------------------------------
		
	if($Tresult == true){
		echo"<script>alert(\"Arquivo Editado com Sucesso!\");</script>";
		$drive->redirect($Tcaminho);
	}else{
		echo"<script>alert(\"Nao foi possivel Editar o Arquivo!\");</script>";
		$drive->redirect($Tcaminho);
	}
}
?>