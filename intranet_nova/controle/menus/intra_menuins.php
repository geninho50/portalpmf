<?php 
//-------------------------------------------------------------------
// Verifica qual sistema está sendo visualizado Intranet ou Internet
//-------------------------------------------------------------------
require_once('includes/get_tipo_sistema.php'); 

//-------------------------------------------------------------------------
// busca todas as tags de atalho pra não deixar cadastrar duas tags iguais
//-------------------------------------------------------------------------
$TvalidaAtalhho = " ";
for($i=0; $i < count($_SESSION['SmenuAtalho'])-1; $i++){
	$TvalidaAtalho .= "'".$_SESSION['SmenuAtalho'][$i]."' , ";
}
$TvalidaAtalho .= "'".$_SESSION['SmenuAtalho'][$i++]."' ";
?>
<div class="centro">
	<div id="caminho_migalhas">intranet &gt;</div>
   	<div id="titulo_pagina">dados do menu</div>
    <div id="margem_direita"><br />
        <div class="conteudo_abas">
            <h2>SITE: <?=$nome_sistema?></h2><br />  
          	<form action="?pagina=menucad&sistema=<?=$get_sistema?>&menu=<?=$_GET['menu']?>" method="post">            
                <div class="texto_formulario">Nome do Menu:</div>
                <input name="txtNomeMenu" id="txtNomeMenu" type="text" class="componente_miolo" maxlength="250" />
                <script type="text/javascript">
                    var txtNomeMenu = new LiveValidation('txtNomeMenu'); 
                    txtNomeMenu.add( Validate.Presence, {failureMessage: "Obrigatório"} );  
                </script> 
                <br /><br />
                <div class="texto_formulario">Ação ao clicar no menu:</div>
                <input name="rbAcaoMenu" type="radio" value="pai" checked onclick="esconde('enderecos');"/>
                Este Menu será um título para outros sub-menus<br>
                <input name="rbAcaoMenu" type="radio" value="filho" onclick="mostra('enderecos');"/>Chamar Página:<br />                
                <div id="enderecos" style="display:none;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Endereço: (ex: controle/entidade/entidcad.php)<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="txtEndereco" id="txtEndereco" type="text" value="#" class="componente_miolo" maxlength="100" /><br />
                <script type="text/javascript">
                    var txtEndereco = new LiveValidation('txtEndereco'); 
                    txtEndereco.add( Validate.Presence, {failureMessage: "Obrigatório"} );  
                </script> 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Atalho para abrir página:(ex: entidedit)<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="txtAtalho" id="txtAtalho" value="#" type="text" class="componente_miolo" maxlength="100" /><br />
                <script type="text/javascript">
                    var txtAtalho = new LiveValidation('txtAtalho'); 
                    txtAtalho.add( Validate.Exclusion, { within: [ <?=$TvalidaAtalho?> ], failureMessage: "Já existe" } ); 
                    txtAtalho.add( Validate.Presence, {failureMessage: "Obrigatório"} ); 
                </script>
                </div>
                <br /><br />
                <input type="image" id="btn_incluir_menu" name="btn_incluir_menu" src="../layout/imagens/intra_btn_salvar.png" border="0" align="absmiddle"/> 
                <input type="hidden" id="txtSistema" name="txtSistema" value="<?=$get_sistema?>" />
                <a href="?pagina=menucad&sistema=<?=$get_sistema?>&menu=<?=$_GET['menu']?>">
                    <img src="../layout/imagens/intra_btn_cancelar.png" border="0" align="absmiddle" />
                </a> 
          	</form>                     
          	<br /><br />
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
</script>