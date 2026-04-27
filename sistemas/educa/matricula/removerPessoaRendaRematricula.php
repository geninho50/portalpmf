<?php
session_name('re');
session_start();

unset($_SESSION['renda']['pessoas'][$_GET['numero']]);

header('Location: dadosRendaRematricula.php');
?>
