<?php
if(!isset($_POST['btUpdate_x'])){

//--------------------------
//recupera dados do contato
//--------------------------
$TcntId		= $_GET['cntId'];
$sqlContato	= "SELECT * FROM mailing_contato WHERE mailing_contato_id = $TcntId";
$TreturnCnt = $drive->pedido($sqlContato);
$Tcontato	= pg_fetch_object($TreturnCnt);
$TverEmail  = $Tcontato->mailing_contato_email; 

//---------------------------
//recupera nome da categoria
//---------------------------
$TcatId		= $Tcontato->mailing_contato_categoria;
$sqlCat		= "SELECT * FROM mailing_categoria WHERE mailing_categoria_id = $TcatId";
$TresultCat = $drive->pedido($sqlCat);
$Tcategoria = pg_fetch_object($TresultCat);

//---------------------------------------------------
//recupera os e-mails ja cadastrados nesta categoria
//---------------------------------------------------
$sqlEmail	  = "SELECT mailing_contato_email FROM mailing_contato WHERE mailing_contato_categoria = $TcatId AND mailing_contato_excluido = 'f' AND mailing_contato_email <> '$TverEmail'";
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
            	<input type="hidden" name="FcntId" value="<?=$TcntId?>" />
                <div class="texto_formulario">Categoria: <font color="#1168A2"><?=$Tcategoria->mailing_categoria_nome?></font></div>
                <div class="texto_formulario">Nome:</div>
                <input name="Fnome" id="Fnome" type="text" class="componente_miolo" value="<?=$Tcontato->mailing_contato_nome?>" maxlength="200" /><br />
                <script type="text/javascript">
					var Fnome = new LiveValidation('Fnome'); 
					Fnome.add( Validate.Presence, {failureMessage: "Obrigatório"} );  
				</script>
                <div class="texto_formulario">E-mail:</div>
                <input name="Femail" id="Femail" type="text" class="componente_miolo" value="<?=$Tcontato->mailing_contato_email?>" maxlength="300" />
                <script type="text/javascript">
				var Femail = new LiveValidation('Femail'); 
					Femail.add( Validate.Exclusion, { within: [ <?=$Temails?> ], failureMessage: "E-mail já Cadastrado" } );
					Femail.add( Validate.Email, {failureMessage: "Formato inválido"} ); 
					Femail.add( Validate.Presence, {failureMessage: "Obrigatório"} ); 
				</script>
                <br /><br /><br />
				<input type="image" src="../layout/imagens/intra_btn_salvar.png" name="btUpdate" id="btUpdate" value="btUpdate" align="absmiddle" />               
                <a href="inicio.php?pagina=mailcontatocad&menu=<?=$_GET['menu']?>&catId=<?=$Tcategoria->mailing_categoria_id?>"><img src="../layout/imagens/intra_btn_cancelar.png" border="0" align="absmiddle" /></a>                             
			</form>
        </div>
	</div>
</div> 
<?php
}else{
	//-----------------------------
	//recupera dados do formulário
	//-----------------------------
	$Tnome 	= $_POST['Fnome'];
	$Temail	= $_POST['Femail'];
	$TcntId	= $_POST['FcntId'];
	
	//------------------------------
	//altera os dados e salva no BD
	//------------------------------
	$sqlUpdate	= "UPDATE 
						mailing_contato
				   SET
				   		mailing_contato_nome 	= '$Tnome',
						mailing_contato_email 	= '$Temail'
				   WHERE
				   		mailing_contato_id = $TcntId";
	$TreturnUp	= $drive->pedido($sqlUpdate);
	if($TreturnUp){
		echo"<script>alert(\"Contato Editado com Sucesso!\");</script>";
		echo("<script>window.location = \"inicio.php?pagina=mailcontatoedit&menu=".$_GET['menu']."&cntId=".$TcntId."\";</script>");
	}else{
		echo"<script>alert(\"Nao foi possivel Editar o Contato!\");</script>";
		echo("<script>window.location = \"inicio.php?pagina=mailcontatoedit&menu=".$_GET['menu']."&cntId=".$TcntId."\";</script>");
	}	
}
?> 