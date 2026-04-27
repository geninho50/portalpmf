
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>CADASTRO DE TRANSPORTE SOLIDARIO - GMF - 153</title>
	
	<link rel="stylesheet" href="stylo/stylo.css" type="text/css" media="projection"/>
	<link rel="stylesheet" href="stylo/stylo.css" type="text/css" media="screen"/>
	<link rel="stylesheet" href="stylo/stylo.css" type="text/css" media="print"/>
	
	<script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>	
	<script type="text/javascript" language="javascript" src="js/jquery.dropdownPlain.js"></script>
	<script type="text/javascript" src="js/arquivo_ajax.js" language="javascript"></script>
	
	<script type="text/javascript" src="js/trata_erros.js" language="javascript"></script>
	
	<link href="stylo/dhtmlgoodies_calendar.css" type="text/css" rel="stylesheet"/>
	<SCRIPT type="text/javascript" src="js/dhtmlgoodies_calendar.js" language="javascript"></script>
	
		

		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery.pstrength-min.1.2.js">
		</script>
		<script type="text/javascript">
		$(function() {
		$('.password').pstrength();
		});
		</script>
		<script language="JavaScript" src="js/shortcut.js"></script>
		<script type="text/javascript" src="js/jquery.min.js"></script> 
		<script type="text/javascript">
				
			function converteUpper(campo) {
       		 campo.value = campo.value.toUpperCase();
      		}
	  	    function pf(){
				document.form.pfisica.style.visibility='visible';
				document.form.pjuridica.style.visibility='hidden';
			}
				shortcut.add("F3",function() 
				{
					window.location.href = 'cadastro_guarnicao.php';
				});
				shortcut.add("F2",function() 
				{
					window.location.href = 'cadastro_ocorrencia.php';
				});
				shortcut.add("F4",function() 
				{
					window.location.href = 'administrar_ocorrencia.php';
				});
				shortcut.add("F6",function() 
				{
					window.location.href = 'empenhar_guarnicao_escola.php';
				});
				shortcut.add("F7",function() 
				{
					window.location.href = 'cadastro_recado.php';
				});

			function formatar(src, mask){
			  var i = src.value.length;
			  var saida = mask.substring(0,1);
			  var texto = mask.substring(i)
			if (texto.substring(0,1) != saida)
			  {
				src.value += texto.substring(0,1);
			  }
			}
		</script>

		<link type="text/css" href="stylo/jquery-ui-1.8.5.custom.css" rel="Stylesheet" />
<script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.5.custom.min.js" type="text/javascript"></script>

<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
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
