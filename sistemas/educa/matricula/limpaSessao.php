<?php
session_name('ma');
session_start();

session_destroy();

session_name('re');
session_start();

session_destroy();

header("Location: index.php");

?>
