<?php

require_once("db-comum.php"); 
require_once("funcoes.php");
require_once("/home/www/scripts/php/config.php");



$sql = "SELECT count(*) as qtd FROM `IsnardAzevedo`.`dadosCadastro`";
$result = $conn->query($sql);
$result = $result->fetch_assoc();
$data = $_POST;

$numeroCampos = 6;
// Tamanho máximo do arquivo (em bytes)
$tamanhoMaximo = 1024 * 1024 * 10; //10Mb
// Extensões aceitas
$extensoes = array(".pdf");
// Caminho para onde o arquivo será enviado
$caminho = CAMINHO_SITE."/sistemas/MostraQuintaisCenicos/Pdfs/";
// Substituir arquivo já existente (true = sim; false = nao)
$substituir = false;

if($result['qtd'] < 100){

require_once("db.php"); 

        $nome               = utf8_decode($data['nome']);
        $endereco           = utf8_decode($data['endereco']);
        $cidade             = utf8_decode($data['cidade']);
        $bairro             = utf8_decode($data['bairro']);
        $cep                = utf8_decode($data['cep']);
        $cnpj               = utf8_decode($data['cnpj']);
        $telefone           = utf8_decode($data['telefone']);
        $email              = utf8_decode($data['email']);
        $responsavel        = utf8_decode($data['responsavel']);
        $cpfResponsa        = utf8_decode($data['cpfResponsa']);
        $produtor           = utf8_decode($data['produtor']);
        $foneProd           = utf8_decode($data['foneProd']);
        $foneProdCel        = utf8_decode($data['foneProdCel']);
        $emailProd          = utf8_decode($data['emailProd']);
        $espetaculo         = utf8_decode($data['espetaculo']);
        $autor              = utf8_decode($data['autor']);
        $direcao            = utf8_decode($data['direcao']);
        $cenografia         = utf8_decode($data['cenografia']);
        $iluminacao         = utf8_decode($data['iluminacao']);
        $figurino           = utf8_decode($data['figurino']);
        $maquiagem          = utf8_decode($data['maquiagem']);
        $tempoDuracao       = utf8_decode($data['tempoDuracao']);
        $tempoMontagem      = utf8_decode($data['tempoMontagem']);
        $TempoDesmonta       = utf8_decode($data['TempoDesmonta']);
        $genero             = utf8_decode($data['genero']);
        $classificacao      = utf8_decode($data['classificacao']);
        $categoria          = utf8_decode($data['categoria']);
        $possibi            = utf8_decode($data['possibi']);
        //$espacoEncena       = utf8_decode($data['espacoEncena']);
       
        $espacoEncena = '';
        if(!empty($data['espacoEncena'])) {
        	$espacoEncena = 0;
		    foreach($data['espacoEncena'] as $check) {
		            $espacoEncena += $check; 
		    }
		}


        $citarOutros        = utf8_decode($data['citarOutros']);
        $sinopseEspeta      = utf8_decode($data['sinopseEspeta']);
        $medidasPalcoBoca   = utf8_decode($data['medidasPalcoBoca']);
        $medidasPalcoBocaMin = utf8_decode($data['medidasPalcoBocaMin']);
        $profundidade       = utf8_decode($data['profundidade']);
        $profundidadeMin    = utf8_decode($data['profundidadeMin']);
        $numeroPessoas      = utf8_decode($data['numeroPessoas']);
        $siteBlog           = utf8_decode($data['siteBlog']);
        $linksVideo         = utf8_decode($data['linksVideo']);
        $idadeIJ            = utf8_decode($data['0']);
        $idadeA             = utf8_decode($data['1']);
        $tipo               = utf8_decode($data['tipo']);
        $link_historico_grupo         = $_FILES["arquivo"]["name"][0]; //utf8_decode($data['link_historico_grupo']);
        $link_curriculo_grupo         = $_FILES["arquivo"]["name"][1]; //utf8_decode($data['link_curriculo_grupo']);
        $link_curriculo_grupo_direcao  = $_FILES["arquivo"]["name"][2]; //utf8_decode($data['link_curriculo_grupo_direcao']);
        $link_fotos                   = $_FILES["arquivo"]["name"][3]; //utf8_decode($data['link_fotos']);
        $link_mapa_iluminacao         = $_FILES["arquivo"]["name"][4]; //utf8_decode($data['link_mapa_iluminacao']);
        $link_mapa_sonorizacao        = $_FILES["arquivo"]["name"][5]; //utf8_decode($data['link_mapa_sonorizacao']);


$result = $conn->query($sql);


validateEmpty($tipo, 'Mostra Oficial ou Cena Universitaria', 'tipo' );
validateEmpty($nome, 'Nome', 'nome' );
validateEmpty($cnpj, 'CNPJ', 'cnpj' );
validateEmpty($endereco, 'Endereço', 'endereco' );
validateEmpty($cidade, 'Cidade', 'cidade' );
validateEmpty($bairro, 'Bairro', 'bairro' );
validateEmpty($cep, 'CEP', 'cep' );
validateEmpty($telefone, 'Telefone', 'telefone' );
validateEmpty($email, 'Email', 'email' );
validateEmpty($responsavel, 'Responsável Legal', 'responsavel' );
validateEmpty($cpfResponsa, 'CPF do Responsável Legal', 'cpfResponsa' );
validateEmpty($produtor, 'Produtor', 'produtor' );
validateEmpty($foneProd, 'Telefone Fixo do Produtor', 'foneProd' );
validateEmpty($foneProdCel, 'Telefone Cel do Produtor', 'foneProdCel' );
validateEmpty($emailProd, 'Email do Produtor', 'emailProd' );
validateEmpty($espetaculo, 'Espetáculo', 'espetaculo' );
validateEmpty($autor, 'Autor', 'autor' );
validateEmpty($direcao, 'Direção', 'direcao' );
validateEmpty($cenografia, 'Cenografia', 'cenografia' );
validateEmpty($iluminacao, 'Iluminção', 'iluminacao' );
validateEmpty($figurino, 'Figurino', 'figurino' );
validateEmpty($maquiagem, 'Maquiagem', 'maquiagem' );
validateEmpty($tempoDuracao, 'Tempo de Duracao', 'tempoDuracao' );
validateEmpty($tempoMontagem, 'Tempo de Montagem', 'tempoMontagem' );
validateEmpty($TempoDesmonta, 'Tempo Desmonta', 'TempoDesmonta' );
validateEmpty($genero, 'Gênero', 'genero' );
validateEmpty($classificacao, 'Classificão Etária', 'classificacao' );
validateEmpty($categoria, 'Categoria', 'categoria' );
validateEmpty($possibi, 'Possibibilidade de mais Apresentações', 'possibi' );
validateEmpty($espacoEncena, 'Espaço para Encenação', 'espacoEncena' );
validateEmpty($sinopseEspeta, 'Sinopse Espetáculo', 'sinopseEspeta' );
validateEmpty($medidasPalcoBoca, 'Medida Boca de Cena', 'medidasPalcoBoca' );
validateEmpty($medidasPalcoBocaMin, 'Medida Boca de Cena Min', 'medidasPalcoBocaMin' );
validateEmpty($profundidade, 'Profundidade', 'profundidade' );
validateEmpty($profundidadeMin, '`Profundidade Min', 'profundidadeMin' );
validateEmpty($numeroPessoas, 'Número Pessoas', 'numeroPessoas' );
validateEmpty($siteBlog, 'Site/Blog/Facebook', 'siteBlog' );
validateEmpty($linksVideo, 'Links para Vídeo', 'linksVideo' );
if ($classificacao == 'IJ') {	
  validateEmpty($idadeIJ, 'idadeIJ', 'idadeIJ' );
} else {	
  validateEmpty($idadeA, 'idadeA', 'idadeA' );
}  
/*validateEmpty($link_historico_grupo, 'Histórico do Grupo', 'link_historico_grupo' );
validateEmpty($link_curriculo_grupo, 'Currículo do Grupo', 'link_curriculo_grupo' );
validateEmpty($link_curriculo_grupo_direcao, 'Currículo da Direção', 'link_curriculo_grupo_direcao' );
validateEmpty($link_fotos, 'PDF com Fotos do Espetáculo', 'link_fotos' );
validateEmpty($link_mapa_iluminacao, 'Mapa de Iluninação', 'link_mapa_iluminacao' );
validateEmpty($link_mapa_sonorizacao, 'Mapa de Sonorização', 'link_mapa_sonorizacao' );
*/



$db->beginTransaction();
//$insertQuery = $db->prepare("INSERT INTO `IsnardAzevedo`.`dadosCadastro` 
$insertQuery = "INSERT INTO `IsnardAzevedo`.`dadosCadastro` 
							 (  `nome`,
							    `endereco`,
								`cidade`,
								`bairro`,
								`cep`,
								`cnpj`,
								`telefone`,
								`email`,
								`responsavel`,
								`cpfResponsa`,
								`produtor`,
								`foneProd`,
								`foneProdCel`,
								`emailProd`,
								`espetaculo`,
								`autor`,
								`direcao`,
								`cenografia`,								
								`iluminacao`,
								`figurino`,
								`maquiagem`,
								`tempoDuracao`,
								`tempoMontagem`,
								`TempoDesmonta`,
								`genero`,
								`classificacao`,
								`categoria`,
								`possibi`,
								`espacoEncena`,
								`citarOutros`,
								`sinopseEspeta`,
								`medidasPalcoBoca`,
								`medidasPalcoBocaMin`,
								`profundidade`,
								`profundidadeMin`,
								`numeroPessoas`,
								`siteBlog`,
								`linksVideo`,
								`idadeIJ`,
								`idadeA`,
								`link_historico_grupo`,
								`link_curriculo_grupo`,
								`link_curriculo_direcao`,
								`link_fotos`,
								`link_mapa_iluminacao`,
								`link_mapa_sonorizacao`,
								`tipo`
								)
							 VALUES 
							 	('$nome',
							 	 '$endereco',
							 	 '$cidade',
							 	 '$bairro',
							 	 '$cep', 
							 	 '$cnpj',
							 	 '$telefone', 
							 	 '$email', 
							 	 '$responsavel', 
							 	 '$cpfResponsa', 
							 	 '$produtor', 
							 	 '$foneProd', 
							 	 '$foneProdCel', 
							 	 '$emailProd',
							 	 '$espetaculo',
							 	 '$autor', 
							 	 '$direcao', 
							 	 '$cenografia', 
							 	 '$iluminacao', 
							 	 '$figurino', 
							 	 '$maquiagem', 
							 	 '$tempoDuracao', 
							 	 '$tempoMontagem', 
							 	 '$TempoDesmonta', 
							 	 '$genero', 
							 	 '$classificacao', 
							 	 '$categoria', 
							 	 '$possibi', 
							 	 '$espacoEncena', 
							 	 '$citarOutros',  
							 	 '$sinopseEspeta', 
							 	 '$medidasPalcoBoca', 
							 	 '$medidasPalcoBocaMin', 
							 	 '$profundidade', 
							 	 '$profundidadeMin', 
							 	 '$numeroPessoas', 
							 	 '$siteBlog', 
							 	 '$linksVideo', 
							 	 '$idadeIJ',
							 	 '$idadeA',
							 	 '$link_historico_grupo',
								 '$link_curriculo_grupo',
								 '$link_curriculo_grupo_direcao',
								 '$link_fotos',
								 '$link_mapa_iluminacao',
								 '$link_mapa_sonorizacao',
								 '$tipo'				 
								 )";
							//);


//$execute = $insertQuery->execute();

$execute = $db->exec($insertQuery);
$id1 = $db->lastInsertId();

$nome_arquivo[0] = 'Histórico do Grupo';
$nome_arquivo[1] = 'Currículo do Grupo';
$nome_arquivo[2] = 'Currículo da Direção';
$nome_arquivo[3] = 'PDF com fotos do Espetáculo';
$nome_arquivo[4] = 'Mapa de Iluminação';
$nome_arquivo[5] = 'Mapa de Sonorização';

for ($i = 0; $i < $numeroCampos; $i++) {
    
    // Informações do arquivo enviado
    $nomeArquivo = $_FILES["arquivo"]["name"][$i];
    $tamanhoArquivo = $_FILES["arquivo"]["size"][$i];
    $nomeTemporario = $_FILES["arquivo"]["tmp_name"][$i];
    
    // Verifica se o arquivo foi colocado no campo
      $erro = false;

      if (empty($nomeArquivo)) {
        $erro = "O arquivo ".$nome_arquivo[$i]." deve ser preenchido";        
      }	            
      // Verifica se o tamanho do arquivo é maior que o permitido
      elseif ($tamanhoArquivo > $tamanhoMaximo) {
        $erro = "O arquivo " . $nomeArquivo . " não deve ultrapassar " . $tamanhoMaximo. " bytes";        
      } 
      // Verifica se a extensão está entre as aceitas
      elseif (!in_array(strrchr($nomeArquivo, "."), $extensoes)) {
        $erro = "A extensão do arquivo " . $nomeArquivo . " não é válida";
      } 
      // Verifica se o arquivo existe e se é para substituir
      elseif (file_exists($caminho . $nomeArquivo) and !$substituir) {
        $erro = "O arquivo " . $nomeArquivo . " já existe";
      }
    
      // Se não houver erro
      if (!$erro) {
        // Move o arquivo para o caminho definido
        // move_uploaded_file($nomeTemporario, ($caminho . $id . "_" . $nomeArquivo));
        //move_uploaded_file($nomeTemporario, ( $caminho . $id1 . "_" . $nomeArquivo) );
        // Mensagem de sucesso
        //echo $caminho . $id . "_" . $nomeArquivo." <br />";
      } 
      // Se houver erro
      else {
        // Mensagem de erro
        $db->rollBack();
        echo json_encode(array('success' => 0, 'error' => $erro, 'fieldProblem' => 'teste'));
        die;
      }
    
  }

for ($i = 0; $i < $numeroCampos; $i++) {
	$nomeArquivo = $_FILES["arquivo"]["name"][$i];
    $tamanhoArquivo = $_FILES["arquivo"]["size"][$i];
    $nomeTemporario = $_FILES["arquivo"]["tmp_name"][$i];

	move_uploaded_file($nomeTemporario, ( $caminho . $id1 . "_" . $nomeArquivo) );
}  

if($execute){
	//session_start();
	//$_SESSION['id'] = $db->lastInsertId();
	$db->commit();
	echo json_encode(array('sucesso' => 1, 'id' => $id1));
}else{
	echo json_encode(array('sucesso' => 0, 'erro' => 'Falha ao enviar', 'classe' => 'geral'));
}

}else{
	echo json_encode(array('sucesso' => 0, 'erro' => 'Número máximo de inscrições atingido.', 'classe' => 'geral'));
} 



?>