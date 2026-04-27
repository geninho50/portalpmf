
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>SIGA- SISTEMA DE GERENCIMENTO ADMINISTRATIVO</title>
	
	<link rel="stylesheet" href="estilo/login.css" type="text/css" media="projection"/>
	<link rel="stylesheet" href="estilo/login.css" type="text/css" media="screen"/>
	<link rel="stylesheet" href="estilo/login.css" type="text/css" media="print"/>
    
    <link rel="shortcut icon" href="imagens/favicon.ico" >
	
    <script type="text/javascript" src="scripts/trata_erros.js" language="javascript"></script>
    
	<!--VERIFICA SE CAPS LOCK ESTÁ ATIVO-->
	<script type="text/javascript">
		function checar_caps_lock(ev) {
			var e = ev || window.event;
			codigo_tecla = e.keyCode?e.keyCode:e.which;
			tecla_shift = e.shiftKey?e.shiftKey:((codigo_tecla == 16)?true:false);
			if(((codigo_tecla >= 65 && codigo_tecla <= 90) && !tecla_shift) || ((codigo_tecla >= 97 && codigo_tecla <= 122) && tecla_shift)) {
				document.getElementById('aviso_caps_lock').style.visibility = 'visible';
			}
			else {
				document.getElementById('aviso_caps_lock').style.visibility = 'hidden';
			}
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
		
		function converteUpper(campo) {
       		 campo.value = campo.value.toUpperCase();
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
		