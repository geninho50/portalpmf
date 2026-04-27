<?php

@header("Cache-Control: no-cache, must-revalidate");
@header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
  
include_once("../../banco/gdb.php"); 
include_once("../../Biblioteca/email/enviarEmailPROCON.php"); 

$gdb 			= new gdb();  

$cpf1           = $gdb->vargetpost('cpf1');
$cpf2           = $gdb->vargetpost('cpf2');
$cpf3           = $gdb->vargetpost('cpf3');
$cpf4           = $gdb->vargetpost('cpf4');
$cpf5           = $gdb->vargetpost('cpf5');
$cpf6           = $gdb->vargetpost('cpf6');
$assunto        = $gdb->vargetpost('assunto');
$pedido         = $gdb->vargetpost('pedido');
$relato         = $gdb->vargetpost('relato');
$codigoprojeto  = 'PROCON';
$fileDocumento1 = $gdb->vargetpost('fileDocumento1');
$fileDocumento2	= $gdb->vargetpost('fileDocumento2');
$fileDocumento3 = $gdb->vargetpost('fileDocumento3');
$codigoPessoa   = $gdb->vargetpost('codigoPessoa');
$uploaddir      = '/home/www/arquivos/procon/reclamacoes/';
$tamanho1       = 0;
$tamanho2       = 0;
$tamanho3       = 0;
$extensao1 		= "jpg";
$extensao2 		= "";
$extensao3 		= "";

/*
  print "<pre>";
  print_r( $_GET );
  print_r( $_POST );
  print_r( $_FILES );
  print "</pre>";
*/

$gdb->open("select ( ifnull(max( codigoReclamacao ),0) + 1 ) as codigo from proconReclamacao");

$codigoReclamacao = str_pad($gdb->gs['CODIGO'][0], 6, "0", STR_PAD_LEFT);

    $enviado  = 0;
	
	// Definindo o tamanho do arquivo
	if ( $_FILES['fileDocumento1']['size'] == 0 && 
		 $_FILES['fileDocumento2']['size'] == 0 && 
		 $_FILES['fileDocumento3']['size'] == 0 ){
	    $tamanho1 = 500000; 
	}else{
		$tamanho1  = $_FILES['fileDocumento1']['size'];
		$tamanho2  = $_FILES['fileDocumento2']['size'];
		$tamanho3  = $_FILES['fileDocumento3']['size'];
	}
	

	// Definindo o tipo de extensão do Arquivo	
	
	if( strpos(strtolower($_FILES['fileDocumento1']['type'] ),'pdf' ) !== false ) $extensao1 = 'pdf';
	else if( strpos(strtolower($_FILES['fileDocumento1']['type']),'jpg' ) !== false) $extensao1 = 'jpg';
	else if( strpos(strtolower($_FILES['fileDocumento1']['type']),'png' ) !== false) $extensao1 = 'png';
	else if( strpos(strtolower($_FILES['fileDocumento1']['type']),'png' ) !== false) $extensao1 = 'jpeg';
	
	if( basename($_FILES['fileDocumento2']['name']) !=""   ){
		$extensao2 = "";
	    if( strpos(strtolower($_FILES['fileDocumento2']['type'] ),'pdf' ) != false ) $extensao2 = 'pdf';
		else if( strpos(strtolower($_FILES['fileDocumento2']['type']),'jpg' ) != false) $extensao2 = 'jpg';
		else if( strpos(strtolower($_FILES['fileDocumento2']['type']),'png' ) !== false) $extensao2 = 'png';
		else if( strpos(strtolower($_FILES['fileDocumento2']['type']),'jpeg' ) !== false) $extensao2 = 'jpeg';
	}
	
	if( basename($_FILES['fileDocumento3']['name']) !=""  ){
		$extensao3 = "";
	    if( strpos(strtolower($_FILES['fileDocumento3']['type'] ),'pdf' ) != false ) $extensao3 = 'pdf';
		else if( strpos(strtolower($_FILES['fileDocumento3']['type']),'jpg' ) != false) $extensao3 = 'jpg';
		else if( strpos(strtolower($_FILES['fileDocumento3']['type']),'png' ) !== false) $extensao3 = 'png';
		else if( strpos(strtolower($_FILES['fileDocumento3']['type']),'jpeg' ) !== false) $extensao3 = 'jpeg';
	}
	
    
    // Verificando se o diretorio existe	
	$diretorio = true;
	if( !file_exists( $uploaddir )){  
	    $diretorio = false;  
	}
	
	/*
	if( $extensao1 == '' ){
		$operacao = array( "success"=>"2","mensagem"=>"Essa extensão de arquivo não é permitida!" );	
	}else
	*/
	 if( !$diretorio ){
		      $operacao = array( "success"=>"2","mensagem"=>"O diretório não existe !" );
	}elseif( $tamanho1>400000 || $tamanho2>400000 || $tamanho3>400000 ){
		      $operacao = array( "success"=>"2","mensagem"=>"O tamanho do arquivo é maior que o permitido !" );
	}else{	
	
	
		// Fazendo o upload do arquvio 
		$uploadfile = $uploaddir ."R".$codigoReclamacao."Arquivo1.".$extensao1;
		$erro = move_uploaded_file($_FILES['fileDocumento1']['tmp_name'], $uploadfile);
		
		if ( $erro ){
			$enviado = 1;
			$fileDocumento1 = $uploadfile;
		}
		$errors_file = $_FILES['fileDocumento1']['error'];
		
		if( basename($_FILES['fileDocumento2']['name']) !="" && $extensao2 !="" ){
		    $uploadfile1 = $uploaddir ."R".$codigoReclamacao."Arquivo2.".$extensao2;
		    $erro = move_uploaded_file($_FILES['fileDocumento2']['tmp_name'], $uploadfile1);
			if ($erro) {
				$enviado = 1;
				$fileDocumento2 = $uploadfile1;
			} else {
				$enviado = 0;
			}	
		}
		
		if( basename($_FILES['fileDocumento3']['name']) !="" && $extensao3 !="" ){
		    $uploadfile2 = $uploaddir ."R".$codigoReclamacao."Arquivo3.".$extensao3;
		    $erro = move_uploaded_file($_FILES['fileDocumento3']['tmp_name'], $uploadfile2);
			if ($erro) {
				$enviado = 1;
				$fileDocumento3 = $uploadfile2;
			} else {
				$enviado = 0;
			}	
		}		
	    
		if( $enviado ){
			$gdb->open("INSERT INTO proconReclamacao ( codigoPessoa, 									 
													   assunto, 
													   relato, 
													   pedido, 
													   fileDocumento1, 
													   fileDocumento2,
													   fileDocumento3 )
											  VALUES ( '$codigoPessoa' , 									 
													   '$assunto', 
													   '$relato', 
													   '$pedido', 
													   '$uploadfile', 
													   '$uploadfile1',
													   '$uploadfile2' )");
			for ($i = 1; $i <= 6; $i++) {
				$cpf = $gdb->vargetpost("cpf$i");
				
				if( $cpf !="" ){
					$codigo = $gdb->buscarCodigoPessoa($cpf, "PROCON" );
					if( $codigo == "" ){
					    
						// Retirando os ponto e traço do cep
						$cep 			= str_replace('.','', $gdb->vargetpost('cep'.$i) );
						$cep 			= str_replace('-','', $cep );
						
						$nome           = $gdb->vargetpost('nome'.$i);
						$celular        = $gdb->vargetpost('celular'.$i);
						$telefone       = $gdb->vargetpost('telefone'.$i);
						$logradouro     = $gdb->vargetpost('logradouro'.$i);
						$bairro         = $gdb->vargetpost('bairro'.$i);
						$municipio      = $gdb->vargetpost('municipio'.$i);
						$numero         = $gdb->vargetpost('numero'.$i);
						$email          = $gdb->vargetpost('email'.$i);
						$estado         = $gdb->vargetpost('estado'.$i);
						$complemento	= $gdb->vargetpost('complemento'.$i);
						$codigo = inserirFornecedor( $cpf, $nome, $celular, $telefone, $cep, $logradouro, $bairro, $municipio, $numero, $email, $estado, $complemento, $gdb  );
					}	
					$gdb->open("INSERT INTO proconReclamacaoFornecedor(codigoReclamacao,codigoPessoa)VALUES('$codigoReclamacao','$codigo') ");				  
				}
			}
			enviarReclamacao( $codigoReclamacao, $gdb );
			$operacao = array( "success"=>"1","mensagem"=>"Cadastro realizado com SUCESSO!","codigoReclamacao"=>"$codigoReclamacao" );
	 	}else{
			$operacao = array( "success"=>"2","mensagem"=>"Erro no download do arquivo ! erro : $errors_file ( Reduza o tamanho do arquivo e tente novamente ! ) " );
		}
	}
				 
	$retorno = json_encode( $operacao );
	echo $retorno;		

function enviarReclamacao($codigo, $db ){
	
	$db->open("SELECT r.*, p.*, pe.*, px.fileDocumento, px.fileProcurador , DATE_FORMAT(r.lancamento,'%d/%m/%Y') AS data  
				  FROM proconReclamacao r
				  
				  JOIN pessoa p
					ON p.codigoPessoa = r.codigoPessoa
					
				  JOIN pessoaEndereco pe
					ON pe.codigoPessoa = p.codigoPessoa
					
				JOIN pessoaAuxiliar px
					ON px.codigoPessoa = p.codigoPessoa
					
				 WHERE r.codigoReclamacao  = '$codigo' ");
	
	$txtNome 		   = "Sistema DGOV";
	$txtAssunto 	   = 'Reclamação n. '.str_pad($codigo, 6, "0", STR_PAD_LEFT);
    $pedido   		   = $db->gs['PEDIDO'][0];
	$relato   		   = $db->gs['RELATO'][0];
	$assunto  		   = $db->gs['ASSUNTO'][0];
	
	$arquivo1 		   = str_replace("/home/www/", "http://www.pmf.sc.gov.br/", $db->gs['FILEDOCUMENTO1'][0]);
	$arquivo2 		   = str_replace("/home/www/", "http://www.pmf.sc.gov.br/", $db->gs['FILEDOCUMENTO2'][0]);
	$arquivo3		   = str_replace("/home/www/", "http://www.pmf.sc.gov.br/", $db->gs['FILEDOCUMENTO3'][0]);
	
	$arquivoPessoa 	   = str_replace("/home/www/", "http://www.pmf.sc.gov.br/", $db->gs['FILEDOCUMENTO'][0]);
	$arquivoProcurador = str_replace("/home/www/", "http://www.pmf.sc.gov.br/", $db->gs['FILEPROCURADOR'][0]);
	
	$corpoMensagem	.= "<b>DADOS DO CONSUMIDOR</b><br><br>";
	if( $db->gs['CPF'][0] !="" )$documento = 'CPF';
	else $documento = "CNPJ"; 
	$corpoMensagem	.= "Documento :  ".$db->gs[$documento][0]."<br>";
    $corpoMensagem	.= "Nome .....:  ".$db->gs['NOME'][0]."<br>";
	$corpoMensagem	.= "Endereço .:  ".$db->gs['LOGRADOURO'][0]." ".$db->gs['NUMERO'][0]." ".$db->gs['COMPLEMENTO'][0]."<br>";
	$corpoMensagem	.= "Bairro ...:  ".$db->gs['BAIRRO'][0]."<br>";      
	$corpoMensagem	.= "Municipio.:  ".$db->gs['MUNICIPIO'][0]."<br>";
    $corpoMensagem	.= "Estado....:  ".$db->gs['ESTADO'][0]."<br>";     
	$corpoMensagem	.= "CEP.......:  ".$db->gs['CEP'][0]."<br>";
	$corpoMensagem	.= "Celular ..:  ".$db->gs['CELULAR'][0]."<br>";     
	$corpoMensagem	.= "Telefone .:  ".$db->gs['TELEFONE'][0]."<br>";	 
	$corpoMensagem	.= "Email ....:  ".$db->gs['EMAIL'][0]."<br>";
	
	if( $arquivoPessoa !="" ){
		$corpoMensagem	.= "<a href = '$arquivoPessoa' >Arquivo com dados Pessoais</a><br>";
	}

	if( $arquivoProcurador !="" ){
		$corpoMensagem	.= "<a href = '$arquivoProcurador' >Arquivo com a Procuração</a><br>";
	}	


    $db->open(" SELECT * 
				  FROM proconReclamacaoFornecedor r 
				  JOIN pessoa p 
				    ON p.codigoPessoa = r.codigoPessoa 
			LEFT  JOIN pessoaEndereco pe 
				    ON pe.codigoPessoa = p.codigoPessoa 
				 WHERE r.codigoReclamacao  = '$codigo'  ");	 

	if($db->linhas>0){ 	
         $corpoMensagem	.= "<br><br><b>DADOS DO(S) FORNECEDOR(ES)</b><br><br>";
			 
		foreach($db->gs['CODIGORECLAMACAO'] as $key => $value ){
			 
		
			 if( $db->gs['CPF'][$key] !="" )$documento = 'CPF';
			 else $documento = "CNPJ";
			 
			 $corpoMensagem	.= "Documento .:  ".$db->gs[$documento][$key]."<br>";
			 $corpoMensagem	.= "Nome ..... :  ".$db->gs['NOME'][$key]."<br>";
			 $corpoMensagem	.= "Endereço ..:  ".$db->gs['LOGRADOURO'][$key]." ".$db->gs['NUMERO'][$key]." ".$db->gs['COMPLEMENTO'][$key]."<br>";
			 $corpoMensagem	.= "Bairro ....:  ".$db->gs['BAIRRO'][$key] ."<br>";
			 $corpoMensagem	.= "Municipio  :  ".$db->gs['MUNICIPIO'][$key]."<br>";
			 $corpoMensagem	.= "Estado.... :  ".$db->gs['ESTADO'][$key]."<br>";
			 $corpoMensagem	.= "CEP........:  ".$db->gs['CEP'][$key]."<br>";
			 $corpoMensagem	.= "Celular ...:  ".$db->gs['CELULAR'][$key]."<br>";
			 $corpoMensagem	.= "Telefone ..:  ".$db->gs['TELEFONE'][$key]."<br>";
			 $corpoMensagem	.= "Email .....:  ".$db->gs['EMAIL'][$key]."<br><br>";
		}		
	}
	
	$corpoMensagem	.= "<b>ASSUNTO :</b><br>  ".$assunto."<br><br> "; 
	$corpoMensagem	.= "<b>RELATO :</b><br>  ".$relato."<br><br> "; 
	$corpoMensagem	.= "<b>PEDIDO :</b><br>  ".$pedido."<br><br>";
	$corpoMensagem	.= "<b>ARQUIVOS COM DADOS DA RECLAMAÇÃO :</b><br> <br> ";
	
	if( $arquivo1 !="" ){
		$corpoMensagem	.= "<a href = '$arquivo1' >Arquivo 1</a><br>";
	}	
	
	if( $arquivo2 !="" ){
		$corpoMensagem	.= "<a href = '$arquivo2' >Arquivo 2</a><br>";
	}	
	
	if( $arquivo3 !="" ){
		$corpoMensagem	.= "<a href = '$arquivo3' >Arquivo 3</a><br>";
	}	

	/* 
	   Passagem dos parametros: email do Destinatário, 
	                            email do remetende, 
								nome do remetente, 
								assunto, 
								mensagem do email.
	*/
	// procon.online@@pmf.sc.gov.br
	$error = smtpmailer('procon.online@pmf.sc.gov.br', 
						'sistema.procon@pmf.sc.gov.br', 
						iconv('utf-8','iso-8859-1//TRANSLIT',$txtNome ), 
						iconv('utf-8','iso-8859-1//TRANSLIT',$txtAssunto), 
						iconv('utf-8','iso-8859-1//TRANSLIT',$corpoMensagem) );
}

function inserirFornecedor( $cpf, $nome, $celular, $telefone, $cep, $logradouro, $bairro, $municipio, $numero, $email, $estado, $complemento, $gdb  ){
	
	$codigoprojeto  = 'PROCON';
	
	if( strlen( $cpf ) == 11 ){
		$campoDocumento = 'cpf';
	}else{
		$campoDocumento = 'cnpj';
	}
	
	$gdb->open("INSERT INTO pessoa ( nome, 									 
									 $campoDocumento,
									 celular, 
									 telefone, 
									 email )
							VALUES ( '$nome',									  
									 '$cpf', 
									 '$celular',
									 '$telefone',
									 '$email' )");
									 
	$gdb->open("select max(codigopessoa) as codigo from pessoa ");
	
	$codigo = $gdb->gs['CODIGO'][0];

	$gdb->open("INSERT INTO pessoaAuxiliar ( codigopessoa,
											 codigoprojeto,
											 situacaoPROCON	)										 
							VALUES ( $codigo,
									'$codigoprojeto',
									'F' ) " );

	$gdb->open("INSERT INTO pessoaEndereco (  codigopessoa,
											  cep, 
											  logradouro, 
											  bairro, 
											  municipio, 
											  numero, 	
											  complemento,												  
											  estado,
											  pais,
											  codigoprojeto )
									VALUES (  $codigo,
											 '$cep',
											 '$logradouro', 
											 '$bairro',
											 '$municipio',
											 '$numero',
											 '$complemento',
											 '$estado',
											 'BRASIL',
											 '$codigoprojeto')");	
	return $codigo;										 
}	

?>