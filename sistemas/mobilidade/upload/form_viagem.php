<?php
session_start();


?>
<!DOCTYPE HTML>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <!-- Adicionando JQuery consulta CEP-->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!-- máscaras para input formularios !-->
    <script type="text/javascript" src="jquery.mask.min.js"></script>
    <script type="text/javascript" src="jquery-ui.min.js"></script>

</head>

<body>

    <!--CABECALHO -->
    <div class="container" role="main">

        <br>
        <div class="page-header rounded">
            <img src="http://redemobilidade.pmf.sc.gov.br\bas\img\cabecalho_02.jpg" class="img-fluid rounded" alt="Imagem responsiva">
        </div>
        <br>
        <div class="container border rounded border-primary" role="main">
            <br>
            <div align=center>
            <a href="rededemobilidade.pmf.sc.gov.br" class="btn btn-warning" align=center >Fechar | Voltar Rede de Mobilidade</a>
            </div><br>
            <!-- Formulário de Editar dados dos Usuários !-->


            <form method="post" id="formuser" action="envia.php">
                <h4 class="bg-primary  text-white"> Cadastro de Usuários</h4>
                <span id="msg-error"></span>

                <div class="form-row">
                    <div class="form-group col-3">
                        <label class="col-form-label">data da viagem: </label>
                        <input name="data" type="date" id="data" class="form-control" />
                    </div>
                    <div class="form-group col-3">
                        <label class="col-form-label">Horário: </label>
                        <input name="rg" type="text" id="rg" class="form-control" size="15" placeholder="RG-Sócio 1" />
                    </div>
                    <div class="form-group col-3">
                        <label class="col-form-label">CPF: </label>
                        <input name="cpf" type="text" id="cpf" class="cpf form-control" size="20" placeholder="CPF-Sócio 1" />
                    </div>

                    <div class="row">
               
                    <div class="col-sm-9"><label class="col-form-label">Comprovante de Residência1</label>
                        <div class="custom-file">
                            <input type="file" name="file2" class="custom-file-input" id="file" onchange="return validararquivo()" />
                            <label class="custom-file-label" for="file">Escolha o arquivo</label>



                        </div>
                    </div>
                    
                    
                    
                
                </div>


                </div>
     
                    <button type="submit" value="Cadastrar" class="btn btn-success">Cadastrar Viagem</button>
                    <a href="pdv.html" class="btn btn-warning" align=center >Fechar | Voltar</a></div>
                </div>
                <br>
            </form>
            
            <br>
            <div class="p-3 mb-2 bg-primary text-white">
            <h5> Prefeitura Municipal de Florianópolis</h5>
            <h6>Secretaria de Mobilidade e Planejamento Urbano </h6>
            Rua Felipe Schmidt, n° 1320 – Centro - CEP 88.010-002 – Florianópolis/SC.<br>
        </div>

        </div><br>
        </div>

        <br>
    </div>

    <script>
        function validar() {
            var nome = formuser.nome.value;
            var nome = nome.trim();
            var email = formuser.email.value;
            var email = email.trim();




            var nome = formuser.nome.value;
            var nome = nome.trim();
            var rg = formuser.rg.value;
            var cpf = formuser.cpf.value;


            var cep = formuser.cep.value;
            var complemento = formuser.complemento.value;

            //ANALISE DE EMAIL

         
            if (nome == "") {
                $("#msg-error").html('<div class="alert alert-danger" role="alert">Necessário indicar responsável - Preencher o campo <b>Nome!</b></div>');
                formuser.nome.focus();
                return false;
            }

      

            if (rg == "") {
                $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencher corretamente o <b>RG!</b></div>');
                formuser.rg.focus();
                return false;
            }

            if (cpf == "") {
                $("#msg-error").html('<div class="alert alert-danger" role="alert">Obrigatório informar <b>CPF!</b></div>');
                formuser.cpf.focus();
                return false;
            }

            if (cpf != "") {

                var strCPF = formuser.cpf.value;
                strCPF = strCPF.replace(/[_\W]+/g, "");

                if (TestaCPF(strCPF) === false) {
                    $("#msg-error").html('<div class="alert alert-danger" role="alert"><b>CPF INVÁLIDO!</b></div>');
                    formuser.cpf.focus();
                    return false;
                }
            };
       
            if (cep == "") {
                $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencher corretamente o <b>CEP</b></div>');
                formuser.cep.focus();
                return false;
            }

            if (complemento == "") {
                $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencher corretamente o <b>complemento</b></div>');
                formuser.complemento.focus();
                return false;
            }

            $("#msg-error").html('<div class="alert alert-success" role="alert">Registro Válido</div>');

        };


        function TestaCPF(strCPF) {
            var Soma;
            var Resto;
            Soma = 0;
            if (strCPF == "00000000000" ||
                strCPF == "11111111111" ||
                strCPF == "22222222222" ||
                strCPF == "33333333333" ||
                strCPF == "44444444444" ||
                strCPF == "55555555555" ||
                strCPF == "66666666666" ||
                strCPF == "77777777777" ||
                strCPF == "88888888888" ||
                strCPF == "99999999999"

            ) return false;

            for (i = 1; i <= 9; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
            Resto = (Soma * 10) % 11;

            if ((Resto == 10) || (Resto == 11)) Resto = 0;
            if (Resto != parseInt(strCPF.substring(9, 10))) return false;

            Soma = 0;
            for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
            Resto = (Soma * 10) % 11;

            if ((Resto == 10) || (Resto == 11)) Resto = 0;
            if (Resto != parseInt(strCPF.substring(10, 11))) return false;
            return true;
        };


        function validarCNPJ(cnpj) {
 
 cnpj = cnpj.replace(/[^\d]+/g,'');

 if(cnpj == '') return false;
  
 if (cnpj.length != 14)
     return false;

 // Elimina CNPJs invalidos conhecidos
 if (cnpj == "00000000000000" || 
     cnpj == "11111111111111" || 
     cnpj == "22222222222222" || 
     cnpj == "33333333333333" || 
     cnpj == "44444444444444" || 
     cnpj == "55555555555555" || 
     cnpj == "66666666666666" || 
     cnpj == "77777777777777" || 
     cnpj == "88888888888888" || 
     cnpj == "99999999999999")
     return false;
      
 // Valida DVs
 tamanho = cnpj.length - 2
 numeros = cnpj.substring(0,tamanho);
 digitos = cnpj.substring(tamanho);
 soma = 0;
 pos = tamanho - 7;
 for (i = tamanho; i >= 1; i--) {
   soma += numeros.charAt(tamanho - i) * pos--;
   if (pos < 2)
         pos = 9;
 }
 resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
 if (resultado != digitos.charAt(0))
     return false;
      
 tamanho = tamanho + 1;
 numeros = cnpj.substring(0,tamanho);
 soma = 0;
 pos = tamanho - 7;
 for (i = tamanho; i >= 1; i--) {
   soma += numeros.charAt(tamanho - i) * pos--;
   if (pos < 2)
         pos = 9;
 }
 resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
 if (resultado != digitos.charAt(1))
       return false;
        
 return true;
 
}


    </script>

</body>

</html>