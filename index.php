<?php
// header("Location: http://appfloripa.pmf.sc.gov.br/portal/");

//-------------------------------------------
// verifica se a conexão é via PC ou CELULAR
//-------------------------------------------

/*
$hora = date('Hi');
	

if( !( $hora < '2300' && $hora > '0700' )){	
   if( !$this->ipLiberado() ){
      header("Location: http://appfloripa.pmf.sc.gov.br/portal/");
   }			
}

*/

// print "Server : <br>";
// print "<pre>";
// print_r( $_SERVER );
// print "</pre>";
// print "<pre>";
// print "Request : <br>";
// print_r( $_REQUEST );
// print "</pre>";
// print "<pre>";
// print "Session : <br>";
// print_r( $_SESSION );
// print "</pre>";
// die();

// PROTEÇÃO DE SEGURANÇA - SEO SPAM
$requestUri = $_SERVER['REQUEST_URI'] ?? '';

// 1. Bloqueio por Padrão de Pasta (file123, file867, etc)
if (preg_match('#/file\d+/#i', $requestUri)) {
    error_log("[SEGURANÇA] Bloqueio de Pasta Spam: " . $requestUri . " - IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'Unknown'));
    http_response_code(410);
    header("Status: 410 Gone");
    exit("<h1>Página Removida / Page Removed</h1>");
}

// 2. Bloqueio por Palavras-Chave
$blacklistedPatterns = [
    'jogar-bet',
    'bet-portal',
    'cassino',
    'slot-gacor',
    'bonus-bet',
    'tigrinho',
    'fortune-tiger',
    'online-betting',
    'pgsoft',
    'slot-demo',
    'demo-mahjong',
    'mahjong-ways',
    'plataforma-bet'
];

foreach ($blacklistedPatterns as $pattern) {
    if (stripos($requestUri, $pattern) !== false) {
        error_log("[SEGURANÇA] Bloqueio de URL suspeita: " . $requestUri . " - IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'Unknown'));
        http_response_code(410);
        header("Status: 410 Gone");
        exit("<h1>Página Removida / Page Removed</h1>");
    }
}

// 2. Proteção contra Cookies de Rastreamento Chinês (CNZZ)
// O dump do servidor mostrou cookies CNZZDATA, comuns em sites invadidos
if (isset($_SERVER['HTTP_COOKIE']) && stripos($_SERVER['HTTP_COOKIE'], 'CNZZDATA') !== false) {
    // Tenta remover os cookies maliciosos do navegador do usuário
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', trim($cookie));
        $cookieName = trim($parts[0]);
        if (stripos($cookieName, 'CNZZDATA') !== false) {
            // Remove o cookie setando data no passado
            setcookie($cookieName, '', time() - 3600, '/');
            setcookie($cookieName, '', time() - 3600, '/', $_SERVER['HTTP_HOST']);
            setcookie($cookieName, '', time() - 3600, '/', '.' . $_SERVER['HTTP_HOST']);
        }
    }
}

require_once($_SERVER['DOCUMENT_ROOT']."/scripts/php/config.php");
require_once(CAMINHO_SITE."/scripts/php/funcoes_bd.php");

// rotina que verifica a origem do link
foreach( $_GET as $i=>$value ){
  $drive->verificarEntrada($i);
}


// rotina que verifica a origem do link
require_once("scripts/php/config.php");
require_once("scripts/php/funcoes_bd.php");
foreach( $_GET as $i=>$value ){
   $drive->verificarEntrada($i);
}

$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

if (preg_match('/[\x{0600}-\x{06FF}]/u', $referer)) {
    // Redirecionar ou bloquear o acesso
    header('HTTP/1.0 403 Forbidden');
    exit('Access Forbidden');
}


if (empty($_SERVER['HTTPS'])){
   echo "<script language= \"JavaScript\">location.href=\"https:\\www.pmf.sc.gov.br\"</script>";
} 


$mobile_browser = '0';

if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
   $mobile_browser++;
}

if(isset( $_SERVER['HTTP_ACCEPT'] )){
   if((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml')>0) or
     ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
      $mobile_browser++;
   }
}    

$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));
$mobile_agents = array(
   'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
   'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
   'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
   'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
   'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
   'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
   'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
   'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
   'wapr','webc','winw','winw','xda','xda-');

if(in_array($mobile_ua,$mobile_agents)) {
   $mobile_browser++;
}

if( isset( $_SERVER['ALL_HTTP'] )){
   if (strpos(strtolower($_SERVER['ALL_HTTP']),'OperaMini')>0) {
      $mobile_browser++;
   }
}


if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows')>0) {
   $mobile_browser=0;
}

//--------------------------------------------------------------------------------
// se a conexão for via celular, redireciona para MOBILE, se não abre normalmente
//--------------------------------------------------------------------------------
if($mobile_browser>0) {
//echo "<script language= \"JavaScript\">location.href=\"mobile/index.php\"</script>";
//echo "<meta http-equiv='refresh' content=\"0;url='mobile/index.php\">";
echo "<script language= \"JavaScript\">location.href=\"home.php\"</script>";
echo "<meta http-equiv='refresh' content=\"0;url='home.php\">";
}
else {
  include("home.php");
}  