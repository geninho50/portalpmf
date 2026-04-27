<?php   

require 'PHPMailer/PHPMailerAutoload.php';


$headers  = "MIME-Version: 1.1\n";
$headers .= "Content-type: text/html; charset=UTF-8\n";
$headers .= "From: helpdesk@next4u.com.br\n"; // remetente
$headers .= "Return-Path: helpdesk@next4u.com.br\n"; // return-path


session_start();
include_once("gdb.php");
$gdb = new gdb();
$gdb2 = new gdb();
$gdb3 = new gdb();


$resultado = NULL;
$relatorio = NULL;
$mensagemEmail=NULL;

$reprovado = False;
$enviarRelatorio = False;
$mostraRelatorio = False;

$nomeFiscal = NULL;

$acertos = 0;

$numeroDePerguntas =0;

if(isset($_POST['modulo'])){
	$modulo = $_POST['modulo'];
} 

if(isset($_POST['idUsuario'])){
	$idUsuario = $_POST['idUsuario'];
} 

$gdb->open("SELECT COUNT(*) FROM suporteStm.questionarioFiscalizacao where ID_MODULO =".$modulo." AND ID_USUARIO = ".$idUsuario);// Verifica quantas vezes o usuario tentou o questionario

$tentativas =($gdb->gs['COUNT(*)'][0]);

$tentativas = $tentativas + 1;

$gdb2->open("SELECT * FROM suporteStm.registraDataHoraFiscal WHERE ID_MODULO = ".$modulo." AND ID_USUARIO = ".$idUsuario); //Verifica se ele ja completou o questionario
$situacao = $gdb2->gs["SITUACAO"][0];

$resultado.="<h3>Resultado Questionario Módulo ".$modulo."</h3><br>";

$gdb3->open("SELECT * FROM suporteStm.usuarioFiscalizacao WHERE ID = ".$idUsuario); //pegar o nome do usuario

if($situacao==2){
	$resultado.="Aviso: Questionario já realizado. <br><br>";
}
else if($tentativas>3){
	$resultado.="Aviso: Máximo de tentativas já realizado <br>";
}else{

	$resultado.="Tentativas: ".$tentativas." de 3. <br>";

	$nomeFiscal.= $gdb3->gs['NOME_FISCAL'][0];

	$relatorio.= "<h2>RELATÓRIO QUESTIONÁRIO MÓDULO ".$modulo."</h2><h3><br> USUÁRIO: ".$gdb3->gs['NOME_FISCAL'][0]."</h3><br>";

	$relatorio.= "<h3>Tentativa número ".$tentativas.", realizada em: ".date("d-m-Y H:i").". <br><br></h3>";



	$gdb->open("SELECT * FROM suporteStm.gabaritoQuestionario where ID_MODULO =".$modulo);

	

	for($i = 0; $i < count($gdb->gs['ID']); $i++){ 

		$numeroDePerguntas++;

		$relatorio.="QUESTÃO ".($i+1).": <br>";

		$resposta = NULL;

		
		if($_POST['mod'.$modulo.'q'.($i+1)] == 1){
			$resposta .= "Verdadeiro";
		}else if($_POST['mod'.$modulo.'q'.($i+1)] == 0){
			$resposta .= "Falso";
		} 

		
		$gabarito = NULL;

		
		if($gdb->gs['RESPOSTA'][$i]==1){
			$gabarito .= "Verdadeiro";
		}else if($gdb->gs['RESPOSTA'][$i] == 0){
			$gabarito .="Falso";
		}
		
		//$relatorio.="RESPOSTA: ".$_POST['mod'.$modulo.'q'.($i+1)]." -- GABARITO: ".$gdb->gs['RESPOSTA'][$i]."<br>";
		$relatorio.="RESPOSTA DO USUÁRIO: ".$resposta." -- GABARITO: ".$gabarito."<br>";

		if($_POST['mod'.$modulo.'q'.($i+1)]==$gdb->gs['RESPOSTA'][$i]){
			$relatorio.="Acertou <br><br>";
			$acertos++;
		}else{
			$relatorio.="Errou <br><br>";
		}
	}

	$pontuacao = intval(($acertos/$numeroDePerguntas) * 100);

	$resultado .= "PONTUACAO: ".$pontuacao."<br>";//."% <br> USUARIO: ".$idUsuario."<br>";

	$relatorio .= "PONTUACAO: ".$pontuacao."/100<br>";

	if($pontuacao>=70){
		$resultado.="<span style='color:green'> APROVADO</span><br>";
		$relatorio.="<span style='color:green'> APROVADO</span><br>";
		$gdb->open("UPDATE suporteStm.registraDataHoraFiscal SET SITUACAO = 2 WHERE ID_MODULO = ".$modulo." AND ID_USUARIO = ".$idUsuario);
		$mostraRelatorio = True;
	}else if($pontuacao<70 && $tentativas < 3){
		$resultado.="<span style='color:red'> REPROVADO</span> (Pontuação Mínima: 70%) <br>";
		$relatorio.="<span style='color:red'> REPROVADO</span> (Pontuação Mínima: 70%) <br>";
	}else if($pontuacao<70 && $tentativas >=3){
		$resultado.="<span style='color:red'> REPROVADO</span> (Pontuação Mínima: 70%) <br>";
		$relatorio.="<span style='color:red'> REPROVADO</span> (Pontuação Mínima: 70%) <br>";
		$reprovado = True;
		$mostraRelatorio = True;
		
		//$gdb->open("UPDATE suporteStm.registraDataHoraFiscal SET SITUACAO = 3 WHERE ID_MODULO = ".$modulo." AND ID_USUARIO = ".$idUsuario);

		$gdb->open("UPDATE suporteStm.registraDataHoraFiscal SET SITUACAO = 3 , DATA_FALHA = NOW() , PRAZO_FALHA = (NOW() + INTERVAL 30 DAY)  WHERE ID_MODULO = ".$modulo." AND ID_USUARIO = ".$idUsuario);


		$resultado.="<span style='color:red'>Contate o gerente. Você poderá refazer o módulo dentro de 30 dias</span> <br>";
		
		
	}

	//SELECT * FROM suporteStm.questionarioFiscalizacao
	$gdb->open("INSERT INTO suporteStm.questionarioFiscalizacao (ID_USUARIO,ID_MODULO,PONTUACAO) VALUES (".$idUsuario." , ".$modulo." , ".$pontuacao.");");


	$mail = new PHPMailer;
	$mail->Charset = 'utf-8';
	$mail->Encoding ='base64';
	$mail->isSMTP();
	$mail->Host='smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'tls';
	$mail->Username = 'fsefinnet@gmail.com';
	$mail->Password = 'Sefinfiscal';
	$mail->Port = 587;

	$mail->setFrom('no-replyfsefinnet@gmail.com');
	$mail->addAddress('180769@pmf.sc.gov.br');
	$mail->isHTML(true);

	$mail->Subject = utf8_decode('Relatório de Desempenho Fiscal: '.$nomeFiscal);
	$mail->Body = utf8_decode($relatorio);
	$mail->AltBody = utf8_decode($relatorio);

	if(!$mail->send()){
		$mensagemEmail.= "ERRO NO EMAIL: ".$mail->ErrorInfo;
	}else{
		$mensagemEmail.= "ENVIADO";
	}

}


if($reprovado == False){
	$resultado .= '<br><br> <a type="button" class="btn btn-primary botao" href="../sefinnetfiscalizacao/modulotutoriais.php?modulo='.$modulo.'" style="color: black;font-size:20px; background-color: orange ;border: 1px solid black;"><b>Retornar</b></a>';
}else{
	$resultado .= '<br><br> <a type="button" class="btn btn-primary botao" href="/tutorialfiscalizacao.php" style="color: black;font-size:20px; background-color: orange ;border: 1px solid black;"><b>Retornar</b></a>';
}

//echo $resultado;

//echo "<br> <br> <br> <br> DEBUG DE RELATORIO: <br>";
//echo $relatorio;

$_SESSION['resultado'] = $resultado;
$_SESSION['relatorio'] = $relatorio;
$_SESSION['mostraRelatorio'] = $mostraRelatorio;

$_SESSION['mensagemEmail'] = $mensagemEmail;


//mail("flavio.pereira@softplan.com.br", "TEST", $relatorio, $headers);

header('Location: resultado_questionario.php');


?>
<!DOCTYPE html>
<html>
<head>
	<title>Resultado Questionario</title>
</head>
<body>

</body>
</html>
