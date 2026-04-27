<?php
session_name('ma');
session_start();

unset($_SESSION['renda']['pessoas'][$_GET['numero']]);

header('Location: dadosRenda.php');
?>
