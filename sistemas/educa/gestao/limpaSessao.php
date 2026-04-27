<?php
session_name('ga');
session_start();

session_destroy();

header("Location: index.php");

?>
