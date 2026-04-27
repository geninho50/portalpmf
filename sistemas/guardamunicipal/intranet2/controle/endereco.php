<?php
$hostname = "192.168.1.20";
$user = "gmf";
$pass = "6f532!@AT";
$basedados = "siga";
$connect = mysql_connect($hostname,$user,$pass) or die ("Impossível estabelecer conexão com o servidor de banco de dados");
mysql_select_db($basedados) or die ("Impossivel estabelecer conexão com o banco de dados");

//busca valor digitado no campo autocomplete "$_GET['term']
$text = mysql_real_escape_string($_GET['term']);
$query = "SELECT * FROM endereco WHERE UPPER(rua) like UPPER('%$text%') ORDER BY rua ASC";
$result = mysql_query($query);
//formata o resultado para JSON
$json = '[';
$first = true;
while($row = mysql_fetch_array($result))
{
  if (!$first) { $json .=  ','; } else { $first = false; }
  $json .= '{"value":"'.$row['rua'].'"}';
}
$json .= ']';

echo $json;
?>