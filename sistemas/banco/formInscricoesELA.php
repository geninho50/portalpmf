<?php

  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  include_once("gdb.php"); 
  include_once("usuario.func.php");   
  include_once("sessao.php");          
		  
  $gdb = new usuarios();  
  
  $registro   = $gdb->vargetpost('registro');  
    
  $gdb->open("SELECT p.codigoPessoa as codigo,
                     Nome,
					 date_format(Nascimento,'%d/%m/%Y')  as Nascimento, 
					 CPF,
					 Identidade, 
					 logradouro, 
					 Numero, 
					 Complemento, 
					 Bairro, 
					 Municipio, 
					 cep, 
					 email, 
					 Telefone, 
					 Celular,
					 facebookELA,
					 youtube,
					 curriculoELA,
					 profissao,
					 video,
					 conta,
					 banco,
					 agencia,
					 Habilidades                       					 
	 		    FROM backend.pessoa p, 
				     backend.pessoaAuxiliar a  					 
			   WHERE p.codigopessoa = a.codigopessoa
			     AND a.codigoProjeto = 'ELA'
			     AND p.codigoPessoa = '$registro' ");
  
?>
<div class="container">  
<div class="row">
<div class="col-lg-12">
<div class="well">
	<table class="table table-striped table-bordered table-hover " border="1" cellpadding="1" cellspacing='0' width="50%" >
		<tr><td colspan=2 align="center" ><a href="#" class="list-group-item active"><b>Cadastro de Inscrições</b></a></td></tr>
		<tr>
		  <td align = "left"><b>Codigo\Nome :<b></td>
		  <td align = "left"><? print $gdb->gs['CODIGO'][0].' - '.$gdb->gs['NOME'][0]; ?></td>
		</tr>
		<tr>
		  <td align = "left"><b>Data de Nascimento :</b></td>
		  <td align = "left"><? print $gdb->gs['NASCIMENTO'][0]; ?></td>
		</tr>
		<tr>
		  <td align = "left"><b>CPF:</b></td>
		  <td align = "left"><? print $gdb->gs['CPF'][0]; ?></td>
		</tr>		
		<tr>
		  <td align = "left"><b>Identidade :</b></td>
		  <td align = "left"><? print $gdb->gs['IDENTIDADE'][0]; ?></td>
		</tr>		
		<tr>
		  <td align = "left"><b>Endereço :</b></td>
		  <td align = "left"><? print $gdb->gs['LOGRADOURO'][0].' '.$gdb->gs['NUMERO'][0].' '.$gdb->gs['COMPLEMENTO'][0]; ?></td>
		</tr>		
		<tr>
		  <td align = "left"><b>Bairro\Municipio\CEP:</b></td>
		  <td align = "left"><? print $gdb->gs['BAIRRO'][0].' - '.$gdb->gs['MUNICIPIO'][0].' - '.$gdb->gs['CEP'][0]; ?></td>
		</tr>
		<tr>
		  <td align = "left"><b>Telefone\Celular :</b></td>
		  <td align = "left"><? print $gdb->gs['TELEFONE'][0].'  '.$gdb->gs['CELULAR'][0]; ?></td>
		</tr>						
		<tr>
		  <td align = "left"><b>Email :</b></td>
		  <td align = "left"><? print $gdb->gs['EMAIL'][0]; ?></td>
		</tr>							
		<tr><td colspan=2 align="center" ><b>Dados Bancário</b></td></tr>
		<tr>
		  <td align = "left"><b>Banco\Agência\Conta:</b></td>
		  <td align = "left"><? print $gdb->gs['BANCO'][0]." \ ".$gdb->gs['AGENCIA'][0]." \ ".$gdb->gs['CONTA'][0]; ?></td>
		</tr>
		

		<tr><td colspan=2 align="center" ><b>Dados Profissionais</b></td></tr>
		<tr>
		  <td align = "left"><b>Currículo:</b></td>
		  <td align = "left"><a target="_blank" href="<? print $gdb->gs['CURRICULOELA'][0]; ?>" ><? print $gdb->gs['CURRICULOELA'][0]; ?><a></td>
		</tr>			
		<tr>
		  <td align = "left"><b>Profissão :</b></td>
		  <td align = "left"><? print $gdb->gs['PROFISSAO'][0]; ?></td>
		</tr>		
		<tr>
		  <td align = "left"><b>Habilidades :</b></td>
		  <td align = "left"><? print $gdb->gs['HABILIDADES'][0]; ?></td>
		</tr>				
		
		<tr><td colspan=2 align="center" ><b>Mídias</b></td></tr>										
		<tr>
		  <td align = "left"><b>Facebook:</b></td>
		  <td align = "left"> 
			<a target="_blank" href="<? print $gdb->gs['FACEBOOKELA'][0]; ?>"><? print $gdb->gs['FACEBOOKELA'][0]; ?></a>
		  </td>
		</tr>													
		<tr>
		  <td align = "left"><b>Youtube:</b></td>
		  <td align = "left"> 
		    <a target="_blank" href="<? print $gdb->gs['YOUTUBE'][0]; ?>"><? print $gdb->gs['YOUTUBE'][0]; ?></a>
		  </td>		  		 
		</tr>															
		<tr>
		  <td align = "left"><b>Video:</b></td>
		  <td align = "left"> 		 
            <a target="_blank" href="<? print $gdb->gs['VIDEO'][0]; ?>"><? print $gdb->gs['VIDEO'][0]; ?></a>		  			
		  </td>			
		</tr>																	
		<tr><td colspan=2 align="left" ><button class="btn-primary primary" onclick="fechar();" ><b>Fechar</b></button></td></tr>
	</table>
</div>
</div>
</div>
</div>