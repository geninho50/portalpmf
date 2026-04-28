<?php
require_once("../../../scripts/php/funcoes_bd.php");
$drive->conecta();

$sql = "SELECT * FROM setores WHERE setor_entidade_id = '".$_GET['identificador']."' ORDER BY setor_posicao ASC";
$resposta = $drive->pedido($sql);
	echo"
	<option>=== Selecione um Setor ===</option>
    <option></option>
	";
while($linha1 = pg_fetch_object($resposta)){
	?>
	<option value="<?=$linha1->setor_id ?>"><?=$linha1->setor_nome ?></option>
	<?php
}
?>
</select>