<?php

	#Eduardo de Toledo Barros Chatagnier
	#eduardotc@ciasc.sc.gov.br
	#(48)3664-1045


	# acao(Array): Array('htmlentities','trim','strip_tags','mysql_real_escape_string') etc.
	# arr (Array): array (pode ser multimencional) a ser aplicada a ação
	# retorno(Array): array

	@ini_set("allow_call_time_pass_reference",true);

	function arrmap($arrAcao,&$arr){
		foreach($arr as $k=>$v){
			if(is_array($v)){
				$arr[$k] = arrmap($arrAcao,$v);
			}else{
				$acao = implode("(",$arrAcao);
				$acaoFecha = str_repeat(")", count($arrAcao));
				// eval("\$arr['$k'] = " . $acao . "(\$v" . $acaoFecha . ";");
			}
		}
		return $arr;
	}

	# valor (String): Texto a ser tratado
	# retorno(String): string
	function remove_sql_injection($valor){
		$arrDe		= Array();					$arrPara	= Array();

		$arrDe[]	= 'DROP ';					$arrPara[]	= 'D_R_O_P ';
		$arrDe[]	= 'TRUNCATE ';				$arrPara[]	= 'T_R_U_N_C_A_T_E ';
		$arrDe[]	= 'SELECT ';					$arrPara[]	= 'S_E_L_E_C_T ';
		$arrDe[]	= 'FROM ';					$arrPara[]	= 'F_R_O_M ';
		$arrDe[]	= 'UNION ';					$arrPara[]	= 'U_N_I_O_N ';
		$arrDe[]	= 'REPLACE ';				$arrPara[]	= 'R_E_P_L_A_C_E ';
		$arrDe[]	= 'INSERT ';					$arrPara[]	= 'I_N_S_E_R_T ';
		$arrDe[]	= 'UPDATE ';					$arrPara[]	= 'U_P_D_A_T_E ';
		$arrDe[]	= 'DELETE ';					$arrPara[]	= 'D_E_L_E_T_E ';
		$arrDe[]	= 'CREATE ';					$arrPara[]	= 'C_R_E_A_T_E ';
		$arrDe[]	= 'ALTER ';					$arrPara[]	= 'A_L_T_E_R ';
		$arrDe[]	= 'SHOW ';					$arrPara[]	= 'S_H_O_W ';
		$arrDe[]	= 'COLUMNS ';				$arrPara[]	= 'C_O_L_U_M_N_S ';
		$arrDe[]	= 'CHR( ';					$arrPara[]	= 'C_H_R_( ';
		$arrDe[]	= 'CHAR( ';					$arrPara[]	= 'C_H_A_R_( ';
		$arrDe[]	= 'NULL ';					$arrPara[]	= 'N_U_L_L ';
		$arrDe[]	= 'SLEEP ';					$arrPara[]	= 'S_L_E_E_P ';
		$arrDe[]	= ' ALL ';					$arrPara[]	= ' A_L_L ';
		$arrDe[]	= ' AND ';					$arrPara[]	= ' A_N_D ';
		$arrDe[]	= '--';						$arrPara[]	= '-_-';
		$arrDe[]	= '/*';						$arrPara[]	= '/_*';
		$arrDe[]	= '*/';						$arrPara[]	= '*_/';
		$arrDe[]	= 'include';				$arrPara[]	= 'i_n_c_l_u_d_e';
		$arrDe[]	= 'require';				$arrPara[]	= 'r_e_q_u_i_r_e';
		$arrDe[]	= 'eval';					$arrPara[]	= 'e_v_a_l';
		$arrDe[]	= 'open';					$arrPara[]	= 'o_p_e_n';
		$arrDe[]	= 'base64_decode';			$arrPara[]	= 'b_a_s_e_6_4_d_e_c_o_d_e';

		return str_ireplace($arrDe,$arrPara,$valor);
	}


	# Funções
	$arrFuncoes = Array();
	$arrFuncoes[] = 'remove_sql_injection';
	$arrFuncoes[] = 'mysql_escape_string';
	$arrFuncoes[] = 'trim';
	$arrFuncoes[] = 'stripslashes';
	$arrFuncoes[] = 'strip_tags';
	$arrFuncoes[] = 'html_entity_decode';

	# Array do GET
	if (count($_GET) > 0) {
		$_GET = arrmap($arrFuncoes, $_GET);
		foreach($_GET as $chave=>$valor){
			$_REQUEST[$chave] = $valor;
			$chave = $valor;
		}
	}

	# Array do POST
	if (count($_POST) > 0) {
		$_POST = arrmap($arrFuncoes, $_POST);
		foreach($_POST as $chave=>$valor){
			$_REQUEST[$chave] = $valor;
			$chave = $valor;
		}
	}
?>
