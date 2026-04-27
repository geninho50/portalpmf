<?php 

$emBreve = "Em breve";

print '
	<a class="navbar-brand" href="index.html">
		   <img class="logo" src="images/logo.png" alt="logo" />
		</a>
		
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="fas fa-bars"></span>
		</button>
		
		<div class="collapse navbar-collapse" id="navbarResponsive">
		
		   <ul class="navbar-nav ml-auto">
		   
			  <li class="nav-item">
				 <a class="nav-link active" href="index.html">Home</a>
			  </li>
			  
			  <li class="nav-item">
				 <a class="nav-link" href="#" onclick="AbrirItem( 1 );">Sobre Nós</a>
			  </li>
			  
			  <li class="nav-item">
				 <a class="nav-link" href="#" onclick="AbrirItem( 2 );">Cursos e Oficinas</a>
			  </li>
			  
			  <li class="nav-item dropdown">
			  
				 <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cadastro</a>
				 
				 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">

					<a class="dropdown-item" href="#" onclick="AbrirItem( 25 );" >CADASTRO DE HORTELÃO</a>
					<a class="dropdown-item" href="#" onclick="AbrirItem( 34 );" >CADASTRE SUA HORTA</a>
					<a class="dropdown-item" href="#" onclick="AbrirItem( 20 );" >MANUAL</a>
				 </div>
				 
			  </li>

			  <li class="nav-item dropdown">
				 <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hortas</a>
				 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
					<a class="nav-link" href="#" onclick="AbrirItem( 20 )">ENCONTRE UMA HORTA</a>
					<hr>
					<a class="nav-link" href="#" onclick="AbrirItem( 8 )">COMUNITÁRIAS</a>
					<hr>
					<a  href="#" ><b>INSTITUCIONAIS</b></a><br>
					<a class="nav-link" href="#" onclick="AbrirItem( 10 )">PEDAGÓGICAS</a>
					<a class="nav-link" href="#" onclick="AbrirItem( 20 );">CRAS</a>
					<a class="nav-link" href="#" onclick="AbrirItem( 22 );">CENTROS DE SAÚDE</a>
				 </div>
			  </li>		

			  <li class="nav-item">
				 <a class="nav-link" href="#" onclick="AbrirItem( 31 );">Compostagem</a>
			  </li>

			  <li class="nav-item">
				 <a class="nav-link"  href="#" onclick="AbrirItem( 6 );">Viveiros Municipais</a>
			  </li>
			  <li class="nav-item">
				 <a class="nav-link"  href="#" onclick="AbrirItem( 7 );">Contato</a>
			  </li>
		   </ul>
		</div>';

		  /*<li class="nav-item dropdown">
				 <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				 Compostagem
				 </a>
				 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
					<a class="dropdown-item"href="#" onclick="AbrirItem(31)">O que é</a>
					<a class="dropdown-item" href="#" onclick="AbrirItem(20)">Composteira Termofílica</a>
					<a class="dropdown-item" href="#" onclick="AbrirItem(20)">Minhocário</a>
					<a class="dropdown-item" href="#" onclick="AbrirItem(20)">Compostagem Comunitária</a>
				 </div>
			  </li>*/
		 /* <li class="nav-item dropdown">
				 <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				 Feiras
				 </a>
				 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
					<a class="dropdown-item" href="#" onclick="AbrirItem(20);">História das Feiras</a>
					<a class="dropdown-item" href="#" onclick="AbrirItem(20);">Feiras Livres</a>
					<a class="dropdown-item" href="#" onclick="AbrirItem(4);">Feiras de Orgânicos</a>
				 </div>
			  </li>*/
?>