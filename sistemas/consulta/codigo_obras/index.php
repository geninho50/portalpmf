<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Código de Obras e Edificações</title>
    <link type="image/x-icon" rel="shortcut icon" href="img/brasao.gif">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/estilos.css" rel="stylesheet">
    <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <link href='https://fonts.googleapis.com/css?family=Cabin+Condensed:700' rel='stylesheet' type='text/css'>
  </head>

  <body>
    <div class="jumbotron">
      <div>
       <img class ='logo' src="img/Logo PMF-01.png" />
      </div>
    </div>

    <div class="container">
     <?php 
      $hoje = date('d-m-Y'); 
      $hoje = strtotime($hoje);
      $final = date('05-08-2016');
      $final = strtotime($final);
      if($hoje < $final) { ?>
     
       <h2>A importância da revisão do Código de Obras e Edificações</h2>

       <p>Após 16 anos em vigor, o Código de Obras de Florianópolis, que é o instrumento legal que regula os preceitos relativos às construções e edificações do município passará por uma revisão.</p>
       <p>O Avanço tecnológico ocorrido nas últimas décadas trouxe o desenvolvimento de novos materiais e técnicas de construção, a consolidação do conceito de prática sustentáveis aliadas às edificações, novos instrumentos de monitoramento das constuções, alterações na legislação edilícia a nível federal, municipal e estadual, e até modificações na economia e no mercado da construção civil, motivos estes que justificam a necessidade da revisão do código de Obras, para atualizá-lo diante da nova realidade.
       </p>

       <h2>Do que trata o Código de Obras</h2>

       <p>No código de Obras encotramos a definição das responsabilidades do ato de construir, as normas administrativas para a aprovação dos projetos e para o licenciamento das obras, as obrigações durante as obras, as infrações e penalidades aplicáveis no descumprimento das regras edilícias, a regulamentação das demolições, as exigências relativas à funcionalidade, a higiene e o conforto das edificações, os parâmetros para estacionamento, as exigências para equipamentos e instalações, entre outros.</p>


       <div class="caixa">
         <h4>Arquivo para download</h4>
         <a href="http://www.pmf.sc.gov.br/arquivos/arquivos/pdf/07_03_2016_10.59.11.15cb00bd9a43e0d8f9e26413d531daad.pdf" target="_Blank">* LEI COMPLEMENTAR Nº 060/2000, de agosto de 2000.</a>

       </div>

       <h2>Envie sua contribuição</h2>

       <p>Para participar do processo de revisão, basta preencher o formulário abaixo e enviar sua sugestão para a Comisão de revisão do Código de Obras e Edificações de Florianópolis. As contribuições podem ser enviadas pelo site até o dia 05 de AGOSTO de 2016.</p>


      <form>
        <div class="form-group">
          <label for="exampleInputEmail1">Nome:</label>
          <input type="text" class="form-control" id="nome">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">E-mail:</label>
          <input type="email" class="form-control" id="email">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Profissão/Ocupação/Entidade:</label>
          <input type="text" class="form-control" id="ocupacao">
        </div>
        
        <select class="form-control" id="tema">
    		  <option value="1" >1 - DIREITOS E RESPONSABILIDADES</option>
    		  <option value="2" >2 - NORMAS ADMINISTRATIVAS</option>
    		  <option value="3" >3 - INFRAÇÕES E PENALIDADES</option>
    		  <option value="4" >4 - EXECUÇÃO DE OBRAS</option>
    		  <option value="5" >5 - NORMAS TECNICAS</option>
    		  <option value="6" >6 - ACESSIBILIDADE</option>
    		  <option value="7" >7 - SUSTENTABILIDADE</option>
    		  <option value="8" >8 - OUTROS</option>
    	   </select>

        <div class="form-group">
          <label for="exampleInputEmail1">Sugestão</label>
          <textarea type="text" class="form-control" id="sugestao"></textarea>
        </div>

        <input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Enviar" />
        <div class="error alert alert-danger"></div>
      </form>
    </div>
    <?php }else{ ?> 
      <h1>Consulta Pública sobre a revisão do Código de Obras e Edificações LEI COMPLEMENTAR Nº 060/2000, de agosto de 2000. FINALIZADA</h1>
    <?php } ?>
  </body>

<script>
 $('#submit').bind('click',function(){
        $('#error').addClass('hide');
        var err = '';
        var obj = {
            nome          : $('#nome').val(),
            email         : $('#email').val(),
            ocupacao      : $('#ocupacao').val(),
            sugestao      : $('#sugestao').val(),
            tema          : $('#tema').val()
        };


        $.post( "cadastrarRevisao.php", obj).done(function( data ) { 
            var retorno = jQuery.parseJSON(data);
            if(retorno.sucesso == 1){
              console.log("CHEGOU");
                location.href = "resultados.php";
            }else{  
                $('#error').text(retorno.erro).removeClass('hide');
                $('.error').removeClass('error');
                $('#' + retorno.idErro).addClass('error');
                window.scrollTo(0, 0);
            }
        });
    });
</script>

</html>