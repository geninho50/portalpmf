<?php 
   
print '	<div class="flex-container hero-wrapper" id="solicite" >
			<div id="busca-home" class="search-bar search-bar--home column6-lg column8-sm column8-xs">
		        <h1 class="hidden-sm hidden-xs">Informe os dados abaixo para acessar o sistema</h1><br>
				
				<div class="row">
				   <div class="col-md-12">
		                <label>E-mail:</label><input value="" id="login" class="form-control" type="text"/>
		            </div>				
		            <div class="col-md-12">
		                <label>Senha :</label><input id="senha" class="form-control" type="password"/>		          
		            </div>
					<div class="col-md-12">
						<label><div class="g-recaptcha form-control" data-sitekey="6Lf0zBsaAAAAAPaI0ZpJj9u79TjRkLJuOl_d8kr5"></div></label>
					</div>
				</div>								
			<br><br>

			<div class="row">
			 <div class="col-md-12">
				<input type="button" class="btn btn-primary botao" value="Entrar" onclick="acessarSistema();" />
				<input type="button" class="btn btn-secondary botao" value="Voltar" onclick="montarTela(1);" />
			</div>

			<div class="col-md-12">
				<h2 class="hidden-sm hidden-xs"></h2>
				<h2 class="hidden-sm hidden-xs"></h2>
			</div>
			</div>
		</div>
	</div> ';
?>	