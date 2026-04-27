<?php
session_name('ga');
session_start();

unset($_SESSION['renda']['pessoas'][$_GET['numero']]);

header('Location: editarRendaInfantil.php?idAluno='.$_GET['idAluno']);
?>
