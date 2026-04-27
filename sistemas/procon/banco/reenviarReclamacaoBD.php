<?php

@header("Cache-Control: no-cache, must-revalidate");
@header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
  
include_once("../../banco/gdb.php"); 
include_once("../../Biblioteca/email/enviarEmailPROCON.php"); 

$gdb 		  	  = new gdb();  

$codigoReclamacao = $gdb->vargetpost('codigoReclamacao');

$envio = enviarReclamacao( $codigoReclamacao, $gdb );

if( $envio ){
	$operacao = array( "success"=>"1","mensagem"=>"Reenvio realizado com SUCESSO!","codigoReclamacao"=>"$codigoReclamacao" );
}else{
	$operacao = array( "success"=>"1","mensagem"=>"Problema no reenvio da Reclamação n. $codigoReclamacao, Tente novamente!","codigoReclamacao"=>"$codigoReclamacao" );
}

$retorno = json_encode( $operacao );
echo $retorno;		
	

function enviarReclamacao( $codigo, $db ){
	
	$db->open("SELECT r.*, p.*, pe.*, px.fileDocumento, px.fileProcurador , DATE_FORMAT(r.lancamento,'%d/%m/%Y') AS data  
				  FROM proconReclamacao r
				  
				  JOIN pessoa p
					ON p.codigoPessoa = r.codigoPessoa
					
				  JOIN pessoaEndereco pe
					ON pe.codigoPessoa = p.codigoPessoa
					
				JOIN pessoaAuxiliar px
					ON px.codigoPessoa = p.codigoPessoa
					
				 WHERE r.codigoReclamacao  = '$codigo' ");
	$ok = false;			 

    if( $db->linhas>0 ){
	
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
			$ok = true;					
	}				 						
} ?>