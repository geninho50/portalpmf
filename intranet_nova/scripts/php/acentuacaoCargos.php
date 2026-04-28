<?

	require_once("funcoes_bd.php");		
	 
	require_once("funcoes.php");	

	$drive->conecta();

    $procurar = $_POST['procurar'];
    $sql = "SELECT * FROM cargos";
	$result = $drive->pedido($sql);
	$nomes = pg_fetch_all($result);    
	
	foreach ($nomes as  $value) {
		
		$id = $value['cargo_id'];
		$sqlAlt = "UPDATE cargos SET cargo_nome = convert_from(convert_to(cargo_nome,'iso-8859-1'),'utf-8') WHERE cargo_id = $id";
		$feito = $drive->pedido($sqlAlt);    
		$nome = $value['cargo_nome'];
		if ($feito) {
			echo "Nome $nome Alterado <br>";
		}	  

	}	



