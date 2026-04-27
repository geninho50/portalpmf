
<?php print '

       <!--
		<div id="busca-home" class="search-bar search-bar--home column3-lg column4-sm column4-xs " >
			<div class="row" align="center">
			<video width="320" height="240" controls="controls">
			    <source src="http://www.pmf.sc.gov.br/sistemas/rastreabilidade/imagens/V�deo 1 - Correspond�ncia Digital - Cadastro (1).mp4" type="video/mp4">
			    Seu navegador n�o suporta HTML5.
			</video>
			<video width="320" height="240" controls="controls">
			    <source src="http://www.pmf.sc.gov.br/sistemas/rastreabilidade/imagens/V�deo 2 - Correspond�ncia Digital - Reprovar e Responder - Fila de Trabalho e E-mail (1).mp4" type="video/mp4">
			    Seu navegador n�o suporta HTML5.
			</video><br /><br>			
			<a type="button" class="btn btn-primary botao" href="http://www.pmf.sc.gov.br/sistemas/rastreabilidade/videos.php" style="color: white;">+ V�deos</a>
			</div>
		</div>
		-->
		<div id="busca-home" class="search-bar search-bar--home column3-lg column4-sm column4-xs">
			<form name="duvida">
					  <h1>D&uacute;vidas?</h1><br>
						<div class="row"> 
								<div class="col-md-6">
									<label>Nome:</label><input  id="nome" class="form-control" type="text"/>		          
								</div>

								<div class="col-md-6">
									<label>E-mail:</label><input  id="email" class="form-control" type="text"/>
								</div>
							</div><br>
							<div class="row">
								 <div class="col-md-12">
									<label>D&uacute;vida:</label><textarea  id="duvida" class="form-control" type="text"></textarea>
								</div>
							</div><br>
							 <div class="col-md-12" align="left">
							<input type="button" class="btn btn-primary botao" value="Enviar" onclick="enviarDuvida(1);" />
							<input type="button" class="btn btn-secondary botao" value="Voltar" onclick="montarTela(1.1);" />
						</div>
			</form> 
		</div> ';

?>