<?php
session_start();

$perfil_id 		= $_SESSION['SuserPerfilId'];
$menu_tipo		= 'intranet'; 	


//Arrays de ids de menus pais em relação ao submenu
$arrayMenusId = array();

//Consulta de submenus em relação ao perfil
$sqlSubMenu = "
        SELECT intranet_perfil_submenu.intranet_perfil_submenu_perfil_id, 
               intranet_menu.intranet_menu_id, 
	           intranet_menu.intranet_menu_tipo, 
	           intranet_menu.intranet_menu_posicao
          FROM (intranet_perfil_submenu 
    INNER JOIN intranet_submenu 
		    ON intranet_perfil_submenu.intranet_perfil_submenu_submenu_id = intranet_submenu.intranet_submenu_id) 
	INNER JOIN intranet_menu 
		    ON intranet_submenu.intranet_submenu_pai_id = intranet_menu.intranet_menu_id
         WHERE (((intranet_perfil_submenu.intranet_perfil_submenu_perfil_id)=$perfil_id) AND ((intranet_menu.intranet_menu_tipo)='$menu_tipo')); ";
		 
//Efetuo a query
$rSubmenu = $drive->pedido($sqlSubMenu);

//Consulta dos menus que não possuem submenus
$sqlMenu = "
SELECT intranet_menu.intranet_menu_id, 
       intranet_menu.intranet_menu_titulo, 
	   intranet_menu.intranet_menu_tipo_pai, 
	   intranet_menu.intranet_menu_endereco_fisico, 
	   intranet_menu.intranet_menu_atalho, 
	   intranet_menu.intranet_menu_posicao, 
	   intranet_menu.intranet_menu_tipo, 
	   intranet_perfil_menu.intranet_perfil_menu_perfil_id
  FROM intranet_menu 
 INNER JOIN intranet_perfil_menu 
    ON intranet_menu.intranet_menu_id = intranet_perfil_menu.intranet_perfil_menu_menu_id
 WHERE (((intranet_menu.intranet_menu_tipo)='$menu_tipo') AND ((intranet_perfil_menu.intranet_perfil_menu_perfil_id)=$perfil_id));";
 
//Efetuo a query
$rMenu = $drive->pedido($sqlMenu);
//Requisito em forma de objeto


//Populo o vetor com o id do menu, o restante dos ids do menu virão da tabelas de submenu
//pois é a unica forma de recuperar menus que são pais para submenus

//Menus que não sao pais
while($oMenu = pg_fetch_object($rMenu)){
	$arrayMenusId[$oMenu->intranet_menu_posicao] = (int)$oMenu->intranet_menu_id;
}
//--------------------
// Menus que são pais
//--------------------
while($oSubmenu = pg_fetch_object($rSubmenu)){
	$arrayMenusId[$oSubmenu->intranet_menu_posicao] = (int)$oSubmenu->intranet_menu_id;
}
//-----------------------------------------------------
// Ordeno o vetor de menus de acordo com a sua posição
//-----------------------------------------------------
asort($arrayMenusId);
?>



<div id="menugeral">
	<ul>  
		<li id="menu_fechado_0" style="display:none"><span><a href="inicio.php">HOME</a></span></li>
		<li id="menu_aberto_0" style="display:block"><span><a href="inicio.php" class="selecionado">HOME</a></span></li>
		<?php
		$string = "
		document.getElementById('menu_fechado_0').style.display = 'block';
		document.getElementById('menu_aberto_0').style.display = 'none'; ";

		//Executo array para perquisar submenus
		for($i = 0; $i <= end($arrayMenusId);$i++){			
			$idMenuAtual = (int)$arrayMenusId[$i];
			$posicaoMenu = $i + 1;
			$query = "SELECT * FROM intranet_menu WHERE intranet_menu_id = $idMenuAtual";
			$rquery = $drive->pedido($query);			
			$oquery = pg_fetch_object($rquery);
				switch($oquery->intranet_menu_tipo_pai){
					case "t"			:						
						$string .= "
						document.getElementById('menu_fechado_". $posicaoMenu . "').style.display = 'block';
						document.getElementById('menu_aberto_". $posicaoMenu . "').style.display = 'none'; 
						";
						//Impressao do titulo do menu fechado
						echo("
						<li id=\"menu_fechado_". $posicaoMenu ."\" style=\"display:block\">
							<div>
								<a href=\"javascript:ControlarMenu('" . $posicaoMenu . "','abrir')\">$oquery->intranet_menu_titulo</a>
							</div>
						</li>");

						//Impressao do título do menu aberto
						echo("
						<li id=\"menu_aberto_". $posicaoMenu . "\" style=\"display:none\">
							<a href=\"javascript:ControlarMenu('". $posicaoMenu . "','fechar')\" class=\"selecionado\">
								$oquery->intranet_menu_titulo
							</a>");
							$idmenu	= $oquery->intranet_menu_id;
							$querysub = "
							SELECT intranet_submenu.intranet_submenu_id, intranet_submenu.intranet_submenu_pai_id, intranet_submenu, intranet_submenu.intranet_submenu_titulo,intranet_submenu.intranet_submenu_atalho, intranet_perfil_submenu.intranet_perfil_submenu_perfil_id
							FROM intranet_perfil_submenu INNER JOIN intranet_submenu ON intranet_perfil_submenu.intranet_perfil_submenu_submenu_id = intranet_submenu.intranet_submenu_id
							WHERE (((intranet_submenu.intranet_submenu_pai_id)= $idmenu) AND ((intranet_perfil_submenu.intranet_perfil_submenu_perfil_id)=$perfil_id)) ORDER BY intranet_submenu_posicao ASC";
							$rquerysub      = $drive->pedido($querysub);
							//Impressao do UL dos submenus
							echo("<ul>");
							while($oquerysub = pg_fetch_object($rquerysub)){
								$endereco = "?pagina=".$oquerysub->intranet_submenu_atalho."&menu=$posicaoMenu";
								echo("<li><a href=\"$endereco\">$oquerysub->intranet_submenu_titulo</a></li>\r");	
							}
							//Fim da impressao da UL dos submenus
							echo("</ul>");					
					break;

					case "f"			:
						$endereco = "?pagina=".$oquery->intranet_menu_atalho."&menu=$posicaoMenu";	
						echo("<li>\r");
						echo("<a href=\"$endereco\">$oquery->intranet_menu_titulo</a>");	
						echo("</li>\r");
					break;
			}
	}
?>     

</ul>
</div>
   
 
<?php
echo("
<script type=\"text/javascript\">

var numSubMenus = " . sizeof($arrayMenusId) . ";" ."


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