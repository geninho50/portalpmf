<?php
@header("Cache-Control: no-cache, must-revalidate");
@header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

include_once("/home/www/sistemas/banco/gdb.php"); 

$gdb = new gdb();  

$nome           = $gdb->vargetpost('nome');
$rg             = $gdb->vargetpost('rg');
$cpf            = $gdb->vargetpost('cpf');
$celular        = $gdb->vargetpost('celular');
$telefone       = $gdb->vargetpost('telefone');
$cep            = $gdb->vargetpost('cep');
$logradouro     = $gdb->vargetpost('logradouro');
$bairro         = $gdb->vargetpost('bairro');
$municipio      = $gdb->vargetpost('municipio');
$numero         = $gdb->vargetpost('numero');
$email          = $gdb->vargetpost('email');
$estado         = $gdb->vargetpost('estado');
$profissao      = $gdb->vargetpost('profissao');
$codigoprojeto  = 'CULTIVA';
// $senha		    = $gdb->vargetpost('senha');
$temEmail       = 0;
$temCPF         = 0;
// $uploaddir      = '/home/www/arquivos/procon/usuarios/';

/*
  print "<pre>";
  print_r( $_GET );
  print_r( $_POST );
  print_r( $_FILES );
  print "</pre>";
*/

$gdb->open("select * from pessoa p , pessoaAuxiliar pa  where p.codigopessoa = pa.codigopessoa and cpf = '$cpf' and codigoprojeto = '$codigoprojeto' and pa.situacaoCULTIVA='H'  ");

if( $gdb->linhas > 0 ){
	$temCPF = 1;
}
	
$gdb->open("select * from pessoa p , pessoaAuxiliar pa  where p.codigopessoa = pa.codigopessoa and email = '$email' and codigoprojeto = '$codigoprojeto' and pa.situacaoCULTIVA='H' ");

if( $gdb->linhas > 0 ){
	$temEmail = 1;
}

if( !$temCPF && !$temEmail ){
	
    $enviado  = 0;
	
	/* Definindo o tamanho do arquivo
	if ( $_FILES['fileDocumento']['size'] == 0 ){
	    $tamanho = 500000; 
	}else{
		$tamanho  = $_FILES['fileDocumento']['size'];
	}
	$tamanho2 = $_FILES['fileProcurador']['size'];
	*/

	/* Definindo o tipo de extensão do Arquivo
	$extensao = "";
	if( strpos(strtolower($_FILES['fileDocumento']['type'] ),'pdf' ) != false ) $extensao = 'pdf';
	else if( strpos(strtolower($_FILES['fileDocumento']['type']),'jpg' ) != false ) $extensao = 'jpg';
	
	if( basename($_FILES['fileProcurador']['name']) !=""  ){
		$extensao2 = "";
		
		$tipo = strtolower( $_FILES['fileProcurador']['type'] );
		
	    if( strpos(strtolower($_FILES['fileProcurador']['type'] ),'pdf' ) != false ) $extensao2 = 'pdf';
		else if( strpos(strtolower($_FILES['fileProcurador']['type']),'jpg' ) != false ) $extensao2 = 'jpg';
	}
	*/
	
    // Retirando os ponto e traço do CPF	
	$cpf = str_replace('.','',$cpf);
	$cpf = str_replace('-','',$cpf);
	
	// Retirando os ponto e traço do cep
	$cep = str_replace('.','',$cep);
	$cep = str_replace('-','',$cep);
    
    /* Verificando se o diretorio existe	
	$diretorio = true;
	if( !file_exists( $uploaddir )){  
	    $diretorio = false;  
	}else{
     	// Definindo o nome e local que vai ser salvo o arquivo
	    $uploadfile = $uploaddir ."U$cpf.$extensao";
		
	}
	*/
	
	/* Fazendo o upload do arquvio 
	if( $extensao !="" ){
		
		$erro = move_uploaded_file($_FILES['fileDocumento']['tmp_name'], $uploadfile);
		if ( $erro ){
			$enviado = 1;
			$fileDocumento = $uploadfile;
		}
		
		if( basename($_FILES['fileProcurador']['name']) !="" ){
			if( $enviado ){
				$uploadfile = $uploaddir ."P$cpf.$extensao2";
				if (move_uploaded_file($_FILES['fileProcurador']['tmp_name'], $uploadfile)) {
					$enviado = 1;
					$fileProcurador = $uploadfile;
				} else {
					$enviado = 0;
				}	
			}		
		}
	}
	
	if( $tamanho>400000 || $tamanho2>400000 ){
		      $operacao = array( "success"=>"2","mensagem"=>"O tamanho do arquivo é maior que o permitido !" );
	}else if( $extensao == '' ){
			  $operacao = array( "success"=>"2","mensagem"=>"Essa extensão de arquivo não é permitida!" );	
	}else if( !$diretorio ){
		      $operacao = array( "success"=>"2","mensagem"=>"O diretório não existe !" );
	}else if( !$enviado ){
		 $operacao = array( "success"=>"2","mensagem"=>"Problema com o arquivo, verifique se ele tem o tamanho igual ou menor que 400KB Ou se a extensão dele é JPG ou PDF !");
		  $operacao = array( "success"=>"2","mensagem"=>"Problema com o arquivo!  Erro : $erro / via post : $viaPost / Enviado : $enviado /
							Diretorio :$diretorio  / Arquivo :  $uploadfile / Resultado : $erro / Tamanho   : $tamanho / Extensão : $extensao2 ");
							
	}else{
		*/	
	if( $temEmail == 0 && $temCPF == 0 ){	
		$gdb->open("INSERT INTO pessoa ( nome, 									 
										 cpf, 
										 senha, 
										 celular, 
										 telefone, 
										 identidade,
										 email )
								VALUES ( '$nome',									  
										 '$cpf', 
										 '$senha',
										 '$celular',
										 '$telefone',
										 '$rg',
										 '$email' )");
										 
		$gdb->open("select max(codigopessoa) as codigo from pessoa ");
		$codigo = $gdb->gs['CODIGO'][0];

		$gdb->open("INSERT INTO pessoaAuxiliar ( codigopessoa,
												 codigoprojeto,
												 profissao,
												 situacaoCULTIVA)										 
								VALUES ( $codigo,
										'$codigoprojeto',
										'$profissao',
										'H' ) " );

		$gdb->open("INSERT INTO pessoaEndereco (  codigopessoa,
												  cep, 
												  logradouro, 
												  bairro, 
												  municipio, 
												  numero, 			
												  estado,
												  pais,
												  codigoprojeto )
										VALUES (  $codigo,
												 '$cep',
												 '$logradouro', 
												 '$bairro',
												 '$municipio',
												 '$numero',
												 '$estado',
												 'BRASIL',
												 '$codigoprojeto')");
		
		$operacao = array( "success"=>"1","mensagem"=>"Cadastro realizado com SUCESSO!" );
	 	
	}
				 
}else{

	if( $temCPF ){
		$operacao = array( "success"=>"2","mensagem"=>"Já tem um cadastro com esse CPF !" );
	}
	
	if( $temEmail ){
		$operacao = array( "success"=>"2","mensagem"=>"Já tem um cadastro com esse email !" );
	}

}
	$retorno = json_encode( $operacao );
	echo $retorno;							
?>