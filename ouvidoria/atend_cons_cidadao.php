<?
require($_SERVER[DOCUMENT_ROOT].'/ouvidoria/com/config.php');

$image_server = "";



$conn = pconnectdb();

if($p_complemento && $enviarcompl){
	$p_complemento ="\n\n ------Manifestação do cidadão em ". date('d/m/Y') . "------\n\n" . $p_complemento;
	
	$sqlUp = "UPDATE tb_atendimento
		SET descrreivindicacao = COALESCE(descrreivindicacao, '') || '$p_complemento',
			atendpendente = 'A'				
		WHERE  numatendimento = $p_num AND 
		anoatendimento = $p_ano ";
	pg_query($conn, $sqlUp);
	$aux = "atend_cons_cidadao.php?p_num=$p_num&p_ano=$p_ano&p_codconsulta=$p_codconsulta";
    header("location:$aux");
    exit();
}
?>
<!--
<?
if ($p_atend != "") {
        if (strlen($p_atend)< 5) {
            $p_num = $p_atend;
            $p_ano = substr(data_now(""),6,4);
        }
        else {
            $p_atend  = str_replace("/","",$p_atend);
            $p_num = substr($p_atend,0,strlen($p_atend)-4);
            $p_ano = substr($p_atend,strlen($p_atend)-4,4);
        }
}

$msg = null;

$query = "select numatendimento,codconsulta from tb_atendimento
          where numatendimento=$p_num and
                anoatendimento=$p_ano";


$consulta = pg_query($conn, $query);

$retorno  = pg_fetch_object($consulta);

$msg ="<br>Atendimento: ".$retorno->numatendimento."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Código de Consulta digitado:  ".$p_codconsulta."<br>";

if (( $retorno->numatendimento != "") and ($retorno->codconsulta == "")) {

          $msg .= "<br>Este atendimento não possui Código de Consulta pela Internet.<br><br> Entre em contato pelo telefone abaixo.<br>";

}
elseif(( $retorno->numatendimento == $p_num) and ($retorno->codconsulta != $p_codconsulta )) {

    $msg .= "<br>O número do Código da Consulta está incorreto. <br><br> Digite novamente ou entre em contato pelo telefone abaixo.<br>";

}
elseif(( $retorno->numatendimento != $p_num) and ($retorno->codconsulta != $p_codconsulta )) {

          $msg .= "<br>Não existe um atendimento para os dados informados.<br><br> Digite novamente ou entre em contato pelo telefone abaixo.<br>";

} else {

$strs=" SELECT A.NUMATENDIMENTO,
        A.ANOATENDIMENTO,
        A.NOMESOLICITANTE,
        A.SEXOSOLICITANTE,
        A.IDADESOLICITANTE,
        A.APELIDOSOLICITANTE,
        A.DATAENTRADA,
        O.SIGLAORGAO,
        E.DESCRPROVIDENCIA,
        E.DATAPROVIDENCIA,
        O.NOMEORGAO,
        A.DESCRREIVINDICACAO,
        C.CODMODELO,
        C.TEXTOCARTA

        FROM TB_ATENDIMENTO A

        INNER JOIN TB_ENCAMINHAMENTO E
          ON A.NUMATENDIMENTO = E.NUMATENDIMENTO AND A.ANOATENDIMENTO = E.ANOATENDIMENTO
        INNER JOIN TB_ORGAO O
          ON E.CODORGAO = O.CODORGAO
          
		INNER JOIN TB_CARTA C
          ON A.NUMATENDIMENTO = C.NUMATENDIMENTO AND A.ANOATENDIMENTO = C.ANOATENDIMENTO
				AND E.NUMENCAMINHAMENTO = C.NUMENCAMINHAMENTO
        INNER JOIN TB_MODELO M
          ON C.CODMODELO = M.CODMODELO
          
        WHERE
          A.NUMATENDIMENTO = '$p_num' AND A.ANOATENDIMENTO = '$p_ano'
          AND A.CODCONSULTA ='$p_codconsulta' AND M.TIPOMODELO='C' AND M.STATUS='A';";

$stres = pg_query($conn, $strs);

$row = 0; 

$retorno = pg_fetch_object($stres, $row);

if( is_object($retorno) ) {
	
                $msg = "";
}
else {

    $msg .= "<br>Sua solicitação de nº ".$p_num."/".$p_ano." já foi encaminhada.<br><br>Ainda não há uma resposta do orgão competente.<br>Consulte nos próximos dias.<br>";

}

}
?>
-->
<html>
<head>

<style type="text/css">
<!--
.texto_form {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 8.5pt;
	color: #333333;
	font-weight: normal;
}
-->
</style>

</head>

<?

?>


<BODY leftMargin=0 topMargin=0 >

			<table width="510" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr><td colspan="2">
                    <p>
					<font color="#000066" size="2" face="Verdana, Arial, Helvetica, sans-serif">
                      <div style="float:left"><strong><big><?if($p_complemento && $enviarcompl){
	
	//echo "$sqlUp";
	
}?></big></strong></div>

                      </font>
                    </p> <BR>
              </td></tr>
                                <?
                                if($msg) {
	                              ?>
	                              			<tr><td colspan="2">
                                    <p>
                                      <font color="#000066" size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                        <div style="text-align:center"><strong><?=$msg?></strong>
                                        </div>
                                      </font>
                                    </p>
										 </td></tr>
                                <?
                                }
                                else {
                                  while ($row = pg_fetch_row($stres)) {
                                       $numeroatendimento = $row[0];
                                       $anoatendimento    = $row[1];
                                       $nomesolicitante   = $row[2];
                                       $sexosolicitante   = $row[3];
                                       $idadesolicitante  = $row[4];
                                       $apelidosolicitante= $row[5];
                                       $datasolicitacao   = $row[6];
                                       $encaminhadopara   = $row[7];
                                       $dataprovidencia   = $row[9];
                                       if ($dataprovidencia != "")
                                          $dataprovidencia = data_php($dataprovidencia);

                                       if ($datasolicitacao != "")
                                          $datasolicitacao = data_php($datasolicitacao);

                                       if ($row[8]) {
                                          /*$blob_data = pg_blob_info($row[7]);
                                          $blob_hndl = pg_blob_open($row[7]);
                                          $providencia = stripslashes(pg_blob_get($blob_hndl, $blob_data[0]));*/
                                          $providencia = stripslashes($row[8]);
                                          //$providencia = str_replace("\\\"", "\"", $providencia);
                                          }

                                       $nomeorgaoencaminhado = " - ".$row[10];
                                                         $descrreivindicacao = stripslashes($row[11]);
                                                         $cartacidadao = stripslashes($row[13]);
                                   ?>
                                       <tr><td valign='Top' align=left bgcolor=#F2F1E9 nowrap><font class="texto_form">Número Atendimento:</font></td><td width=200px bgcolor=#F2F1E9><font class="texto_form"><?=$numeroatendimento."/".$anoatendimento;?>
                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Código de Consulta na Internet:&nbsp;<?=$p_codconsulta?></font>
                                       </td></tr>
                                       <tr><td valign='Top' width='20%'align=left bgcolor=#ffffff><font class="texto_form">Nome Solicitante:</font></td><td width=200px bgcolor=#ffffff><font class="texto_form"><?=$nomesolicitante;?></font></td></tr>
                                       <tr><td valign='Top' align=left bgcolor=#F2F1E9><font class="texto_form">Data solicitação:</font></td><td width=200px bgcolor=#F2F1E9><font class="texto_form"><?=$datasolicitacao;?></font></td></tr>
                                       <tr><td valign='Top' align=left bgcolor=#ffffff><font class="texto_form">Encaminhado para:</font></td><td width=200px bgcolor=#ffffff><font class="texto_form"><?=$encaminhadopara.$nomeorgaoencaminhado;?></font></td></tr>
                                       <tr><td valign='Top' align=left bgcolor=#F2F1E9><font class="texto_form">Reivindicação:</font></td><td width=200px bgcolor=#F2F1E9><font class="texto_form"><?=str_replace("\n","<br>", $descrreivindicacao);?></font></td></tr>
                                       <tr><td valign='Top' align=left bgcolor=#ffffff><font class="texto_form">Data Providência:</font></td><td width=200px bgcolor=#ffffff><font class="texto_form"><?=$dataprovidencia;?></font></td></tr>
                                       <tr><td valign='Top' align=left bgcolor=#F2F1E9><font class="texto_form">Resposta do Orgão:</font></td><td width=200px bgcolor=#F2F1E9><font class="texto_form"><? echo("<pre>"); str_replace("\n","<br>",print_r($cartacidadao)); ?></font></td></tr>
                                       <tr><td colspan=2 valign='Top' align=left bgcolor=#F2F1E9>&nbsp;</td></tr>
                                       <tr><td colspan=2 valign='Top' align=left bgcolor=#ffffff>&nbsp;</td></tr>
                                   <?
                                  }
                                }
                                ?>
                                <form name='frm_atendimento' action='complementa_solicitacao.php' method='POST'>

                                <input type=hidden name=p_num value=<?php echo $p_num?>>
                                <input type=hidden name=p_ano value=<?php echo $p_ano?>>                               
                                <input type=hidden name=p_codconsulta value=<?php echo $p_codconsulta?>>
          						
								<tr>
                                    <td align=right valign=middle height="15">&nbsp;</td>
                                    <td align=left valign=top height="15"><!-- <input  type="submit" value="Complementar Solicitaï¿½ï¿½o" border="0" name="enviar" align="center" width="57" height="21" >-->
                                     
                                    </td>
                               	</tr>
                               	</form> 
              </table>
</body>
</html>

