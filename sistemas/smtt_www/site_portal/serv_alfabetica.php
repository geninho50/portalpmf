<?php
$drive->conecta();
require_once("../scripts/php/funcoes.php");	

//========================================================
// verifica se é o primeiro acesso aos serviços, 
// se não for recurera da variavel GET o tipo da consulta 	
//========================================================
if(isset($_GET['info'])){
	$info = $_GET['info'];
}else{
	$info = "servicos";
}	

//=================================================
// verifica se foi setada uma letra para consulta,
// se não for setada usa A por default
//=================================================
if(isset($_GET['letra'])){
	$letra = $_GET['letra'];
}else {
	$letra = "A";
}	
?>

<script type="text/javascript">
function stAba(menu,conteudo){
	this.menu = menu;
	this.conteudo = conteudo;
}
var arAbas = new Array();
arAbas[0]  = new stAba('aba_servicos','conteudo_servicos');
arAbas[1]  = new stAba('aba_documentos','conteudo_documentos');
function AlternarAbas(menu,conteudo){
	for (i=0;i<arAbas.length;i++){
		document.getElementById(arAbas[i].menu).className = 'aba_serv';
		document.getElementById(arAbas[i].conteudo).style.display = 'none';
	}
	document.getElementById(menu).className = 'aba_sel';
	document.getElementById(conteudo).style.display = 'inline';
}
</script>

<div class="centro">
	<div id="cabecalho_servicos">
	<div id="caminho_migalhas">home &gt; serviços</div>
	
		<?php
		
		//=========================================
		// verifica qual aba será mostrada na tela
		//=========================================
        switch($info){
            case "servicos": require_once("abas/Salfabetico.php");
            break;
            case "documentos": require_once("abas/Dalfabetico.php");
            break;
            default: require_once("abas/Salfabetico.php");
            break;
        }	
		?>
	</div>
</div>