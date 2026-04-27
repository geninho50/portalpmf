<?php

$dataEscolhida = $_GET['dataEscolhida'];

include_once("banco/gdb.php");

$gdb = new gdb();

$horariosAtendimento = array( '--:--','08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00');

print "<select style='width: 250px; height:30px;' name='horaEscolhida' i='horaEscolhida' onChange='changeHora(this);' >";

foreach( $horariosAtendimento as $key=>$value ){ 		

  $tem = horarioOcupado( $value, $dataEscolhida );
  
  // print "TEm : ".$tem;
  
  if( $tem == 0 ){

	  print "<option value='$value'>$value</option>"; 
  }
}

print '</select>';

function horarioOcupado( $horas, $dataEscolhida ){
	$gdb2 = new gdb();
	$gdb2->open("select COUNT(*) as tem from agenda where data = '$dataEscolhida' and TIME_FORMAT(horario,'%H:%i') = '$horas' ");
	if( $gdb2->gs['TEM'][0] !=0 ) return 1; 
	else return 0;										
}
?>