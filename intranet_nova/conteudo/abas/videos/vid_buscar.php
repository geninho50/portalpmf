<div id="aba_localizar_vid">        
<div class="submenu">
         <div class="item_link"><a href="?pagina=pagedit&menu=<?=$_GET['menu']?>&idPag=<?=$_GET['idPag'];?>&aba=videos&sb=galeria"><img src="../layout/imagens/intra_btn_galeria.png" border="0" alt="galeria da página"></a></div>
         <div class="item_link"><a href="?pagina=pagedit&menu=<?=$_GET['menu']?>&idPag=<?=$_GET['idPag'];?>&aba=videos&sb=insere"><img src="../layout/imagens/intra_btn_add.png" border="0" alt="adicionar à página"></a></div>
         <div class="item_selecionado"><a href="?pagina=pagedit&menu=<?=$_GET['menu']?>&idPag=<?=$_GET['idPag'];?>&aba=videos&sb=buscar"><img src="../layout/imagens/intra_btn_buscar.png" border="0" alt="buscar no repositório"></a></div>
</div>

<div class="subabas" id="vid_busca">       
<?php include("conteudo/forms/form_vidbusca.php"); ?> 
</div>

</div>