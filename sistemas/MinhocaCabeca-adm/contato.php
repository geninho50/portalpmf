<?

$nome=$_POST['nome'];
$email=$_POST['email'];
$titulo=$_POST['titulo'];
$texto=$_POST['texto'];
$codigoTurma=$_POST['codigoTurma'];
$codigoPessoa=$_POST['codigoPessoa'];
$codigoUsuario=$_POST['codigoUsuario'];

$Destinatario="minhocacabeca.comcap@pmf.sc.gov.br";

$Titulo="$titulo";

$mensagem1="Uma mensagem vinda do Minhoca na Cabeça!

Nome: $nome
Email: $email

Mensagem: $texto";

mail("$Destinatario","$Titulo", "$mensagem1","From:$email");

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Comcap</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<div class="logo"><a href="residuometro.html">RESIDUÔMETRO</a></div>
				<a href="#menu">Menu</a>
			</header>

		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
					<li><a href="sistema.php?codigoUsuario=<?echo $codigoUsuario;?>">Home</a></li>
					<li><a href="meusDados.php">Meus Dados</a></li>
					<li><a href="">Certificado da Oficina</a></li>
					<li><a href="caixa.html">Minha Caixa</a></li>
				</ul>
				<input type="hidden" name="codigoUsuario" value="<?echo $codigoUsuario;?>">
			</nav>

		<!-- One -->
			<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p>Prefeitura de Florianópolis / Comcap</p>
						<h2>Projeto Minhoca na Cabeça</h2>
					</header>
				</div>
			</section>

			<section id="two" class="wrapper style2">
				<div class="inner">
					<header class="align-center">
						<h2>Sua mensagem foi enviada para a equipe da Comcap.</h2>		
							<h2>Logo entraremos em contato com você para esclarecer sua dúvida.</h2>						
							</div>
					</header>
				</div>
			</section>



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

	</body>
</html>
