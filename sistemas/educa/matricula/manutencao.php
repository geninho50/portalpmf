<?php
session_name('ma');
session_start();
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
            <div class='barraTopoConteudo'>
				
			</div>
            <div class='conteudo'>
                 <br><br>
                <div class='row-fluid' style='text-align: center; height: 90px;'>
                    <div style='text-align: center; padding-top: -10px;'>
                        <h1 style='font-size:50px;position:relative; top: 10px; left: 30px;'>Sistema em Manutenção!</h1>
                        <img src="img/lapis.png" style="width: 700px; position:relative; top: -64px; left: -10px;">
						
                    </div>
                </div>
               <div class='row-fluid' style='text-align: center; padding-top: 20px; padding-bottom: 20px;'>
                    
					
                     <!--<div style='margin-left:auto; margin-right:auto; 
                         width: 400px; height: 250px; border-radius: 5px; 
                         background: #eee; border-color: #9a9aff; border-width: 1px; border-style: solid;'>
                        <br><br><br><br><br><br><p>Vídeo</p>
                    </div>-->
					<br>
					<img src="img/manutencao.png" style="width: 300px; position:relative; top: -20px; left: 20px;">
	
					
                    <div style='text-align: center; padding-top: -10px;'>
                        <h5 style='font-size:30px;position:relative; top: -30px; left: 30px;'>Aguarde...</h1>
                        
						
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
