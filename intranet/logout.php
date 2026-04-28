<?php 
session_start(); 
session_unset();
session_destroy();
echo "	<script language= \"JavaScript\">
			location.href=\"index.php\"
		</script>";
echo "<meta http-equiv='refresh' content=\"0;url='index.php\">";
?>