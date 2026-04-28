<?php
require_once(CAMINHO_SITE."/layout/themePMF/includes/Mobile_Detect.php");
$detect = new Mobile_Detect;

?>
<div class="column8-lg column4-md column8-sm proccess-check-wrapper">
	<h2>Consulta de Processos</h2>
	<p class="hidden-sm hidden-xs">Consulte o andamento informando o número do processo/ano e o CPF ou CNPJ de um dos interessados.</p>
	<form id="xtt-consulta-processo" action="<?=CONSULTA_PROCESSO_POST_URL?>">
		<div class="flex-container">
			<div class="input-wrapper">
				<label for="Número/Ano">Número/Ano</label>
				<?php
				if ($detect->isMobile() ) {
					echo "<input type=\"tel\" name=\"Número/Ano\" id=\"xtt-processo-ano\" placeholder=\"Número do processo/Ano\">";
				} else {
					echo "<input type=\"text\" name=\"Número/Ano\" id=\"xtt-processo-ano\" placeholder=\"Número do processo/Ano\">";
				}
				 ?>

			</div>
			<div class="input-wrapper">
				<label for="CPF/CNPJ">CPF/CNPJ</label>
				<?php
				if ($detect->isMobile() ) {
					echo "<input type=\"tel\" name=\"CPF/CNPJ\" id=\"xtt-cpf-cnpj\" placeholder=\"CPF/CNPJ\">";
				} else {
					echo "<input type=\"text\" name=\"CPF/CNPJ\" id=\"xtt-cpf-cnpj\" placeholder=\"CPF/CNPJ\">";
				}
				 ?>
			</div>
		</div>
		<div class="recaptcha-wrapper">
			<div class="g-recaptcha" data-callback="recaptchaInserted" data-sitekey="6LeVejAUAAAAADnlpWEtKW2eXJSo_L5yl2efPCjd"></div>
		</div>
		<button class="btn-block btn-lg btn-primary xtt-btn-submit" id="consultaProcessoDefault" type="button" disabled>Consultar</button>
		<button class="btn-block btn-lg btn-primary" id="consultaProcessoLoading" type="button" style="display: none;"><i class="fa fa-spinner fa-spin"></i></button>
	</form>
	<div id="xtt-consulta-processo-error">

	</div>
</div>
