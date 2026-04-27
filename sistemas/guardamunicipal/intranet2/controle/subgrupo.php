<?php

//mysql_connect("187.45.196.207", "gmf", "mkstec8045");
//mysql_select_db("gmf");

mysql_connect("192.168.1.20", "gmf", "6f532!@AT");
mysql_select_db("siga");

$grupo = $_POST['ygrupo'];

echo $sql = "SELECT * FROM subgrupo_material WHERE grupo = '$grupo' ORDER BY nome ASC";
$qr = mysql_query($sql) or die(mysql_error());

if(mysql_num_rows($qr) == 0){
   echo  '<option value="0">Nao existe subgrupo para este grupo</option>';
   
}else{
   while($ln = mysql_fetch_assoc($qr)){
      echo '<option value="'.$ln['nome'].'">'.$ln['nome'].'</option>';
   }
}

?>

