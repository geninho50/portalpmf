<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Prefeitura de Florianópolis</title>

  <link rel="stylesheet" href="../../layout/pmf-estilo.css" type="text/css">
  <link rel="stylesheet" href="../../layout/pmf-estilo-home-new-2.css" type="text/css">
  <link rel="stylesheet" href="../../scripts/slidesjs/css/global.css">
  <link rel="stylesheet" href="../../scripts/js/ui/jquery-ui.css">
  <link href="../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

  <?php

    include_once("banco/gdb.php");
    include_once("menu.php");

    $gdb = new gdb();
    
	$nome = $gdb->vargetpost("nome");
	$cpf = $gdb->vargetpost("cpf");
	$processo = $gdb->vargetpost("processo");

    if($nome == ''){
       header('Location: index2.php');
    }
    
	/*
	print "<pre>";
	print_r($_GET);
	print_r($_POST);
	print "</pre>";
	*/
	
  ?>

</head>
<body>

  <div style="display:none">
	    <a href="mobile/" title="Link para o portal de acessibilidade">para acessar o portal no modulo de acessibilidade, acesse este link</a>
  </div>

  	<script>

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54979843-1', 'auto');
  ga('send', 'pageview');

</script>


<link href="https://fonts.googleapis.com/css?family=Montserrat:300??,400,500,600,700" rel="stylesheet">
<link rel="stylesheet" href="../../layout/themePMF/css/style.css">

		<div class="mini-header">
	    <ul class="mini-header__items">
	      <li style="font-size: 13px;">Treinamentos Ambulantes - Operação Verão 2020</li>
	    </ul>
	  </div>
	

<div class="header">
  <div class="header__brand">
  	<a href="http://www.pmf.sc.gov.br">
  		<img src="../../images/marca-pmf.svg">
  	</a>
	</div>
	</ul>
</div>

 <?php 
	$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
	$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
	$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
	$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
	$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
	$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
	$symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");

	if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true){
		echo '<div class="flex-container hero-wrapper">';
	}else{
		echo '<div class="flex-container hero-wrapper" style="background-image: url(../rastreabilidade/imagens/praia.jpg);">';  };    ?>

 <!--  style="background-color: #DADADC;" -->

 		
				<div id="busca-home" class="search-bar search-bar--home column6-lg column8-sm column8-xs">
			        <h1 class="hidden-sm hidden-xs">Treinamentos Ambulantes - Operação Verão 2020</h1><br>
			        <p style="color: white;">Passarela Nego Quirido - Av. Governador Gustavo Richard, 5000, Centro, Florianópolis - 150 lugares</p>
              <br><br>
			        <p style="color: white;">(*) Vagas limitadas de acordo com a capacidade da sala de treinamento.</p>
              <p style="color: white;">(**) Datas e horários sujeitos a alteração conforme demanda das inscrições.</p>
              <p style="color: white;">(***) Inscritos deverão assinar presença obrigatoriamente no início e fim do treinamento.</p>
				</div>
		

</div>

		<div class="flex-container hero-wrapper" id="solicite" >
			<div id="busca-home" class="search-bar search-bar--home column6-lg column8-sm column8-xs">
		        <h1 class="hidden-sm hidden-xs">Oi <?php echo $nome ?> escolha o dia, horário e local do seu treinamento:</h1><br>

		 		<div class="row">
		 <div class="col-md-6">
      <h2 style="color: #FDAE45;"><strong>29/out (segunda-feira):</strong></h2>
      <h3 style="color: #00CED1;">ACIF Centro:</h3>
      <input type="radio" name="turma" value="29/out - 16-18hs - ACIF Centro" id="turma1" />
      <label for="turma1" style="font-size: 17px; cursor:pointer;">16h - 18hs</label><br />

      <input type="radio" name="turma" value="29/out - 19-21hs - ACIF Centro" id="turma2" />
      <label for="turma2" style="font-size: 17px; cursor:pointer;">19h - 21hs</label><br />

      <br>
      <h2 style="color: #FDAE45;"><strong>30/out (terça-feira):</strong></h2>
      <h3 style="color: #00CED1;">ACIF Centro:</h3>
      <input type="radio" name="turma" value="30/out - 16-18hs - ACIF Centro" id="turma3" />
      <label for="turma3" style="font-size: 17px; cursor:pointer;"><strong>16h - 18hs</strong></label><br />

      <input type="radio" name="turma" value="30/out -19-21hs - ACIF Centro" id="turma4" />
      <label for="turma4" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label><br />

      <h3 style="color: #00CED1;">ACIF Lagoa:</h3>
      <input type="radio" name="turma" value="30/out -19-21hs - ACIF Lagoa" id="turma5"  />
      <label for="turma5" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label><br />

      <br>
      <h2 style="color: #FDAE45;"><strong>31/out (quarta-feira):</strong></h2>
      <h3 style="color: #00CED1;">ACIF Centro:</h3>
      <input type="radio" name="turma" value="31/out -16-18hs - ACIF Centro" id="turma6"  />
      <label for="turma6" style="font-size: 17px; cursor:pointer;"><strong>16h - 18hs</strong></label><br />

      <input type="radio" name="turma" value="31/out - 19-21hs - ACIF Centro" id="turma7"  />
      <label for="turma7" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label><br />

      <h3 style="color: #00CED1;">ACIF Lagoa:</h3>
      <input type="radio" name="turma" value="31/out - 19-21hs - ACIF Centro" id="turma8"  >
      <label for="turma8" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label><br />
      <br>


      <h2 style="color: #FDAE45;"><strong>01/nov (quinta-feira):</strong></h2>
      <h3 style="color: #00CED1;">ACIF Centro:</h3>
      <input type="radio" name="turma" value="01/nov -10-12hs - ACIF Centro" id="turma9"  >
      <label for="turma9" style="font-size: 17px; cursor:pointer;"><strong>10h - 12hs</strong></label><br />

      <input type="radio" name="turma" value="01/nov - 19-21hs - ACIF Centro" id="turma10"  />
      <label for="turma10" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label><br />
      <br>

      <h2 style="color: #FDAE45;"><strong>03/nov (sábado):</strong></h2>
      <h3 style="color: #00CED1;">ACIF Centro:</h3>
      <input type="radio" name="turma" value="03/nov -16-18hs - ACIF Centro" id="turma11"  >
      <label for="turma11" style="font-size: 17px; cursor:pointer;"><strong>16h - 18hs</strong></label><br />

      <input type="radio" name="turma" value="03/nov - 19-21hs - ACIF Centro" id="turma12"  />
      <label for="turma12" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label><br />

       <h3 style="color: #00CED1;">ACIF Lagoa:</h3>
      <input type="radio" name="turma" value="03/nov -16-18hs - ACIF Lagoa" id="turma13"  >
      <label for="turma13" style="font-size: 17px; cursor:pointer;"><strong>16h - 18hs</strong></label><br />

      <input type="radio" name="turma" value="03/nov - 19-21hs - ACIF Lagoa" id="turma14"  />
      <label for="turma14" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label><br />
      <br>

      <h2 style="color: #FDAE45;"><strong>05/nov (segunda-feira):</strong></h2>
      <h3 style="color: #00CED1;">ACIF Centro:</h3>
      <input type="radio" name="turma" value="05/nov -10-12hs - ACIF Centro" id="turma15"  >
      <label for="turma15" style="font-size: 17px; cursor:pointer;"><strong>10h - 12hs</strong></label><br />

      <input type="radio" name="turma" value="05/nov - 19-21hs - ACIF Centro" id="turma16"  />
      <label for="turma16" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label><br />
      <br>

      <h2 style="color: #FDAE45;"><strong>06/nov (terça-feira):</strong></h2>
      <h3 style="color: #00CED1;">ACIF Centro:</h3>
      <input type="radio" name="turma" value="06/nov -16-18hs - ACIF Centro" id="turma17"  >
      <label for="turma17" style="font-size: 17px; cursor:pointer;"><strong>16h - 18hs</strong></label><br />

      <input type="radio" name="turma" value="06/nov - 19-21hs - ACIF Centro" id="turma18"  />
      <label for="turma18" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label><br />

      <h3 style="color: #00CED1;">ACIF Lagoa:</h3>
      <input type="radio" name="turma" value="06/nov -19-21hs - ACIF Lagoa" id="turma19"  >
      <label for="turma19" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label><br />
      <br>

      <h2 style="color: #FDAE45;"><strong>07/nov (quarta-feira):</strong></h2>
      <h3 style="color: #00CED1;">ACIF Centro:</h3>
      <input type="radio" name="turma" value="07/nov - 16-18hs - ACIF Centro" id="turma20" />
      <label for="turma20" style="font-size: 17px; cursor:pointer;"><strong>16h - 18hs</strong></label><br />

      <input type="radio" name="turma" value="07/nov -19-21hs - ACIF Centro" id="turma21" />
      <label for="turma21" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label><br />

      <h3 style="color: #00CED1;">ACIF Lagoa:</h3>
      <input type="radio" name="turma" value="07/nov -19-21hs - ACIF Lagoa" id="turma22"  />
      <label for="turma22" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label><br />
      <br>

      <h2 style="color: #FDAE45;"><strong>08/nov (quinta-feira):</strong></h2>
      <h3 style="color: #00CED1;">ACIF Centro:</h3>
      <input type="radio" name="turma" value="08/nov -10-12hs - ACIF Centro" id="turma23"  >
      <label for="turma23" style="font-size: 17px; cursor:pointer;"><strong>10h - 12hs</strong></label><br />

      <input type="radio" name="turma" value="08/nov - 19-21hs - ACIF Centro" id="turma24"  />
      <label for="turma24" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label><br />
      <br>

      <h2 style="color: #FDAE45;"><strong>09/nov (sexta-feira):</strong></h2>
      <h3 style="color: #00CED1;">ACIF Centro:</h3>
      <input type="radio" name="turma" value="09/nov - 16-18hs - ACIF Centro" id="turma25" />
      <label for="turma25" style="font-size: 17px; cursor:pointer;"><strong>16h - 18hs</strong></label><br />

      <input type="radio" name="turma" value="09/nov -19-21hs - ACIF Centro" id="turma26" />
      <label for="turma26" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label><br />

      <h3 style="color: #00CED1;">ACIF Lagoa:</h3>
      <input type="radio" name="turma" value="09/nov -19-21hs - ACIF Lagoa" id="turma27"  />
      <label for="turma27" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label><br />
      <br>

      <h2 style="color: #FDAE45;"><strong>10/nov (sábado):</strong></h2>
      <h3 style="color: #00CED1;">ACIF Centro:</h3>
      <input type="radio" name="turma" value="10/nov - 16-18hs - ACIF Centro" id="turma28" />
      <label for="turma28" style="font-size: 17px; cursor:pointer;"><strong>16h - 18hs</strong></label><br />

      <input type="radio" name="turma" value="10/nov -19-21hs - ACIF Centro" id="turma29" />
      <label for="turma29" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label><br />

      <h3 style="color: #00CED1;">ACIF Lagoa:</h3>
      <input type="radio" name="turma" value="10/nov -16-18hs - ACIF Lagoa" id="turma30"  />
      <label for="turma30" style="font-size: 17px; cursor:pointer;"><strong>16h - 18hs</strong></label><br />

      <input type="radio" name="turma" value="10/nov -19-21hs - ACIF Lagoa" id="turma31"  />
      <label for="turma31" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label><br />
      <br>

       <!--
            <table class="table">
              <tr>
              <td>
                <h2 style="color: #FDAE45;"><strong>29/out (segunda-feira):</strong></h2>
                <h3 style="color: #00CED1;">ACIF Centro:</h3>
                <input type="radio" name="turma" value="29/out - 16-18hs - ACIF Centro" id="turma1" />
                <label for="turma1" style="font-size: 17px; cursor:pointer;">16h - 18hs</label><br />

                <input type="radio" name="turma" value="29/out - 19-21hs - ACIF Centro" id="turma2" />
                <label for="turma2" style="font-size: 17px; cursor:pointer;">19h - 21hs</label>
              </td>
              <td>
                <h2 style="color: #FDAE45;"><strong>30/out (terça-feira):</strong></h2>
                <h3 style="color: #00CED1;">ACIF Centro:</h3>
                <input type="radio" name="turma" value="30/out - 16-18hs - ACIF Centro" id="turma3" />
                <label for="turma3" style="font-size: 17px; cursor:pointer;"><strong>16h - 18hs</strong></label><br />

                <input type="radio" name="turma" value="30/out -19-21hs - ACIF Centro" id="turma4" />
                <label for="turma4" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label><br />

                <h3 style="color: #00CED1;">ACIF Lagoa:</h3>
                <input type="radio" name="turma" value="30/out -19-21hs - ACIF Lagoa" id="turma5"  />
                <label for="turma5" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label>
              </td>
              <td>
                <h2 style="color: #FDAE45;"><strong>31/out (quarta-feira):</strong></h2>
                <h3 style="color: #00CED1;">ACIF Centro:</h3>
                <input type="radio" name="turma" value="31/out -16-18hs - ACIF Centro" id="turma6"  />
                <label for="turma6" style="font-size: 17px; cursor:pointer;"><strong>16h - 18hs</strong></label><br />

                <input type="radio" name="turma" value="31/out - 19-21hs - ACIF Centro" id="turma7"  />
                <label for="turma7" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label><br />

                <h3 style="color: #00CED1;">ACIF Lagoa:</h3>
                <input type="radio" name="turma" value="31/out - 19-21hs - ACIF Centro" id="turma8"  >
                <label for="turma8" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label>
              </td>
              <td>
              <h2 style="color: #FDAE45;"><strong>01/nov (quinta-feira):</strong></h2>
              <h3 style="color: #00CED1;">ACIF Centro:</h3>
              <input type="radio" name="turma" value="01/nov -10-12hs - ACIF Centro" id="turma9"  >
              <label for="turma9" style="font-size: 17px; cursor:pointer;"><strong>10h - 12hs</strong></label><br />

              <input type="radio" name="turma" value="01/nov - 19-21hs - ACIF Centro" id="turma10"  />
              <label for="turma10" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label>
              </td>
            </tr>
            <tr>
              <td>
                <h2 style="color: #FDAE45;"><strong>03/nov (sábado):</strong></h2>
                <h3 style="color: #00CED1;">ACIF Centro:</h3>
                <input type="radio" name="turma" value="03/nov -16-18hs - ACIF Centro" id="turma11"  >
                <label for="turma11" style="font-size: 17px; cursor:pointer;"><strong>16h - 18hs</strong></label><br />

                <input type="radio" name="turma" value="03/nov - 19-21hs - ACIF Centro" id="turma12"  />
                <label for="turma12" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label><br />

                 <h3 style="color: #00CED1;">ACIF Lagoa:</h3>
                <input type="radio" name="turma" value="03/nov -16-18hs - ACIF Lagoa" id="turma13"  >
                <label for="turma13" style="font-size: 17px; cursor:pointer;"><strong>16h - 18hs</strong></label><br />

                <input type="radio" name="turma" value="03/nov - 19-21hs - ACIF Lagoa" id="turma14"  />
                <label for="turma14" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label>
              </td>
              <td>
                <h2 style="color: #FDAE45;"><strong>05/nov (segunda-feira):</strong></h2>
                <h3 style="color: #00CED1;">ACIF Centro:</h3>
                <input type="radio" name="turma" value="05/nov -10-12hs - ACIF Centro" id="turma15"  >
                <label for="turma15" style="font-size: 17px; cursor:pointer;"><strong>10h - 12hs</strong></label><br />

                <input type="radio" name="turma" value="05/nov - 19-21hs - ACIF Centro" id="turma16"  />
                <label for="turma16" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label>
              </td>
              <td>
                <h2 style="color: #FDAE45;"><strong>06/nov (terça-feira):</strong></h2>
                <h3 style="color: #00CED1;">ACIF Centro:</h3>
                <input type="radio" name="turma" value="06/nov -16-18hs - ACIF Centro" id="turma17"  >
                <label for="turma17" style="font-size: 17px; cursor:pointer;"><strong>16h - 18hs</strong></label><br />

                <input type="radio" name="turma" value="06/nov - 19-21hs - ACIF Centro" id="turma18"  />
                <label for="turma18" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label><br />

                <h3 style="color: #00CED1;">ACIF Lagoa:</h3>
                <input type="radio" name="turma" value="06/nov -19-21hs - ACIF Lagoa" id="turma19"  >
                <label for="turma19" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label>
              </td>
              <td>
                <h2 style="color: #FDAE45;"><strong>07/nov (quarta-feira):</strong></h2>
                <h3 style="color: #00CED1;">ACIF Centro:</h3>
                <input type="radio" name="turma" value="07/nov - 16-18hs - ACIF Centro" id="turma20" />
                <label for="turma20" style="font-size: 17px; cursor:pointer;"><strong>16h - 18hs</strong></label><br />

                <input type="radio" name="turma" value="07/nov -19-21hs - ACIF Centro" id="turma21" />
                <label for="turma21" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label><br />

                <h3 style="color: #00CED1;">ACIF Lagoa:</h3>
                <input type="radio" name="turma" value="07/nov -19-21hs - ACIF Lagoa" id="turma22"  />
                <label for="turma22" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label>
              </td>  
            </tr>
            <tr>
              <td>
                <h2 style="color: #FDAE45;"><strong>08/nov (quinta-feira):</strong></h2>
                <h3 style="color: #00CED1;">ACIF Centro:</h3>
                <input type="radio" name="turma" value="08/nov -10-12hs - ACIF Centro" id="turma23"  >
                <label for="turma23" style="font-size: 17px; cursor:pointer;"><strong>10h - 12hs</strong></label><br />

                <input type="radio" name="turma" value="08/nov - 19-21hs - ACIF Centro" id="turma24"  />
                <label for="turma24" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label>
              </td>
              <td>
                <h2 style="color: #FDAE45;"><strong>09/nov (sexta-feira):</strong></h2>
                <h3 style="color: #00CED1;">ACIF Centro:</h3>
                <input type="radio" name="turma" value="09/nov - 16-18hs - ACIF Centro" id="turma25" />
                <label for="turma25" style="font-size: 17px; cursor:pointer;"><strong>16h - 18hs</strong></label><br />

                <input type="radio" name="turma" value="09/nov -19-21hs - ACIF Centro" id="turma26" />
                <label for="turma26" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label><br />

                <h3 style="color: #00CED1;">ACIF Lagoa:</h3>
                <input type="radio" name="turma" value="09/nov -19-21hs - ACIF Lagoa" id="turma27"  />
                <label for="turma27" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label>
              </td>
              <td>
                <h2 style="color: #FDAE45;"><strong>10/nov (sábado):</strong></h2>
                <h3 style="color: #00CED1;">ACIF Centro:</h3>
                <input type="radio" name="turma" value="10/nov - 16-18hs - ACIF Centro" id="turma28" />
                <label for="turma28" style="font-size: 17px; cursor:pointer;"><strong>16h - 18hs</strong></label><br />

                <input type="radio" name="turma" value="10/nov -19-21hs - ACIF Centro" id="turma29" />
                <label for="turma29" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label><br />

                <h3 style="color: #00CED1;">ACIF Lagoa:</h3>
                <input type="radio" name="turma" value="10/nov -16-18hs - ACIF Lagoa" id="turma30"  />
                <label for="turma30" style="font-size: 17px; cursor:pointer;"><strong>16h - 18hs</strong></label><br />

                <input type="radio" name="turma" value="10/nov -19-21hs - ACIF Lagoa" id="turma31"  />
                <label for="turma31" style="font-size: 17px; cursor:pointer;"><strong>19h - 21hs</strong></label>
              </td>
            </tr>
              
            </table>
 -->


</div>  
				</div><br>		
<br>
			<div class="row">
			 <div class="col-md-12">
				<input type="button" name="submit" id="submit" class="btn btn-primary botao" value="Entrar" onclick="acessarSistema();" />
			</div>

			<div class="col-md-12">
				<h2 class="hidden-sm hidden-xs">(*) Vagas limitadas de acordo com a capacidade da sala de treinamento.</h2>
        <h2 class="hidden-sm hidden-xs">(**) Datas e horários sujeitos a alteração conforme demanda das inscrições.</h2>
        <h2 class="hidden-sm hidden-xs">(***) Inscritos deverão assinar presença obrigatoriamente no início e fim do treinamento.</h2>
			</div>
			</div>
		</div>

  

  <div class="flex-container">
    <div class="column4-lg column4-md column8-sm">
      <div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.10&appId=150853192172803";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

</div>
    </div>
  </div>


  <script type="text/javascript" src="js/validadores.js"></script>  
  <script src="../MinhocaCabeca/assets/js/jquery.min.js"></script>
  <script src="../MinhocaCabeca/assets/js/jquery.maskedinput.min.js" type="text/javascript"></script> 
  <script src='http://momentjs.com/downloads/moment.min.js'></script>
  <script type="text/javascript">
  
  $("#cpf").mask("999.999.999-99");
  $("#processo").mask("999999/9999");

      function loadScript( url, callback ) {
        var script = document.createElement( "script" )
        script.type = "text/javascript";
        if(script.readyState) {  //IE
          script.onreadystatechange = function() {
            if ( script.readyState === "loaded" || script.readyState === "complete" ) {
              script.onreadystatechange = null;
              callback();
            }
          };
        } else {  //Others
          script.onload = function() {
            callback();
          };
        }
        script.src = url;
        document.getElementsByTagName( "head" )[0].appendChild( script );
      }


	 function acessarSistema(){

	if( $("#processo").val() =="" ){
		  alert("Informe o número do processo!");	
          $("#processo").val("");		  
	  }else if( $("#cpf").val() =="" ){
  			    alert("Informe o cpf !");		  
				$("#cpf").val("");		  	  
	  }else{
        data = {
             "processo"  : $("#processo").val(),
             "cpf"       : $("#cpf").val()
        };
	
		$.ajax( {
		  type: "POST",
		  dataType: "json",
		  url: "banco/logar.php", 
		  data: data,
		  success: function( data ){
					 if( data['success'] == 1 ){
						 $("#processo").val("");		  
						 $("#cpf").val("");		  				 	
					     document.formLogin.action = "agendamento.php";
					     $("#nome").val();
						 document.formLogin.submit();
					 }else{
					 	 alert( data['error'] );
						 $("#processo").val("");		  
						 $("#cpf").val("");
						 $("#processo").focus;										 	
					 }         
				  },
		  error: function( data ){
				alert(data['error']);
		 	}
		} );
	  }	
    }

</script>

<script src="../../layout/themePMF/js/slick.min.js"></script>

<script src="../../layout/themePMF/js/main.min.js"></script>
<div id="rodape">
  <div class="info">
    <div class="info-column">
      <div class="info-block">
        <h4>Equipe de Suporte</h4>
        <ul>
          <li><p style="color: white;">Fulano</p></li>
        </ul>
      </div>
    </div>

     <div class="info-column">
      <div class="info-block">
        <h4>Telefone - Endereço</h4>
        <ul>
          <li><p style="color: white;">(48) 3213-5509 - Secretaria da Fazenda</p></li>
          <li><p style="color: white;">(48) 3251-6457 - Pró-Cidadão</p></li>
        </ul>
      </div>

       <div class="info-block">
        <h4>Email</h4>
        <ul>
          <li><p style="color: white;">suporte.rastreabilidade@pmf.sc.gov.br</p></li>
        </ul>
      </div>
    </div>
    </div>
</div>

<script src="../../layout/themePMF/js/home.min.js"></script>

</body>
</html>
