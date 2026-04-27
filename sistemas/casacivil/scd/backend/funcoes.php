<?php

function validateEmpty($var, $fieldName, $fieldProblem) {
	if(empty($var)){
		$error = 'O Campo "'.$fieldName.'" não pode ficar em branco';
		echo json_encode(array('success' => 0, 'error' => $error, 'fieldProblem' => $fieldProblem));
		die;
	}
}

function validateCPF($cpf, $fieldProblem) {
	if(!validaCPF($cpf)){
		echo json_encode(array('success' => 0, 'error' => 'Digite um CPF válido', 'fieldProblem' => $fieldProblem));
		die;
	}
}

function validateCNPJ($cnpj, $fieldProblem) {
	if(!validaCNPJ($cnpj)){
		echo json_encode(array('success' => 0, 'error' => 'Digite um CNPJ válido', 'fieldProblem' => $fieldProblem));
		die;
	}
}

function validateMail($mail, $fieldProblem){
	if(!validMail($mail)){
		echo json_encode(array('success' => 0, 'error' => 'Digite um E-mail válido', 'fieldProblem' => $fieldProblem));
		die;	
	}	
}

function validateIp($ip, $fieldProblem){
if(!validIp($ip)){
		echo json_encode(array('success' => 0, 'error' => 'Digite um IP válido (necessário colocar os pontos)', 'fieldProblem' => $fieldProblem));
		die;	
	}	
}

/**
* Verifica se o e-mail e o dominio s‹o validos
* @param $mail
* @return bool
*/
function validMail($mail) {
	$retorno = true;
	/*
	$isMail = preg_match('/^[\d\w._%-]+@[\d\w.-]+\.[\w]{2,4}$/', $mail);
	$retorno = ((bool) $isMail);
	
	if($isMail){
		$host = explode("@", $mail);
		$host = $host[1];
		$retorno = getmxrr($host, $mx);

		if (!$retorno) { 
	    	$ipaddress = gethostbyname($host);
		    if ($ipaddress != $host) {
		    	$retorno=true;
	    	}
		}
	}
	*/
	return $retorno;
}

function validIp($ip){
	$pontos = explode(".", $ip);
	if(count($pontos) != 4 ){
		return false;
	}else{
		return true;
	}
}

function validaCPF($cpf = null) {
 
    // Verifica se um número foi informado
    if(empty($cpf)) {
        return false;
    }
 
    // Elimina possivel mascara
	// $cpf = ereg_replace('[^0-9]', '', $cpf);
	$cpf = str_replace('.','',$cpf );
	$cpf = str_replace('-','',$cpf );
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
     
    // Verifica se o numero de digitos informados é igual a 11 
    if (strlen($cpf) != 11) {
        return false;
    }
    // Verifica se nenhuma das sequências invalidas abaixo 
    // foi digitada. Caso afirmativo, retorna falso
    else if ($cpf == '00000000000' || 
        $cpf == '11111111111' || 
        $cpf == '22222222222' || 
        $cpf == '33333333333' || 
        $cpf == '44444444444' || 
        $cpf == '55555555555' || 
        $cpf == '66666666666' || 
        $cpf == '77777777777' || 
        $cpf == '88888888888' || 
        $cpf == '99999999999') {
        return false;
     // Calcula os digitos verificadores para verificar se o
     // CPF é válido
     } else {   
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }
        return true;
    }
}

function validaCNPJ($cnpj){

	$cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
	// Valida tamanho
	if (strlen($cnpj) != 14)
		return false;
	// Valida primeiro dígito verificador
	for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++){
		$soma += $cnpj{$i} * $j;
		$j = ($j == 2) ? 9 : $j - 1;
	}
	$resto = $soma % 11;
	if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
		return false;
	// Valida segundo dígito verificador
	for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++){
		$soma += $cnpj{$i} * $j;
		$j = ($j == 2) ? 9 : $j - 1;
	}
	$resto = $soma % 11;
	return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
}

function estado($uf){
	$uf_array = array(
		1 => 'AL',
		2 => 'AP',
		3 => 'AM',
		4 => 'BA',
		5 => 'CE',
		6 => 'DF',
		7 => 'ES',
		8 => 'GO',
		9 => 'MA',
		10 => 'MT',
		11 => 'MS',
		12 => 'MG',
		13 => 'PA',
		14 => 'PB',
		15 => 'PR',
		16 => 'PE',
		17 => 'PI',
		18 => 'RJ',
		19 => 'RN',
		20 => 'RS',
		21 => 'RO',
		22 => 'RR',
		23 => 'SC',
		24 => 'SP',
		25 => 'SE',
		26 => 'TO'
	); 
	return $uf_array[$uf];
}

function mesEscrito($mes){
	$mes_array = array(
		'01' => 'Janeiro',
		'02' => 'Fevereiro',
		'03' => 'Março',
		'04' => 'Abril',
		'05' => 'Maio',
		'06' => 'Junho',
		'07' => 'Julho',
		'08' => 'Agosto',
		'09' => 'Setembro',
		'10' => 'Outubro',
		'11' => 'Novembro',
		'12' => 'Dezembro',
	); 

	return $mes_array[$mes];
}

function liberacaoCertificacaoDigital($numero){
		Switch($numero){
	
		case 0: 
			return 'Aguardando';
			break;
		case 1: 
			return 'Liberado';
			break;
		case 2:
			return 'Expirado';
			break;
	}
}


function tabelaIP($liberacao){
	include "backend/db.php"; 
	$sql = $db->prepare("SELECT * FROM scd.liberacaoip where liberacao = $liberacao order by id DESC");
	$sql->execute();
	$data = $sql->fetchALL(PDO::FETCH_ASSOC);
	$tabela = '';
	Switch($liberacao){
	
		case 0: 
			$class = 'danger';
			break;
		case 1: 
			$class = 'warning';
			break;
		case 3:
			$class = 'success';
			break;
		default:
			$class = 'active';
			break;
	}
	
	for($i = 0; $i < sizeof($data); $i++){
			$tabela .= "<tr>";
			$tabela .= "<td>";		
				$tabela .= utf8_decode($data[$i]['nome']);
			$tabela .= "</td>";	
			$tabela .= "<td>";		
				$tabela .= utf8_decode($data[$i]['secretaria']);
			$tabela .= "</td>";
			$tabela .= "<td>";
				$data[$i]['ip'] = $data[$i]['ip'] == '' ? '-' : $data[$i]['ip'];
				$tabela .= $data[$i]['ip'];
			$tabela .= "</td>";		
			$tabela .= "<td>";		
				$tabela .= utf8_decode($data[$i]['setor']);
			$tabela .= "</td>";	
			$tabela .= "<td>";		
				$tabela .= $data[$i]['telefone'];
			$tabela .= "</td>";	
			
			if($liberacao != 2){
				$tabela .= "<td>";		
				$id = $data[$i]['id'];
				$tabela .= "<input type='button' value='Ver mais' id=$id class='botaoVerMais btn btn-primary btn-xs'>";
				$tabela .= "</td>";		
			}
			$tabela .= "</tr>";
	}
	return $tabela;
}

function status($statusnum){
	$status = '';
		switch($statusnum){
					case 0:
						$status = "AGUARDANDO";
						break;
					case 1:
						$status = "APROVADO";
						break;
					case 2:
						$status = "CANCELADO";
						break;	
					case 3:
						$status = "FINALIZADO";
						break;	
  				}
	return $status;
}

function tabelaVPN($liberacao){
	include "backend/db.php"; 
	$sql = $db->prepare("SELECT * FROM scd.liberacaovpn where liberacao = $liberacao");
	$sql->execute();
	$data = $sql->fetchALL(PDO::FETCH_ASSOC);
	$tabela = '';
	
	Switch($liberacao){
	
		case 0: 
			$class = 'danger';
			break;
		case 1: 
			$class = 'warning';
			break;
		case 3:
			$class = 'success';
			break;
		default:
			$class = 'active';
			break;
	}
	
	for($i = 0; $i < sizeof($data); $i++){
			$tabela .= "<tr >";
			$tabela .= "<td class=nomeTabelaVPN>";		
				$tabela .= utf8_encode($data[$i]['nome']);
			$tabela .= "</td>";	
			$tabela .= "<td>";		
				$tabela .= utf8_encode($data[$i]['nomeInstituicao']);
			$tabela .= "</td>";	
			
			$tabela .= "<td>";		
				$tabela .= $data[$i]['email'];
			$tabela .= "</td>";	
			
			if($liberacao != 2){
				$tabela .= "<td>";		
				$id = $data[$i]['id'];
				$tabela .= "<input type='button' value='Ver mais' id=$id class='botaoVerMais btn btn-primary btn-xs'>";
				$tabela .= "</td>";		
			}
			$tabela .= "</tr>";
	}
	return $tabela;
}

function tipoDeFuncionario($numero){
	Switch($numero){
			case 1: 
				return 'Comissionado';
				break;
			case 2: 
				return 'Comissionado de Carreira';
				break;
			case 3:
				return 'Efetivo';
				break;
		}
}

function detectarExpirado($dataLiberacao, $id, $anoExpiracao){
	$dataHoje = date('Y-m-d');
	$dataAtual = explode('-',$dataHoje);
	$dataLiberacao = explode('-',$dataLiberacao);

	if ( $dataAtual[0] - ($dataLiberacao[0] + $anoExpiracao) >= 0){
		if($dataAtual[1] >= $dataLiberacao[1]){
			if($dataAtual[2] >= $dataLiberacao[2]){
			include "backend/db.php"; 
					$insetQr = $db->prepare("UPDATE scd.certificacaodigital SET liberacao = 2, dataExpiracao = '$dataHoje' WHERE id=$id");
					$execute = $insetQr->execute();
					return true;
			}
		}
	}

	return false;
}


function tabelaCD($liberacao){
	include "backend/db.php"; 
	$sql = $db->prepare("SELECT * FROM scd.certificacaodigital where liberacao = $liberacao");
	$sql->execute();
	$data = $sql->fetchALL(PDO::FETCH_ASSOC);
	$tabela = '';
	Switch($liberacao){
	
		case 0: 
			$class = 'warning';
			break;
		case 2: 
			$class = 'danger';
			break;
		case 1:
			$class = 'success';
			break;
		default:
			$class = 'active';
			break;
	}
	
	for($i = 0; $i < sizeof($data); $i++){
			if($liberacao == 1){
				$mudouStatus = detectarExpirado($data[$i]['dataLiberacao'], $data[$i]['id'],$data[$i]['QtdAnoExpiracao']);
			}
			if($mudouStatus == false){
			$tabela .= "<tr class='$class'>";
			$tabela .= "<td>";		
				$tabela .= utf8_decode($data[$i]['nome']);
			$tabela .= "</td>";	
			$tabela .= "<td>";		
				$tabela .= $data[$i]['cpf'];
			$tabela .= "</td>";	
			$tabela .= "<td>";		
				$dataNascimento = explode ('-',$data[$i]['nascimento']);
				$dataNascimento = $dataNascimento[2].'/'.$dataNascimento[1].'/'.$dataNascimento[0];
				$tabela .= $dataNascimento;
			$tabela .= "</td>";	
			$tabela .= "<td>";		
				$tabela .= tipoDeFuncionario($data[$i]['tipoFuncionario']);
			$tabela .= "</td>";	
			$id = $data[$i]['id'];

			if($liberacao == 0){
				$tabela .= "<td>";
					$tabela .= "<input type='text' id='data$id' class='dataLiberacao form-control'>";
				$tabela .= "</td>";	
				$tabela .= "<td>";
					$tabela .= "<input type='text' id='ano$id' class='QtdAnoExpiracao form-control' >";
				$tabela .= "</td>";	
				$tabela .= "<td>";
					$tabela .= "<input type='button' value='Liberar' id=$id class='botaoLiberar btn btn-success btn-xs'>";
				$tabela .= "</td>";	
			}
			
			if($liberacao >= 1){
				$tabela .= "<td>";
					$dataLiberacao = explode ('-',$data[$i]['dataLiberacao']);
					$dataLiberacao = $dataLiberacao[2].'/'.$dataLiberacao[1].'/'.$dataLiberacao[0];
					$tabela .= $dataLiberacao;
				$tabela .= "</td>";	
			}
			
			if($liberacao == 2){
				$tabela .= "<td>";
					$dataExpiracao = explode ('-',$data[$i]['dataExpiracao']);
					$dataExpiracao = $dataExpiracao[2].'/'.$dataExpiracao[1].'/'.$dataExpiracao[0];
					$tabela .= $dataExpiracao;
				$tabela .= "</td>";
			}
			
			$tabela .= "<td>";		
				$tabela .= "<input type='button' value='Ver mais' id=$id class='botaoVerMais btn btn-primary btn-xs'>";
			$tabela .= "</td>";		

			$tabela .= "</tr>";
			}
	}
	return $tabela;
}