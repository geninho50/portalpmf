<?php
//cria um array contendo 3 empregados

$contar =$_POST["nome"];

$empregados =     array(
        'nome' => $_POST["nome"],
        'idade' => 38,
        'sexo' => 'M'
);
    

//converte o conteúdo do array para uma string JSON
$json_str = json_encode($empregados);


foreach($empregados as $key=>$value)
{
    echo $key . "=>" . $value . "<br>";
}





//imprime a string JSON
echo "$json_str";
?>