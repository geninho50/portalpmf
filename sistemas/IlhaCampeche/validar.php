<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reservar.css" />
  <link rel="stylesheet" href="css/modalReserva.css" />
  <script src="js/modal.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.dsgovserprodesign.estaleiro.serpro.gov.br/design-system/fonts/rawline/css/rawline.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800,900&amp;display=swap" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <title>Valida Voucher</title>
</head>


<div id="modal" class="modal">
    <div class="modal-content">
      <p>Voucher validado com sucesso!</p>
      <button class="modal-button" onclick="redirecionar()">OK</button>
    </div>
  </div>


<?php 

include_once("banco/gdb.php");

$db        = new gdb( );

$codigo    = $db->vargetpost("codigo");
$voucodigo = intval( substr($codigo,0,8)  );
$acocodigo = intval( substr($codigo,9,8) );

echo "<div class='alinhaCards'>";
if( $acocodigo == 0 ){
    $db->open("select *, 
                    DATE_FORMAT( voudata,'%d/%m/%Y') as dvisita 
                from voucher vou, 
                    pessoa pes 
              where pescodigo = voupescodigo 
                and voudata>=CURDATE()
                and voucodigo = '$voucodigo' ");

        voucher($db->gs['PESNOME'][0],
                $db->gs['PESCPF'][0], 
                $db->gs['DVISITA'][0],
                $file, 
                $voucodigo, 
                0 );
}else{
    $db->open("select *, 
                    DATE_FORMAT( voudata,'%d/%m/%Y') as dvisita 
               from voucher vou,
                    acompanhante aco, 
                    pessoa pes 
              where pescodigo        = voupescodigo 
                and aco.acovoucodigo = vou.voucodigo 
                and vou.voudata>=CURDATE()
                and vou.voucodigo        = '$voucodigo'
                and aco.acocodigo = '$acocodigo' ");

        voucher($db->gs['ACONOME'][0],
                $db->gs['ACODOCUMENTO'][0],
                $db->gs['DVISITA'][0],
                $file,
                $voucodigo,
                $db->gs['ACOCODIGO'][0] );
}

function voucher($nome, $cpf, $dvisita, $file,$voucodigo,$value ){    

    $voucodigo2  = str_pad($voucodigo, 8, '0', STR_PAD_LEFT)."A".str_pad($value, 8, '0', STR_PAD_LEFT);
    $cpf2        = substr($cpf,0,3)."****".substr($cpf,7,4);

    if(trim($nome) !=="" ){?>   
           
              <div class="container">   
                <img src="images/logopmfbranco.png" alt="Logo" class="logo">
                <div class="linha-branca"></div>                
                <h2>ILHA DO CAMPECHE</h2>
                <h2><?=$dvisita; ?></h2>                
                <img src="images/certo.jpg" width="200px;" height="200px;" >
                <h3><?=$voucodigo2; ?></h3>
                <h4> Titular: <?=$nome; ?> </h4>
                <h4> CPF: <?=$cpf2; ?> </h4>
                <h4> Data: <?=date('d/m/Y'); ?> </h4>
              </div>
                
                <input class="btnValidar btnValidarVoucher" type="button" value="Validar voucher" onclick="abrirModal()">
                  
                
                <input class="btnValidar btnCancelarVoucher" type="button" value="Cancelar voucher">
                  
                </div>
                </div>
            
            
   <?php }else{ ?>
            <div class="container">   
                <img src="images/logopmfbranco.png" alt="Logo" class="logo">
                <div class="linha-branca"></div>                
                <h2>ILHA DO CAMPECHE</h2>
                <h2><?=$dvisita; ?></h2>                
                <img src="images/invalido.jpg" width="200px;" height="200px;" >
                <h2><?=$voucodigo2; ?></h2>
                <h4> Esse voucher &eacute; inv&aacute;lido !</h4>
                <h4>  </h4>
                <h4> </h4>
            </div></div>   
<?php
 }
}
?>

<style>
body {
margin: 0;
padding: 0;
background-color: #f2f2f2;
}

.alinharH4 {
display: flex;
justify-content: center;
}

.alinhaCards {
font-family: Arial, sans-serif;
display: flex;
flex-wrap: wrap;
align-items: center;
justify-content: center;
flex-direction: column;

}

.container {
margin: 1%;
text-align: center;
max-width: 250px;
padding: 20px;
background: linear-gradient(to bottom right, #002f66, #0093d4);
border-radius: 20px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
color: #fff;
}

.logo {
max-width: 250px;
}

.linha-branca {
width: 100%;
height: 1px;
background-color: #fff;
margin: 10px 0;
}
.validacaoDeVoucher{
  display:flex;
  flex-direction:row;
  margin: 2%;
}
.btnValidar{
  margin:2%;
  margin: 10px;
  height: 60px;
  width: 250px;
  font-weight: 600;
  font-size: 1rem;
  cursor: pointer;
  border-radius: 10px;
  border-style: none;
}

.btnValidarVoucher{
  background-color: var(--verdeValidar) ;
  color: var(--brancoPmf);
}
.btnCancelarVoucher{
  background-color: var(--vermelhoCancelar) ;
  color: var(--brancoPmf);
}
</style>
