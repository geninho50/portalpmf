<?php
$Tnoticias 	 = explode("#",$_POST['Fnoticias']);
$TdesEnvMail = explode("#",$_POST['Fdest']);

//-----------------------------------------------------------------
// atraza o timeout do php, setando 25 seg. para cada destinatario
//----------------------------------------------------------------- 
$Ttime = count($TdesEnvMail) * 25;
set_time_limit($Ttime);

require_once("../scripts/php/funcoes.php");

//---------------------------------------------------
// Monta SQL para consultar as notícias selecionadas
//---------------------------------------------------
$sqlNoticias  = "SELECT * FROM noticias WHERE ";
for($i=0;$i<(count($Tnoticias)-2);$i++){
	$sqlNoticias .= "noti_id = ".$Tnoticias[$i]." OR ";	
}
$sqlNoticias 	.=" noti_id = ".$Tnoticias[$i]." ORDER BY noti_data DESC";
$TreturnNoticias = $drive->pedido($sqlNoticias);	

//---------------------------------------
// Monta o HTML a ser enviado no Mailing
//---------------------------------------
$Thtml = "<table width=\"600\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
while($Tnot = pg_fetch_object($TreturnNoticias)){
	$Thtml .= "
	<tr>
		<td>
			<span>
				<a href=\"mailing/envio/mailing_notprev.php?noti=".$Tnot->noti_id."\"> 
					<span>".inverteDateBd($Tnot->noti_data)." - ".substr($Tnot->noti_titulo, 0, 60)."...</span><br>
					".strip_tags(substr($Tnot->noti_manchete, 0, 165))."...								
				</a>
			</span> 
		</td>
	</tr>";
}
$Thtml .= "</table>";

//--------------------------------------------------------
// Recupera os emails para quem vai ser enviado o Mailing 
//--------------------------------------------------------
$sqlMailing  = "SELECT * FROM mailing_contato WHERE ";
for($i=0;$i<(count($TdesEnvMail)-2);$i++){
	$sqlMailing .= "mailing_contato_id = ".$TdesEnvMail[$i]." OR ";	
}
$sqlMailing 	.=" mailing_contato_id = ".$TdesEnvMail[$i]." ORDER BY mailing_contato_id ASC";
$TreturnMailing = $drive->pedido($sqlMailing);

//----------------------------------------------------
// Envia o Mailing para todos os contatos selecionado
//----------------------------------------------------
$TnumMailEnv = 0;
while($Tcontato = pg_fetch_object($TreturnMailing)){
	$to 	  = $Tcontato->mailing_contato_email;
	$subject  = "Not&iacute;cias - Prefeitura Municipal de Florian&oacute;polis - ".date("d/m/Y");
	$headers  = "MIME-Version: 1.1\n";
	$headers .= "Content-type: text/html; charset=utf-8\n";
	$headers .= "From: portal@pmf.sc.gov.br\n";
	$headers .= "Return-Path: portal@pmf.sc.gov.br\n";
	$headers .= "X-Mailer: PHP mail ver".phpversion()."\n";
	if(mail($to, $subject, $Thtml, $headers)){
		$TnumMailEnv++;		
	}
}


//--------------------------------------------------------
// Registra as informações do Mailing enviado (histórico)
//--------------------------------------------------------
$TuserId 	  	= $_SESSION['SuserId'];
$TentidadeId	= $_SESSION['SuserEnt'];
$TdataMailing 	= date("Y-m-d");
$Tnoticias	  	= strlen($_POST['Fnoticias']);
$TnoticiasId  	= substr($_POST['Fnoticias'], 0, ($Tnoticias-1));
$Tdestinatorios = strlen($_POST['Fdest']);
$TdestId  		= substr($_POST['Fdest'], 0, ($Tdestinatorios-1));

$sqlHistorico	= "INSERT INTO
						mailing_historico(
							mailing_historico_id,
							mailing_historico_data,
							mailing_historico_user_id,
							mailing_historico_entidade_id,
							mailing_historico_noticias_ids,
							mailing_historico_destinatarios_ids
				   )VALUES (
						 default, 
						'$TdataMailing',
						 $TuserId,
						 $TentidadeId,
						'$TnoticiasId',
						'$TdestId')";

$TreturnHist	= $drive->pedido($sqlHistorico);

//----------------------------------------------------------
// Imprime mensagem de confirmação/erro no envio do Mailing
//----------------------------------------------------------
if($TnumMailEnv > 0){
	echo"<script>alert(\"Mailing enviado com Sucesso!\");</script>";
	echo("<script>window.location = \"inicio.php?pagina=mailenvionot&menu=".$_GET['menu']."\"</script>");
}else{
	echo"<script>alert(\"O Mailing não pode ser enviado,\n\ntente novamente mais tarde.\");</script>";
	echo("<script>window.location = \"inicio.php?pagina=mailenvionot&menu=".$_GET['menu']."\"</script>");
}

?>