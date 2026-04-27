<div id="aba_galeria_vid">        
    <div class="submenu">
        <div class="item_selecionado"><a href="?pagina=pagedit&menu=<?=$_GET['menu']?>&idPag=<?=$_GET['idPag'];?>&aba=videos&sb=galeria"><img src="../layout/imagens/intra_btn_galeria.png" border="0" alt="galeria da página"></a></div>
        <div class="item_link"><a href="?pagina=pagedit&menu=<?=$_GET['menu']?>&idPag=<?=$_GET['idPag'];?>&aba=videos&sb=insere"><img src="../layout/imagens/intra_btn_add.png" border="0" alt="adicionar à página"></a></div>
        <div class="item_link"><a href="?pagina=pagedit&menu=<?=$_GET['menu']?>&idPag=<?=$_GET['idPag'];?>&aba=videos&sb=buscar"><img src="../layout/imagens/intra_btn_buscar.png" border="0" alt="buscar no repositório"></a></div>
    </div>
    <?php if(!isset($_GET['id'])){ 
    	echo "<div class=\"subabas\" id=\"vid_galeria\" >";       
        	include("conteudo/forms/form_vidgaleria.php"); 
    	echo"</div>";
	}else{
    	echo"<div class=\"subabas\" id=\"aud_edit\"> 
        	<h1>Editar dados do Vídeo:</h1>";         
        	include("midias/forms/form_videdit.php"); 
    	echo"</div>";
    }
	?>
</div>