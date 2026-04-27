<?

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
    $cpf = ereg_replace('[^0-9]', '', $cpf);
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

function tabelaIP($liberacao){
	include "backend/db.php"; 
	$sql = $db->prepare("SELECT * FROM scd.liberacaoip where liberacao = $liberacao");
	$sql->execute();
	$data = $sql->fetchALL(PDO::FETCH_ASSOC);
	$tabela = '';
	for($i = 0; $i < sizeof($data); $i++){
			$tabela .= "<tr>";
			$tabela .= "<td class=nomeTabela>";		
				$tabela .= utf8_decode($data[$i]['nome']);
			$tabela .= "</td>";	
			$tabela .= "<td>";		
				$tabela .= utf8_decode($data[$i]['setor']);
			$tabela .= "</td>";	
			$tabela .= "<td>";		
				$tabela .= utf8_decode($data[$i]['funcao']);
			$tabela .= "</td>";	
			$tabela .= "<td>";		
				$tabela .= $data[$i]['telefone'];
			$tabela .= "</td>";	
			
			if($liberacao < 2){
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
  				}
	return $status;
}

function tabelaVPN($liberacao){
	include "backend/db.php"; 
	$sql = $db->prepare("SELECT * FROM scd.liberacaovpn where liberacao = $liberacao");
	$sql->execute();
	$data = $sql->fetchALL(PDO::FETCH_ASSOC);
	$tabela = '';
	for($i = 0; $i < sizeof($data); $i++){
			$tabela .= "<tr>";
			$tabela .= "<td class=nomeTabelaVPN>";		
				$tabela .= utf8_encode($data[$i]['nome']);
			$tabela .= "</td>";	
			$tabela .= "<td>";		
				$tabela .= utf8_encode($data[$i]['nomeInstituicao']);
			$tabela .= "</td>";	
			
			$tabela .= "<td>";		
				$tabela .= $data[$i]['email'];
			$tabela .= "</td>";	
			
			if($liberacao < 2){
				$tabela .= "<td>";		
				$id = $data[$i]['id'];
				$tabela .= "<input type='button' value='Ver mais' id=$id class='botaoVerMais btn btn-primary btn-xs'>";
				$tabela .= "</td>";		
			}
			$tabela .= "</tr>";
	}
	return $tabela;
}
