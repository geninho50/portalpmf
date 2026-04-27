<?php 

    error_reporting(E_ALL);
    ini_set('display_errors', 'On');

    require_once("funcoes_bd.php"); 
    require_once("config.php");  

function validateEmpty($var, $fieldName, $fieldProblem) {
	if(empty($var)){
		$error = 'O Campo "'.$fieldName.'" não pode ficar em branco';
		echo json_encode(array('success' => 0));
		die;
	}
}

function validateCPF($cpf, $fieldProblem) {
	if(!validaCPF($cpf)){
		echo json_encode(array('success' => 2));
		die;
	}
}

function validateMail($mail, $fieldProblem){
    /*
    if(!validMail($mail)){
		echo json_encode(array('success' => 3));
		die;	
    }
    */	
}

function validateEspaco($variavel){
    $explosao = explode(" ", $variavel);
    if (count($explosao) > 1) {
        echo json_encode(array('success' => 4));
        die;
    }
}  

/**
* Verifica se o e-mail e o dominio são validos
* @param $mail
* @return bool
*/
function validMail($mail) {
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

    return $retorno;
    */
    return true;
}

function validaCPF($cpf = null) {
 
    // Verifica se um número foi informado
    if(empty($cpf)) {
        return false;
    }
 
    // Elimina possivel mascara
    // $cpf = ereg_replace('[^0-9]', '', $cpf);
    $cpf = str_replace('.','', $cpf);
    $cpf = str_replace('-','', $cpf);
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

$nome = utf8_decode($_POST['nome']);
$email = $_POST['email'];
$matricula = $_POST['matricula'];
$cpf = $_POST['cpf'];
$login = $_POST['login'];
$fone = $_POST['fone'];
$nascimento = $_POST['nascimento'];
$nascimento = explode("/", $nascimento);
$nascimento = $nascimento[2]."-".$nascimento[1]."-".$nascimento[0];
$entidades = $_POST['entidades'];
$grupo = $_POST['grupo'];
$setor = $_POST['setor'];
$cargo = $_POST['cargo'];
$perfil = $_POST['perfil'];
$senha_rand = rand(111111, 999999);
$senha = md5($senha_rand);
validateEspaco($login);

// $login = md5( $login );
// $cpf   = md5( $cpf );
validateEmpty($nome, "Nome", "nome");
validateEmpty($cpf, "CPF", "cpf");
validateCPF($cpf, "cpf");
validateEmpty($email, "E-mail", "email");
validateMail($email, "email");
validateEmpty($matricula, "Matricula", "matricula");
validateEmpty($login, "Login", "login");
validateEmpty($fone, "Telefone", "fone");
validateEmpty($nascimento, "Nascimento", "nascimento");

$fone2 = explode("-",$fone);

if( isset( $fone2[0] ) ){
    $fone = "48".$fone2[0];
}

if( isset( $fone2[1] ) ){
    $fone += $fone2[1];
}

$conexao = $drive->conecta();
$sql = "INSERT INTO uni_usuarios( user_nome, 
                                  user_senha, 
                                  user_login, 
                                  user_fone, 
                                  user_entidade_id, 
                                  user_grupo_id, 
                                  user_setor_id, 
                                  user_cargo_id, 
                                  user_data_nascimento,
                                  user_maticula, 
                                  user_email, 
                                  user_cpf )
                        VALUES ( '$nome', 
                                 '$senha', 
                                 '$login', 
                                 '$fone', 
                                  $entidades, 
                                  $grupo, 
                                  $setor, 
                                  $cargo, 
                                 '$nascimento', 
                                 '$matricula', 
                                 '$email', 
                                 '$cpf');";
$insetQr = $drive->pedido( $sql );

$sqlNovoUsario     = " SELECT * 
                         FROM uni_usuarios 
                        WHERE user_senha = '$senha' 
                          AND user_login = '$login' ";  

$TresultNovoUsario = $drive->pedido($sqlNovoUsario);
$TNovoUsario = pg_fetch_object($TresultNovoUsario);
$NovoUsuarioID = $TNovoUsario->user_id;
$insert = " INSERT INTO intranet_permissoes( intranet_user_id, 
                                             intranet_perfil_id, 
                                             intranet_entidade_id ) 
                                    VALUES ( $NovoUsuarioID, 
                                             $perfil, 
                                             $entidades ); ";

// print "Insert : ".$insert;

$insetQr = $drive->pedido( $insert );

if($insetQr){
    echo json_encode(array('success' => 1, 'senha' => $senha_rand));
}