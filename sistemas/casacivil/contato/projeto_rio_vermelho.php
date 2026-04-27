<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
	if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['mensagem'])) {
		include 'smtp/mail.php';
		
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$mensagem = 'Nome: '.$nome.'<br />';
		$mensagem .= 'E-mail: '.$email.'<br />';
		$mensagem .= 'Mensagem: '.$_POST['mensagem'];
		
		$valida = true;
		if(empty($nome)){
			echo "<script>alert('Digite seu Nome!')</script>";
			$valida = false;
		}
		
		if(!validMail($email)){
			echo "<script>alert('Digite um E-mail V\u00e1lido')</script>";
			$valida = false;
		}
		
		if(empty($mensagem)){
			echo "<script>alert('Digite sua Mensagem!')</script>";
			$valida = false;
		}
		
		if($valida){
			$sentMail = sendMail('frederico.027@gmail.com', 'portal@pmf.sc.gov.br', $mensagem, 'Nova mensagem do site');
			//$sentMail = sendMail('projetoriovermelho@gmail.com', 'portal@pmf.sc.gov.br', $mensagem, 'Nova mensagem do site');

			if($sentMail){
				//echo "<script>alert('Mensagem Enviada com Sucesso!')</script>";
			}else{
				//echo "<script>alert('Erro ao Enviar Mensagem!')</script>";
			}	
		}
	}
?>
<div class="centro">
	<!-- box = caixa cinza-->
	<div class="box">
		<form action="projeto_rio_vermelho.php" method="post">
			<br>
			<!-- *componente_grande determina o tamanho do input alem de outras coisas-->
			Nome:
			<input type="text" name="nome" maxlength="100" class="componente_grande">
			<br>
     		<br>
			E-mail:
			<input type="text" class="componente_grande" maxlength="100" name="email">
			<br>
      		<br>
			Mensagem:
			<!-- *470px é o tamanho para deixar alinhado com os outros acima-->
			<textarea style="width:470px" class="componente_grande" name="mensagem"></textarea>
			<br>
			<br>
			<!-- botao estilizado-->
			<input type="submit" align="absmiddle" style="background-color:#1b9be4; color:white; border:1px solid #ccc; width:60px; height:25px" value="Enviar">
		</form>
	</div>
	<br>
</div>