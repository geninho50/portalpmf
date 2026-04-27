<div id="aba_incluir_aud">        
    <div class="submenu">
        <div class="item_link"><a href="?pagina=pagedit&menu=<?=$_GET['menu']?>&idPag=<?=$_GET['idPag'];?>&aba=audios&sb=galeria"><img src="../layout/imagens/intra_btn_galeria.png" border="0" alt="galeria da página"></a></div>
        <div class="item_selecionado"><a href="?pagina=pagedit&menu=<?=$_GET['menu']?>&idPag=<?=$_GET['idPag'];?>&aba=audios&sb=insere"><img src="../layout/imagens/intra_btn_add.png" border="0" alt="adicionar à página"></a></div>
    	<div class="item_link"><a href="?pagina=pagedit&menu=<?=$_GET['menu']?>&idPag=<?=$_GET['idPag'];?>&aba=audios&sb=buscar"><img src="../layout/imagens/intra_btn_buscar.png" border="0" alt="buscar no repositório"></a></div>
    </div>
    <div class="subabas"> 
        <h1>Adicionar novo áudio à Página</h1>       
        <?php include("midias/forms/form_audinclui.php"); ?> 
    </div>
</div>