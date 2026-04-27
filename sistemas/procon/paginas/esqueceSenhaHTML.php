<?php 
   
print '		<div class="flex-container hero-wrapper" id="solicite" >
			<div id="busca-home" class="search-bar search-bar--home column6-lg column8-sm column8-xs">
		        <h1 class="hidden-sm hidden-xs">Informe o E-mail que foi cadastrado para enviar uma nova senha</h1><br>
				
				<div class="row">
				   <div class="col-md-12">
		                <label>E-mail:</label><input value="" id="email" class="form-control" type="text"/>
		            </div>
				</div>				
			<br><br>

			<div class="row">
			 <div class="col-md-12">
				<input type="button" class="btn btn-primary botao" value="Enviar" onclick="esqueceuSenha();" />
				<input type="button" class="btn btn-secondary botao" value="Voltar" onclick="montarTela(1.1);" />
			</div>

			<div class="col-md-12">
				<h2 class="hidden-sm hidden-xs"></h2>
				<h2 class="hidden-sm hidden-xs"></h2>
			</div>
			</div>
		</div>
	</div> ';
?>	