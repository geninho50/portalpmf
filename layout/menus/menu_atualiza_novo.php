<?php

$permi_user_id = $_SESSION['Suserid'];
$userLogin = $_SESSION['Suserlogin'];
$sqlPerm = "SELECT permi_somatorio FROM permissao WHERE permi_user_id = $permi_user_id";

$RPerm = $drive->pedido($sqlPerm);

$objPerm = pg_fetch_object($RPerm);

$numero = $objPerm->permi_somatorio;

$indice = array();
$i = 0;

$menuIdeias			= false;
$menuDestaque  		= false;
$menuEstrutura 		= false;
$menuServicos  		= false;
$menuNoticias  		= false;
$menuGestao    		= false;
$menuRepositorio 	= false;
$menuCms			= false;


$string = "
				document.getElementById('menu_fechado_0').style.display = 'block';
				document.getElementById('menu_aberto_0').style.display = 'none'; ";

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
				break;

				case 4: $menuServicos  	     = true;

				break;

				case 8: $menuNoticias  	   = true;

				break;

				case 16: $menuGestao   	   = true;

				break;

				case 32: $menuRepositorio  = true;

				break;

				case 64: $menuCms	 	   = true;

				break;

				case 128: $menuIdeias 	   = true;

				break;

			}

		}
        $i++;
		$numero = $numero/2;

}

?>

  <div id="menugeral">

  <h2>bem vindo, <?=$userLogin?></h2>
  utilize as op&ccedil;&otilde;es abaixo para atualizar o Portal da Prefeitura.<br><br>



  <ul>



    <?php

	$string = "";

	if($menuIdeias == true) {
		require_once(CAMINHO_SITE . "/layout/menus/menusadm_novo/Mideias.php");
		$string .= "document.getElementById('menu_fechado_7').style.display = 'block';
					document.getElementById('menu_aberto_7').style.display = 'none'; ";
	}

	if($menuDestaque == true) {
		require_once(CAMINHO_SITE . "/layout/menus/menusadm_novo/Mdestaque.php");
		$string .= "document.getElementById('menu_fechado_0').style.display = 'block';
					document.getElementById('menu_aberto_0').style.display = 'none'; ";
	}

	if($menuEstrutura == true) {
		require_once(CAMINHO_SITE . "/layout/menus/menusadm_novo/Mestrutura.php");
		$string .= "document.getElementById('menu_fechado_1').style.display = 'block';
					document.getElementById('menu_aberto_1').style.display = 'none'; ";
	}

    if($menuServicos == true) {
		require_once(CAMINHO_SITE . "/layout/menus/menusadm_novo/Mservicos.php");
		$string .= "document.getElementById('menu_fechado_2').style.display = 'block';
					document.getElementById('menu_aberto_2').style.display = 'none'; ";
	}

    if($menuNoticias == true) {
		require_once(CAMINHO_SITE . "/layout/menus/menusadm_novo/Mnoticias.php");
		$string .= "document.getElementById('menu_fechado_3').style.display = 'block';
					document.getElementById('menu_aberto_3').style.display = 'none'; ";
	}

    if($menuGestao == true) {
		require_once(CAMINHO_SITE . "/layout/menus/menusadm_novo/Mgestao.php");
		$string .= "document.getElementById('menu_fechado_4').style.display = 'block';
					document.getElementById('menu_aberto_4').style.display = 'none'; ";
	}

	if($menuRepositorio == true) {
		require_once(CAMINHO_SITE . "/layout/menus/menusadm_novo/Mrepositorio.php");
		$string .= "document.getElementById('menu_fechado_5').style.display = 'block';
					document.getElementById('menu_aberto_5').style.display = 'none'; ";
	}


	if($menuCms == true) {
		require_once(CAMINHO_SITE . "/layout/menus/menusadm_novo/Mcms.php");
		$string .= "document.getElementById('menu_fechado_6').style.display = 'block';
					document.getElementById('menu_aberto_6').style.display = 'none'; ";
	}
	?>




   </ul>

   </div>




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

	  if ( empty($menuAtual) ) {
	      $menuAtual = 0 ;
	   }


	  print "ControlarMenu('";
	  print $menuAtual;
	  print "','abrir');";

?>
</script>
