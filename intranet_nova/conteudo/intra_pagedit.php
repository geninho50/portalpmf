<div class="centro">
   <?php 
    switch($_GET['aba']){
        case "dados": 	   require_once("abas/aba_dados.php"); 			break;
        case "imagens":	   require_once("abas/aba_imagens.php");		break;
        case "audios": 	   require_once("abas/aba_audios.php"); 		break;
        case "videos": 	   require_once("abas/aba_videos.php"); 		break;
        case "arquivos":   require_once("abas/aba_arquivos.php");		break;
        case "visualizar": require_once("abas/aba_visualizacao.php");	break;
        default: require_once("abas/aba_dados.php");
    }
    ?>     
</div>