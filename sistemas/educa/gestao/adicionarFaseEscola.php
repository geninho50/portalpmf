<?php
session_name('ga');
session_start();

//EXPIRA A SESSAO SE NAO HOUVE ATIVIDADE NOS ULTIMOS 30 MINUTOS
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset(); 
    session_destroy();
    header("Location: index.php");
}
$_SESSION['LAST_ACTIVITY'] = time();

 if (isset($_SESSION['aut_gm'])) {
     if ($_SESSION['aut_gm'] != true) {
         header('Location: index.php');
     }
 } else {
    header('Location: index.php');
}

if (!isset($_GET['idEscola'])) {
  header('Location: manutencaoEscolas.php');
} else {
  include 'fnc/buscaEndereco.php';
  $endereco = buscaEndereco($_GET['idEscola']);
  if ($endereco != FALSE) {
    $end['cep'] = substr($endereco[1][11], 0, 2) . '.' . substr($endereco[1][11], 2, 3) . '-' . substr($endereco[1][11], 5, 3);
    $end['logradouro'] = $endereco[1][6];
    $end['complemento'] = $endereco[1][8];
    $end['numero'] = $endereco[1][7];
    $end['bairro'] = $endereco[1][3];
  }


  include 'fnc/buscaEscola.php';
  $escola = buscaEscola($_GET['idEscola']);

    //$fases = buscaFases($_GET['idEscola']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>SGE &middot; Editar Escola</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Le styles -->
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <![endif]-->

          <!-- Fav and touch icons -->
          <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
          <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
          <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
          <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
          <link rel="shortcut icon" href="ico/favicon.png">
          <style>
            .controls {
              text-align: left;
              padding-left: 40px;
            }
            .control-group {
              padding-left: 120px;
            }
          </style>
        </head>

        <body>

          <div class="container">

            <div id='topo' class="masthead">
              <div class='row-fluid' style="margin-bottom: 5px;">
                <div class="span2" style='margin-top: 5px;'>
                  <img style="width: 100px;" src="img/logo.png"/>
                </div>
                <div class="span8" style="margin-left: 0px;">  
                  <h4>Prefeitura Municipal de Florian&oacute;polis</h4>
                  <h5 style="margin-top: -10px;">Secretaria Municipal de Educa&ccedil;&atilde;o</h5>
                  <h6 style="margin-top: -10px;">Sistema de Gerenciamento Escolar</h6>
                </div>
                <div class="span2" style="text-align: right; margin-top: 3px;">
                  <img style="width: 80px;" src="img/logoSistema.png"/>
                </div>
              </div><!-- /.navbar -->
            </div>
            <?php include 'shared/barraTopo.php'; ?>
            <div class='conteudo' style='min-height: 500px;'>
              <div class='row-fluid' style='text-align: center; padding-top: 20px;'>
              <h2 style='font-size:30px;'>Editar Escola</h2>
                    <h4><?php echo ($escola[1][1]); ?></h4>
                </div>
                <hr>
                <div class="row-fluid">
                  <div class="span12" style='padding: 20px; padding-top: 0px;'>
                    <div>
                      <div class="tab-pane" id="tabEndereco">
                        <div style='display: inherit;'>
                          <h4>Adicionar Fase</h4>
                          <?php
                          if (isset($_GET['sucesso'])) {
                            if ($_GET['sucesso'] == true) {
                              ?>
                              <div class='sucesso'>
                                <strong>Sucesso!</strong> Fase adicionada com sucesso. 
                                <a class='btn btn-success' href='visualizarEscola.php?idEscola=<?php echo $_GET["idEscola"];?>'>Visualizar</a>
                              </div>
                              <?php
                            } else {
                              ?>
                              <div class='erro'>
                                <strong>Erro!</strong> Um erro ocorreu, tente novamente.
                              </div>
                              <?php
                            }
                          }
                          ?>
                          <form class='form-horizontal' method='post' action="insereFaseEscola.php">
                            <input type='hidden' value='<?php echo $_GET['idEscola']; ?>' name='id'>
                            
                            <div class="control-group highlight" style="padding-top: 5px;">
                              <label class="control-label" for="inputCurso">Curso</label>
                              <div class="controls">
                                <select name='curso' id="inputCurso" required 
                                onchange='$.get( "ajax/fases.php", { curso: $(this).val() } )
                                .done(function( data ) {
                                $("#inputFases").html(data);
                                $("#inputFases").css("display", "inherit");
                              });'>
                              <option></option>
                              <?php
                              include 'fnc/buscaCursos.php';
                              $cursos = buscaCursos();
                              foreach ($cursos as $key => $value) {
                                echo '<option value="' . $key . '">' . ($value[1]) . '</option>';
                              }

                              ?>
                            </select>
                          </div>
                        </div> 
                        <div class="control-group highlight" style="padding-top: 5px;">
                          <label class="control-label" for="inputAno">Ano</label>
                          <div class="controls">
                            <select name='ano' id="inputAno" required>
                              <option></option>
                              <?php
                              include 'fnc/buscaPeriodos.php';
                              $periodos = buscaPeriodos();
                              foreach ($periodos as $key => $value) {
                                echo '<option value="' . $key . '">' . ($value[0]) . '</option>';
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="control-group highlight" style="padding-top: 5px;">
                          <label class="control-label" for="inputFases">Fase</label>
                          <div class="controls">
                            <select name='fase' id="inputFases" required>
                              <option></option>
                            </select>
                          </div>
                        </div> 
                        <button class='btn btn-primary pull-right' style="margin-left: 5px;">Adicionar</button>
                        <a href="editarEscola.php?idEscola=<?php echo $_GET["idEscola"];?>" class="btn pull-right">Voltar</a>  
                      </form>
                    </div>
                  </div>


                </div>
              </div>
            </div>   
          </div>
        </div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/bootstrap.js"></script>       

      </body>
      </html>
