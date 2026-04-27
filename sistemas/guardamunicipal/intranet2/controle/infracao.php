<?php

//mysql_connect("187.45.196.207", "gmf", "mkstec8045");
//mysql_select_db("gmf");

/*mysql_connect("localhost", "root", "mkstec8045");
mysql_select_db("central");

$tipificacao = $_POST['tipificacao'];

$sql = "SELECT * FROM ait WHERE tipificacao = '$tipificacao' ORDER BY descricao ASC";
$qr = mysql_query($sql) or die(mysql_error());

if(mysql_num_rows($qr) == 0){
   echo  '<option value="0">'.htmlentities('Sem dados para essa tipificação').'</option>';
   
}else{
   while($ln = mysql_fetch_assoc($qr)){
      echo '<option value="'.$ln['id'].'">'.$ln['descricao'].'</option>';
   }
}

$hostname = "localhost";
//$hostname = "192.168.39.206";
$user = "root";
$pass = "mkstec8045";
$basedados = "central";
$connect = mysql_connect($hostname,$user,$pass) or die ("Impossível estabelecer conexão com o servidor de banco de dados");
mysql_select_db($basedados) or die ("Impossivel estabelecer conexão com o banco de dados");
//busca valor digitado no campo autocomplete "$_GET['term']

$text = mysql_real_escape_string($_GET['term']);
$query = "SELECT * FROM ait WHERE UPPER(descricao) like UPPER('%$text%') ORDER BY descricao ASC";
$result = mysql_query($query);
//formata o resultado para JSON

$first = true;
while($row = mysql_fetch_array($result))
{
  if (!$first) { $json .=  ','; } else { $first = false; }
  echo $row['descricao'].' - '.$row['codigo'].'/'.$row['desdobramento']."\n";
}

?>
*/
$hostname = "192.168.1.20";
$user = "gmf";
$pass = "6f532!@AT";
$basedados = "siga";
$connect = mysql_connect($hostname,$user,$pass) or die ("Impossível estabelecer conexão com o servidor de banco de dados");
mysql_select_db($basedados) or die ("Impossivel estabelecer conexão com o banco de dados");

//busca valor digitado no campo autocomplete "$_GET['term']
$text = mysql_real_escape_string($_GET['term']);
$query = "SELECT * FROM ait WHERE UPPER(descricao) like UPPER('%$text%') ORDER BY descricao ASC";
$result = mysql_query($query);
//formata o resultado para JSON
$json = '[';
$first = true;
while($row = mysql_fetch_array($result))
{
  if (!$first) { $json .=  ','; } else { $first = false; }
  $json .= '{"value":"'.$row['codigo'].'/'.$row['desdobramento'].' -> '.$row['descricao'].'  - '.$row['codigo'].'/'.$row['desdobramento'].'\n"}';
}
$json .= ']';

echo $json;
?>

