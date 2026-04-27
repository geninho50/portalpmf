<?php
session_name('ma_eja');
session_start();

session_destroy();

header("Location: dadosPessoaisAlunoEJA.php");
?>
