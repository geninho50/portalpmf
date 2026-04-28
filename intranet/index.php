<?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);

//---------------------------------------
// faz a validação da conecção com o ldap
//---------------------------------------

// print "<pre>";
// print_r($_POST);
// print "</pre>";

if(isset($_POST["btConn_x"])){
	require_once("../scripts/php/funcoes_bd_ldap.php");
	print "Entrou no 1";
	die();
}else{
	session_start();
}

require_once("../scripts/php/config.php");
require_once("../scripts/php/funcoes_bd.php");
require_once("../scripts/php/funcoes.php");
$drive->conecta();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
	//------------------------------------------------------------
	// se cadastro desatualizado carrega auto completar entidades
	//------------------------------------------------------------
	if(isset($_GET['user'])){
		echo('
			<script src="../scripts/js/jquery/jquery.js" type="text/javascript"></script>
			<script type="text/javascript" src="controle/usuarios/script_setores.js"></script>
			');
	}
    ?>
	<title>Prefeitura Municipal de Florianópolis</title>
	<link rel="stylesheet" href="../layout/pmf-estilo.css" type="text/css">
	<link rel="stylesheet" href="../layout/pmf-estilo-intranet.css" type="text/css">
	<link href="../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../scripts/js/livevalidation/livevalidation13.css" />
	<script type="text/javascript" src="../scripts/js/livevalidation/livevalidation13.js"></script>

</head>

<body>
	<div class="layout_intranet">
		<?php $menu_principal = "login";  ?>
		<div style="display:none"><?php echo($menu_principal); ?></div>
		<?php include("../layout/menus/menu_geral.php"); ?>
		<div class="flex-container page-template">
			<div class="page-navigation">
            	<div id="titulo-intranet">&nbsp;</div>
            	<div id="msg_login">					
					<h3>Intranet</h3>
					<p>
					
	                	Acesso exclusivo a administradores do sistema. <br /> 
	                	Entre em contato com a Dgov <br /> 
						da Prefeitura para liberação <br />
						do seu acesso.<br />
						<br />
					<!--	<a href="mailto:intranet@pmf.sc.gov.br">intranet@pmf.sc.gov.br</a><br />-->
					</p>
				</div>
			</div>
			<div class="page-content">
				<?php		
					if( !$drive->ipLiberado() ){						
						print "<h3>Acesso não está autorizado !<br><br></h3>IP :  <b>".$_SERVER['REMOTE_ADDR']."</b>";
					}else{

						if( isset( $_GET['user'] ) ){
							switch($_GET['user']){
								case "at":
									include "inicio/intra_atualiza_user.php";
									break;
								default:
									include "inicio/intra_login.php";
									break;
							}
						}else{
							include "inicio/intra_login.php";
						}
					}
				
                ?>
			</div>
			</div>
		</div>
		<?php include("../layout/rodape/rodape.php"); ?>
	</div>
</body>
</html>