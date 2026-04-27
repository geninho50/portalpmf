<script language='javascript'>
function fecha(){
window.close();
}
tempo = 100;
setTimeout("fecha()",tempo);
</script>
<?php
	$idconduzir = 0;
	$idconduzir = $_GET['idconduzir'];
	if( $idconduzir == 0 )
	{
		$idconduzir = $_POST['idconduzir'];
	}
	$ocorrencia = $_POST['ocorrencia'];
	$numerobo = $_POST['bo'];
	$repp = $_POST['repp'];
	$nomeconduzido = $_POST['nomeconduzido'];
	$raca = $_POST['raca'];
	$sexo = $_POST['sexo'];
	$datafinal = $_POST['datafinal'];
	$nomemae = $_POST['nomemae'];
	$documento = $_POST['documento'];
	$nascionalidade = $_POST['nascionalidade'];
	$naturalidade = $_POST['naturalidade'];
	$crime = $_POST['xait'];
	$pertences = $_POST['pertences'];
	$delegacia = $_POST['delegacia'];
	
	require ("DB_mysql.php");	
	require ("trataArquivo.php");
	require ("trataData.php");
	$conexao = new DB_mysql;
	$conexao->conectarConf();
	$objT = new trataArquivo;
	$objD = new trataData;
	
	$data_atual = date("Y-m-d");
   	$hora_atual = date("H:i:s");
	
	// Variáveis com os tamanhos das previews
	$tamanhoPreview1 = 120;
	$queryU = "INSERT INTO conduzir_delegacia (idocorrencia,numerobo,repp,nomeconduzido,raca,sexo,data_nascimento,nomemae,documento,nascionalidade,naturalidade,delegacia,crime,pertences) values ($ocorrencia,'$numerobo','$repp','$nomeconduzido','$raca','$sexo','$datafinal','$nomemae','$documento','$nascionalidade','$naturalidade','$delegacia','$crime','$pertences')";		
	$conexao->executaQuery($queryU);
	
	$queryA = "insert into atividade (hora,data,dados)values('$hora_atual','$data_atual','Enserido os dados do conduzido a delegacia na ocorrencia de numero $ocorrencia')";
	$conexao->executaQuery($queryA);
	
	echo "<script>alert('Cadastrado com sucesso!');</script>";
	
	// Pega o ultimo id inserido e atualiza a variavel $idNoticia
	$query = "select MAX(id) as id from conduzir_delegacia";
	$resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");	
	while ($linha=mysql_fetch_array($resultado))
	{
		$id = $linha['id'];
	}
	
	// Upload de IMAGEM
	
	// Prepara a variável do arquivo
	$arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : FALSE;	
	$tmp_name = $_FILES["arquivo"]["tmp_name"];
	$nome = $_FILES["arquivo"]["name"];
	$path = $objT->getPath(6)."$id/";
	$tamanhoNomeArquivoEnviado = strlen($nome);

	// Verifica se algum arquivo foi enviado...
	if( $tamanhoNomeArquivoEnviado > 0 )
	{
		if (!is_dir($path) )
		{
			mkdir ($path, 0777); // rmdir($_GET['rem'])
		}
		else
		{
			// Excluir arquivos antigos da pasta
			$objT->rmdir_rf($path);
		}
		$path = $objT->getPath(6)."$id/$id".".jpg";
		copy($tmp_name,$path);

		
		// Tratamento de IMAGEM [ Cria as previews para 120, 270 e 800 px de comprimento ]
		try 
		{
			require ("Resize.php");
			$tmp = getimagesize($path);
            $width  = $tmp[0];
            $height  = $tmp[1];			
			// Criação da Preview 1
			$path1 = $objT->getPath(6)."$id/$id"."_1.jpg";
			if( $width > $tamanhoPreview1 )
			{					
				$tI = new Resize($path);
				$tI->setNewImage($path1);
				$tI->setProportionalFlag('H');
				$tI->setProportional(1);
				$tI->setNewSize($tamanhoPreview1,$tamanhoPreview1);
				$tI->make();
			}
			else
			{
				copy($tmp_name,$path1);
			}			
		}
		catch (Exception $e)
		{
			die($e);
		}
	}
?>