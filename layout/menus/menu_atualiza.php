<?php

$permi_user_id = $_SESSION['Suserid'];
$userLogin = $_SESSION['Suserlogin'];
$sqlPerm = "SELECT permi_somatorio FROM permissao WHERE permi_user_id = $permi_user_id";

$RPerm = $drive->pedido($sqlPerm);

$objPerm = pg_fetch_object($RPerm);

$numero = $objPerm->permi_somatorio;

$indice = array();
$i = 0;


$menuDestaque  		= false;
$menuEstrutura 		= false;
$menuServicos  		= false;
$menuCategorias   = false;
$menuNoticias  		= false;
$menuGestao    		= false;
$menuRepositorio 	= false;
$menuCms			= false;


while($numero >= 1)
{
        $perm = $numero%2*pow(2,$i);
		if($perm != 0)
		{
			$indice[$i] = $perm;
			switch($perm)
			{
				case 1: $menuDestaque      = true;
				break;

				case 2: $menuEstrutura     = true;
				$string .= "
				document.getElementById('menu_fechado_1').style.display = 'block';
				document.getElementById('menu_aberto_1').style.display = 'none'; ";
				break;

				case 4: $menuServicos  	   = true;
				$string .= "
				document.getElementById('menu_fechado_2').style.display = 'block';
				document.getElementById('menu_aberto_2').style.display = 'none'; ";
				break;

				case 8: $menuNoticias  	   = true;
				$string .= "
				document.getElementById('menu_fechado_3').style.display = 'block';
				document.getElementById('menu_aberto_3').style.display = 'none'; ";
				break;

        case 17: $menuCategorias  	   = true;
				$string .= "
				document.getElementById('menu_fechado_17').style.display = 'block';
				document.getElementById('menu_aberto_17').style.display = 'none'; ";
				break;

				case 16: $menuGestao   	   = true;
				$string .= "
				document.getElementById('menu_fechado_4').style.display = 'block';
				document.getElementById('menu_aberto_4').style.display = 'none'; ";
				break;

				case 32: $menuRepositorio  = true;
				$string .= "
				document.getElementById('menu_fechado_5').style.display = 'block';
				document.getElementById('menu_aberto_5').style.display = 'none'; ";
				break;

				case 64: $menuCms	 	   = true;
				$string .= "
				document.getElementById('menu_fechado_6').style.display = 'block';
				document.getElementById('menu_aberto_6').style.display = 'none'; ";
				break;
			}

		}
        $i++;
		$numero = $numero/2;

}

?>

  <h2>bem vindo, <?=$userLogin?></h2>
  utilize as op&ccedil;&otilde;es abaixo para atualizar o Portal da Prefeitura.<br><br>

  <ul>

    <?php

	if($menuDestaque == true){
		require_once(CAMINHO_SITE . "/layout/menus/menusadm/Mdestaque.php");
	}

	if($menuEstrutura == true){
		require_once(CAMINHO_SITE . "/layout/menus/menusadm/Mestrutura.php");
	}

    if($menuServicos == true){
		require_once(CAMINHO_SITE . "/layout/menus/menusadm/Mservicos.php");
	}

    if($menuCategorias == true){
    require_once(CAMINHO_SITE . "/layout/menus/menusadm/Mcategorias.php");
  }

    if($menuNoticias == true){
		require_once(CAMINHO_SITE . "/layout/menus/menusadm/Mnoticias.php");
	}

    if($menuGestao == true){
		require_once(CAMINHO_SITE . "/layout/menus/menusadm/Mgestao.php");
	}

	if($menuRepositorio == true){
		require_once(CAMINHO_SITE . "/layout/menus/menusadm/Mrepositorio.php");
	}


	if($menuCms == true){
		require_once(CAMINHO_SITE . "/layout/menus/menusadm/Mcms.php");
	}
	?>




   </ul>




<?php
echo("
<script type=\"text/javascript\">


var numSubMenus = " . sizeof($indice) . ";" ."


function ControlarMenu(num,acao){ // acao = 'abrir' ou 'fechar'
".$string."



	if (acao == 'abrir'){
	    document.getElementById('menu_fechado_'+num).style.display = 'none';
		document.getElementById('menu_aberto_'+num).style.display = 'block';
	}
}


</script>");
?>

<script type="text/javascript">
<?php


      $menuAtual = $_GET['menu'];
	  print "ControlarMenu('";
	  print $menuAtual;
	  print "','abrir');";

?>
</script>
