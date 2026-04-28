<?php
require_once(CAMINHO_SITE."/layout/themePMF/includes/Mobile_Detect.php");
$detect = new Mobile_Detect;
 ?>

<div class="column4-lg column4-md column8-sm proccess-check-wrapper">
	<h2>Consulta de Processos</h2>	
	<form id="xtt-consulta-processo"  >		
		<p class="hidden-sm hidden-xs">Consulte o andamento de seu processo, visualize se existem pendências e/ou imprima 2 via de boleto caso possua uma ou mais 
										taxas que não foram pagas, basta acessar clicando no <b>botão abaixo</b></p>
		<a class="btn-block btn-lg btn-primary xtt-btn-submit" id="consultaProcessoDefault" href="https://servicos.floripa.sc.gov.br/atendimento/atendimento" target="_blank" ><b>Consultar</b></a>		
	</form>
	<div id="xtt-consulta-processo-error">

	</div>
</div>