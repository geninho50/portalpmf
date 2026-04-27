<?php
switch($_GET['acao']){
	case "up":
		if($oQueryControl->intranet_submenu_posicao > 1){
			
			//------------------------------------
			// Esta posição irá para o menu atual
			//------------------------------------
			$posicaoCima 	   = (int)$oQueryControl->intranet_submenu_posicao - 1;
			
			//------------------------------------------------------------------------
			// O menu acima deste que está sendo tratado receberá a sua posição atual
			//------------------------------------------------------------------------
			$posicaoAtual	   = (int)$oQueryControl->intranet_submenu_posicao;
			
			//-------------------------------------------------
			// Query que irá alterar a posição do menu de cima
			//-------------------------------------------------
			$QueryMenuCima  = "UPDATE intranet_submenu 
							  SET intranet_submenu_posicao = $posicaoAtual 
							  WHERE intranet_submenu_posicao = $posicaoCima 
							  AND intranet_submenu_pai_id = $menuid";
		
			//-----------------------------------------------
			// Query que irá alterar a posição do menu atual
			//-----------------------------------------------
			$QueryMenuAtual = "UPDATE intranet_submenu
							   SET intranet_submenu_posicao = $posicaoCima 
							   WHERE intranet_submenu_id = $submenuid";
							   
							   
			$RQueryMenuCima  = $drive->pedido($QueryMenuCima);
			$RQueryMenuAtual = $drive->pedido($QueryMenuAtual);
							   
			
			if($RQueryMenuCima && $RQueryMenuAtual){
				$drive->mensagem("Dados atualizado com sucesso !");
			}		
		}else{
			$drive->mensagem("Erro: Este menu esta na primeira posicao !");	
		}
	break;
	case "down":					
		$sqlCount = "SELECT count(intranet_submenu_id) as quantidade 
					 FROM intranet_submenu WHERE intranet_submenu_pai_id = $menuid";
	
		$RsqlCount  = $drive->pedido($sqlCount);
		$oSqlCount = pg_fetch_object($RsqlCount); 			
		
		if($oQueryControl->intranet_submenu_posicao < $oSqlCount->quantidade){
			
			//------------------------------------
			// Esta posição irá para o menu atual
			//------------------------------------
			$posicaoBaixo 	   = (int)$oQueryControl->intranet_submenu_posicao + 1;
			
			//-------------------------------------------------------------------------
			// O menu abaixo deste que está sendo tratado receberá a sua posição atual
			//-------------------------------------------------------------------------
			$posicaoAtual	   = (int)$oQueryControl->intranet_submenu_posicao;
			
			//-------------------------------------------------- 
			// Query que irá alterar a posição do menu de baixo
			//--------------------------------------------------
			$QueryMenuBaixo  = "UPDATE intranet_submenu 
							  SET intranet_submenu_posicao = $posicaoAtual 
							  WHERE intranet_submenu_posicao = $posicaoBaixo 
							  AND intranet_submenu_pai_id = $menuid";
		
			//-----------------------------------------------
			// Query que irá alterar a posição do menu atual
			//-----------------------------------------------
			$QueryMenuAtual = "UPDATE intranet_submenu
							   SET intranet_submenu_posicao = $posicaoBaixo 
							   WHERE intranet_submenu_id = $submenuid";							   
							   
			$RQueryMenuBaixo  = $drive->pedido($QueryMenuBaixo);
			$RQueryMenuAtual = $drive->pedido($QueryMenuAtual);							   
			
			if($RQueryMenuBaixo && $RQueryMenuAtual){
				$drive->mensagem("Dados atualizados com sucesso!");
			}		
		}else{
			$drive->mensagem("Erro: Este menu esta na ultima posicao !");	
		}
	break;
}
?>