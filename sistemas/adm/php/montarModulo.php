<?php

include_once("funcoes.php");

include_once("gdb.php");

$gdb = new gdb();

$modulo = $gdb->vargetpost('modulo');

switch ($modulo) {
	case 41:
		$titulo_cadastro = "";
		$pai = "Transparência";
		$titulo = "Contratos/Aquisi&ccedil;&otilde;es";
		$campos = array("codigo", "orgao", "numero", "contratado", "documento", "objeto", "unidade", "quantidde", "valor", "total", "assinatura", "prazo", "download", "instrumento", "modalidade", "local");
		$cabecalho = array("Codigo", "Orgão", "Número", "Contratado", "Documento", "Objeto", "Unidade", "Quantidde", "Valor", "Total", "Assinatura", "Prazo", "Download", "Instrumento", "Modalidade", "Local");
		break;
	case 31:
		$titulo_cadastro = "Listagem de Equipamentos";
		$pai = "<i class=\"icon_tools\"></i>Suporte";
		$titulo = "<i class=\"icon-task-l\"></i>Equipamento";
		$tabela = "SERVICOEquipamento";
		$campos = array("equCodigo", "equTombamento", "equTipo", "equDescricao", "equLocalOrigem", "equSituacao", "equObs");
		$tipoCampos = array("N", "N", "S", "S", "N", "S", "S");
		$cabecalho = array("Codigo", "Tombamento", "Tipo", "Descri&ccedil;&atilde;o", "Local", "Situa&ccedil;&atilde;o", "Observa&ccedil;&atilde;o");
		$filtroCampo = array(1, 1, 1, 1, 0, 0, 0);
		$visivelCampo = array(1, 1, 1, 1, 0, 0, 0);
		break;
}

montarConsulta($pai, $cabecalho, $campos, $titulo, $tabela, $filtroCampo, $visivelCampo, $tipoCampos, $titulo_cadastro);

?>