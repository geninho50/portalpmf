<tr>  
	<td class="container_item_result">
    	<?php 
      	$submenuid 			= (int)$oquerysubmenu->intranet_submenu_id;
		$querymenuperfil 	= "SELECT * FROM intranet_perfil_submenu 
					  		   WHERE intranet_perfil_submenu_perfil_id = $perfilid 
							   AND intranet_perfil_submenu_submenu_id = $submenuid";
		$rquerymenuperfil = $drive->pedido($querymenuperfil);
		if(pg_num_rows($rquerymenuperfil) > 0){
		?>	
			<a href="#SM<?=$oquerysubmenu->intranet_submenu_id?>" class="fakecheck" id="FCSM<?=$oquerysubmenu->intranet_submenu_id?>"></a>
            <input type="checkbox" name="SM<?=$oquerysubmenu->intranet_submenu_id?>" id="SM<?=$oquerysubmenu->intranet_submenu_id?>" checked="checked" style="display:none;"/>
   	 	<?php    
        }else{
		?>
			<a href="#SM<?=$oquerysubmenu->intranet_submenu_id?>" class="fakecheck" id="FCSM<?=$oquerysubmenu->intranet_submenu_id?>"></a>
            <input type="checkbox" style="display:none;" name="SM<?=$oquerysubmenu->intranet_submenu_id?>" id="SM<?=$oquerysubmenu->intranet_submenu_id?>" />
		<?php
		}
		?>
	</td>
  	<td class="container_item_result"><strong><?=$ointranet->intranet_menu_titulo?></strong> &raquo; <?=$oquerysubmenu->intranet_submenu_titulo?></td>
</tr>