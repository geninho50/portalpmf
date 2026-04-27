<?php
session_start();
require_once("config/database.php");
require_once("config/compatibility.php");
require_once("includes/functions.php");

// Registrar log de logout se estiver logado
if (isset($_SESSION['SuserId'])) {
    logAction($_SESSION['SuserId'], 'logout', 'Logout realizado');
}

// Destruir sessão
session_destroy();

// Redirecionar para login
header("Location: login.php?message=logout_success");
exit();
?>