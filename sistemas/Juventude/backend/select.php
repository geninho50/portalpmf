<?php
require_once "db.php";



$ordem = $_GET['ordem'];
	switch ($ordem) {
		case 'nome':
			$ordernar = 'nome';
			break;
		default:
			$ordernar = 'id';
			break;
}

$sql = $db->prepare("SELECT j.id, j.nome, j.genero, j.dataNasc, j.rua, j.numero,
							j.bairro, j.cep, j.escolaridade, j.email, j.telefone,
							j.celular, j.profissional, j.qual, j.ctps, j.cpf, j.etnia,
							j.rg, c.nmcurso, t.nuturma, t.dt1, t.dt2, t.hrini, t.hrfim
					FROM juventude.juventude j
					JOIN juventude.turma t ON t.idturma = j.idturma
					JOIN juventude.curso c ON c.idcurso = t.idcurso
					WHERE j.idturma > 40 
					AND j.ano = '".(date("Y"))."' ORDER BY j.id");
$sql->execute();
$data = $sql->fetchALL(PDO::FETCH_ASSOC);
$tabela = '';


for($i = 0; $i < sizeof($data); $i++){
	$tabela .= "<tr>";
		$tabela .= "<td>";
			$tabela .= utf8_encode($data[$i]['id']);
		$tabela .= "</td>";

		$tabela .= "<td>";
			$tabela .= utf8_encode($data[$i]['nome']);
		$tabela .= "</td>";


		$tabela .= "<td>";
			$tabela .= utf8_encode($data[$i]['dataNasc']);
		$tabela .= "</td>";

		$tabela .= "<td>";
			$tabela .= utf8_encode($data[$i]['cpf']);
		$tabela .= "</td>";


		$tabela .= "<td>";
			$tabela .= utf8_encode($data[$i]['genero']);
		$tabela .= "</td>";


		$tabela .= "<td>";
		$tabela .= utf8_encode($data[$i]['escolaridade']);
		$tabela .= "</td>";

		$tabela .= "<td>";
			$tabela .= utf8_encode($data[$i]['email']);
		$tabela .= "</td>";

		$tabela .= "<td>";
			$tabela .= utf8_encode($data[$i]['telefone']);
		$tabela .= "</td>";

		$tabela .= "</td>";

		$tabela .= "<td>";
			$tabela .= utf8_encode($data[$i]['celular']);
		$tabela .= "</td>";

		$tabela .= "<td>";
		$tabela .= utf8_encode($data[$i]['profissional']);
		$tabela .= "</td>";

		$tabela .= "<td>";
			$tabela .= utf8_encode($data[$i]['qual']);
		$tabela .= "</td>";

		$tabela .= "<td>";
			$tabela .= utf8_encode($data[$i]['ctps']);
		$tabela .= "</td>";


		$tabela .= "<td>";
		$tabela .= utf8_encode($data[$i]['nmcurso'])." - Turma ".$data[$i]['nuturma']." - ".date("d/m/Y",strtotime($data[$i]['dt1']))." e ".date("d/m/Y",strtotime($data[$i]['dt2']))." - Horário das ".$data[$i]['hrini']." as ".$data[$i]['hrfim'];
		$tabela .= "</td>";


}

?>
