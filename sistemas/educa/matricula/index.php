<?php

header('location: http://sgeweb.pmf.sc.gov.br/matricula');

die;

session_name('ma');
session_start();

date_default_timezone_set('America/Sao_Paulo');
$fechar = date('d-m-Y') >= '12-02-2014';
$fechar = 'true';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SGE &middot; Página Inicial</title>
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
      </head>

      <body>

        <div class="container">
            <?php include 'shared/topo.php'; ?>
            <?php include 'shared/barraTopo.php'; ?>
            <div class='conteudo'>
             <br>
             <div class='row-fluid' style='text-align: center; height: 90px;'>
                <div style='text-align: center; padding-top: 15px;'>
                    <!-- <h1 style='font-size:30px;'>Matrículas fechadas!</h1>
                    <img src="img/lapis.png" style="width: 550px; position:relative; top: -65px; left: -25px;"> -->
                </div>
            </div>
            <div class='row-fluid' style='text-align: center; padding-top: 20px; padding-bottom: 20px;'>


                     <!--<div style='margin-left:auto; margin-right:auto; 
                         width: 400px; height: 250px; border-radius: 5px; 
                         background: #eee; border-color: #9a9aff; border-width: 1px; border-style: solid;'>
                        <br><br><br><br><br><br><p>Vídeo</p>
                    </div>-->
                    <img src="img/fotoPaginaInicial.jpg"/>
<!--					<object width="550" height="340">
					<param name="movie" value="http://www.youtube.com/v/AJlP6aeR6Lo?rel=1&color1=0x2b405b&color2=0x6b8ab6&fs=1&border=1&fs=1&autoplay=0&showsearch=0&cc_load_policy=1&iv_load_policy=1&showinfo=0&rel=0&egm=0"></param>
						<param name="allowFullScreen" value="true"></param>
						<embed src="https://www.youtube.com/v/AJlP6aeR6Lo?rel=1&color1=0x2b405b&color2=0x6b8ab6&fs=1&border=1&fs=1&autoplay=0&showsearch=0&cc_load_policy=1&iv_load_policy=1&showinfo=0&rel=0&egm=0"
						type="application/x-shockwave-flash"
						width="550" height="340" 
						allowfullscreen="true"></embed>
						</object>
                     <br>-->
                     <!--<p style='width:90%; margin-left:auto; margin-right:auto;'>Seja bem vindo ao sistema de Gerenciamento Escolar da Prefeitura Municipal de Florianópolis.</p> -->
                 </div>
                 <div class="row-fluid">                    
                    <div class="span1">
                    </div>
                    <div class="span5">
                        <h3>Ensino Fundamental</h3>
                        <p>Aqui você pode realizar a Matrícula e a Rematrícula para alunos do Ensino Fundamental da Rede Municipal de Ensino. Se você já estuda na Rede Municipal, clique em Rematrícula. Se você ainda não é aluno da Rede Municipal, clique em Novo Aluno.</p>
                        <!--<p><a class="btn btn-primary" href="loginRematricula.php">Rematrícula &raquo;</a>-->
                        <p><a class="btn btn-primary" 
                            <?php if($fechar != 'true'){ 
                                echo "href='loginRematricula.php'";
                            } else echo 'disabled';
                                ?>>Rematrícula &raquo;</a>
                                <a class="btn btn-primary"  
                                <?php if($fechar != 'true'){
                                    echo 'href="novoAluno.php"';
                                } else echo 'disabled'; ?>
                                >Novo Aluno &raquo;</a></p>
                            </div>
                            <div class="span5">
                                <h3>EJA</h3>
                                <p>Aqui você pode realizar a Matrícula e a Rematrícula para alunos da Educação de Jovens e Adultos da Rede Municipal de Ensino de Florianópolis. Se você já estuda em uma escola da Rede Municipal, clique em Rematrícula. Se você ainda não é aluno da Rede Municipal, clique em Novo Aluno.</p>
                                <p><a class="btn btn-primary" disabled>Rematrícula &raquo;</a>
                                    <a class="btn btn-primary" 
                                    <?php if($fechar != 'true'){ echo 'href="novoAlunoEJA.php"';
                                } else echo 'disabled'; ?>
                                >Novo Aluno &raquo;</a></p>
                            </div>               
                            <div class="span1">
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
