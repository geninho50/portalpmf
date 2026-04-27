<?php

function calcular_idade($data, $data_chegada){ 
  //date in mm/dd/yyyy format; or it can be in other formats as well
  //explode the date to get month, day and year
  $data = explode("-", $data);
  $data_chegada = explode("-", $data_chegada);
  //obter idade da data de aniversario
  $idade = (date("md", date("U", mktime(0, 0, 0, $data[0], $data[1], $data[2]))) > date("md")
    ? (($data_chegada[2] - $data[2]) - 1)
    : ($data_chegada[2] - $data[2]));
  
  // Se a idade for entre 17 e 2 anos, imprimir idade + 'anos'
  if ($idade < 18 && $idade > 1) {
    echo  $idade.' anos';
  }
  
  // Se a idade for menor que 1, imprimir idade + 'ano'
  if ($idade <= 1) {
    echo  $idade.' ano';
  }

  // Se a idade for maior que 17, imprimir idade + 'anos'
  if ($idade > 18 ) {
    echo  $idade.' anos';
  }
}
?>