
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>INTRANET - GUARDA MUNICIPAL DE FLORIANÓPOLIS</title>
	
	<link rel="stylesheet" href="stylo/stylo.css" type="text/css" media="screen, projection"/>
	<script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>	
	<script type="text/javascript" language="javascript" src="js/jquery.dropdownPlain.js"></script>
	<script type="text/javascript" src="js/arquivo_ajax.js" language="javascript"></script>
	
	<script type="text/javascript" src="js/trata_erros.js" language="javascript"></script>
	
	<!--menu-->
	<link type="text/css" href="menu/menu.css" rel="stylesheet" />
    <script type="text/javascript" src="menu/jquery.js"></script>
    <!--<script type="text/javascript" src="menu/menu.js"></script>-->
	
	<!--calendário-->
	<link href="stylo/dhtmlgoodies_calendar.css" type="text/css" rel="stylesheet"/>
	<SCRIPT type="text/javascript" src="js/dhtmlgoodies_calendar.js" language="javascript"></script>
	
	<link href="themes/default.css" rel="stylesheet" type="text/css"> </link> 
	<link href="themes/alphacube.css" rel="stylesheet" type="text/css"> </link>
	<script type="text/javascript" src="js/prototype.js"> </script>
	<script type="text/javascript" src="js/effects.js"> </script>
	<script type="text/javascript" src="js/window.js"> </script>
	<script type="text/javascript" src="js/window_effects.js"> </script>
	<script type="text/javascript" src="js/mac_os_x_dialog.js"> </script>
	
	<!-- ini AJAX -->
	<script type="text/javascript" src="js/arquivo_ajax_agenda.js"></script>
	<script type="text/javascript" src="js/ajax_agenda_int.js"></script>
<!-- fim AJAX -->

	<!--testa a senha-->
	<script type="text/javascript" src="testasenha.js"></script>
	
	<!--editor de texto-->
	</script>
	<link href="fckeditor/sample.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
	
	<!--valida hora-->
	<script type="text/javascript">
		function valida_horas(edit){
		  if(event.keyCode<48 || event.keyCode>57){
			event.returnValue=false;
		  }
		  if(edit.value.length==2 || edit.value.length==5){
			edit.value+=":";}
		}
	</script>
	
	<!--valida cpf-->
	<script LANGUAGE="JavaScript"><!--
		function Verifica_campo_CPF(campo) {
		var CPF = campo.value; // Recebe o valor digitado no campo
		 
		// Aqui começa a checagem do CPF
		var POSICAO, I, SOMA, DV, DV_INFORMADO;
		var DIGITO = new Array(10);
		DV_INFORMADO = CPF.substr(9, 2); // Retira os dois últimos dígitos do número informado
		 
		// Desemembra o número do CPF na array DIGITO
		for (I=0; I<=8; I++) {
		 DIGITO[I] = CPF.substr( I, 1);
		}
		 
		// Calcula o valor do 10º dígito da verificação
		POSICAO = 10;
		SOMA = 0;
		 for (I=0; I<=8; I++) {
		 SOMA = SOMA + DIGITO[I] * POSICAO;
		 POSICAO = POSICAO - 1;
		 }
		DIGITO[9] = SOMA % 11;
		 if (DIGITO[9] < 2) {
		 DIGITO[9] = 0;
		}
		 else{
		 DIGITO[9] = 11 - DIGITO[9];
		}
		 
		// Calcula o valor do 11º dígito da verificação
		POSICAO = 11;
		SOMA = 0;
		 for (I=0; I<=9; I++) {
		 SOMA = SOMA + DIGITO[I] * POSICAO;
		 POSICAO = POSICAO - 1;
		 }
		DIGITO[10] = SOMA % 11;
		 if (DIGITO[10] < 2) {
		 DIGITO[10] = 0;
		 }
		 else {
		 DIGITO[10] = 11 - DIGITO[10];
		 }
		 
		// Verifica se os valores dos dígitos verificadores conferem
		DV = DIGITO[9] * 10 + DIGITO[10];
		 if (DV != DV_INFORMADO) {
		 alert('CPF invalido');
		 campo.value = '';
		 campo.focus();
			  return false;
		 } 
		}
		
		// -->
		</script>
		
		<!-- gerar coluna-->
		
		<?
		function GeraColunas($pNumColunas, $pQuery) {
			// Executa a instrução SQL
			$resultado = mysql_query($pQuery);
		 
			// Inicia a tabela
			echo ("<table width='300px' border='1' style='border-collapse:collapse; border-color: #999'>\n");
		 
			// Loops para gerar as colunas
			for($i = 0; $i <= mysql_num_rows($resultado); ++$i) {
			for ($intCont = 0; $intCont < $pNumColunas; $intCont++) {
				$linha = mysql_fetch_array($resultado);
				if ($i > $linha) {
					if ( $intCont < $pNumColunas-1) echo "</tr>\n";
						break;
					}
		 
					// Coloca cada valor do banco de dados em uma variável
					$login = $linha[0];
					$produto = $linha[1];
					$valor = $linha[2];
		 
					if ($intCont == 0) {
						echo "<tr>\n";
					}
		 
					// Aqui vai o conteudo, ou seja, exibimos o nome do produto e seu respectivo valor
					echo "<td align='center'><b>". $login ."</b></td>\n";
		 
					if ($intCont == $pNumColunas-1 ) {
						echo "</tr>\n";
					} else {
						$i++;
					}
				}
			}
			// Fim da tabela
			echo ('</table>');
		}
		?>
		
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery.pstrength-min.1.2.js">
		</script>
		<script type="text/javascript">
		$(function() {
		$('.password').pstrength();
		});
		
		function converteUpper(campo) {
       		 campo.value = campo.value.toUpperCase();
      		}
		</script>
		
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
		 
			//Checkbox
			$("input[name=checktodos]").change(function(){
				$('input[type=checkbox]').each( function() {			
					if($("input[name=checktodos]:checked").length == 1){
						this.checked = true;
					} else {
						this.checked = false;
					}
				});
			});
		 
		});
		</script>