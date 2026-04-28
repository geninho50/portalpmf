<div id="aba_galeria_img" >        
    <div class="submenu">
        <div class="item_selecionado"><a href="?pagina=pagedit&menu=<?=$_GET['menu']?>&idPag=<?=$_GET['idPag'];?>&aba=imagens&sb=galeria"><img src="../layout/imagens/intra_btn_galeria.png" border="0" alt="galeria da página"></a></div>
        <div class="item_link"><a href="?pagina=pagedit&menu=<?=$_GET['menu']?>&idPag=<?=$_GET['idPag'];?>&aba=imagens&sb=insere"><img src="../layout/imagens/intra_btn_add.png" border="0" alt="adicionar à página"></a></div>
       	<div class="item_link"><a href="?pagina=pagedit&menu=<?=$_GET['menu']?>&idPag=<?=$_GET['idPag'];?>&aba=imagens&sb=buscar"><img src="../layout/imagens/intra_btn_buscar.png" border="0" alt="buscar no repositório"></a></div>
    </div>
    <div class="subabas">
    <?php if(!isset($_GET['id'])){ 
    	echo"<div class=\"subabas\" id=\"img_galeria\" >";
			include("conteudo/forms/form_imggaleria.php"); 
    	echo"</div>";
	}else{
    	echo"<div class=\"subabas\" id=\"img_edit\"> 
        	<h1>Editar dados da Imagem:</h1>";         
        	include("midias/forms/form_imgedit.php");
    	echo"</div>";
	}
	?>
    </div>
</div>