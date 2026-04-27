<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Telao</title>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../layout/pmf-estilo-entidades.css" type="text/css">
   <link rel="stylesheet" href="../../layout/pmf-estilo.css" type="text/css">
    <link href="estilo.css" rel="stylesheet">

  </head>
  <body>
  	<div id="conteudo">
      <img src="http://www.pmf.sc.gov.br/layout/imagens/marca-pmf.png" id="logo">
      <h1>NOTÍCIAS PORTAL PMF</h1>
      
      <div id="caixa_branca" class="animacao">
        <p id="origem"></p>
        <img src="" id="imagem">
        <div id="textos">
          <p id="titulo"></p>
          <div id="manchete"></div>
        </div>
      </div>
      <img src="http://www.pmf.sc.gov.br/layout/imagens/cabecalho.jpg" id="fundo_site">
  	</div>
   <div id="caixa_total">  <img src="http://www.pmf.sc.gov.br/layout/imagens/cabecalho.jpg"> </div>
  </body>
</html>


<script>
function getNoiticias(){
  contador = 0;
  interrompeu = false;

	$.getJSON( "getNoticias.php" ,function( noticias ) {
		noticiasArr = $.makeArray(noticias);

    function mostrar_avisos(){
      contadorAvisos = 0;
      $.getJSON( "getAvisos.php" ,function( avisos ) { 
        avisosArr = $.makeArray(avisos);
        if (avisosArr != '') {
          trocar_aviso();
        }else{
          trocar_noticia();
        }
        function trocar_aviso(){
          if(avisosArr[contadorAvisos].tela_cheia != 1){
          $("#caixa_branca").css('visibility', 'hidden');
          $("#caixa_branca").removeClass('animacao');
          $("#caixa_total").css('visibility', 'hidden');
          $("#titulo").html(avisosArr[contadorAvisos].titulo);
          $("#origem").html(avisosArr[contadorAvisos].origem);
          $("#manchete").html(avisosArr[contadorAvisos].manchete);
          $("#imagem").attr("src", "../../" + avisosArr[contadorAvisos].imagem).load(function(){
            $("#caixa_branca").css({visibility: "visible"});
            $("#caixa_branca").addClass('animacao');
          });
          margin = ( 533 - $('#manchete').height() ) / 4;
          $('#manchete').css('margin-top', margin);
          $('#titulo').css('margin-top', margin);
          }else{
            $("#caixa_total").find('img').attr("src", "../../" + avisosArr[contadorAvisos].imagem).load(function(){
              $("#caixa_total").css({visibility: "visible"});
            });
          }
          contadorAvisos++;
          if(contadorAvisos >= avisosArr.length){
            setTimeout(trocar_noticia, 5000);
          }else{
            setTimeout(trocar_aviso, 5000);
          }
        } 
      });
    }

    mostrar_avisos();

    function trocar_noticia(){
      if( interrompeu == true ){
        $("#caixa_branca").css('visibility', 'hidden');
        $("#caixa_branca").removeClass('animacao');
        $("#caixa_total").css('visibility', 'hidden');
        $("#titulo").html(noticiasArr[contador].titulo);
        $("#origem").html(noticiasArr[contador].origem);
        $("#manchete").html(noticiasArr[contador].manchete);
        $("#imagem").attr("src", "../../" + noticiasArr[contador].imagem).load(function(){
          $("#caixa_branca").css({visibility: "visible"});
          $("#caixa_branca").addClass('animacao');
        });
        margin = ( 533 - $('#manchete').height() ) / 4;
        $('#manchete').css('margin-top', margin);
        $('#titulo').css('margin-top', margin);
        contador++;
        if(contador % 5 == 0){
            interrompeu = false;
        }
        if(contador >= noticiasArr.length){
          setTimeout(getNoiticias, 5000);
        }else{
          setTimeout(trocar_noticia, 5000);
        }
      }else{
         contadorAvisos = 0;
         interrompeu = true;
         mostrar_avisos();
      }
    }
  });
}
getNoiticias();
</script>