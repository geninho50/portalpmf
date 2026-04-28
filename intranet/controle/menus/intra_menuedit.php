<?php 
if(isset($_GET['menuid']) && !empty($_GET['menuid'])){
	$menuid 	= (int)$_GET['menuid'];
	$query 		= "SELECT * FROM intranet_menu WHERE intranet_menu_id = $menuid";
	$resultado	= $drive->pedido($query);	
	if(pg_num_rows($resultado) > 0){
		$o 			 = pg_fetch_object($resultado);
		$txtNomeMenu = $o->intranet_menu_titulo;
		$txtMenuPai  = $o->intranet_menu_tipo_pai;
		$txtEndereco = $o->intranet_menu_endereco_fisico;
		$txtAtalho 	 = $o->intranet_menu_atalho;
		switch($o->intranet_menu_tipo){
			case 'intranet' : $txtSistema = "Intranet PMF";		break;
			case 'internet' : $txtSistema = "ADM da Internet";  break;
		}			
		switch($txtMenuPai){
			case "t"	:
				$display_css	 = "none";
				$checked_pai 	 = "checked=\"checked\"";
				$checked_filho	 =  NULL;				
			break;
			case  "f"	:
				$display_css 	= "block";
				$checked_pai	=  NULL;
				$checked_filho  = "checked=\"checked\"";
			break;
		}
	}else{
		$drive->mensagem("Não faça isso !");
		$drive->redirect("?pagina=menucad&menu=".$_GET['menu']);	
	}
}else{
	$drive->redirect("?pagina=menucad&menu=".$_GET['menu']);
}

//-------------------------------------------------------------------------
// busca todas as tags de atalho pra não deixar cadastrar duas tags iguais
//-------------------------------------------------------------------------
$TvalidaAtalhho = "";
for($i=0; $i < count($_SESSION['SmenuAtalho'])-1; $i++){
	if($txtAtalho != $_SESSION['SmenuAtalho'][$i]){
		$TvalidaAtalho .= "'".$_SESSION['SmenuAtalho'][$i]."' , ";
	}
}
if($txtAtalho != $_SESSION['SmenuAtalho'][$i]){
	$TvalidaAtalho .= "'".$_SESSION['SmenuAtalho'][$i++]."' ";
}
?>
<div class="centro">
	<div id="caminho_migalhas">intranet &gt; </div>
   	<div id="titulo_pagina">dados do menu</div>
    <div id="margem_direita"><br>
    	<div class="conteudo_abas">        
			<h2>SITE: <?=$txtSistema?></h2><br>
        	<form action="?pagina=menucad&sistema=<?=$o->intranet_menu_tipo?>&menu=<?=$_GET['menu']?>" method="post" onsubmit="return verifica(this);">
            
            <div class="texto_formulario">Nome do Menu:</div>
          	<input name="txtNomeMenu" id="txtNomeMenu" type="text" class="componente_miolo" maxlength="250" value="<?=$txtNomeMenu?>"/>
            <script type="text/javascript">
				 var txtNomeMenu = new LiveValidation('txtNomeMenu'); 
				 txtNomeMenu.add( Validate.Presence, {failureMessage: "Obrigatório"} );  
			</script> 
            <br><br>
			<div class="texto_formulario">Ação ao clicar no menu:</div>
          	<input name="rbAcaoMenu" type="radio" value="pai"  <?=$checked_pai?> onclick="esconde('enderecos');"/>
            Este Menu será um título para outros sub-menus<br>
          	<input name="rbAcaoMenu" type="radio" value="filho" <?=$checked_filho?> onclick="mostra('enderecos');"/>Chamar Página:<br>
            
            <div id="enderecos" style="display:<?=$display_css?>;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Endereço: (ex: controle/entidade/entidcad.php)<br>
          	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="txtEndereco" id="txtEndereco" type="text" class="componente_miolo" maxlength="100" value="<?=$txtEndereco?>" /><br>
          	<script type="text/javascript">
				 var txtEndereco = new LiveValidation('txtEndereco'); 
				 txtEndereco.add( Validate.Presence, {failureMessage: "Obrigatório"} );  
			</script> 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Atalho para abrir página:(ex: entidedit)<br>
          	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="txtAtalho" id="txtAtalho" type="text" class="componente_miolo" maxlength="100" value="<?=$txtAtalho?>" /><br>
          	<script type="text/javascript">
				var txtAtalho = new LiveValidation('txtAtalho'); 
				txtAtalho.add( Validate.Exclusion, { within: [ <?=$TvalidaAtalho?> ], failureMessage: "Já existe" } ); 
				txtAtalho.add( Validate.Presence, {failureMessage: "Obrigatório"} ); 
			</script> 
            </div>
            <br /><br />
            <input type="image" id="btn_editar_menu" name="btn_editar_menu" src="../layout/imagens/intra_btn_salvar.png" border="0" align="absmiddle"/> 
            <input type="hidden" id="txtSistema" name="txtSistema" value="<?=$o->intranet_menu_tipo?>" />
            <input type="hidden" id="menuid" name="menuid" value="<?=$menuid?>" />
          	<a href="?pagina=menucad&sistema=<?=$o->intranet_menu_tipo?>&menu=<?=$_GET['menu']?>">
            	<img src="../layout/imagens/intra_btn_cancelar.png" border="0" align="absmiddle" />
            </a> 
          	</form>
            <br /><br>
      	</div>        
	</div>
</div>  
<script language="javascript">
function mostra(valor){
	document.getElementById(valor).style.display = "block";
}
function esconde(valor){
	document.getElementById(valor).style.display = "none";
}
function verifica(form){
	if(form.txtNomeMenu.value == ""){
		alert("Preencha o campo Nome do Menu");
		return false;
	}else{
		for(var i = 0; i < form.rbAcaoMenu.length; i++){					
			switch(form.rbAcaoMenu[i].checked){
				case true :					
					switch(form.rbAcaoMenu[i].value){
						case "pai":
							form.txtEndereco.value = "#";
							form.txtAtalho.value   = "#";
						break;						
						case "filho":
							if(form.txtEndereco.value == "" || form.txtAtalho.value == ""){
								alert("campo ENDEREÇO e campo ATALHO devem estar preenchidos");
								return false;
							}							
						break;
					}				
				break;				
				case false :
			    break;
			}
		}		
	}	
	return true;
}
</script>