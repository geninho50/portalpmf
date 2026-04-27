<!DOCTYPE html>
<html lang="en">
	<head>
		<link href="/../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Cálculo IPTU</title>
		<link rel="stylesheet" href="layout/estilo-calculo.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  	</head>
	<body>
		<p align="justify"><b><u>Como se calcula o limitador do percentual da Lei Complementar 480/2013?</b></u><br>
		Para que o contribuinte identifique o seu percentual de aumento, deverá fazer a seguinte conta:</p>
 
 		<p align="justify">Ele deve pegar o valor do IT de 2015 e dividir por 1.0659 (que é o IPCA). Este resultado somado ao IP de 2014 seria o imposto cobrado do contribuinte em 2014. esse imposto, dividido pelo imposto (IT + IP) de 2013 dará o percentual de aumento.Obs: Deve-se desconsiderar 1 ponto deste resultado (ex: se o resultado der 1.36, o percentual de aumento será de 36%).</p>

		<div id="formulario_campos">
			<div class="table">	
				<div class="form-group">
					<input type="text" id="ip2013" name="ip2013" >
					<label for="ip2013">IP 2013 <red>*carnê 2013</red></label><br>
					
					<input type="text"  id="it2013" name="it2013" >
					<label for="it2013">IT 2013 <red>*carnê 2013</red></label><br>
					
					<input type="text" id="ip2014" name="ip2014" >
					<label for="ip2014">IP 2014 <red>*carnê 2014</red></label><br>
					
					<input type="text" id="it2015" name="it2015" >
					<label for="it2015">IT 2015</label><br>

					<div id='bloco_resultado'>Percentual: <span id='resultado'></span></div>
					
					<button type="submit" id="calcular">Calcular</button>       
				</div>
			</div>			  
		</div>
		<p align="justify"><b>O.b.s:</b> Aqueles imoveis que sofreram quaisquer alterações cadastrais que tem consequências no valor do IPTU estão excluídos da regra do limitador de 50% determinado por decisão judicial, uma vez que esta é decorrente exclusivamente da aplicação da nova Planta Genérica de Valores (LC 480/2013).</p>

		<script>
		$('#calcular').click(function(){
			ip2013 = parseFloat ( $('#ip2013').val() );
			it2013 = parseFloat ( $('#it2013').val() );
			ip2014 = parseFloat ( $('#ip2014').val() );
			it2015 = parseFloat ( $('#it2015').val() );
			
			if ( !testarcampo('#ip2013') && !testarcampo('#it2013') && !testarcampo('#ip2014') && !testarcampo('#it2015') ){
				it2014 = it2015 / 1.0659;
				iptu2013 = ip2013 + it2013;
				iptu2014 = ip2014 + it2014;
				resultado = iptu2014 / iptu2013;
				resultado = Math.round ( resultado * 100 ) / 100;
				resultado = resultado.toString();
				decimal = resultado.split('.');
				if(decimal[1]){
					if(decimal[1] < 10){
						resultado = decimal[1] + '0%';
					}else{
						resultado = decimal[1] + '%';
					}
					$('#resultado').html( resultado ) ;
				}else{
					$('#resultado').html( "<b>Números inválidos!<b>" ) ;
				}	
				
				//$('#resultado').val( resultado ) ;
			}
		});
		function testarcampo(id){
			if( $(id).val() == '' ){
				$(id).focus();
				return true;
			}else{
				return false
			}
		}
		</script>
	</body>
</html>