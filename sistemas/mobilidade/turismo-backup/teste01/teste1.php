<?php
//Assign JSON encoded string to a PHP variable
$age = '{"Poll":55,"Devid":40,"Akbar":68,"Cally":70}';

// Decode JSON data to PHP associative array
$array = json_decode($age, true);

// Loop through the associative array
foreach($array as $key=>$value)
{
    echo $key . "=>" . $value . "<br>";
}
?>