<?php
include "backend/db.php"; 


$id = $_GET['id'];
$idBotSub = "btnSubmit";
if($id != null){
    $sql = $db->prepare("SELECT * FROM `infraestrutura`.`dados` where `id` = $id");
    $sql->execute();
    $data = $sql->fetch(PDO::FETCH_ASSOC);

    if($data != ''){
        $nome            = utf8_encode($data['nome']);
        $localidade      = utf8_encode($data['localidade']);
        $fone            = utf8_encode($data['fone']);
        $email           = utf8_encode($data['email']);
        $proposta        = utf8_encode($data['proposta']);
        $justificativa   = utf8_encode($data['justificativa']);
        $metodologia     = utf8_encode($data['metodologia']);
        $entidade        = utf8_encode($data['entidade']);
    }    
    $idBotSub = "update";
}
?>

<!DOCTYPE HTML> 
<html>
  <head>
    <title>SISTEMA DE ESGOTAMENTO SANITÁRIO</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
  </head>
  <body>


    <!-- One -->
      <section id="One" class="wrapper style3">
        <div class="inner">
          <div class="logo">
            <img src="images/Prefeitura.png" alt=""/>
          </div>
          <header class="align-center">
            <h2><Strong>CONSULTA PÚBLICA</Strong></h2>
            <h2>CONCEPÇÃO GERAL DO SISTEMA DE ESGOTAMENTO SANITÁRIO</h2>
          </header>
        </div>
      </section>

    <!-- Main -->
      <div id="main" class="container">
              <!-- Form -->
                <h2>Agradecemos a participação!</h2>
                <p>Caso queira inserir um documento, envie-o para o email: ouvindoasociedade@pmf.sc.gov.br</p>

                    <div class="12u$">
                      <ul class="actions">
                                         
                    <a href="http://www.pmf.sc.gov.br/" class="button alt">SAIR</a>
               
                      </ul>
                    </div>
                  </div>
                </form>


            </div>
          </div>

      </div>


    <!-- Footer -->
      <section id="One" class="wrapper style3">
        <div class="inner">
          <header class="align-center">
              <img src="images/Prefeitura.png" alt=""/>
          </header>
        </div>
      </section>

    <!-- Scripts -->
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/jquery.maskedinput.min.js" type="text/javascript"></script>
      <script src="assets/js/jquery.scrollex.min.js"></script>
      <script src="assets/js/skel.min.js"></script>
      <script src="assets/js/util.js"></script>
      <script src="assets/js/main.js"></script>

  </body>
</html>