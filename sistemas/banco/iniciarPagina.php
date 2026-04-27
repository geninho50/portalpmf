<?php 
   header("Expires: 0");
   include_once("sessao.php");

   $sessao = new sessao();

   if ( !$sessao->updateAcesso($sessao->id, $sessao->usid, $sessao->pagina , "now", "now()", $sessao->ip) ) {
         // $msg = $acessos->error;
         //include_once("/usr1/wwwroot/sefin/admin/logoff.php");
    }else{		 
	  $sessao->insertAcesso($sessao->id,$sessao->usid, $sessao->pagina,"now()","now()", $sessao->ip, $sessao->codigoSessao);      
   }
?>