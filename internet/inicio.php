<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require_once("../intranet/valida_session.php");
require_once("../scripts/php/funcoes_bd.php");
require_once("../scripts/php/config.php");

if(isset($_POST['entid_intranet']))
{
	//---------------------------------------------------------------
	// Altera perfil de usuário quando combo de entidades é alterado
	//---------------------------------------------------------------

	$drive->conecta();
	$_SESSION['SuserEnt'] = $_POST['entid_intranet'];
	$sqlEntidade	= "SELECT entidade_tipo FROM entidades WHERE entidade_id = ".$_SESSION['SuserEnt'];
	$TresultEnt  	= $drive->pedido($sqlEntidade);
	$Tentidade 	 	= pg_fetch_object($TresultEnt);
	$_SESSION['SentTipo'] = $Tentidade->entidade_tipo;

	$sqlPerfil 		= "SELECT * FROM intranet_permissoes WHERE intranet_user_id = ".$_SESSION['SuserId']." AND intranet_entidade_id = ".$_SESSION['SuserEnt']."";
	$TresultPerfil  = $drive->pedido($sqlPerfil);
	$TperfilId 	 	= pg_fetch_object($TresultPerfil);
	$TperfilInicial = $TperfilId->intranet_perfil_id;

	//------------------------------------------------
	//recupera a quais páginas o usuário tem acesso
	//------------------------------------------------

	$i = 0;
	$sqlAssMenu = 	"SELECT REL.intranet_menu_rel_atalho FROM intranet_menu_relacionado AS REL INNER JOIN intranet_submenu AS SUB ON REL.intranet_menu_rel_menu_id = SUB.intranet_submenu_id INNER JOIN intranet_perfil_submenu AS PERF ON SUB.intranet_submenu_id = PERF.intranet_perfil_submenu_submenu_id WHERE PERF.intranet_perfil_submenu_perfil_id = $TperfilInicial";
	$TreturnAssm = $drive->pedido($sqlAssMenu);
	while($TassMenu = pg_fetch_object($TreturnAssm)){
		$TpaginasLiberadas[$i] = $TassMenu->intranet_menu_rel_atalho;
		$i++;
	}

	$sqlPaginasLiberadas	= "SELECT SUBM.intranet_submenu_atalho FROM intranet_submenu AS SUBM INNER JOIN intranet_perfil_submenu AS PERF ON intranet_submenu_id = intranet_perfil_submenu_submenu_id WHERE intranet_perfil_submenu_perfil_id = $TperfilInicial";
	$TreturnPaginas			= $drive->pedido($sqlPaginasLiberadas);
	$i=count($TpaginasLiberadas);
	while($TpaginasNome	= pg_fetch_object($TreturnPaginas)){
		$TpaginasLiberadas[$i] = $TpaginasNome->intranet_submenu_atalho;
		$i++;
	}

	$sqlMenu 	 = "SELECT MEN.intranet_menu_atalho FROM intranet_menu AS MEN INNER JOIN intranet_perfil_menu AS PERF ON MEN.intranet_menu_id = PERF.intranet_perfil_menu_menu_id WHERE PERF.intranet_perfil_menu_perfil_id = $TperfilInicial";
	$TreturnMenu = $drive->pedido($sqlMenu);
	while($Tmenu = pg_fetch_object($TreturnMenu)){
		$TpaginasLiberadas[$i] = $Tmenu->intranet_menu_atalho;
		$i++;
	}

	$_SESSION['SuserPerfilId']  = $TperfilInicial;
	$_SESSION['SuserPagAccess'] = $TpaginasLiberadas;

	$drive->close();
}

$drive->conecta();

?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Prefeitura Municipal de Florianópolis</title>


<link rel="stylesheet" href="../layout/pmf-estilo.css" type="text/css">
<link rel="stylesheet" href="../layout/pmf-estilo-home.css" type="text/css">
<link rel="stylesheet" href="../layout/pmf-estilo-governo.css" type="text/css">
<link rel="stylesheet" href="../layout/pmf-estilo-noticias.css" type="text/css">
<link rel="stylesheet" href="../layout/pmf-estilo-intranet.css" type="text/css">
<link rel="stylesheet" href="../layout/pmf-estilo-internet.css" type="text/css">


<link href="../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="../scripts/js/livevalidation/livevalidation13.css" />
<link rel="stylesheet" href="../scripts/colorbox/colorbox.css" type="text/css" media="screen"/>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript" src="../scripts/js/livevalidation/livevalidation13.js"></script>
<script type="text/javascript" src="../scripts/js/jmask/jquery.maskedinput.js" ></script>
<script type="text/javascript" src="../scripts/js/jdrag-n-drop/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="../scripts/colorbox/jquery.colorbox.js"></script>
<script type="text/javascript" src="../scripts/js/tiny_mce/tiny_mce_src.js"></script>
<script type="text/javascript" src="../scripts/js/funcoes.js" ></script>


<?php require_once("requires_css.php"); ?>
<?php require_once("requires_js.php"); ?>

<link href="../scripts/js/ptags/jquery.ptags.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../scripts/js/ptags/jquery.ptags.js"></script>
<link href="../scripts/js/ptags/jquery.ptags.default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    $(document).ready(function(){
        $("#Ftags").ptags();
    });
</script>
</head>

<body>

<div class="layout_intranet interno">

<?php $menu_principal = "internet";  ?>
<div style="display:none"><?php echo($menu_principal); ?></div>
<?php include("../layout/menus/menu_geral.php"); ?>


<div id="conteudo_wrapper" >
<div id="conteudo">


			<div id="conteudo_coluna1">
		     	<div id="menu">
     					<div id="titulo-internet">&nbsp;</div>
       					<?php
						$menu = 0;
					 	include("../layout/menus/menu_internet.php");
	 					?>

     			</div>
		     	<br>
   			</div>
            <div id="conteudo_coluna2">
          		<div >
					<?php

					//-------------------------------------------
					// Procura o caminho da página a ser exibida
					//-------------------------------------------
					if(isset($_GET['pagina'])){
						$TincludeAtalho 	= array_search($_GET['pagina'],$_SESSION['SmenuAtalho']);
						$TincludeCaminho	= $_SESSION['SmenuCaminho'][$TincludeAtalho];
						
						// print "Caminho :".$TincludeCaminho;
						if(stristr($TincludeCaminho, "http")){
							echo "<script language= \"JavaScript\">location.href=\"".$TincludeCaminho."\"</script>";
							echo "<meta http-equiv='refresh' content=\"0;url='".$TincludeCaminho."\">";
						}else{

							include $TincludeCaminho;
						}
					}else{
						include "home.php";
					}
					?>

          		</div>
   			</div>

<br class="clearfloat">
</div>	<!-- fim do conteudo -->
</div> <!-- fim do conteudo_wrapper -->


<?php include("../layout/rodape/rodape.php"); ?>
<?php  // require_once("../tracker.php"); ?>
</div><!-- fim layout-home -->

</body>
</html>

<?php
$drive->close();
?>