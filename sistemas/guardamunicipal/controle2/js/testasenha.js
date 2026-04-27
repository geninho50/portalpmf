function verCaracterDaSenha(valor) {
 
  var erespeciais = /[@!#$%&*+=?|-]/;
  var ermaiuscula = /[A-Z]/;
  var erminuscula = /[a-z]/;
  var ernumeros   = /[0-9]/;
  var cont = 0;
 
  if (erespeciais.test(valor)) cont++;
  if (ermaiuscula.test(valor)) cont++;
  if (erminuscula.test(valor)) cont++;
  if (ernumeros.test(valor))   cont++;
  return cont;
}
 
function segurancaBaixa(d) {
  d.innerHTML = '<h4>Seguranca da senha: <font color=\'red\'>  BAIXA</font></h4>';
}
function segurancaMedia(d) {
  d.innerHTML = '<h4>Seguranca da senha: <font color=\'orange\'>  MEDIA</font></h4>';
}
function segurancaAlta(d) {
  d.innerHTML = '<h4>Seguranca da senha: <font color=\'green\'>  ALTA</font></h4>';
}
 
function testaSenha(valor) {
  var d = document.getElementById('seguranca');
  var c = verCaracterDaSenha(valor);
  var t = valor.length;
 
  if(t == ''){
    d.innerHTML = "<h4>Seguranca da senha: !</h4>";
  } else {
    if(t > 7 && c >= 3) segurancaAlta(d);
    else { 
      if(t > 7 && c >= 2 || t > 4 && c >= 3) segurancaMedia(d);
      else segurancaBaixa(d);
    }
  }  
}