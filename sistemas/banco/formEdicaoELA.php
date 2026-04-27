<html lang="pt-BR">
  <head>
    <meta charset="UTF-8">
    <title> S I S D G O V </title>
    <link rel="stylesheet" href="../backend/css/normalize.css">
    <script src="../backend/js/prefixfree.min.js"></script>
	<link href="../backend/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script src="../backend/js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="../backend/js/jquery.maskedinput.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../backend/css/estilo.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
  </head>
<?php

  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  include_once("gdb.php"); 
  include_once("usuario.func.php");   
  include_once("sessao.php");          
		  
  $gdb = new usuarios();  
  
  $registro   = $gdb->vargetpost('registro');  
  if( strlen( $registro ) != 4 ){
	  $registro   = base64_decode( $gdb->vargetpost('registro') );  
  }	  
  
    
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
					 Habilidades,
                     tipoConta  					 
	 		    FROM backend.pessoa p
			
		   LEFT JOIN backend.pessoaAuxiliar a  
		          ON p.codigopessoa = a.codigopessoa     
			     AND a.codigoProjeto = 'ELA'
				 
			   WHERE  p.codigoPessoa = '$registro' ");
  
?>
<form name="frm1" id="frm1" action="" method="post" >
	<div class="container">  
	<div class="row">
	<div class="col-lg-12">
	<div class="well">
	<input type="hidden" value="<? print $gdb->gs['CODIGO'][0]; ?>" id="codigoPessoa" name="codigoPessoa" >

		<table class="table table-striped table-bordered table-hover " border="1" cellpadding="1" cellspacing='0' width="50%" >
			<tr><td colspan=2 align="center" ><a href="#" class="list-group-item active"><b>Cadastro de Inscri&ccedil;&otilde;es</b></a></td></tr>
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
			  <td align = "left"><b>Endere&ccedil;o :</b></td>
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
			<tr><td colspan=2 align="center" ><b>Dados Banc&aacute;rio</b></td></tr>
			<tr>
			  <td align = "left"><b>Banco\Ag&ecirc;ncia\Conta\Tipo de Conta:</b></td>
			  <td align = "left">
				<input type="text" id="banco"    name="banco"   value="<? // print $gdb->gs['BANCO'][0]; ?>"  size="15" />/
				<input type="text" id="agencia" name="agencia"  value="<? // print $gdb->gs['AGENCIA'][0]; ?>"  size="15" />/
				<input type="text" id="conta"   name="conta"    value="<? // print $gdb->gs['CONTA'][0]; ?>"  size="15" />/
				<select name="tipoconta" id="tipoconta" >
				   <option value="1" <?// if($gdb->gs['TIPOCONTA'][0] == '1') print "Selected"; ?> >Conta Corrente</option>
				   <option value="2" <? // if($gdb->gs['TIPOCONTA'][0] == '2') print "Selected"; ?> >Poupanca</option>
				</select>
			  </td>
			</tr>
			

			<tr><td colspan=2 align="center" ><b>Dados Profissionais</b></td></tr>
			<tr>
			  <td align = "left"><b>Curr&iacute;culo:</b></td>		  
			  <td align = "left">
				<input type="text" id="curriculoela" name="curriculoela"  value="<? // print $gdb->gs['CURRICULOELA'][0]; ?>"  size="100" />	
			  </td>
			</tr>			
			<tr>
			  <td align = "left"><b>Profiss&atilde;o :</b></td>
			  <td align = "left">
				<input type="text" id="profissao" name="profissao"  value="<? // print $gdb->gs['PROFISSAO'][0]; ?>"  size="50" />
			  </td>
			</tr>		
			<tr><td colspan=2 align="center" ><b>M&iacute;dias</b></td></tr>										
			<tr>
			  <td align = "left"><b>Facebook:</b></td>
			  <td align = "left"> 
				<input type="text" id="facebookela" name="facebookela"  value="<? // print $gdb->gs['FACEBOOKELA'][0]; ?>"  size="100" />
			  </td>
			</tr>													
			<tr>
			  <td align = "left"><b>Youtube:</b></td>
			  <td align = "left"> 
				 <input type="text" id="youtube" name="youtube"  value="<? // print $gdb->gs['YOUTUBE'][0]; ?>"  size="100" />
			  </td>		  		 
			</tr>															
			<tr>
			  <td align = "left"><b>Video:</b></td>
			  <td align = "left"> 		 
				 <input type="text" id="video" name="video"  value="<? // print $gdb->gs['VIDEO'][0]; ?>"  size="100" />		              
			  </td>			
			</tr>																	
			<tr>
			  <td colspan="2" align="center" ><b>Atividades</b></td>
			</tr>		
			<tr>	    	  
			  <td align = "left" colspan="2" >
					<h2>&aacute;rea de Atua&ccedil;&atilde;o *:</h2><br>

					<label>Artes Visuais</label><br>
					<div class="col-md-6">
					<input type="checkbox" name="habilidades[]" value="atelie" class="desenho"> Desenho de Ateli&ecirc;</div>
					<div class="col-md-6">
					<input type="checkbox" name="habilidades[]" value="quadrinho" class="desenho"> Desenho e Quadrinho</div>
					<div class="col-md-6">
					<input type="checkbox" name="habilidades[]" value="modelagem" class="desenho"> Modelagem em Argila/Cer&acirc;mica</div>
					<div class="col-md-6">
					<input type="checkbox" name="habilidades[]" value="pintura" class="desenho"> Pintura</div>
					<br><br><br>


					<label>Cultura Popular</label><br>
					<div class="col-md-6">
					<input type="checkbox" name="habilidades[]" value="boi" class="desenho"> Boi de Mam&atilde;o</div>
					<div class="col-md-6">
					<input type="checkbox" name="habilidades[]" value="bilro" class="desenho"> Renda de Bilro para Iniciantes</div>
					<br><br>

					<label>Dan&ccedil;a</label><br>
					<div class="col-md-6">
					<input type="checkbox" name="habilidades[]" value="danca1" class="desenho"> Inicia&ccedil;&atilde;o &agrave; Dan&ccedil;a I</div>
					<div class="col-md-6">
					<input type="checkbox" name="habilidades[]" value="danca2" class="desenho"> Inicia&ccedil;&atilde;o &agrave; Dan&ccedil;a II</div>
					<br><br>

					<label>Teatro</label><br>
					<div class="col-md-6">
					<input type="checkbox" name="habilidades[]" value="teatro" class="desenho"> Inicia&ccedil;&atilde;o Teatral</div>
					<br><br>

					<label>M&uacute;sica</label><br>
					<div class="col-md-6">
					<input type="checkbox" name="habilidades[]" value="canto" class="desenho"> Canto</div>
					<div class="col-md-6">
					<input type="checkbox" name="habilidades[]" value="cavaquinho" class="desenho"> Cavaquinho/Bandolim</div>
					<div class="col-md-6">
					<input type="checkbox" name="habilidades[]" value="musicalizacao" class="desenho"> Musicaliza&ccedil;&atilde;o</div>
					<div class="col-md-6">
					<input type="checkbox" name="habilidades[]" value="violao" class="desenho"> Viol&atilde;o/Guitarra</div>
					<div class="col-md-6">
					<input type="checkbox" name="habilidades[]" value="conjunto" class="desenho"> Pr&aacute;tica de Conjunto</div>
					<div class="col-md-6">
					<input type="checkbox" name="habilidades[]" value="violino" class="desenho"> Violino</div>
					<div class="col-md-6">
					<input type="checkbox" name="habilidades[]" value="piano" class="desenho"> Piano</div>
					<div class="col-md-6">
					<input type="checkbox" name="habilidades[]" value="contrabaixo" class="desenho"> Contrabaixo</div>
					<div class="col-md-6">
					<input type="checkbox" name="habilidades[]" value="acordeon" class="desenho"> Acordeon</div>
					<div class="col-md-6">
					<input type="checkbox" name="habilidades[]" value="percussao" class="desenho"> Percuss&atilde;o</div>		  
			  </td>
			</tr>				
			
			<tr><td colspan=2 align="left" >
					<input type="button" class="btn-primary primary" onclick="salvar();" value="Salvar" >
			</td></tr>
			
		</table>
	</div>
	</div>
	</div>
	</div>
</form>

<script>
function salvar(){
		var habilidades = $("#frm1 input[name='habilidades[]']:checked");		
		var habilidadesChecked = '';
		var err = 0;
		var localImagem  = '../Cultura/EscolaLivreArtes/img/';
		
		if( habilidades.length == 0 ){
		    alert("informe uma ou mais habilidades !");
		    err = 1;
		    $("#frm1 input[name='habilidades[]']").focus();
		}else{
		    habilidades.each( function(){
			   habilidadesChecked += $(this).val() + ", ";
			});	
			
			var banco = $('#banco').val();
			if( banco == '' ){
				alert("informe um banco !");
				err = 1;			
				$('#banco').focus();
			}
			
			var agencia = $('#agencia').val();
			if( agencia == '' ){
				alert("informe um agência !");
				err = 1;			
				$('#agencia').focus();
			}		
			
			var conta = $('#conta').val();
			if( conta == '' ){
				alert("informe um Conta !");
				err = 1;	
				$('#conta').focus();	
			}		
		}
		

		if( err == 0 ){
			
			var obj = {
				habilidades    : habilidadesChecked,
				banco          : $('#banco').val(),
				agencia        : $('#agencia').val(),
				contaNum       : $('#conta').val(), 
				tipoConta      : $('#tipoconta').val(),
				curriculo      : $('#curriculoela').val(),
				facebook       : $('#facebookela').val(),
				youtube        : $('#youtube').val(),
				video          : $('#video').val(),
				profissao      : $('#profissao').val(),
				codigoprojeto  : 'ELA',
				codigoPessoa   : $('#codigoPessoa').val() 	
			};
			
			obj = $( this ).serialize() + "&" + $.param( obj );
					  
			$.ajax({			
				   type: "POST",
				   url: "cadastrarELAProfessor.php",
				   dataType: "json",
				   data: obj,
				   success: function ( data ) {
				      if( data['codigo'] !="E" ){
						  document.getElementById("frm1").action = "sucesso.php?codigoprojeto=ELA&titulo=Franklin Cascaes&codigo="+data['codigo']+"&emailResposta=escolalivredeartesffc@gmail.com&codigoPessoa=" + codigoPessoa + "&localImagem="+ localImagem ;
						  document.getElementById("frm1").submit();                             
					  }
					},				   
				   error: function ( data ) {
					  console.log(data);
				   }
				
			});	
		}	
}	
</script>

</html>