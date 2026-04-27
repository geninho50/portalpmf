<?php
require_once("../../../scripts/php/funcoes_bd.php");
$drive->conecta();
$sql1 		= "SELECT * FROM entidades WHERE entidade_tipo = 0 AND entidade_id <> 0 ORDER BY entidade_linha_1";
$ReturnPref	= $drive->pedido($sql1);
$sql2 		= "SELECT * FROM entidades WHERE entidade_tipo = 4 ORDER BY entidade_linha_1";
$ReturnSec	= $drive->pedido($sql2);
$sql3 		= "SELECT * FROM entidades WHERE entidade_tipo = 5 ORDER BY entidade_linha_1";
$ReturnExec	= $drive->pedido($sql3);
$sql4 		= "SELECT * FROM entidades WHERE entidade_tipo = 6 ORDER BY entidade_linha_1";
$ReturnOrg	= $drive->pedido($sql4);

	echo"
	<option>=== Selecione uma Entidade ===</option>
	<option> </option>
	<option>== Prefeitura ==</option>
	<option> </option>
	";
while($Tpref = pg_fetch_object($ReturnPref)){
	echo"<option value=\"".$Tpref->entidade_id."\">&nbsp;&nbsp;&nbsp;&nbsp;".$Tpref->entidade_linha_1."</option>";
}
	echo"
	<option> </option>
	<option>== Secretaria Municipal ==</option>
	<option> </option>
	";
while($Tsec  = pg_fetch_object($ReturnSec)){
	echo"<option value=\"".$Tsec->entidade_id."\">&nbsp;&nbsp;&nbsp;&nbsp;".$Tsec->entidade_linha_1."</option>";
}
	echo"
	<option> </option>
	<option>== Secretaria Executiva ==</option>
	<option> </option>
	";
while($Texec = pg_fetch_object($ReturnExec)){
	echo"<option value=\"".$Texec->entidade_id."\">&nbsp;&nbsp;&nbsp;&nbsp;".$Texec->entidade_linha_1."</option>";
}
	echo"
	<option> </option>
	<option>== Org&atilde;os ==</option>
	<option> </option>
	";
while($Torg  = pg_fetch_object($ReturnOrg)){
	echo"<option value=\"".$Torg->entidade_id."\">&nbsp;&nbsp;&nbsp;&nbsp;".$Torg->entidade_linha_1."</option>";
}
	echo"
	<option> </option>
	";
?>