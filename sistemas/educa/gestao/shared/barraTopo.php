
<div class='barraTopoConteudo'>
    <a href="index.php">Início</a>
<!--     <a href="">Perguntas Frequentes</a>
    <a href="">Notícias</a>
   <a href="http://189.90.59.3:3000">Suporte</a>
    <a href="">Contato</a>
    <a href="">Sobre</a> -->
    <?php if(isset($_SESSION['aut_gm'])){
    	if($_SESSION['aut_gm'] == true){
    		?>
    		<a href="limpaSessao.php">Sair</a>
    		<?php
    	}
    	} ?>
</div>