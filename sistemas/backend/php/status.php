<?php

print '
<nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute fixed-top">
	<div class="container-fluid">
		<div class="navbar-wrapper">
			<a class="navbar-brand" href="#pablo">Dados do Usuário</a>
		</div>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
			<span class="sr-only">Menu</span>
			<span class="navbar-toggler-icon icon-bar"></span>
			<span class="navbar-toggler-icon icon-bar"></span>
			<span class="navbar-toggler-icon icon-bar"></span>
		</button>
		<div class="collapse navbar-collapse justify-content-end" id="navigation">
			<form class="navbar-form">
				<div class="input-group no-border">
					<input type="text" value="" class="form-control" placeholder="Buscar...">
					<button type="submit" class="btn btn-white btn-round btn-just-icon">
						<i class="material-icons">Buscar</i>
						<div class="ripple-container"></div>
					</button>
				</div>
			</form>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="#pablo">
						<i class="material-icons">dashboard</i>
						<p>
							<span class="d-lg-none d-md-block">Status</span>
						</p>
					</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="material-icons">notificacoes</i>
						<span class="notification">5</span>
						<p>
							<span class="d-lg-none d-md-block">Acoes</span>
						</p>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="#">Responder Mensagem</a>
						<a class="dropdown-item" href="#">Enviar ping Servidor</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#pablo">
						<i class="material-icons">Pessoal</i>
						<p>
							<span class="d-lg-none d-md-block">Conta</span>
						</p>
					</a>
				</li>
			</ul>
		</div>
	</div>
 </nav>';
 
 ?>