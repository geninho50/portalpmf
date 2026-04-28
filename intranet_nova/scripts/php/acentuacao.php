<?

	require_once("funcoes_bd.php");		
	 
	require_once("funcoes.php");	

	$drive->conecta();

    $procurar = $_POST['procurar'];
    $sql = "SELECT * FROM uni_usuarios";
	$result = $drive->pedido($sql);
	$nomes = pg_fetch_all($result);    
	
	foreach ($nomes as  $value) {
		
		$id = $value['user_id'];
		$sqlAlt = "UPDATE uni_usuarios SET user_nome = convert_from(convert_to(user_nome, 'iso-8859-1'), 'utf-8') WHERE user_id = $id";
		$feito = $drive->pedido($sqlAlt);    
		$nome = $value['user_nome'];
		if ($feito) {
			echo "Nome $nome Alterado <br>";
		}	  

	}	



