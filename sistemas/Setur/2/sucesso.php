  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="UTF-8">
    <title>Jovem em Ação Floripa</title>
    <link rel="stylesheet" href="css/normalize.css">
    <script src="js/prefixfree.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/estilo.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
  </head>

      <div class="container">
        <div class="alert alert-danger hide" id="error"></div>
        <div class="form" role="form">

        <div class="row">
            <div class="col-md-12">
                <img src="img/capa.jpg" class="fcc"> 
            </div> 
        </div>
        </div>
 <br>
 <br>
 <br>
       <h4>Sua inscrição no Jovem em Ação Floripa foi realizada com <b>sucesso</b>!!</h4>

        <h4><font color="red"> Traga um documento de identidade  </font><br /> junto com o número de inscrição:</h4>
       <h4></h4><h3 align="center"><Strong><font color="red" size="30"><? print $_POST['id1']; ?></font></Strong></h3>
       <br>
       <h4>O curso ocorrerá no dia <font color="red" size="5">29/11 - <? switch ($_POST['turno']){
					case "1":
					   echo "Matutino - 08:30 / 11:30";
						break;
					case "2":
					   echo "Vespertino - 14:00 / 17:00 ";
						break;
					case "3":
					   echo "Noturno - 19:00 / 22:00 ";
						break;
					default: 
					  break;
					} ?> </font> no seguinte endereço:</h4><br />
       <br><br>
		<p>CRC-SC - Conselho Regional de Contabilidade de Santa Catarina</p>
		<p>Av. Osvaldo Rodrigues Cabral, 1900 - Centro, Florianópolis - SC, 88015-710</p>
		<p><font color="red">Acesso pela rua dos fundos – Rua Almirante Lamego.</font></p>
       <br><br><br>
       <p>Qualquer alteração na ficha de inscrição deve ser solicitado por email, junto com o número de inscrição, para: <font color="red"><strong>juventude@pmf.sc.gov.br</strong></font></p>
       <p>Dúvidas e informações: <font color="red">(48) 3333-8862 - RENAPSI-SC</font></p>
       <br><br>


         <input type="button" id="btnImprimir" value="Imprimir" onclick="window.print();">
</div>  

</body>

  </html>