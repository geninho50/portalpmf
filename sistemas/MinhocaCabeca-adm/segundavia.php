<!DOCTYPE HTML>
<!--
  Hielo by TEMPLATED
  templated.co @templatedco
  Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
  <head>
    <title>Minhoca na Cabeça</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
  </head>
  <body class="subpage">

    <!-- Header -->
      <header id="header" >
        <div class="logo"></div>
        <div class="logo"><a href="residuometro.html">RESIDUÔMETRO</a></div>
        <a href="#menu">Menu</a>
      </header>

    <!-- Nav -->
      <nav id="menu">
        <ul class="links">
          <li><a href="http://www.pmf.sc.gov.br/sistemas/MinhocaCabeca/">Home</a></li>
          <li><a href="passo.html">Inscreva-se</a></li>
          <li><a href="areaAviso.html">Área do Participante</a></li>
        </ul>
      </nav>

    <!-- One -->
      <section id="One" class="wrapper style3">
        <div class="inner">
          <header class="align-center">
            <p><Strong>PROJETO MINHOCA NA CABEÇA</Strong></p>
            <h2>Recicle seus hábitos, aprenda a valorizar os resíduos orgânicos</h2>
          </header>
        </div>
      </section>

        
    <div id="main" class="container">
                <h3>Informe seus dados</h3>

                <form method="post" name="formVia" action="#" id="formIndex">
                  <div class="row uniform">
                    <div class="6u 12u$(xsmall)">
                      <label>Login</label><input type="text" name="login" id="login" placeholder="Informe o Email" />
                    </div>
                    <div class="6u$ 12u$(xsmall)">
                      <label>Senha</label><input type="password" name="senha" id="senha" placeholder="Informe a senha" />
                    </div>
                  </div>
                </form>

              <div class="12u$">
                      <ul class="actions">
                         <a class="button alt" onclick="gerarComprovante();" >Gerar Comprovante</a></li>
                      </ul>
                    </div>
                  </div>
                </form>

            </div>
          </div>

      </div>
      </div>


    <!-- Footer -->
      <footer id="footer">
        <div class="container">
          <ul class="icons">
            <li><a href="https://twitter.com/_comcap" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="https://www.facebook.com/comcapoficial" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
            <li><a href="https://www.instagram.com/explore/locations/240724652/prefeitura-de-florianopolis/" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
            <li><a href="mailto:minhocacabeca.comcap@pmf.sc.gov.br" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
          </ul>
        </div>
        <div class="copyright">
          <header class="align-center">
              <img src="images/Comcap.png" alt="" />
              <img src="images/Prefeitura.png" alt=""/>
          </header>
        </div>
      </footer>
      

    <!-- Scripts -->
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/jquery.scrollex.min.js"></script>
      <script src="assets/js/skel.min.js"></script>
      <script src="assets/js/util.js"></script>
      <script src="assets/js/main.js"></script>
	  <script>
	  function gerarComprovante(){
	     var login = 	formVia.login.value;
         var senha  = 	formVia.senha.value;
		 
		 formVia.action = "comprovante2Via.php?login="+login+"&senha="+senha;
		 formVia.submit();
		 
	  }
	  </script>

  </body>
</html>
