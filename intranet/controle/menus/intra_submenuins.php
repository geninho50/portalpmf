<?php
if( isset($_GET['menupai']) && !empty($_GET['menupai']) ){
	$menupai 	 = (int)$_GET['menupai'];
	$sqlControl  = "SELECT intranet_menu_tipo_pai, intranet_menu_titulo, intranet_menu_id FROM intranet_menu WHERE intranet_menu_id = $menupai"; 
	$rsqlControl = $drive->pedido($sqlControl);
	if(pg_num_rows($rsqlControl) > 0){
		$oSqlControl = pg_fetch_object($rsqlControl);
		if($oSqlControl->intranet_menu_tipo_pai == "t"){
			$txtTituloMenu = $oSqlControl->intranet_menu_titulo;
		}else{
			$drive->redirect("?pagina=menucad&menu=".$_GET['menu']."");	
		}
	}else{
		$drive->redirect("?pagina=menucad&menu=".$_GET['menu']."");	
	}
}else{
	$drive->redirect("?pagina=menucad&menu=".$_GET['menu']."");
}
		
//-------------------------------------------------------------------------
// busca todas as tags de atalho pra não deixar cadastrar duas tags iguais
//-------------------------------------------------------------------------
$TvalidaAtalhho = "";
for($i=0; $i < count($_SESSION['SmenuAtalho'])-1; $i++){
	$TvalidaAtalho .= "'".$_SESSION['SmenuAtalho'][$i]."' , ";
}
$TvalidaAtalho .= "'".$_SESSION['SmenuAtalho'][$i++]."' ";

?>
<div class="centro">
	<div id="caminho_migalhas">intranet &gt;</div>
	<div id="titulo_pagina">dados do submenu</div>
	<div id="margem_direita"><br />
		<div class="conteudo_abas">
 			<h2>menu: <?=$txtTituloMenu?></h2><br>
            <form action="?pagina=submenucad&menuid=<?=$menupai?>&menu=<?=$_GET['menu']?>" method="post">
                <input type="hidden" id="txtmenupai" name="txtmenupai" value="<?=$menupai?>" />	
                <div class="texto_formulario">Nome do Menu:</div>
                <input name="txtNomeMenu" id="txtNomeMenu" type="text" class="componente_miolo" maxlength="200" />
                <script type="text/javascript">
                    var txtNomeMenu = new LiveValidation('txtNomeMenu'); 
                    txtNomeMenu.add( Validate.Presence, {failureMessage: "Obrigatório"} );  
                </script> 
                <br><br>
                <b>Endereço:</b> (ex: controle/entidade/entidcad.php)<br>
                <input name="txtEndereco" id="txtEndereco" type="text" class="componente_miolo" maxlength="500" /><br>
                <script type="text/javascript">
                    var txtEndereco = new LiveValidation('txtEndereco'); 
                    txtEndereco.add( Validate.Presence, {failureMessage: "Obrigatório"} );  
                </script> 
                <br /><b>Atalho para abrir página:</b> (ex: entidedit)<br>
                <input name="txtAtalho" id="txtAtalho" type="text" class="componente_miolo" maxlength="20" /><br>
                <script type="text/javascript">
                    var txtAtalho = new LiveValidation('txtAtalho'); 
                    txtAtalho.add( Validate.Exclusion, { within: [ <?=$TvalidaAtalho?> ], failureMessage: "Já existe" } ); 
                    txtAtalho.add( Validate.Presence, {failureMessage: "Obrigatório"} ); 
                </script>              
                <br />
                <br />             
                <input type="image" id="btn_incluir_menu" name="btn_incluir_menu" src="../layout/imagens/intra_btn_salvar.png" border="0" align="absmiddle"/> 
                <a href="?pagina=submenucad&menuid=<?=$_GET['menupai']?>&menu=<?=$_GET['menu']?>">
                    <img src="../layout/imagens/intra_btn_cancelar.png" border="0" align="absmiddle" />
                </a>            
        	</form>      
      	</div>
  	</div>
</div>