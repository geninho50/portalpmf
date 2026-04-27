<?php

/* Informa o nível dos erros que serão exibidos */
error_reporting(E_ALL);
 
/* Habilita a exibição de erros */
ini_set("display_errors", 1);

/*
 *	$Id: client1.php,v 1.3 2007/11/06 14:48:24 snichol Exp $
 *
 *	Client sample that should get a fault response.
 *
 *	Service: SOAP endpoint
 *	Payload: rpc/encoded
 *	Transport: http
 *	Authentication: none
 */
require_once('../nusoap.php');
$proxyhost = isset($_POST['proxyhost']) ? $_POST['proxyhost'] : '';
$proxyport = isset($_POST['proxyport']) ? $_POST['proxyport'] : '';
$proxyusername = isset($_POST['proxyusername']) ? $_POST['proxyusername'] : '';
$proxypassword = isset($_POST['proxypassword']) ? $_POST['proxypassword'] : '';
$useCURL = isset($_POST['usecurl']) ? $_POST['usecurl'] : '0';
$client = new nusoap_client("https://comcapfiles.pmf.sc.gov.br:8181/g5-senior-services/rubi_Synccom_senior_g5_rh_fp_portalTransparencia", false,
						$proxyhost, $proxyport, $proxyusername, $proxypassword);
$err = $client->getError();
if ($err) {
	echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
	echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
	exit();
}
$client->setUseCurl($useCURL);
// This is an archaic parameter list
$params = array(
'user'       => 'transparencia',
'password'   => '@trapmf*',
'encryption' =>0,
array(
'datCmp'     =>'01/06/2021',
'nomFun'	 =>'Eugênio',
'numEmp'	 =>1,
'tipCal'	 =>11 ) 
);
$result = $client->call('ManufacturerSearchRequest', $params, 'https://comcapfiles.pmf.sc.gov.br:8181/g5-senior-services/rubi_Synccom_senior_g5_rh_fp_portalTransparencia', 'https://comcapfiles.pmf.sc.gov.br:8181/g5-senior-services/rubi_Synccom_senior_g5_rh_fp_portalTransparencia');
if ($client->fault) {
	echo '<h2>Fault (Expect - The request contains an invalid SOAP body)</h2><pre>'; print_r($result); echo '</pre>';
} else {
	$err = $client->getError();
	if ($err) {
		echo '<h2>Error</h2><pre>' . $err . '</pre>';
	} else {
		echo '<h2>Result</h2><pre>'; print_r($result); echo '</pre>';
	}
}
echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
?>