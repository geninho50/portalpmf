<?php
session_name('ma');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>SGE &middot; Perguntas Frequentes</title>
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

            <div id='topo' class="masthead">
                <div class='row-fluid' style="margin-bottom: 5px;">
                    <div class="span2" style='margin-top: 5px;'>
                        <img style="width: 90px;" src="img/logo.png"/>
                    </div>
                    <div class="span8" style="margin-left: 0px;">  
                        <h4>Prefeitura Municipal de Florian&oacute;polis</h4>
                        <h5 style="margin-top: -6px;">Secretaria Municipal de Educa&ccedil;&atilde;o</h5>
                        <h6 style="margin-top: -9px;">Sistema de Gerenciamento Escolar</h6>
                    </div>
                    <div class="span2" style="text-align: right; margin-top: 3px;">
                        <img style="width: 80px;" src="img/logoSistema.png"/>
                    </div>
                </div><!-- /.navbar -->
            </div>
				
				<?php include 'shared/barraTopo.php'; ?>
            
					<div class='conteudo'>
						<div id='textoPerguntasFrequentes'>
						
						<br>
						<h3 style='width:90%; margin-left:10px; margin-right:auto;'> Perguntas Frequentes </h3>
						<br>
						<p style='width:90%; margin-left:10px; margin-right:auto; color:#1c5b86; font-weight:bold;'>P: Sou aluno do Ensino Fundamental de uma Escola Municipal, como faço para me rematricular?</p>
						<p style='width:90%; margin-left:18px; margin-right:auto;'>R: Para se rematricular na Rede Municipal de Ensino basta clicar em 'Rematrícula' na aba 'Ensino Fundamental' da página inicial e seguir os passos indicados na tela. Mantenha todos os dados atualizados, eles são importantes para que sua rematrícula seja efetivada com sucesso.</p>
						<br>
						<p style='width:90%; margin-left:10px; margin-right:auto; color:#1c5b86; font-weight:bold;'>P: Não sou aluno de uma Escola Municipal, como faço para me matricular no Ensino Fundamental?</p>
						<p style='width:90%; margin-left:18px; margin-right:auto;'>R: Para se matricular na Rede Municipal de Ensino basta clicar em 'Novos Alunos' na página inicial e seguir os passos indicados na tela. Mantenha todos os dados atualizados, eles são importantes para que sua matrícula seja efetivada com sucesso.</p>
						<br>
						<p style='width:90%; margin-left:10px; margin-right:auto; color:#1c5b86; font-weight:bold;'>P: Fechei meu navegador antes de confirmar minha inscrição. Meus dados foram salvos?</p>
						<p style='width:90%; margin-left:18px; margin-right:auto;'>R: Não! Os dados só são salvos quando você recebe a mensagem que sua inscrição foi confirmada.</p>
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
