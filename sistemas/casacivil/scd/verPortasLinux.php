<?php
session_start();
include "backend/db.php"; 
if(!$_SESSION['login']){
    header('Location: ../loginADM.php');
     }
$id = $_GET['id'];
if($id != null){
  $sql = $db->prepare("SELECT * FROM portaslinux where id = $id");
  $sql->execute();
  $data = $sql->fetch(PDO::FETCH_ASSOC);

  if($data != ''){
    $porta    = $data['porta'];
  }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link href="/../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="estilo.css" />
    
  <title>Portas Linux</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/bootstrap.min.js"></script>
    
</head>
<body>
  <div class="headerLogin bg-primary">
    <input type='button' value='Sair' class='sair btn btn-default btn-xs'>
    <input type='button' value='Home' class='home btn btn-default btn-xs'>
    <div id="nomeUsuario"><strong>Nome: </strong><?php echo $_SESSION['login'];?></div>
  </div>

  <div  class="loginAdm masthead">
    <div class="boxDecisao">
      <a href="servidoresLinux.php" class="btn btn-primary portas">Voltar</a>
    </div>
  </div>

  <div  role="form">
    <div class="formulario boxDecisao">
      <label>Portas: <input value="<?=$porta?>" id="porta" class="form-control" type="text" name="porta" /></label>
      <br>
      <input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />      
    </div>
  </div>

  <div class="tabelaPortas">
    <table class="table table-striped">
      <tr>
    	 <th>Portas</th>
       <th>Excluir</th>
      </tr>
  </div>
<?php 
  include "backend/SelectPortasLinux.php";
  echo $tabela;
?>
  </table>
<script src="http://www.pmf.sc.gov.br/sistemas/casacivil/scd/jquery.maskedinput.js"></script>
<script type="text/javascript">
 $("#porta").mask("9999");

 $('.home').bind('click',function(){
    location.href = "decidirADM.php";
  });
  $('.sair').bind('click',function(){
    location.href = "loginADM.php";
  }); 

  function excluir(id){
    var confirmacao = confirm('Você deseja excluir?');
    if(confirmacao){
      var err = '';
      var obj = {id : id};

    $.post( "backend/deletePortasLinux.php", obj).done(function( data ) { 
        var retorno = jQuery.parseJSON(data);
          if(retorno.success != 1){
            $('#error').text(retorno.error).removeClass('hide');
          } else{
            location.href = '';
          }         
      });
  }
}
    $('#submit').bind('click',function(){
    $('#error').addClass('hide');
        var err = '';
        var obj = {
          porta       : $('#porta').val(),
          id_servidor : "<?=$_GET['id']?>"
        };

         $.post( "backend/formPortasLinuxReq.php", obj).done(function( data ) {  
            var retorno = jQuery.parseJSON(data);
            if(retorno.success == 1){
              location.href = '';
            }else{
              $('#error').text(retorno.error).removeClass('hide');              
            }           
        });
    });

</script>
</body>
</html>