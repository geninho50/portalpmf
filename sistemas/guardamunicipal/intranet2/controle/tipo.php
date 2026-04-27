<?php

//mysql_connect("187.45.196.207", "gmf", "mkstec8045");
//mysql_select_db("gmf");

mysql_connect("192.168.1.20", "gmf", "6f532!@AT");
mysql_select_db("siga");

$especie = $_POST['yespecie'];

$sql = "SELECT * FROM tipo WHERE idespecie = '$especie' ORDER BY tipo asc";
$qr = mysql_query($sql) or die(mysql_error());

if(mysql_num_rows($qr) == 0){
   echo  '<option value="0">'.htmlentities('Nao ha tipo para essa especie de veiculo').'</option>';
   
}else{
   while($ln = mysql_fetch_assoc($qr)){
      echo '<option value="'.$ln['id'].'">'.$ln['tipo'].'</option>';
   }
}

?>

