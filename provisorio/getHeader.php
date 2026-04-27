<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
require_once("scripts/php/config.php");
require_once("scripts/php/funcoes_bd.php");
require_once("scripts/php/funcoes.php");
$drive->conecta();
$menu_principal = "home";
$charset = "";

if( isset($_GET["charset"]) ){
   $charset = $_GET["charset"];
}   
if(isset($charset)) {
  header('Content-Type: text/html; charset='.$charset);
} else {
  $charset = "UTF-8";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="<?=$charset?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <?php
      echo("<link rel=\"stylesheet\" href=\"http://".$_SERVER['HTTP_HOST']."/layout/pmf-estilo.css\">");
    ?>
  </head>
  <body>
    <?php
    include("layout/menus/menu_geral.php");
    echo("<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js\"></script>");
     ?>
  </body>
</html>
