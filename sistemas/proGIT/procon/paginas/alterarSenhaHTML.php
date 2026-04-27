<?php 
   
print '		<div class="flex-container hero-wrapper" id="solicite" >
			<div id="busca-home" class="search-bar search-bar--home column6-lg column8-sm column8-xs">
		        <h1 class="hidden-sm hidden-xs">Informe os dados abaixo para alterar a sua senha</h1><br>
				
				<div class="row">
					<div class="col-md-12">
		                <label>Senha atual:</label><input name="atual" id="atual" class="form-control" type="password"/>
		            </div>	
				    <div class="col-md-12">
		                <label>Nova senha:</label><input name="senha" id="senha" class="form-control" type="password"/>
		            </div>				
		            <div class="col-md-12">
		                <label>Repita senha nova:</label><input name="repita" id="repita" class="form-control" type="password"/>		          
		            </div>
				</div>				
			<br><br>

			<div class="row">
			 <div class="col-md-12">
				<input type="button" class="btn btn-primary botao" value="Alterar" onclick="alterarSenha();" />
				<input type="button" class="btn btn-secondary botao" value="Voltar" onclick="montarTela(7);" />
			</div>

			<div class="col-md-12">
				<h2 class="hidden-sm hidden-xs"></h2>
				<h2 class="hidden-sm hidden-xs"></h2>
			</div>
			</div>
		</div>
	</div> ';
?>	