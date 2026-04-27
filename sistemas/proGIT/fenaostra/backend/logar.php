<?

$login =  md5($_POST['login']);
$senha =  md5($_POST['senha']);
$loginSistema = "a6b2c38cc01994defb6aa295256c8959";
$senhaSistema = "9ce17146641ce28a9815adc3983b5db3";


if($login == $loginSistema && $senha == $senhaSistema){
	session_start();
	$_SESSION['login'] = $login;
	echo json_encode(array('success' => 1));
}else{
	echo json_encode(array('success' => 0, 'error' => 'Login ou Senha Incorreto'));
}