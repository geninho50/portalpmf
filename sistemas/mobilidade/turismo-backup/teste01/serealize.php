<?php

session_start();
include_once 'conexao.php';

if( $_REQUEST["name"] ) {

   $name = $_REQUEST['name'];
   echo "Welcome ". $name;
   $age = $_REQUEST['age'];
   echo "<br />Your age : ". $age;
   $sex = $_REQUEST['sex'];
   echo "<br />Your gender : ". $sex;


   foreach ($name as $key => $value) {
    $values[] = $value;
    $i_pax_max++;
}


// $i = 0;
for ($i = 0; $i < $i_pax_max; $i++) {
    $result[$i] =   array('nome' => $name[$i]);
};

$passageiros = json_encode($result);

   $sql = "INSERT INTO turismo.teste
   (
       nome
   )
   VALUES
   (
       :nome
       
   )";

$stmt = $conn->prepare($sql);
$stmt->bindValue(':nome', $passageiros);
$stmt->execute();
$count = $stmt->rowCount();




}
?>