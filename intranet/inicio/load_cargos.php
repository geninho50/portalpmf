<?php
require_once("../../../scripts/php/funcoes_bd.php");
$drive->conecta();
$sql 	  = "SELECT * FROM cargos WHERE cargo_entidade_id = '".$_GET['identificador']."' ORDER BY cargo_posicao ASC";
$resposta = $drive->pedido($sql);
	echo"
	<option>=== Selecione um Cargo ===</option>
    <option></option>
	";
while($linha1 = pg_fetch_object($resposta)){
	?>
	<option value="<?=$linha1->cargo_id ?>"><?=$linha1->cargo_nome ?></option>
	<?php
}
?>
</select>