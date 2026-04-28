<?php
$mysqli = new mysqli('localhost', 'root', 'mkstec8045', 'central');
$text = $mysqli->real_escape_string($_GET['term']);

$query = "SELECT rua FROM endereco WHERE rua LIKE '%$text%' ORDER BY rua ASC";
$result = $mysqli->query($query);
$json = '[';
$first = true;
while($row = $result->fetch_assoc())
{
    if (!$first) { $json .=  ','; } else { $first = false; }
    $json .= '{"value":"'.$row['rua'].'"}';
}
$json .= ']';
echo $json;
?>