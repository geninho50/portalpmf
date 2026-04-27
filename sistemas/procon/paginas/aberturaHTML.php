<?php
  
  @header("Content-Type: text/html; charset=iso-8859-1");
  @header("Cache-Control: no-cache, must-revalidate");
  @header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
  
  print '     <div class="column4-lg column4-md column8-sm" >
				<div id="busca-home" class="search-bar search-bar--home column6-lg column8-sm column8-xs">
			        <h1 class="hidden-sm hidden-xs">FAÇA AQUI A SUA RECLAMAÇÃO!</h1><br>
			        <p style="color: white;"> O PROCON, em razão da pandemia da COVID-19, está recebendo reclamações por meio desta ferramenta online.</p><br>
			        <li style="color: white;"> Caso você não tenha um cadastro de Consumidor, clique no botão abaixo e faça o seu cadastro.</li><br>
			        <li style="color: white;">Caso você já tenha um cadastro, clique em <b>Faça sua Reclamação</b>. Informe o seu usuário ( E-mail ) e a senha, e faça a sua reclamação.</li><br>
					<li style="color: yellow;">O cadastro é permitido somente para <b>Consumidores de Florianópolis.</b></li><br>
				</div>
		</div>

		<div class="column4-lg column4-md column8-sm" style="padding-top: 15px; padding-right: 15px; ">
				<div class="category-list" >
					<div class="category-list">
						<div class="category-citizen active">
							<a class="category active" style="background-color: transparent;"></a>
							<a class="category active" style="background-color: transparent;"></a>
							<a class="category active" style="background-color: transparent;"></a>
							<a class="category active" onclick="montarTela(2);" >Cadastro do Consumidor</a>
							<a class="category active" onclick="montarTela(5);" >Esqueceu a senha</a>
							<a class="category active" onclick="montarTela(4);" >Faça sua Reclamação</a>
							<a class="category active" onclick="montarTela(6);" >Acompanhe sua Reclamação</a>
							<a class="category active" href="http://www.pmf.sc.gov.br/ouvidoria/index.php" target="_blank">Ouvidoria</a>
						    <a class="category active" onclick="montarTela(3);">Dúvidas</a>
							<a class="category active" style="background-color: transparent;"></a>
						</div>
					</div>
				</div>
		 </div>';
?>