<?php

ini_set('error_reporting',E_ALL);
ini_set('display_errors',1);

// EXEMPLO do uso dessa função

// $server = "192.168.12.100"; 
$server = "ldap://ntpmf-ad1.pmf.local"; 
$dominio = ""; 
$user = "11135".$dominio;
$pass = "Ols201581";
 
echo "Aguarde ....";

if ( valida_ldap("ldap://ntpmf-ad1.pmf.local", $user, $pass) ) {
   echo "<br>usuário autenticado";
}


function valida_ldap($srv, $usr, $pwd){

  $ldap_server = $srv;
  $auth_user = $usr;
  $auth_pass = $pwd;

  $connect = ldap_connect($ldap_server, 389);  
  
  if ( !$connect ) {
       echo "<br>Problema na conexão com o Servidor";  
       return false;
  }

  $bind = ldap_bind($connect, $auth_user, $auth_pass);

  if ( !$bind ) {
       echo "<br>Problema na conexão com o Usuário : ".$auth_user;  
       return false;
  } else {
      return true;
  }
  
}

?>
<div class="container" id="item0" style="display:block;" >

    <div class="containers">

         <table class="table table-striped">
            <h1>Cadastro de Email Setorial</h1>
            <th style="width:200px">Secretaria :<input id="secretaria" class="form-control field" type="text" placeholder="Informe a secretaria"></th>
            <th style="width:200px">Setor<input id="setor" class="form-control field" type="text"  placeholder="Informe o setor"></th>
            <th style="width:200px">Sigla<input id="sigla" class="form-control field" type="text"  placeholder="Informe a sigla"/></th>
         </table>

         <table class="table table-striped">
            <th style="width:200px">Senha<input id="a1profissao" class="form-control field" type="password"  placeholder="Informe a senha"/></th>
            <th style="width:200px">Repita Senha<input id="a1endereco" class="form-control field" type="password"  placeholder="Repita a senha" /></th>
        </table>

        <table class="table table-striped">                    
            <th><input id="btnSalvarEmail" class="btn btn-success" type="button" value="Salvar" /></th>
        </table>

    </div>

</div>

<script type="text/javascript">
$(document).ready(function(){
    $('#secretaria').simpleAutoComplete('addm.pmf.sc.gov.br/stm/ajax_recuperar_usuarios_auditoria_simples.php',{
        autoCompleteClassName: 'autocomplete',
        selectedClassName: 'sel',
        attrCallBack: 'rel',
        minLength: 3,
        identifier: 'usuario'
    });
});
</script>

