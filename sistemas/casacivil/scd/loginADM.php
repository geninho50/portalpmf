<?php 
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="/../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="https://www.pmf.sc.gov.br/sistemas/casacivil/scd/estilo.css" />
        <title>Formulario para liberação de IP</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <script src="js/bootstrap.min.js"></script>
        
    </head>
    <body>
        <div  role="form">
            <div  class="loginAdm masthead">
                <div class="boxLogin">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Login</label>
                            <input type="text" class="form-control input-sm" id="login" placeholder="">
                        </div>
        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Senha</label>
                            <input type="password" class="form-control input-sm" id="senha" placeholder="" >
                        </div>
                            
                        <div class="alert alert-danger hide" id="error"></div>
                        
                        <button type="button" id="sendPesquisa" class="btn btn-primary btn-xs">Logar</button>
                </div>
            </div>
        </div>
        
        <script src="https://www.pmf.sc.gov.br/sistemas/casacivil/scd/jquery.maskedinput.js"></script>
        <script>

        $('input').bind('focus',function(){
            $('#error').addClass('hide');
        });
        
        
        $('#sendPesquisa').bind('click',function(){
            $('#error').addClass('hide');
            
            var err = '';
            var obj = {
                login : $('#login').val(),
                senha : $('#senha').val()
            };

            $.post( "backend/testeLogin.php", obj).done(function( data ) {  
                var retorno = jQuery.parseJSON(data);
                if(retorno.success == 1){
                    location.href = "decidirADM.php";
                }else{
                    $('#error').text(retorno.error).removeClass('hide');
                }
                
                console.log( data );
            });
        });
        
        $(document).keypress(function(e) {
          if ( e.which == 13 ) {
            $('#error').addClass('hide');
            
            var err = '';
            var obj = {
                login : $('#login').val(),
                senha : $('#senha').val()
            };
                $.post( "backend/testeLogin.php", obj).done(function( data ) {  
                    var retorno = jQuery.parseJSON(data);
                    if(retorno.success == 1){
                        location.href = "decidirADM.php";
                    }else{
                        $('#error').text(retorno.error).removeClass('hide');
                    }
                    
                    console.log( data );
                });
          }
        });
        </script>
        
    </body>