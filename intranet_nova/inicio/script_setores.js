$(document).ready
(

 
	function()
	{
		combodinamico("secretaria","setor","cargo");	
	}
);

combodinamico = function(secretaria, setor, cargo)
{
	var secretaria  = document.getElementById(secretaria);
	var setor 		= document.getElementById(setor);
	var cargo 		= document.getElementById(cargo);
	
	$(secretaria).load('controle/usuarios/load_entidades.php');
	
	$(secretaria).change(
		
		function() {			
			if($(this).val() == 999999) {
				alert('Escolha uma Secretaria');
				$(this).focus();
			} 
			
			else 
			{
				$(setor).load('controle/usuarios/load_setores.php?identificador=' + $(this).val());
				$(cargo).load('controle/usuarios/load_cargos.php?identificador=' + $(this).val());
			}
		}
	);
}
