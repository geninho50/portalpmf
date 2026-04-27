function eCPF(strCPF) {
    var Soma;
    var Resto;
    Soma = 0;
	
	strCPF = strCPF.replace('.','');
	strCPF = strCPF.replace('.','');
	strCPF = strCPF.replace('.','');
	strCPF = strCPF.replace('-','');
	
	if (strCPF == "00000000000") return false;
	if (strCPF == "11111111111") return false;
    if (strCPF == "22222222222") return false;
    if (strCPF == "33333333333") return false;
	if (strCPF == "44444444444") return false;
	if (strCPF == "55555555555") return false;
	if (strCPF == "66666666666") return false;
    if (strCPF == "77777777777") return false;
    if (strCPF == "88888888888") return false;
	if (strCPF == "99999999999") return false;
    
	for (i=1; i<=9; i++){
		Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
	}	
	
	Resto = (Soma * 10) % 11;
	
    if ((Resto == 10) || (Resto == 11)){
		Resto = 0;
	}
	
    if (Resto != parseInt(strCPF.substring(9, 10)) ){
		return false;
	}	
	
	Soma = 0;
    for (i = 1; i <= 10; i++){
		Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
	}
	
    Resto = (Soma * 10) % 11;
	
    if ((Resto == 10) || (Resto == 11)){
		Resto = 0;
	}	
    if (Resto != parseInt(strCPF.substring(10, 11) ) ){
		return false;
	}	
    return true;
}

 
function ePIS(){
 
	var ftap="3298765432";
	var i;
	var resto=0;
	var numPIS=0;
	var strResto="";	
	var total=0;

 
	numPIS=$("#pis").val().replace(/\D/g, '');
			
	if (numPIS=="" || numPIS==null){
		return false;
	}
	
	for(i=0;i<=9;i++){
		resultado = (numPIS.slice(i,i+1))*(ftap.slice(i,i+1));
		total=total+resultado;
	}
	
	resto = (total % 11);
	
	if (resto != 0){
		resto=11-resto;
	}
	
	if (resto==10 || resto==11){
		strResto=resto+"";
		resto = strResto.slice(1,2);
	}
	
	if (resto!=(numPIS.slice(10,11))){
		return false;
	}
	
	return true;
}

function limpezaDeDocumento(numDoc){
	
	var numero = numDoc;
	var i = 0;
	
	for( i=1; i<4; i++){
		numero = numero.replace('.', '');
		numero = numero.replace('/', '');
		numero = numero.replace('-', '');	
		numero = numero.replace('(', '');
		numero = numero.replace(')', '');
		numero = numero.replace('+', '');

	}

	return numero;	
}

function ajustarData(nDate){
	var vDate = nDate;
	
	vDate = vDate.replace('/', '-');	
	vDate = vDate.replace('/', '-');
	vDate = vDate.substr(6,4)+'-'+vDate.substr(3,2)+'-'+vDate.substr(0,2);
	
	return vDate;
	
}

function Base64Encode(str, encoding = 'utf-8') {
   var bytes = new (TextEncoder || TextEncoderLite)(encoding).encode(str);        
   return base64js.fromByteArray(bytes);
}	

