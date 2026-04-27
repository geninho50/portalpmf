<?php
switch($_GET['acao']){
	case "up":
		if($oQueryControl->intranet_menu_posicao > 1){
			
			//------------------------------------
			// Esta posição irá para o menu atual
			//------------------------------------
			$posicaoCima 	   = (int)$oQueryControl->intranet_menu_posicao - 1;
			
			//------------------------------------------------------------------------
			// O menu acima deste que está sendo tratado receberá a sua posição atual
			//------------------------------------------------------------------------
			$posicaoAtual	   = (int)$oQueryControl->intranet_menu_posicao;
						
			//-------------------------------------------------
			// Query que irá alterar a posição do menu de cima
			//-------------------------------------------------
			$QueryMenuCima  = "UPDATE intranet_menu 
							  SET intranet_menu_posicao = $posicaoAtual 
							  WHERE intranet_menu_posicao = $posicaoCima 
							  AND intranet_menu_tipo = '$get_sistema'";
			
			//-----------------------------------------------		
			// Query que irá alterar a posição do menu atual
			//-----------------------------------------------
			$QueryMenuAtual = "UPDATE intranet_menu
							   SET intranet_menu_posicao = $posicaoCima 
							   WHERE intranet_menu_id = $menuid";								   
										   
			$RQueryMenuCima  = $drive->pedido($QueryMenuCima);
			$RQueryMenuAtual = $drive->pedido($QueryMenuAtual);
		}else{
			$drive->mensagem("Erro: Este menu esta na primeira posicao !");	
		}
	break;
	case "down":
		$sqlCount = "SELECT count(intranet_menu_id) as quantidade 
					 FROM intranet_menu WHERE intranet_menu_tipo = '$get_sistema'";
				
		$RsqlCount  = $drive->pedido($sqlCount);
		$oSqlCount = pg_fetch_object($RsqlCount); 	
			
		if($oQueryControl->intranet_menu_posicao < $oSqlCount->quantidade){
			
			//------------------------------------
			// Esta posição irá para o menu atual
			//------------------------------------
			$posicaoBaixo 	   = (int)$oQueryControl->intranet_menu_posicao + 1;
			
			//-------------------------------------------------------------------------
			// O menu abaixo deste que está sendo tratado receberá a sua posição atual
			//-------------------------------------------------------------------------
			$posicaoAtual	   = (int)$oQueryControl->intranet_menu_posicao;
			
			//--------------------------------------------------
			// Query que irá alterar a posição do menu de baixo
			//--------------------------------------------------
			$QueryMenuBaixo  = "UPDATE intranet_menu 
							  SET intranet_menu_posicao = $posicaoAtual 
							  WHERE intranet_menu_posicao = $posicaoBaixo 
							  AND intranet_menu_tipo = '$get_sistema'";
			
			//-----------------------------------------------
			// Query que irá alterar a posição do menu atual
			//-----------------------------------------------
			$QueryMenuAtual = "UPDATE intranet_menu
							   SET intranet_menu_posicao = $posicaoBaixo 
							   WHERE intranet_menu_id = $menuid";
							   
							   
			$RQueryMenuBaixo  = $drive->pedido($QueryMenuBaixo);
			$RQueryMenuAtual = $drive->pedido($QueryMenuAtual);
		}else{
			$drive->mensagem("Erro: Este menu esta na ultima posicao !");	
		}
	break;
}
?>