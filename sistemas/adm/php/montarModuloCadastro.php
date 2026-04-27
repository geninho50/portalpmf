<?php

include_once("funcoes.php");

include_once("gdb.php");

$gdb = new gdb();

$modulo = $gdb->vargetpost('modulo');
$id     = $gdb->vargetpost('id');

switch ($modulo) {
	case 41:

		$pai = "<i class=\"icon_tools\"></i>Servi&ccedil;os";
		$NomeCadastro = " <i class=\"icon-task-l\"></i>Equipamento";
		$tabela = "SERVICOEquipamento";
		$campos = array("equCodigo", "equTombamento", "equTipo", "equDescricao", "equLocalOrigem", "equSituacao", "equObs");
		$titulos = array("Codigo", "Tombamento", "Tipo", "Descri&ccedil;&atilde;o", "Local", "Situação", "Observa&ccedil;&atilde;o");
		break;
	case 31:
		$pai = "<i class=\"icon_tools\"></i>Servi&ccedil;os";
		$NomeCadastro = " <i class=\"icon-task-l\"></i>Cadastro de Equipamento";
		$tabela = "SERVICOEquipamento";
		$campos = array("equCodigo", "equTombamento", "equTipo", "equDescricao", "equLocalOrigem", "equSituacao", "equObs");
		$titulos = array("Codigo", "Tombamento", "Tipo", "Descri&ccedil;&atilde;o", "Local", "Situação", "Observa&ccedil;&atilde;o");

		// V(N)   - V => campo tipo Numerico, N=> tamanho maximo do campo - Ex.: S10
		// S(N)   - S => campo tipo String, N=> tamanho maximo do campo - Ex.: S10
		// T(N)   - T => campo tipo texto,  N=> Número de linhas da caixa de texto, coluna é 50 -  Ex.: T5
		// C(V:N) - C => Combo com valores definidos, V=>valor, N => titulo - Ex.: C(M:Mação,L:Laranja,U:Uva,1:Tangerina)
		// B(T)   - B => Combo com valores definidos, T= Select para montar a tabela - Ex.: B(Select Nome, valor from Precos )

		$montarCombo = array(
			'V(6)',
			'V(6)',
			'B( select sitValor, sitDescricao from situacao order by sitDescricao  )',
			'T(5)',
			'B( select localCodigo, localDescricao from servicoLocal order by localDescricao )',
			'B( select sitValor, sitDescricao from situacao order by sitDescricao )',
			'T(5)'
		);
		break;
}

montarCadastro($pai, $NomeCadastro, $tabela, $campos, $titulos,$id );
?>