<?php
require_once("../scripts/php/config.php");
require_once(CAMINHO_SITE."/scripts/php/funcoes_bd.php");
$drive->conecta();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Prefeitura de Florianópolis</title>

<link rel="stylesheet" href="../layout/pmf-estilo.css" type="text/css">
<link rel="stylesheet" href="../layout/pmf-estilo-ouvidoria.css" type="text/css">
<link type="image/x-icon" rel="shortcut icon" href="../layout/imagens/brasao.gif">

<?php
include(CAMINHO_SITE."/layout/themePMF/includes/header.php")
?>

</head>

<body>
<div class="layout_ouvidoria">

<?php $menu_principal = "ouvidoria";  ?>
<?php include("../layout/menus/menu_geral.php"); ?>


<div class="flex-container page-template">

    <div class="page-navigation">
        <?php
            //---------------------------
            // imprime menu da OUVIDORIA
            //---------------------------
            $menu = 0;
            require_once(CAMINHO_SITE."/layout/themePMF/includes/ouvidoria/menu_ouvidoria_novo.php");
        ?>
    </div>
    <div class="page-content">
        <?php
			//------------------------------------------------------
			// busca qual página deve ser exibida no painel central
			//------------------------------------------------------
            switch ($_GET['pagina']){
                case "relatorios"              : include "ouv_relatorios.php";          break;
                case "consulta"	               : include "ouv_consulta.php";            break;
                case "requisicao"              : include "ouv_requisicao.php";          break;
				case "telefone"                : include "ouv_telefone.php";            break;
                case "ouvidor"                 : include "ouv_ouvidor.php";             break;
                case "ouvidorRel"              : include "ouv_ouvidorRel.php";          break;
                case "home"                    : include "ouv_index.php";               break;
                case "ouv_sic"                 : include "ouv_sic.php";                 break; 
                case "ouv_encarregadoDados"    : include "ouv_encarregadoDados.php";    break;
                case "ouv_lai"                 : include "ouv_lai.php";                 break;
                default                        : include "ouv_index.php";               break;
            }
        ?>
    </div>

</div>


<?php include("../layout/rodape/rodape.php");
require_once("../google_analytics.php");
?>
</div><!-- fim layout-home -->

</body>
</html>
