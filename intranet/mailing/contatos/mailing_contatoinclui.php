<?php
if(!isset($_POST['btInclui_x'])){
//------------------------------------------------------------------
//recupera o nome da entidade a qual o novo usuário será cadastrado
//------------------------------------------------------------------
$TcategoriaId = $_GET['catId'];
$sqlCategoria = "SELECT * FROM mailing_categoria WHERE mailing_categoria_id = $TcategoriaId";
$TreturnCat	  = $drive->pedido($sqlCategoria);
$Tcategoria   = pg_fetch_object($TreturnCat);

//---------------------------------------------------
//recupera os e-mails ja cadastrados nesta categoria
//---------------------------------------------------
$sqlEmail	  = "SELECT mailing_contato_email FROM mailing_contato WHERE mailing_contato_categoria = $TcategoriaId AND mailing_contato_excluido = 'f'";
$TresturnEmail= $drive->pedido($sqlEmail);
$Temails 	  = "";
while($TrecEmail = pg_fetch_object($TresturnEmail)){
	$Temails .= "'".$TrecEmail->mailing_contato_email."', ";
}
?>
<div class="centro">
	<div id="caminho_migalhas">intranet &gt; mailing</div>
	<div id="titulo_pagina">cadastro de contatos</div>
	<div id="margem_direita">
    	<br />
		<div class="conteudo_abas">        
			<div class="container_item_result">
            	<h3>
                	<img src="../layout/imagens/intra_icon_contato.png" alt="editar" border="0" align="absmiddle" /> 
                    <span>dados do contato</span>
                </h3>
           	</div>
            <br />
			<form method="post">
            	<input type="hidden" name="FcatId" value="<?=$_GET['catId']?>" />
                <div class="texto_formulario">Categoria: <font color="#1168A2"><?=$Tcategoria->mailing_categoria_nome?></font></div>
                <div class="texto_formulario">Nome:</div>
                <input name="Fnome" id="Fnome" type="text" class="componente_miolo" maxlength="200" /><br>
                <script type="text/javascript">
					var Fnome = new LiveValidation('Fnome'); 
					Fnome.add( Validate.Presence, {failureMessage: "Obrigatório"} );  
				</script>
                <div class="texto_formulario">E-mail:</div>
                <input name="Femail" id="Femail" type="text" class="componente_miolo" maxlength="300" />
                <script type="text/javascript">
				var Femail = new LiveValidation('Femail'); 
					Femail.add( Validate.Exclusion, { within: [ <?=$Temails?> ], failureMessage: "E-mail já Cadastrado" } );
					Femail.add( Validate.Email, {failureMessage: "Formato inválido"} ); 
					Femail.add( Validate.Presence, {failureMessage: "Obrigatório"} ); 
				</script>
                <br /><br /><br />
                <input type="image" src="../layout/imagens/intra_btn_salvar.png" name="btInclui" id="btInclui" value="btInclui" align="absmiddle" />
                <a href="inicio.php?pagina=mailcontatocad&menu=<?=$_GET['menu']?>&catId=<?=$_GET['catId']?>"><img src="../layout/imagens/intra_btn_cancelar.png" border="0" align="absmiddle" /></a>                             
			</form>
		</div>
	</div>
</div>  
<?php
}else{
	
	//----------------------------
	//recupera dados do formulario
	//----------------------------
	$Tnome 	= $_POST['Fnome'];
	$Temail	= $_POST['Femail'];
	$TcatId	= $_POST['FcatId'];
	$Texc	= "f";

	//-----------------------------------------------------------------------
	//verifica se o e-mail já esta cadastrado mas esta marcado como excluído
	//-----------------------------------------------------------------------
	$sqlVerifica	 = "SELECT * FROM mailing_contato WHERE mailing_contato_email = '$Temail'";
	$TreturnVerifica = $drive->pedido($sqlVerifica);
	$Tcontato 		 = pg_fetch_object($TreturnVerifica);
	$TcontatoId		 = $Tcontato->mailing_contato_id;
	if($Tcontato->mailing_contato_nome == NULL){
	
		//----------------------
		//se não existe insere os dados no BD
		//----------------------
		$sqlInsere 	= "INSERT INTO 
							mailing_contato(
								mailing_contato_id,
								mailing_contato_nome,
								mailing_contato_email,
								mailing_contato_categoria,
								mailing_contato_excluido
					  )VALUES(
							 default,
							'$Tnome',
							'$Temail',
							 $TcatId,
							'$Texc')";
	}else{
		
		//------------------------------------
		//se existir apenas atualiza os dados
		//------------------------------------
		$sqlInsere 	= "UPDATE 
							mailing_contato
					   SET
							mailing_contato_nome 	  = '$Tnome',
							mailing_contato_categoria =  $TcatId,
							mailing_contato_excluido  = '$Texc'
					   WHERE
					   		mailing_contato_id = $TcontatoId";
		
	}
	$TreturnIns	= $drive->pedido($sqlInsere);

	if($TreturnIns){
		echo("<script>alert('Contato incluido com Sucesso')</script>");	
		echo("<script>window.location = \"inicio.php?pagina=mailcontatoinclui&menu=".$_GET['menu']."&catId=".$_GET['catId']."\";</script>");
	}else{
		echo("<script>alert('Nao foi possivel incluir a Contato')</script>");
		echo("<script>window.location = \"inicio.php?pagina=mailcontatoinclui&menu=".$_GET['menu']."&catId=".$_GET['catId']."\";</script>");
	}
}
?>