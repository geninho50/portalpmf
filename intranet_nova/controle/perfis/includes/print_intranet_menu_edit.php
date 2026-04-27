<tr>  
	<td class="container_item_result">     
		<?php 
      	$menuid	   			= (int)$ointranet->intranet_menu_id;
		$querymenuperfil 	= "SELECT * FROM intranet_perfil_menu 
					  		   WHERE intranet_perfil_menu_perfil_id = $perfilid 
							   AND intranet_perfil_menu_menu_id = $menuid";
		$rquerymenuperfil = $drive->pedido($querymenuperfil);
		if( pg_num_rows($rquerymenuperfil) > 0){
			?>
			<a href="#M<?=$ointranet->intranet_menu_id?>" class="fakecheck" id="FCM<?=$ointranet->intranet_menu_id?>"></a>
			<input type="checkbox" style="display:none;" name="M<?=$ointranet->intranet_menu_id?>" id="M<?=$ointranet->intranet_menu_id?>" checked="checked"/>
			<?php		
		}else{
			?>
			<a href="#M<?=$ointranet->intranet_menu_id?>" class="fakecheck" id="FCM<?=$ointranet->intranet_menu_id?>"></a>
			<input type="checkbox" style="display:none;" name="M<?=$ointranet->intranet_menu_id?>" id="M<?=$ointranet->intranet_menu_id?>" />
			<?php	
		}
			?>
	</td>
  	<td class="container_item_result"><strong><?=$ointranet->intranet_menu_titulo?></strong></td>
</tr>