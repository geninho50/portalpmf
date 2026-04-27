
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>SIGA - Sistema de Gerenciamento Administrativo</title>
	
	<link rel="stylesheet" href="estilo/autocompletar/jquery-ui-1.8.5.custom.css" type="text/css" media="projection"/>
	<link rel="stylesheet" href="estilo/autocompletar/jquery-ui-1.8.5.custom.css" type="text/css" media="screen"/>
	<link rel="stylesheet" href="estilo/autocompletar/jquery-ui-1.8.5.custom.css" type="text/css" media="print"/>
	
	<link rel="stylesheet" href="estilo/stylo.css" type="text/css" media="projection"/>
	<link rel="stylesheet" href="estilo/stylo.css" type="text/css" media="screen"/>
	<link rel="stylesheet" href="estilo/stylo.css" type="text/css" media="print"/>
    
    <link rel="shortcut icon" href="imagens/favicon.ico" >
		
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
			shortcut.add("F8",function() 
			{
				window.location.href = 'controle_guarnicao_adm.php';
			});
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
	<script type="text/javascript" src="scripts/trata_erros.js" language="javascript"></script>
	
	<!--calendário-->
	<link href="css/dhtmlgoodies_calendar.css" type="text/css" rel="stylesheet"/>
	<SCRIPT type="text/javascript" src="scripts/dhtmlgoodies_calendar.js" language="javascript"></script>
	
	<!-- ini AJAX -->
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
    
    <script> 
			function mudacor(ref,cor){ 
			ref.style.backgroundColor=cor; 
			} 
			function converteUpper(campo) {
       		 campo.value = campo.value.toUpperCase();
      		}
		</script>

	<script type="text/javascript" src="scripts/autocompletar/jquery-1.4.4.min.js"></script>
	<script type="text/javascript" src="scripts/autocompletar/jquery-ui-1.8.9.custom.min.js"></script>

		<!--auto completar-->
	
		<script type="text/javascript">
		 $(document).ready(function() 	{
		 $('#rua').autocomplete(
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
		<script type="text/javascript">
	 	 $(document).ready(function(){
		 $('#xescola').autocomplete(
		  {
			source: "completar.php",
			minLength: 1
		  });
	     });
		</script>

