<div id="caminho_migalhas">intranet &gt;</div>
<div id="titulo_pagina">editar p&aacute;gina</div>
<div id="margem_direita">
    <div class="painel_abas">
        <a href="?pagina=pagedit&menu=<?=$_GET['menu']?>&idPag=<?=$_GET['idPag'];?>&aba=dados"><div id="aba_dados" class="aba_adm"><span>dados</span></div></a>
        <a href="?pagina=pagedit&menu=<?=$_GET['menu']?>&idPag=<?=$_GET['idPag'];?>&aba=imagens"><div id="aba_imagens" class="aba_sel"><span>imagens</span></div></a>
        <a href="?pagina=pagedit&menu=<?=$_GET['menu']?>&idPag=<?=$_GET['idPag'];?>&aba=videos"><div id="aba_video" class="aba_adm"><span>v&iacute;deos</span></div></a>
        <a href="?pagina=pagedit&menu=<?=$_GET['menu']?>&idPag=<?=$_GET['idPag'];?>&aba=audios"><div id="aba_audio" class="aba_adm"><span>&aacute;udios</span></div></a>
        <a href="?pagina=pagedit&menu=<?=$_GET['menu']?>&idPag=<?=$_GET['idPag'];?>&aba=arquivos"><div id="aba_arquivos" class="aba_adm"><span>arquivos</span></div></a>
        <a href="?pagina=pagedit&menu=<?=$_GET['menu']?>&idPag=<?=$_GET['idPag'];?>&aba=visualizar"><div id="aba_view" class="aba_adm"><span>visualiza&ccedil;&atilde;o</span></div></a>
    </div> 
    <div class="conteudo_abas">  
        <div id="conteudo_imagens">
			<?php 
            switch($_GET['sb']){
                case "galeria": require_once("imagens/img_galeria.php"); break;
                case "insere": require_once("imagens/img_insere.php"); break;  
				case "buscar": require_once("imagens/img_buscar.php"); break;                
               	default: require_once("imagens/img_galeria.php");
            }
            ?>
            <br class="clearfloat">  
        </div>
	</div>
</div>        