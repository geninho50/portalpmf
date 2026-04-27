<?php 

@header("Content-Type: text/html; charset=iso-8859-1");
@header("Cache-Control: no-cache, must-revalidate");
@header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    

print '		<div class="flex-container hero-wrapper" id="solicite" >
			<div id="busca-home" class="search-bar search-bar--home column6-lg column8-sm column8-xs">
		        <h1 class="hidden-sm hidden-xs">Informe o c&oacute;digo da sua reclama&ccedil;&atilde;o abaixo</h1><br>
				
				<div class="row">
				   <div class="col-md-12">
		                <label>Código :</label><input value="" id="reclamacaoCodigo" class="form-control" type="text"/>
		            </div>
				</div>				
			<br><br>

			<div class="row">
			 <div class="col-md-12">
				<input type="button" class="btn btn-primary botao" value="consultar" onclick="consultar();" />
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