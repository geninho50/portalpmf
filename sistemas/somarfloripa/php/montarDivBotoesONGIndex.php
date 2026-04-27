<?php
  @header("Cache-Control: no-cache, must-revalidate");
  @header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
  
include_once("../../banco/gdb.php"); 

$gdb = new gdb();  

// $codigoPessoa = $gdb->vargetpost('codigoPessoa');

$gdb->open("  select p.codigoPessoa as codigo, 
					upper( nome ) as nome, 
					cnpj, 
					e.*,
					a.* 
				from pessoa p, 
					 pessoaAuxiliar a, 
					 pessoaEndereco e 
			   where a.codigoPessoa = p.codigoPessoa 
				 and e.codigoPessoa = p.codigoPessoa 
				 and a.situacaoSOMAR = 'O'
			limit 15,12 ");

if( $gdb->linhas > 0 ){
	$x = 0;
    $dados = "<div class='row'>";
	
	foreach( $gdb->gs['NOME'] as $key=>$value ){
		$id = $gdb->gs['CODIGO'][$key];
		if( $x == 4 ){
			$dados .= " </div>
						<div class='row'>
						<button class='col' id='btnONG' data-toggle='modal' data-target='#idOng$id' >$value</button>";
			$x = 0;
		}else{
			$dados .= "<button class='col' id='btnONG' data-toggle='modal' data-target='#idOng$id' >$value</button>";
		}
		$x++;
	}

	$dados .= " </div>";
	
	foreach( $gdb->gs['NOME'] as $key=>$value ){
		
		$id     	  = $gdb->gs['CODIGO'][$key];
		$logo   	  = $gdb->gs['FILEDOCUMENTO'][$key];
		$nome   	  = $gdb->gs['NOME'][$key];
		$outros 	  = $gdb->gs['OUTROS'][$key];
		
		$localizacao  = $gdb->gs['LOGRADOURO'][$key].' '.$gdb->gs['NUMERO'][$key].' '.$gdb->gs['COMPLEMENTO'][$key].' - '.$gdb->gs['BAIRRO'][$key];
		$localizacao .= ' - '.$gdb->gs['MUNICIPIO'][$key].' - '.$gdb->gs['CEP'][$key].' - '.$gdb->gs['ESTADO'][$key].', '.$gdb->gs['PAIS'][$key];
			 
		$dados .= " <div class='modal fade' id='idOng$id' tabindex='-1' role='dialog' aria-hidden='true'> 
		<div class='modal-dialog' role='document'>
			<div class='modal-content'>
				<div class='modal-header'>
					<div class='row'>
						<center><h5 class='modal-title' id='tituloModal'></h5></center>
						<center><img width='1500px' height='100px' src='$logo' display='block' class='img-fluid' id='logoModal'></center>
						<center><h5 class='modal-title' id='tituloModal'>Sobre ONG</h5></center>
					</div>
					
					<button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
					<span aria-hidden='true'>&times;</span>
					</button>
				</div>
				<div class='modal-body'>
					<h5 id='h5MODAL'>$nome</h5>
					<h6 id='h6MODAL'>$outros</h6>
					<h5 id='h5MODAL'>Localização:</h5>
					<h6 id='h6MODAL'>$localizacao</h6>
					<h5 id='h5MODAL'>Contato:</h5><br>";

					if( $gdb->gs['EMAIL2'][$key] !="" || $gdb->gs['TELEFONE2'][$key] !="" || $gdb->gs['WHATZAP'][$key] !="" ){
						$dados .= "<div class='row'>";

						if( $gdb->gs['EMAIL2'][$key] !="" ){
							$dados .= "<div class='col'>";
							$dados .= "<h5 id='h5MODAL'>E-mail</h5>";
							$dados .= "<h6 id='h6MODAL'>".$gdb->gs['EMAIL2'][$key];
							$dados .= "</div>";
						}	

						if( $gdb->gs['TELEFONE2'][$key] !="" ){
							$dados .= "<div class='col'>";
							$dados .= "<h5 id='h5MODAL'>Telefone</h5>";
							$dados .= "<h6 id='h6MODAL'>".$gdb->gs['TELEFONE2'][$key];
							$dados .= "</div>";
						}

						if( $gdb->gs['WHATZAP'][$key] !="" ){
							$dados .= "<div class='col'>";
							$dados .= "<h5 id='h5MODAL'>whatsapp</h5>";
							$dados .= "<h6 id='h6MODAL'>".$gdb->gs['WHATZAP'][$key];
							$dados .= "</div>";
						}

						$dados .= "</div>";
					}
					
					if ( $gdb->gs['I_SEGUNDA'][$key] !="" || $gdb->gs['I_TERCA'][$key] !="" || $gdb->gs['I_QUARTA'][$key] !="" || $gdb->gs['I_QUINTA'][$key] !=""|| $gdb->gs['I_SEXTA'][$key] !="" ){
						 
						$dados .= " <h5 id='h5MODAL'>Horário de atendimento:</h5><br><div class='row'>";
							    
						if( $gdb->gs['I_SEGUNDA'][$key] !="" && $gdb->gs['F_SEGUNDA'][$key] !="" ){
							$dados .= "<div class='col'>";
							$dados .= "<h5 id='h5MODAL'>Segunda</h5>";
							$dados .= "<h6 id='h6MODAL'>".$gdb->gs['I_SEGUNDA'][$key]." às ".$gdb->gs['F_SEGUNDA'][$key]."</h6>";
							$dados .= "</div>";
						}	

						if( $gdb->gs['I_TERCA'][$key] !="" && $gdb->gs['F_TERCA'][$key] !="" ){
							$dados .= "<div class='col'>";
							$dados .= "<h5 id='h5MODAL'>Terça</h5>";
							$dados .= "<h6 id='h6MODAL'>".$gdb->gs['I_TERCA'][$key]." às ".$gdb->gs['F_TERCA'][$key]."</h6>";
							$dados .= "</div>";
						}
						
						if( $gdb->gs['I_QUARTA'][$key] !="" && $gdb->gs['F_QUARTA'][$key] !="" ){
							$dados .= "<div class='col'>";
							$dados .= "<h5 id='h5MODAL'>Quarta</h5>";
							$dados .= "<h6 id='h6MODAL'>".$gdb->gs['I_QUARTA'][$key]." às ".$gdb->gs['F_QUARTA'][$key]."</h6>";
							$dados .= "</div>";
						}
						
						if( $gdb->gs['I_QUINTA'][$key] !="" && $gdb->gs['F_QUINTA'][$key] !="" ){
							$dados .= "<div class='col'>";
							$dados .= "<h5 id='h5MODAL'>Quinta</h5>";
							$dados .= "<h6 id='h6MODAL'>".$gdb->gs['I_QUINTA'][$key]." às ".$gdb->gs['F_QUINTA'][$key]."</h6>";
							$dados .= "</div>";
						}

						if( $gdb->gs['I_SEXTA'][$key] !="" && $gdb->gs['F_SEXTA'][$key] !="" ){
							$dados .= "<div class='col'>";
							$dados .= "<h5 id='h5MODAL'>Sexta</h5>";
							$dados .= "<h6 id='h6MODAL'>".$gdb->gs['I_SEXTA'][$key]." às ".$gdb->gs['F_SEXTA'][$key]."</h6>";
							$dados .= "</div>";
						}

						if( $gdb->gs['I_SABADO'][$key] !="" && $gdb->gs['F_SABADO'][$key] !="" ){
							$dados .= "<div class='col'>";
							$dados .= "<h5 id='h5MODAL'>Sábado</h5>";
							$dados .= "<h6 id='h6MODAL'>".$gdb->gs['I_SABADO'][$key]." às ".$gdb->gs['F_SABADO'][$key]."</h6>";
							$dados .= "</div>";
						}

						if( $gdb->gs['I_DOMINGO'][$key] !="" && $gdb->gs['F_DOMINGO'][$key] !="" ){
							$dados .= "<div class='col'>";
							$dados .= "<h5 id='h5MODAL'>Domingo</h5>";
							$dados .= "<h6 id='h6MODAL'>".$gdb->gs['I_DOMINGO'][$key]." às ".$gdb->gs['F_DOMINGO'][$key]."</h6>";
							$dados .= "</div>";
						}

						$dados .= "</div>";
					}
					
					$dados .= "<!--  
									<br><br>
									<center><label>Sobre as oportunidades</label><br>
									<label>no momento não temos vagas abertas</label></center>
									-->
									</div>     
								</div>
							</div>
						</div>
					</div>";
						
	}	
					
}else{
	$dados = "<div class='row'>
			
				<label>Problemas com o banco de dados !</label>
			
		</div>";
}

print $dados;
?>			