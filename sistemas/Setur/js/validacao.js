function ecnpjcpf(number) {

   var digit, cgc, i, b, s, numbers, replicated, tipo;

   numbers = '0123456789';
   replicated= '';
   digit = '';
   tipo = '';
  
   // Tira Pontos, Barras e Hífens do CGC //
   //for (i=number.length-1; i>=0; i--) {
   //   if (numbers.indexOf(number.substr(i, 1)) < 0)
   //      number = number.substr(0, i).concat(number.substr(i+1, number.length-i));
   //}
   
   // Verifica Pontos, Barras e Hífens do CGC //
   for (i=number.length-1; i>=0; i--) {
      if (numbers.indexOf(number.substr(i, 1)) < 0) {
         alert('Informe apenas numeros no CPF. Caracter \"'+number.substr(i, 1)+'\" invalido.');
         return false;
      }
   }

   // Cria número de cgc/cpf repetido para teste de validade //
   for (i=0; i<number.length-2; i++)
      replicated = replicated.concat(number.substr(0, 1));

   // Testa se é cpf ou cgc //
   if (number.length != 14 && number.length != 11 && number.length != 10) {
      alert('CNPJ deve ser informado com 14 digitos e CPF com 11.');
      return false;
   }
   
   // Verifica se todos os números são iguais //
   else if (number.substr(0, number.length-2) == replicated) {
      alert('Nao e permitido CPF com todos os numeros iguais. ');
      return false;      
   }
   
   // Calcula Dígito //
   else {
      if (number.length == 14) tipo = "CNPJ"; else tipo = "CPF";
      cgc = number.substr(0, number.length-2);
      while (digit.length <2) {
         s = 0;
         b = 2;
         for (i=cgc.length-1; i>=0; i--) {
             s = s + b * cgc.substr(i, 1);
             b = b + 1;
             if (number.length == 14 && b > 9)
                b = 2;
         }
         s = 11 - (s % 11);
         if (s > 9) s = 0;
         digit = digit.concat(s);
         cgc = cgc.concat(s);

      }
   
      // Verifica retorno //
      if (digit==number.substr(number.length-2, 2))
         return true;
      else {
         alert('Digito verificador do ' + tipo + ' nao esta correto.');
         return false;
      }  
   }
}