/*MKS Tecnologia
Fun??o para validar formul?rio
*/

function validaForm(form)
{
	for (i=0;i<form.length;i++)
	{
		var text = form[i].name.indexOf("t");
		var list = form[i].name.indexOf("l");
		if (text!=-1)
		{
			if (form[i].value == "")
			{
				var nome = form[i].name.substring(1,form[i].name.length);
				alert("O campo " + nome + " ? obrigatorio.")
				form[i].focus();
				return false
			}
		}
		if (list!=-1)
		{
			if (form[i].value == "0")
			{
				var nome = form[i].name.substring(1,form[i].name.length);
				alert("O campo " + nome + " ? obrigatorio.")
				form[i].focus();
				return false
			}
		}
	}
	return true
}//fim do validaForm