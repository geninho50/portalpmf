<?php
//--------------------------------------------
//verifica se o usu�rio tem acesso ao sistema
//--------------------------------------------
session_start();
if(isset($_SESSION['SuserId'])){
	//-------------------------------------------------------------------
	//verifica se o usuario pode acessar a pagina passada como paramento
	//-------------------------------------------------------------------
	if((isset($_GET['pagina'])) and (!in_array($_GET['pagina'], $_SESSION['SuserPagAccess']))){
			echo "<script language= \"JavaScript\">location.href=\"inicio.php\"</script>";
			echo "<meta http-equiv='refresh' content=\"0;url='inicio.php'\">";
			exit();
	}
}else{
	echo "<script language= \"JavaScript\">location.href=\"index.php\"</script>";
	echo "<meta http-equiv='refresh' content=\"0;url='index.php'\">";
	exit();
}
?>
