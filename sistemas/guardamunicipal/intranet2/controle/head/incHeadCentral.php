
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>SIGA- SISTEMA DE GERENCIMENTO ADMINISTRATIVO</title>
	
	<link rel="stylesheet" href="estilo/autocompletar/jquery-ui-1.8.5.custom.css" type="text/css" media="projection"/>
    <link rel="stylesheet" href="estilo/autocompletar/jquery-ui-1.8.5.custom.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="estilo/autocompletar/jquery-ui-1.8.5.custom.css" type="text/css" media="print"/>
    
    <link rel="stylesheet" href="estilo/estilo.css" type="text/css" media="projection"/>
	<link rel="stylesheet" href="estilo/estilo.css" type="text/css" media="screen"/>
	<link rel="stylesheet" href="estilo/estilo.css" type="text/css" media="print"/>
    
    <link rel="shortcut icon" href="imagens/favicon.ico" >
	
	<script type="text/javascript" src="scripts/jquery-1.3.1.min.js"></script>	
	<script type="text/javascript" src="scripts/arquivo_ajax.js" language="javascript"></script>
	<script type="text/javascript" src="scripts/trata_erros.js" language="javascript"></script>
	
	<!--menu-->
	<link type="text/css" href="menu/menu.css" rel="stylesheet" />
    <script type="text/javascript" src="menu/jquery.js"></script>
    <!--<script type="text/javascript" src="menu/menu.js"></script>-->
    
    <!--calendário-->
	<link href="estilo/dhtmlgoodies_calendar.css" type="text/css" rel="stylesheet"/>
	<SCRIPT type="text/javascript" src="scripts/dhtmlgoodies_calendar.js" language="javascript"></script>
	<script type="text/javascript" src="scripts/arquivo_ajax_agenda.js"></script>
	<script type="text/javascript" src="scripts/ajax_agenda_int.js"></script>
	<!-- fim AJAX -->
	
    
        
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
	
    <script language='JavaScript'>
	function SomenteNumero(e){
	 var tecla=(window.event)?event.keyCode:e.which;
	 if((tecla>47 && tecla<58)) return true;
	 else{
	 if (tecla==8 || tecla==0) return true;
	 else  return false;
	 }
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
		 alert('CPF inválido');
		 campo.value = '';
		 campo.focus();
			  return false;
		 } 
		}
		
		// -->
		</script>
		
		<!-- gerar coluna-->
		
		<?
		//hora extra
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
		
		//atividade extra
		function GeraColunasExtra($pNumColunas, $pQuery) {
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
					$id = $linha[0];
					$produto = $linha[1];
					$valor = $linha[2];
					$login = $linha[3];
		 
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
		
		//atividade extra
		function GeraColunasCaixa($pNumColunas, $pQuery) {
			// Executa a instrução SQL
			$resultado = mysql_query($pQuery);
		 
			// Inicia a tabela
			echo ("<table width='600' border='0'>\n");
		 
			// Loops para gerar as colunas
			for($i = 0; $i <= mysql_num_rows($resultado); ++$i) {
			for ($intCont = 0; $intCont < $pNumColunas; $intCont++) {
				$linha = mysql_fetch_array($resultado);
				if ($i > $linha) {
					if ( $intCont < $pNumColunas-1) echo "</tr>\n";
						break;
					}
		 
					// Coloca cada valor do banco de dados em uma variável
					$id = $linha[0];
					$caixa = $linha[1];
					$numbloco = $linha[2];
		 
					if ($intCont == 0) {
						echo "<tr>\n";
					}
		 
					// Aqui vai o conteudo, ou seja, exibimos o nome do produto e seu respectivo valor
					echo "<td align='center' background='imagens/caixa.jpg' width='60' height='110'><font color='#FFFFFF' face='Arial, Helvetica, sans-serif' size='2'><b>". $caixa ."</b></font></td>\n";
		 
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
		
		function GeraColunasBloco($pNumColunas, $pQuery) {
			// Executa a instrução SQL
			$resultado = mysql_query($pQuery);
		 
			// Inicia a tabela
			echo ("<table width='600' border='1' style='border-collapse:collapse; border-color: #999'>\n");
		 
			// Loops para gerar as colunas
			for($i = 0; $i <= mysql_num_rows($resultado); ++$i) {
			for ($intCont = 0; $intCont < $pNumColunas; $intCont++) {
				$linha = mysql_fetch_array($resultado);
				if ($i > $linha) {
					if ( $intCont < $pNumColunas-1) echo "</tr>\n";
						break;
					}
		 
					// Coloca cada valor do banco de dados em uma variável
					$id = $linha[0];
					$numinicialbloco = $linha[3];
		 
					if ($intCont == 0) {
						echo "<tr>\n";
					}
		 
					// Aqui vai o conteudo, ou seja, exibimos o nome do produto e seu respectivo valor
					echo "<td align='center'><b>". $numinicialbloco ."</b></td>\n";
		 
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
    
        
		<script type="text/javascript" src="scripts/jquery.min.js"></script>
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
        <!--mudar cor campo texto-->
        <script> 
			function mudacor(ref,cor){ 
			ref.style.backgroundColor=cor; 
			} 
			function converteUpper(campo) {
       		 campo.value = campo.value.toUpperCase();
      		}
		</script>
        
        
        <script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
		<script src="js/jquery-ui-1.8.5.custom.min.js" type="text/javascript"></script>
		
		<script type="text/javascript">
			  
			  $(document).ready(function(){
				 
				 $("select[name=estado]").change(function(){
					$("select[name=cidade]").html('<option value="0">Carregando...</option>');
					
					$.post("cidades.php", 
						  {estado:$(this).val()},
						  function(valor){
							 $("select[name=cidade]").html(valor);
						  }
						  )
					
				 })
			  })
			  
		</script>
       	
        <script language="JavaScript" src="scripts/shortcut.js"></script>
		<script type="text/javascript">
			shortcut.add("F3",function() 
			{
				window.location.href = 'cadastro_guarnicao.php';
			});
			shortcut.add("F2",function() 
			{
				window.location.href = 'central_cadastro_ocorrencia.php';
			});
			shortcut.add("F4",function() 
			{
				window.location.href = 'administrar_ocorrencia.php';
			});
			shortcut.add("F6",function() 
			{
				window.location.href = 'empenhar_guarnicao_escola.php';
			});
			/*shortcut.add("F8",function() 
			{
				window.location.href = 'controle_guarnicao_adm.php';
			});*/
			shortcut.add("F9",function() 
			{
				window.location.href = 'cadastro_operacao_transito.php';
			});
			
			function converteUpper(campo) {
       		 campo.value = campo.value.toUpperCase();
      		}
			function pf(){
				document.form.pfisica.style.visibility='visible';
				document.form.pjuridica.style.visibility='hidden';
			}
	</script>
        
		<script type="text/javascript" src="scripts/autocompletar/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="scripts/autocompletar/jquery-ui-1.8.9.custom.min.js"></script>
    
   		<script type="text/javascript">
		 $(document).ready(function() 	{
		 $('#xguarda').autocomplete(
		  {
		   source: "guarda.php",
		   minLength: 2
		  });
		 });
		</script>
		<script type="text/javascript">
		 $(document).ready(function() 	{
		 $('#guardasolicitado').autocomplete(
		  {
		   source: "guarda.php",
		   minLength: 2
		  });
		 });
		</script>
		<script type="text/javascript">
		 $(document).ready(function() 	{
		 $('#xguardasolicitante').autocomplete(
		  {
		   source: "guarda.php",
		   minLength: 2
		  });
		 });
		</script>
        <script type="text/javascript">
	 	 $(document).ready(function(){
		 $('#xescola').autocomplete(
		  {
			source: "completar.php",
			minLength: 1
		  });
	     });
		</script>
        <script type="text/javascript">
		 $(document).ready(function() 	{
		 $('#xrua').autocomplete(
		  {
		   source: "endereco.php",
		   minLength: 2
		  });
		 });
		</script>
		
		<script type="text/javascript">
		 $(document).ready(function() 	{
		 $('#bairro').autocomplete(
		  {
		   source: "bairro.php",
		   minLength: 2
		  });
		 });
		</script>
		
		<script type="text/javascript">
		 $(document).ready(function() 	{
		 $('#xait').autocomplete(
		  {
		   source: "infracao.php",
		   minLength: 2
		  });
		 });
		</script>
		
		<script type="text/javascript">
		 $(document).ready(function() 	{
		 $('#xGM1_1').autocomplete(
		  {
		   source: "guarda.php",
		   minLength: 2
		  });
		 });
		</script>
		<script type="text/javascript">
		 $(document).ready(function() 	{
		 $('#GM1_2').autocomplete(
		  {
		   source: "guarda.php",
		   minLength: 2
		  });
		 });
		</script>
		<script type="text/javascript">
		 $(document).ready(function() 	{
		 $('#GM1_3').autocomplete(
		  {
		   source: "guarda.php",
		   minLength: 2
		  });
		 });
		</script>
		<script type="text/javascript">
		 $(document).ready(function() 	{
		 $('#GM1_4').autocomplete(
		  {
		   source: "guarda.php",
		   minLength: 2
		  });
		 });
		</script>
		<script type="text/javascript">
		 $(document).ready(function() 	{
		 $('#GM1_5').autocomplete(
		  {
		   source: "guarda.php",
		   minLength: 2
		  });
		 });
		</script>