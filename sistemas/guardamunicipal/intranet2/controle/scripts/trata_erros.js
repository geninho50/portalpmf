// Tratamento de Erros - MKS Tecnologia

function Trim( str )
{
 	while( str.charAt( str.length-1 ) == " "  )	{ str = str.substring( 0,str.length-1 ); }	
 	while( str.charAt(0) == ( " " ) )	{ str = str.substring( 1 ); }		
	return str;
}
 
function eInteiroPositivo( str )
{
	var padrao = "0123456789";
	var i = 0;
	do
	{
		var pos =0;
		for (var j=0; j < padrao.length; j++)
		{
			if ( str.charAt(i) == padrao.charAt(j) )
			{
				pos = 1;
				break;
			}
		}
		i++;
	 }
	 while ( pos ==1 && i < str.length )
	if ( pos == 0 )
		return false;
	return true;
 }
 
function validaFormAll(form)
{
	for (i=0;i<form.length;i++)
	{
		var text = form[i].name.indexOf("x");
		var list = form[i].name.indexOf("y");
		if (text!=-1)
		{
			if (form[i].value == "")
			{
				var nome = form[i].name.substring(1,form[i].name.length);
				alert("O campo " + nome + " e obrigatorio.");
				form[i].focus();
				return false;
			}
		}
		if (list!=-1)
		{
			if (form[i].value == "0")
			{
				var nome = form[i].name.substring(1,form[i].name.length);
				alert("O campo " + nome + " e obrigatorio.");
				form[i].focus();
				return false;
			}
		}
	} 
	return true;
}

function validaFormAll(form,id)
{
	var ver = true;
	for (i=0;i<form.length;i++)
	{
		var text = form[i].name.indexOf("x");
		var list = form[i].name.indexOf("y");
		if (text!=-1)
		{
			if (form[i].value == "")
			{
				var nome = form[i].name.substring(1,form[i].name.length);
				alert("O campo " + nome + " e obrigatorio.");
				resetButton('Continuar','Continuar');
				form[i].focus();
				return false;
				ver = false;
			}
		}
		if (list!=-1)
		{
			if (form[i].value == "0" || form[i].value == "")
			{
				var nome = form[i].name.substring(1,form[i].name.length);
				alert("O campo " + nome + " e obrigatorio.");
				resetButton('Continuar','Continuar');
				form[i].focus();
				return false;
				ver = false;
			}
		}
	} 
	return ver;
}

function validaFormAll(form,id,mensagem)
{
	var ver = true;
	if(mensagem=='')
	{
		mensagem = 'Enviar';
	}
	for (i=0;i<form.length;i++)
	{
		var text = form[i].name.indexOf("x");
		var list = form[i].name.indexOf("y");
		if (text!=-1)
		{
			if (form[i].value == "")
			{
				var nome = form[i].name.substring(1,form[i].name.length);
				alert("O campo " + nome + " e obrigatorio.");
				resetButton(''+mensagem,''+id);
				form[i].focus();
				ver = false;
				return false;				
			}
		}
		if (list!=-1)
		{
			if (form[i].value == "0" || form[i].value == "")
			{				
				var nome = form[i].name.substring(1,form[i].name.length);
				alert("O campo " + nome + " e obrigatorio.");
				resetButton(''+mensagem,''+id);				
				form[i].focus();				
				ver = false;				
				return false;				
			}
		}
	} 
	return ver;	
}
 
 function validarFormString( valor,campo ){	 
	 var i = Trim ( valor );
	 if( i == '')
	 {
		 alert( 'O campo '+campo+' esta em branco!!' );
	 }
	 else
	 {
		return true;		 
	 }
 }
 
 function validarFormInt( oForm ){
	 var i = oForm.value;
	 if(parseInt(i) && i == 0)
	 {
		 
	 }
 }
 
 function validarForm( oForm ){
 	if ( Trim ( oForm.condicao.value )=='0' ){
		alert( 'o campo "condicao" nao esta selecionado!!' );
		oForm.condicao.focus();
		return false;
	}
		
	if ( !eInteiroPositivo( Trim (oForm.matricula.value) ) ){
		alert('o campo matricula esta em branco ou vc nao digitou numeros!');
		oForm.matricula.focus();
		return false;
	}
	
	if ( Trim ( oForm.nome.value )=='' ){
		alert( 'O campo nome esta em branco!!' );
		oForm.nome.focus();
		return false;
	}
	
	if ( Trim ( oForm.sexo.value )=='Selecione' ){
		alert( 'O campo "sexo" nao esta selecionado!!' );
		oForm.nome.focus();
		return false;
	}
	return true;
 }
// Formata de acordo com uma máscara
// formatar(this, '##/##/####')
function formatar(src, mask) 
{
  var i = src.value.length;
  var saida = mask.substring(0,1);
  var texto = mask.substring(i)
  if (texto.substring(0,1) != saida) 
  {
        src.value += texto.substring(0,1);
  }
}

// Pega a data atual
function dataAtual()
{
	var now = new Date(); 
	var mName = now.getMonth() + 1; 
	var dayNr = now.getDate(); 
	var yearNr=now.getYear(); 
	
	if(yearNr < 2000) Year = 1900 + yearNr; 
	else Year = yearNr; 
	
	if(parseInt(dayNr) < 10)
	{
		dayNr = "0"+dayNr;		
	}
	if(parseInt(mName) < 10)
	{
		mName = "0"+mName;		
	}
	
	// Variavel para exibir a data. 
	var todaysDate = ""+dayNr+"/"+mName+"/"+Year;
}

function mes(mes)
{
	if(mes==01)
		return 'JANEIRO';
	else
	if(mes==02)
		return 'FEVEREIRO';
	else
	if(mes==03)
		return 'MARCO';
	else
	if(mes==04)
		return 'ABRIL';
	else
	if(mes==05)
		return 'MAIO';
	else
	if(mes==06)
		return 'JUNHO';
	else
	if(mes==07)
		return 'JULHO';	
	else
	if(mes==08)
		return 'AGOSTO';
	else
	if(mes==09)
		return 'SETEMBRO';
	else
	if(mes==10)
		return 'OUTUBRO';
	else
	if(mes==11)
		return 'NOVEMBRO';
	else
		return 'DEZEMBRO';
}


function Limpar(valor, validos) { 
// retira caracteres invalidos da string 
var result = ""; 
var aux; 
for (var i=0; i < valor.length; i++) { 
aux = validos.indexOf(valor.substring(i, i+1)); 
if (aux>=0) { 
result += aux; 
} 
} 
return result; 
} 

//Formata número tipo moeda usando o evento onKeyDown 

function Formata(campo,tammax,teclapres,decimal)
{
	var tecla = teclapres.keyCode; 
	vr = Limpar(campo.value,"0123456789"); 
	tam = vr.length; 
	dec=decimal 

	if (tam < tammax && tecla != 8){ tam = vr.length + 1 ; } 

	if (tecla == 8 ) 
	{ tam = tam - 1 ; } 

	if ( tecla == 8 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105 ) 
	{ 

	if ( tam <= dec ) 
	{ campo.value = vr ; } 

	if ( (tam > dec) && (tam <= 5) ){ 
	campo.value = vr.substr( 0, tam - 2 ) + "," + vr.substr( tam - dec, tam ) ; } 
	if ( (tam >= 6) && (tam <= 8) ){ 
	campo.value = vr.substr( 0, tam - 5 ) + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - dec, tam ) ; 
	} 
	if ( (tam >= 9) && (tam <= 11) ){ 
	campo.value = vr.substr( 0, tam - 8 )+ vr.substr( tam - 8, 3 ) + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - dec, tam ) ; } 
	if ( (tam >= 12) && (tam <= 14) ){ 
	campo.value = vr.substr( 0, tam - 11 ) + vr.substr( tam - 11, 3 ) + vr.substr( tam - 8, 3 ) + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - dec, tam ) ; } 
	if ( (tam >= 15) && (tam <= 17) ){ 
	campo.value = vr.substr( 0, tam - 14 ) + vr.substr( tam - 14, 3 ) + vr.substr( tam - 11, 3 ) + vr.substr( tam - 8, 3 ) + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - 2, tam ) ;} 
	} 
} 

function Tecla(e)
{
	if (document.all) // Internet Explorer
		var tecla = event.keyCode;
	else
	if(document.layers) // Nestcape
		var tecla = e.which;
	if ( ( tecla > 47 && tecla < 58 ) || ( tecla == 46 )  ) // numeros de 0 a 9
		return true;
	else
	{
		if (tecla != 8) // backspace
			event.keyCode = 0;//return false;
		else 
			return true;
		alert("Digite somente numeros");
	}
}


function SoNumeros(e)
{
	if(window.event)
	{
		key = event.keyCode;
	}
	else if(e.which)
	{
	// netscape
		key = e.which;
	}
	if (key!=8 || key < 48 || key > 57) return (((key > 47) && (key < 58)) || (key==8));
	{
		return true;
	}
}


function Excluir(link)
{
	document.ReturnValue=confirm('Deseja confirmar a Exclusao?');
	if (document.ReturnValue)
	{
		location = ''+link;
	}
}
function FINALIZAR(link)
{
	document.ReturnValue=confirm('Deseja Finalizar o Servico?');
	if (document.ReturnValue)
	{
		location = ''+link;
	}
}
function J4(link)
{
	document.ReturnValue=confirm('Deseja colocar a Guarnicao em J4?');
	if (document.ReturnValue)
	{
		location = ''+link;
	}
}
function J5(link)
{
	document.ReturnValue=confirm('Deseja colocar a Guarnicao em J5?');
	if (document.ReturnValue)
	{
		location = ''+link;
	}
}
function J6(link)
{
	document.ReturnValue=confirm('Deseja colocar a Guarnicao em J6?');
	if (document.ReturnValue)
	{
		location = ''+link;
	}
}
function J8(link)
{
	document.ReturnValue=confirm('Deseja colocar a Guarnicao em J8?');
	if (document.ReturnValue)
	{
		location = ''+link;
	}
}
function INDISPONIVEL(link)
{
	document.ReturnValue=confirm('Deseja deixar a Guarnicao INDISPONIVEL?');
	if (document.ReturnValue)
	{
		location = ''+link;
	}
}
function FOLGA(link)
{
	document.ReturnValue=confirm('Deseja cadastrar a folga?');
	if (document.ReturnValue)
	{
		location = ''+link;
	}
}
function P18(link)
{
	document.ReturnValue=confirm('Deseja deixar a Guarnicao em P18?');
	if (document.ReturnValue)
	{
		location = ''+link;
	}
}
function EXLUIRGUARNICAO(link)
{
	document.ReturnValue=confirm('Deseja realmente excluir a Guarnicao?');
	if (document.ReturnValue)
	{
		location = ''+link;
	}
}
function LIBERAR(link)
{
	document.ReturnValue=confirm('Deseja realmente liberar a Viatura?');
	if (document.ReturnValue)
	{
		location = ''+link;
	}
}


function ExcluirCategoria(linkCategoria)
{
	document.ReturnValue=confirm('Ao Excluir a Galeria as suas fotos tambem serao excluidas. Deseja confirmar a Exclusao da Galeria ?');
	if (document.ReturnValue)
	{
		location = ''+linkCategoria;
	}
}

function ExcluirSubCategoria(linkCategoria)
{
	document.ReturnValue=confirm('Os produtos cadastrados para a SubCategoria que deseja excluir tambem serao deletados da base de dados. Deseja confirmar a Exclusao da SubCategoria e de seus produtos ?');
	if (document.ReturnValue)
	{
		location = ''+linkCategoria;
	}
}

function DoPrinting()
{
	if (!window.print)
	{
		alert("Use o Netscape  ou Internet Explorer \n nas versoes 4.0 ou superior!")
		return
	}
	window.print()
}

function criaListBoxPais(sPais,ClassStyle)
{
	var vetor = new Array('BRASIL','AFEGANISTAO','AFRICA DO SUL','ALBANIA, REPUBLICA DA','ALEMANHA','ANDORRA','ANGOLA','ANGUILA','ANTIGUA E BARBUDA','ANTILHAS HOLANDESAS','ARABIA SAUDITA','ARGELIA','ARGENTINA','ARMENIA, REPUBLICA DA','ARUBA','AUSTRALIA','AUSTRIA','AZERBAIJAO, REPUBLICA DO','BAHAMAS, ILHAS','BAHREIN, ILHAS','BANGLADESH','BARBADOS','BELARUS, REPUBLICA DA','BELGICA','BELIZE','BENIN','BERMUDAS','BOLIVIA','BOSNIA-HERZEGOVINA (REPUBLICA DA)','BOTSUANA','BRUNEI','BULGARIA, REPUBLICA DA','BURKINA FASO','BURUNDI','BUTAO','CABO VERDE, REPUBLICA DE','CAMAROES','CAMBOJA','CANADA','CANADA','CANARIAS, ILHAS','CATAR','CAYMAN, ILHAS','CAZAQUISTAO, REPUBLICA DO','CHADE','CHILE','CHINA, REPUBLICA POPULAR','CHIPRE','CHRISTMAS,ILHA (NAVIDAD)','CINGAPURA','COCOS(KEELING),ILHAS','COLOMBIA','COMORES, ILHAS','CONGO','COOK, ILHAS','COREIA, REP.POP.DEMOCRATICA','COREIA, REPUBLICA DA','COSTA DO MARFIM','COSTA RICA','COVEITE','CROACIA (REPUBLICA DA)','CUBA','DINAMARCA','DJIBUTI','DOMINICA,ILHA','EGITO','EL SALVADOR','EMIRADOS ARABES UNIDOS','EQUADOR','ESLOVACA, REPUBLICA','ESLOVENIA, REPUBLICA DA','ESPANHA','ESTADOS UNIDOS','ESTONIA, REPUBLICA DA','ETIOPIA','FALKLAND (ILHAS MALVINAS)','FEROE, ILHAS','FIJI','FILIPINAS','FINLANDIA','FORMOSA (TAIWAN)','FRANCA','GABAO','GAMBIA','GANA','GEORGIA, REPUBLICA DA','GIBRALTAR','GRANADA','GRECIA','GROENLANDIA','GUADALUPE','GUAM','GUATEMALA','GUIANA','GUIANA FRANCESA','GUINE','GUINE-BISSAU','GUINE-EQUATORIAL','HAITI','HONDURAS','HONG KONG','HUNGRIA, REPUBLICA DA','IEMEN','INDIA','INDONESIA','IRA, REPUBLICA ISLAMICA DO','IRAQUE','IRLANDA','ISLANDIA','ISRAEL','ITALIA','IUGOSLAVIA, REP.FED.DA','JAMAICA','JAPAO','JOHNSTON, ILHAS','JORDANIA','KIRIBATI','LAOS, REP.POP.DEMOCR.DO','LEBUAN,ILHAS','LESOTO','LETONIA, REPUBLICA DA','LIBANO','LIBERIA','LIBIA','LIECHTENSTEIN','LITUANIA, REPUBLICA DA','LUXEMBURGO','MACAU','MACEDONIA, ANT.REP.IUGOSLAVA','MADAGASCAR','MALASIA','MALAVI','MALDIVAS','MALI','MALTA','MARIANAS DO NORTE','MARROCOS','MARSHALL,ILHAS','MARTINICA','MAURICIO','MAURITANIA','MEXICO','MIANMAR (BIRMANIA)','MICRONESIA','MIDWAY, ILHAS','MOCAMBIQUE','MOLDOVA, REPUBLICA DA','MONACO','MONGOLIA','MONTSERRAT,ILHAS','NAMIBIA','NAURU','NEPAL','NICARAGUA','NIGER','NIGERIA','NIVE,ILHA','NORFOLK,ILHA','NORUEG','NOVA CALEDONIA','NOVA ZELANDIA','OMA','PACIFICO,ILHAS DO (POSSESSAO DOS EUA)','PAISES BAIXOS (HOLANDA)','PALAU','PANAMA','PAPUA NOVA GUINE','PAQUISTAO','PARAGUAI','PERU','PITCAIRN,ILHA','POLINESIA FRANCESA','POLONIA, REPUBLICA DA','PORTO RICO','PORTUGAL','PROVISSAO DE NAVIOS E AERONAVES','QUENIA','QUIRGUIZ, REPUBLICA','REINO UNIDO','REPUBLICA CENTRO-AFRICANA','REPUBLICA DOMINICANA','REUNIAO, LHA','ROMENIA','RUANDA','RUSSIA, FEDERACAO DA','SAARA OCIDENTAL','SALOMAO, ILHAS','SAMOA','SAMOA AMERICANA','SAN MARINO','SANTA HELENA','SANTA LUCIA','SAO CRISTOVAO E NEVES,ILHAS','SAO PEDRO E MIQUELON','SAO TOME E PRINCIPE, ILHAS','SAO VICENTE E GRANADINAS','SENEGAL','SERRA LEOA','SEYCHELLES','SIRIA, REPUBLICA ARABE DA','SOMALIA','SRI LANKA','SUAZILANDIA','SUDAO','SUECIA','SUICA','SURINAME','TADJIQUISTAO, REPUBLICA DO','TAILANDIA','TANZANIA, REP.UNIDA DA','TCHECA, EPUBLICA','TERRITORIO BRIT.OC.INDICO','TIMOR LESTE','TOGO','TONGA','TOQUELAU,ILHAS','TRINIDAD E TOBAGO','TUNISIA','TURCAS ECAICOS,ILHAS','TURCOMENISTAO, REPUBLICA DO','TURQUIA','TUVALU','UCRANIA','UGANDA','URUGUAI','UZBEQUISTAO, REPUBLICA DO','VATICANO, EST.DA CIDADE DO','VENEZUELA','VIETNA','VIRGENS,ILHAS (E.U.A.)','VIRGENS,ILHAS(BRITANICAS)','VUANUTU','WAKE, ILHA','WALLIS E FUTUNA,ILHAS','ZAIRE','ZAMBIA','ZIMBABUE','ZONA DO CANAL DO PANAMA','OUTROS');
	document.write('<select size="1" class="'+ClassStyle+'" name="pais"><BR>');
	for(i=0; i<vetor.length; i++)
	{
		if( sPais == vetor[i] )
			document.write('<option value="'+vetor[i]+'" selected>'+vetor[i]+'</option><BR>');
		else
			document.write('<option value="'+vetor[i]+'">'+vetor[i]+'</option><BR>');
	}document.write('</select><BR>');
}

function criaListBoxEstado(sEstado,ClassStyle)
{
	var vetor = new Array('Santa Catarina','Acre','Alagoas','Amapá','Amazonas','Bahia','Brasília','Ceará','Espírito Santo','Goias','Maranhão','Mato Grosso','Mato Grosso do Sul','Minas Gerais','Pará','Paraíba','Paraná','Pernambuco','Piauí','Rio de Janeiro','Rio Grande do Norte','Rio Grande do Sul','Rondônia','Roraima','São Paulo','Sergipe','Tocantins','Outros');
	document.write('<select size="1" class="'+ClassStyle+'" name="uf"><BR>');
	for(i=0; i<vetor.length; i++)
	{
		if( sEstado == vetor[i] )
			document.write('<option value="'+vetor[i]+'" selected>'+vetor[i]+'</option><BR>');
		else
			document.write('<option value="'+vetor[i]+'">'+vetor[i]+'</option><BR>');
	}document.write('</select><BR>');
}

function criaListBoxPaisSelect(sPais,ClassStyle)
{
	var vetor = new Array('SELECIONE O PAÍS','BRASIL','AFEGANISTAO','AFRICA DO SUL','ALBANIA, REPUBLICA DA','ALEMANHA','ANDORRA','ANGOLA','ANGUILA','ANTIGUA E BARBUDA','ANTILHAS HOLANDESAS','ARABIA SAUDITA','ARGELIA','ARGENTINA','ARMENIA, REPUBLICA DA','ARUBA','AUSTRALIA','AUSTRIA','AZERBAIJAO, REPUBLICA DO','BAHAMAS, ILHAS','BAHREIN, ILHAS','BANGLADESH','BARBADOS','BELARUS, REPUBLICA DA','BELGICA','BELIZE','BENIN','BERMUDAS','BOLIVIA','BOSNIA-HERZEGOVINA (REPUBLICA DA)','BOTSUANA','BRUNEI','BULGARIA, REPUBLICA DA','BURKINA FASO','BURUNDI','BUTAO','CABO VERDE, REPUBLICA DE','CAMAROES','CAMBOJA','CANADA','CANADA','CANARIAS, ILHAS','CATAR','CAYMAN, ILHAS','CAZAQUISTAO, REPUBLICA DO','CHADE','CHILE','CHINA, REPUBLICA POPULAR','CHIPRE','CHRISTMAS,ILHA (NAVIDAD)','CINGAPURA','COCOS(KEELING),ILHAS','COLOMBIA','COMORES, ILHAS','CONGO','COOK, ILHAS','COREIA, REP.POP.DEMOCRATICA','COREIA, REPUBLICA DA','COSTA DO MARFIM','COSTA RICA','COVEITE','CROACIA (REPUBLICA DA)','CUBA','DINAMARCA','DJIBUTI','DOMINICA,ILHA','EGITO','EL SALVADOR','EMIRADOS ARABES UNIDOS','EQUADOR','ESLOVACA, REPUBLICA','ESLOVENIA, REPUBLICA DA','ESPANHA','ESTADOS UNIDOS','ESTONIA, REPUBLICA DA','ETIOPIA','FALKLAND (ILHAS MALVINAS)','FEROE, ILHAS','FIJI','FILIPINAS','FINLANDIA','FORMOSA (TAIWAN)','FRANCA','GABAO','GAMBIA','GANA','GEORGIA, REPUBLICA DA','GIBRALTAR','GRANADA','GRECIA','GROENLANDIA','GUADALUPE','GUAM','GUATEMALA','GUIANA','GUIANA FRANCESA','GUINE','GUINE-BISSAU','GUINE-EQUATORIAL','HAITI','HONDURAS','HONG KONG','HUNGRIA, REPUBLICA DA','IEMEN','INDIA','INDONESIA','IRA, REPUBLICA ISLAMICA DO','IRAQUE','IRLANDA','ISLANDIA','ISRAEL','ITALIA','IUGOSLAVIA, REP.FED.DA','JAMAICA','JAPAO','JOHNSTON, ILHAS','JORDANIA','KIRIBATI','LAOS, REP.POP.DEMOCR.DO','LEBUAN,ILHAS','LESOTO','LETONIA, REPUBLICA DA','LIBANO','LIBERIA','LIBIA','LIECHTENSTEIN','LITUANIA, REPUBLICA DA','LUXEMBURGO','MACAU','MACEDONIA, ANT.REP.IUGOSLAVA','MADAGASCAR','MALASIA','MALAVI','MALDIVAS','MALI','MALTA','MARIANAS DO NORTE','MARROCOS','MARSHALL,ILHAS','MARTINICA','MAURICIO','MAURITANIA','MEXICO','MIANMAR (BIRMANIA)','MICRONESIA','MIDWAY, ILHAS','MOCAMBIQUE','MOLDOVA, REPUBLICA DA','MONACO','MONGOLIA','MONTSERRAT,ILHAS','NAMIBIA','NAURU','NEPAL','NICARAGUA','NIGER','NIGERIA','NIVE,ILHA','NORFOLK,ILHA','NORUEG','NOVA CALEDONIA','NOVA ZELANDIA','OMA','PACIFICO,ILHAS DO (POSSESSAO DOS EUA)','PAISES BAIXOS (HOLANDA)','PALAU','PANAMA','PAPUA NOVA GUINE','PAQUISTAO','PARAGUAI','PERU','PITCAIRN,ILHA','POLINESIA FRANCESA','POLONIA, REPUBLICA DA','PORTO RICO','PORTUGAL','PROVISSAO DE NAVIOS E AERONAVES','QUENIA','QUIRGUIZ, REPUBLICA','REINO UNIDO','REPUBLICA CENTRO-AFRICANA','REPUBLICA DOMINICANA','REUNIAO, LHA','ROMENIA','RUANDA','RUSSIA, FEDERACAO DA','SAARA OCIDENTAL','SALOMAO, ILHAS','SAMOA','SAMOA AMERICANA','SAN MARINO','SANTA HELENA','SANTA LUCIA','SAO CRISTOVAO E NEVES,ILHAS','SAO PEDRO E MIQUELON','SAO TOME E PRINCIPE, ILHAS','SAO VICENTE E GRANADINAS','SENEGAL','SERRA LEOA','SEYCHELLES','SIRIA, REPUBLICA ARABE DA','SOMALIA','SRI LANKA','SUAZILANDIA','SUDAO','SUECIA','SUICA','SURINAME','TADJIQUISTAO, REPUBLICA DO','TAILANDIA','TANZANIA, REP.UNIDA DA','TCHECA, EPUBLICA','TERRITORIO BRIT.OC.INDICO','TIMOR LESTE','TOGO','TONGA','TOQUELAU,ILHAS','TRINIDAD E TOBAGO','TUNISIA','TURCAS ECAICOS,ILHAS','TURCOMENISTAO, REPUBLICA DO','TURQUIA','TUVALU','UCRANIA','UGANDA','URUGUAI','UZBEQUISTAO, REPUBLICA DO','VATICANO, EST.DA CIDADE DO','VENEZUELA','VIETNA','VIRGENS,ILHAS (E.U.A.)','VIRGENS,ILHAS(BRITANICAS)','VUANUTU','WAKE, ILHA','WALLIS E FUTUNA,ILHAS','ZAIRE','ZAMBIA','ZIMBABUE','ZONA DO CANAL DO PANAMA','OUTROS');
	document.write('<select size="1" class="'+ClassStyle+'" name="pais"><BR>');
	for(i=0; i<vetor.length; i++)
	{
		if( sPais == vetor[i] )
			document.write('<option value="'+vetor[i]+'" selected>'+vetor[i]+'</option><BR>');
		else
			document.write('<option value="'+vetor[i]+'">'+vetor[i]+'</option><BR>');
	}document.write('</select><BR>');
}

function criaListBoxEstadoSelect(sEstado,ClassStyle)
{
	var vetor = new Array('Selecione o Estado','Santa Catarina','Acre','Alagoas','Amapá','Amazonas','Bahia','Brasília','Ceará','Espírito Santo','Goias','Maranhão','Mato Grosso','Mato Grosso do Sul','Minas Gerais','Pará','Paraíba','Paraná','Pernambuco','Piauí','Rio de Janeiro','Rio Grande do Norte','Rio Grande do Sul','Rondônia','Roraima','São Paulo','Sergipe','Tocantins','Outros');
	document.write('<select size="1" class="'+ClassStyle+'" name="uf"><BR>');
	for(i=0; i<vetor.length; i++)
	{
		if( sEstado == vetor[i] )
			document.write('<option value="'+vetor[i]+'" selected>'+vetor[i]+'</option><BR>');
		else
			document.write('<option value="'+vetor[i]+'">'+vetor[i]+'</option><BR>');
	}document.write('</select><BR>');
}

function criaListBoxEstadoCivil(sEstadoCivil,ClassStyle)
{
	var vetor = new Array('solteiro(a)','casado(a)','viuvo(a)','separado(a)','uniao estavel');
	document.write('<select size="1" class="'+ClassStyle+'" name="estadocivil"><BR>');
	for(i=0; i<vetor.length; i++)
	{
		if( sEstadoCivil == vetor[i] )
			document.write('<option value="'+vetor[i]+'" selected>'+vetor[i]+'</option><BR>');
		else
			document.write('<option value="'+vetor[i]+'">'+vetor[i]+'</option><BR>');
	}document.write('</select><BR>');
}

function criaListBoxPeriodo(sPeriodo,ClassStyle)
{
	var vetor = new Array('manha','tarde');
	document.write('<select size="1" class="'+ClassStyle+'" name="periodo"><BR>');
	for(i=0; i<vetor.length; i++)
	{
		if( sPeriodo == vetor[i] )
			document.write('<option value="'+vetor[i]+'" selected>'+vetor[i]+'</option><BR>');
		else
			document.write('<option value="'+vetor[i]+'">'+vetor[i]+'</option><BR>');
	}document.write('</select><BR>');
}

function onClickButton(form,mensagem,link,id)
{
	document.getElementById(""+id).value = ''+mensagem;

	if( link != '' )
	{
		location=''+link;		
	}

	if( form != null )
	{
		form.submit();
	}
}

function resetButton(mensagem,id)
{
	document.getElementById(""+id).value = ''+mensagem;
}

function POPUP(URL,W,H)
{
	var NewPop = null;
	NewPop = window.open(URL,'removieopening','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,left=120,top=100,width='+ W +',height='+ H + '');
	NewPop.focus();
}

function setaFocusForm(posicao)
{
	document.getElementsByTagName('input')[posicao].focus();
}

function counterUpdate(opt_countedTextBox, opt_countBody, opt_maxSize)
{
	var countedTextBox = opt_countedTextBox ? opt_countedTextBox : "counttxt";
	var countBody = opt_countBody ? opt_countBody : "countBody";
	var maxSize = opt_maxSize ? opt_maxSize : 1024;
	var field = document.getElementById(countedTextBox);
	if (field && field.value.length >= maxSize)
	{
		field.value = field.value.substring(0, maxSize);
	}
	var txtField = document.getElementById(countBody);
	if (txtField)
	{
		txtField.innerHTML = field.value.length;
	}
}

function formataMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
    var sep = 0;
    var key = '';
    var i = j = 0;
    var len = len2 = 0;
    var strCheck = '0123456789';
    var aux = aux2 = '';
    var whichCode = (window.Event) ? e.which : e.keyCode;    
    // 13=enter, 8=backspace as demais retornam 0(zero)
    // whichCode==0 faz com que seja possivel usar todas as teclas como delete, setas, etc    
    if ((whichCode == 13) || (whichCode == 0) || (whichCode == 8))
    	return true;
    key = String.fromCharCode(whichCode); // Valor para o código da Chave
 
 
    if (strCheck.indexOf(key) == -1) 
    	return false; // Chave inválida
    len = objTextBox.value.length;
    for(i = 0; i < len; i++)
        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) 
        	break;
    aux = '';
    for(; i < len; i++)
        if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) 
        	aux += objTextBox.value.charAt(i);
    aux += key;
    len = aux.length;
    if (len == 0) 
    	objTextBox.value = '';
    if (len == 1) 
    	objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
    if (len == 2) 
    	objTextBox.value = '0'+ SeparadorDecimal + aux;
    if (len > 2) {
        aux2 = '';
        for (j = 0, i = len - 3; i >= 0; i--) {
            if (j == 3) {
                aux2 += SeparadorMilesimo;
                j = 0;
            }
            aux2 += aux.charAt(i);
            j++;
        }
        objTextBox.value = '';
        len2 = aux2.length;
        for (i = len2 - 1; i >= 0; i--)
        	objTextBox.value += aux2.charAt(i);
        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
    }
    return false;
}