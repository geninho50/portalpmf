<?php 

function menu( $codigo, $pagina ){ ?>
	<div id="menu" class="container">
		<ul>
			<li <?php if( $pagina == 'inicio' ){ print " class='current_page_item'"; }  ?>><a href="home.php?codigo=<? echo $codigo; ?>">Inicio</a></li>
			<li <?php if( $pagina == 'inscricao' ){ print " class='current_page_item'"; }  ?>><a href="times.php?codigo=<? echo $codigo; ?>">Inscri&ccedil;&atilde;o de Alunos</a></li> 
			<li <?php if( $pagina == 'inscricaoEquipe' ){ print " class='current_page_item'"; }  ?>><a href="preEquipe.php?codigo=<? echo $codigo; ?>">Inscri&ccedil;&atilde;o de Times</a></li> 
			<li <?php if( $pagina == 'consultaTimes' ){ print " class='current_page_item'"; }  ?>><a href="consultaTimes.php?codigo=<? echo $codigo; ?>">Consultar Times Inscritos</a></li>
			<!--<li class="current_page_item"><a href="login.html">Entrar</a></li> -->
			<li <?php if( $pagina == 'contato' ){ print " class='current_page_item'"; }  ?> ><a href="contato.php?codigo=<? echo $codigo; ?>">Contato</a></li>
			<li <?php if( $pagina == 'sair' ){ print " class='current_page_item'"; }  ?>><a href="index.php?codigo=<? echo $codigo; ?>">Sair</a></li>
		</ul>
	</div>
<?php } ?>