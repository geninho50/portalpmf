<?php
	
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a pÃ¡gina seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	$datainicial = $_POST['xdataini'];
	$datafinal = $_POST['xdatafinal'];
	$guarda = $_POST['xGM1_1'];
	
	$arrayI = explode("-", $datainicial);
	$diai = $arrayI[2];
	$mesi = $arrayI[1];
	$anoi = $arrayI[0];
	
	$arrayF = explode("-", $datafinal);
	$diaf = $arrayF[2];
	$mesf = $arrayF[1];
	$anof = $arrayF[0];
	
	$datainicial = trim($datainicial);
	$tamanho = strlen($datainicial);
	$nvaloresencontrados = 0;
	
	$queryT = "SELECT * FROM guarnicao WHERE data_entrada between '$datainicial' and '$datafinal'";
	if( $tamanho > 0 )
	{
		$nvaloresencontrados = $obj->numregistros($queryT);
	}
	
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("head/incHeadCentral.php");?>
<!-- fim inc head -->
</head>

<body>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="42%" align="left">&nbsp;</td>
    <td width="58%" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<fieldset>
	<legend class="cabecalho">CONSULTAR ATIVIDADES POR GUARDAS</legend>
		<form name="form1" method="post" action="relatorio_atividade_guarda.php" enctype="multipart/form-data"  onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">
		
		<INPUT TYPE="hidden" name="cadastro" value="true">
		
		<table width="100%" border="0" cellspacing="1" cellpadding="1">
			<tr>
			<td width="11%" align="right" class="letra">Data Inicial: </td>
			<td width="10%" class="letra">
			<input type="text" value="<? echo $dataini;?>" readonly name="xdataini" size="12"/>
			<a onClick="displayCalendar(document.forms[0].xdataini,'yyyy-mm-dd',this)"> <img  src="images/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a>
		</td>
			<td width="6%" align="right"><span class="letra">Data Final: </span></td>
		    <td width="73%">
			<input type="text" value="<? echo $datafinal;?>" readonly name="xdatafinal" size="12"/>
			<a onClick="displayCalendar(document.forms[0].xdatafinal,'yyyy-mm-dd',this)"> <img  src="images/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a>
		</td>
		  </tr>
		    <tr>
		      <td align="right" class="letra">Guarda:</td>
		      <td align="left" class="letra"><input type="text" name="xGM1_1" id="xGM1_1" size="20"/></td>
		      <td>&nbsp;</td>
	        </tr>
	      <tr>
			<td align="right" class="letra">&nbsp;</td>
			<td align="left" class="letra"><input name="Pesquisar" type="submit" class="letra" id="Pesquisar" value="Pesquisar" onclick="onClickButton(null,'Aguarde...','','Pesquisar')" /></td>
			<td>&nbsp;</td>
		    </tr>
		</table>
		
		
		
		</form>
		</fieldset>

	</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<!--inicio adm-->
<?
if($nvaloresencontrados > 0){
?>
<fieldset>
	<legend class="negrito">Retornou(s) <B><? echo $nvaloresencontrados;?></B> ocorrencias para o Guarda <? echo $guarda;?> no periodo <? echo $datainicial.' a '.$datafinal;?>.</legend>

		<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#006699">
              <tr align="center">
                <td width="5%" class="branco"><b>Data</b> </td>
                <td width="8%" align="center" class="branco"><b>J4</b></td>
                <td width="8%" align="center" class="branco"><b>J8</b></td>
                <td width="15%" align="center" class="branco"><b>Indisponivel</b></td>
                <td width="17%" align="center" class="branco"><b>P18</b></td>
                <td width="9%" align="center" class="branco"><b>Tempo de Servico</b></td>
                <td width="8%" align="center" class="branco"><b>CENTRAL - GERADA </b></td>
                <td width="14%" align="center" class="branco"><b>Escola</b></td>
              </tr>
              
            </table>
					<?
						$queryR = "SELECT id,outros,vtr,hora_entrada,hora_saida,data_entrada,DAY(data_entrada) as dia,MONTH(data_entrada) as mes,YEAR(data_entrada) as ano,guarda1,guarda2,guarda3,guarda4,guarda5 FROM guarnicao WHERE data_entrada between '$datainicial' and '$datafinal'";
						$resultadoR = $obj->executaQuery($queryR);
						while( $linhaR = mysql_fetch_array($resultadoR) )
						{
							$guarda1 = $linhaR['guarda1'];
							$guarda2 = $linhaR['guarda2'];
							$guarda3 = $linhaR['guarda3'];
							$guarda4 = $linhaR['guarda4'];
							$guarda5 = $linhaR['guarda5'];
							$outrosC = $linhaR['outros'];
							$vtrC = $linhaR['vtr'];
							$dia = $linhaR['dia'];
							$mes = $linhaR['mes'];
							$ano = $linhaR['ano'];
							$hora_entradaC = $linhaR['hora_entrada'];
							$hora_saidaC = $linhaR['hora_saida'];
							$data_entradaC = $linhaR['data_entrada'];
								
							if($guarda == $guarda1 || $guarda == $guarda2 || $guarda == $guarda3 || $guarda == $guarda4 || $guarda == $guarda5){
								$idagendaG = $linhaR['id'];
							?>
                            <table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#cccccc" style="border-collapse: collapse">
                              <tr>
                                <td width="5%" align="center" class="negrito"><? echo $dia.'/'.$mes.'/'.$ano;?></td>
                                
                                <td width="8%" align="center" class="negrito">
                                    <? 
                                        $j4 = "select * from j4 where idguarnicao=$idagendaG";
                                        $resultJ4 = $obj->executaQuery($j4);
                                        while( $dadosJ4 = mysql_fetch_array($resultJ4) )
                                        {
                                            echo $dadosJ4['hora_entrada'].' - '. $dadosJ4['hora_saida'].'<br>';
                                            $entrada = $dadosJ4['hora_entrada'];
                                            $saida = $dadosJ4['hora_saida'];
                                            $hora1 = explode(":",$entrada);
                                            $hora2 = explode(":",$saida);
                                            $acumulador1 = ($hora1[0] * 3600) + ($hora1[1] * 60) + $hora1[2];
                                            $acumulador2 = ($hora2[0] * 3600) + ($hora2[1] * 60) + $hora2[2];
                                            $resultado = $acumulador2 - $acumulador1;
                                            $hora_ponto = floor($resultado / 3600);
                                            $resultado = $resultado - ($hora_ponto * 3600);
                                            $min_ponto = floor($resultado / 60);
                                            $resultado = $resultado - ($min_ponto * 60);
                                            $secs_ponto = $resultado;
                                            echo $hora_ponto.":".$min_ponto.":".$secs_ponto.'<br>';
                                        }
                                    ?>
                                </td>
                                <td width="8%" align="center" class="negrito">
                                <? 
                                        $j8 = "select * from j8 where idguarnicao=$idagendaG";
                                        $resultJ8 = $obj->executaQuery($j8);
                                        while( $dadosJ8 = mysql_fetch_array($resultJ8) )
                                        {
                                            echo $dadosJ8['hora_entrada'].' - '.$dadosJ8['hora_saida'].'<br>';
                                            
                                            $entrada = $dadosJ8['hora_entrada'];
                                            $saida = $dadosJ8['hora_saida'];
                                            $hora1 = explode(":",$entrada);
                                            $hora2 = explode(":",$saida);
                                            $acumulador1 = ($hora1[0] * 3600) + ($hora1[1] * 60) + $hora1[2];
                                            $acumulador2 = ($hora2[0] * 3600) + ($hora2[1] * 60) + $hora2[2];
                                            $resultado = $acumulador2 - $acumulador1;
                                            $hora_ponto = floor($resultado / 3600);
                                            $resultado = $resultado - ($hora_ponto * 3600);
                                            $min_ponto = floor($resultado / 60);
                                            $resultado = $resultado - ($min_ponto * 60);
                                            $secs_ponto = $resultado;
                                            echo $hora_ponto.":".$min_ponto.":".$secs_ponto; 
                                        }
                                    ?>
                                </td>
                                <td width="15%" align="center" class="negrito">
                                <? 
                                        $j6 = "select * from indisponivel where idguarnicao=$idagendaG";
                                        $resultJ6 = $obj->executaQuery($j6);
                                        while( $dadosJ6 = mysql_fetch_array($resultJ6) )
                                        {
                                            echo $dadosJ6['hora_entrada'].' - '.$dadosJ6['hora_saida'].'<br>';
                                            
                                            $entrada = $dadosJ6['hora_entrada'];
                                            $saida = $dadosJ6['hora_saida'];
                                            $motivo = $dadosJ6['motivo'];
                                            $hora1 = explode(":",$entrada);
                                            $hora2 = explode(":",$saida);
                                            $acumulador1 = ($hora1[0] * 3600) + ($hora1[1] * 60) + $hora1[2];
                                            $acumulador2 = ($hora2[0] * 3600) + ($hora2[1] * 60) + $hora2[2];
                                            $resultado = $acumulador2 - $acumulador1;
                                            $hora_ponto = floor($resultado / 3600);
                                            $resultado = $resultado - ($hora_ponto * 3600);
                                            $min_ponto = floor($resultado / 60);
                                            $resultado = $resultado - ($min_ponto * 60);
                                            $secs_ponto = $resultado;
                                            echo $hora_ponto.":".$min_ponto.":".$secs_ponto.'<br>'.$motivo.'<br>'; 
                                        }
                                    ?>
                                </td>
                                <td width="17%" align="center" class="negrito">
                                <? 
                                        $j6 = "select * from p18 where idguarnicao=$idagendaG";
                                        $resultJ6 = $obj->executaQuery($j6);
                                        while( $dadosJ6 = mysql_fetch_array($resultJ6) )
                                        {
                                            echo $dadosJ6['hora_entrada'].' - '.$dadosJ6['hora_saida'].'<br>';
                                            
                                            $entrada = $dadosJ6['hora_entrada'];
                                            $saida = $dadosJ6['hora_saida'];
                                            $motivo = $dadosJ6['motivo'];
                                            $hora1 = explode(":",$entrada);
                                            $hora2 = explode(":",$saida);
                                            $acumulador1 = ($hora1[0] * 3600) + ($hora1[1] * 60) + $hora1[2];
                                            $acumulador2 = ($hora2[0] * 3600) + ($hora2[1] * 60) + $hora2[2];
                                            $resultado = $acumulador2 - $acumulador1;
                                            $hora_ponto = floor($resultado / 3600);
                                            $resultado = $resultado - ($hora_ponto * 3600);
                                            $min_ponto = floor($resultado / 60);
                                            $resultado = $resultado - ($min_ponto * 60);
                                            $secs_ponto = $resultado;
                                            echo $hora_ponto.":".$min_ponto.":".$secs_ponto.'<br>'.$motivo.'<br>'; 
                                        }
                                    ?>
                                </td>
                                <td width="9%" align="center" class="negrito">
                                    <? 
                                            echo $hora_entradaC.' - '. $hora_saidaC.'<br>';
                                            $entrada = $hora_entradaC;
                                            $saida = $hora_saidaC;
                                            $hora1 = explode(":",$entrada);
                                            $hora2 = explode(":",$saida);
                                            $acumulador1 = ($hora1[0] * 3600) + ($hora1[1] * 60) + $hora1[2];
                                            $acumulador2 = ($hora2[0] * 3600) + ($hora2[1] * 60) + $hora2[2];
                                            $resultado = $acumulador2 - $acumulador1;
                                            $hora_ponto = floor($resultado / 3600);
                                            $resultado = $resultado - ($hora_ponto * 3600);
                                            $min_ponto = floor($resultado / 60);
                                            $resultado = $resultado - ($min_ponto * 60);
                                            $secs_ponto = $resultado;
                                            echo $hora_ponto.":".$min_ponto.":".$secs_ponto;
                                    ?>
                                </td>
                                <td width="8%" align="center" class="negrito">
                                <?
                                    $qtdSql = "select count(idguarnicao) as total from ocorrencia_guarnicao where idguarnicao=$idagendaG";
                                    $resultQTD = $obj->executaQuery($qtdSql);
                                    $linhaQTD = mysql_fetch_array($resultQTD);
                                    if( $linhaQTD )
                                    {
                                        echo $total = $linhaQTD['total'];
                                    }
                                        
                                ?>
                                </td>
                                <td width="14%" align="center" class="negrito">
                                <? 
                                       echo'ID: '.$idagendaG;
									    $escolaAT = "select * from atendimento_escola where idguarnicao=$idagendaG";
                                        $resultaAT = $obj->executaQuery($escolaAT);
                                        while( $dadosAT = mysql_fetch_array($resultaAT) )
                                        {
                                            echo $dadosAT['hora_empenho'].' / '.$dadosAT['hora_chegada'].' - '.$dadosAT['hora_saida'].'<br>';
                                           	
											$idescola = $dadosAT['idescola'];
										   	
										   	$escola = "select * from escolas where id=$idescola";
											$resultE = $obj->executaQuery($escola);
											$dadosE = mysql_fetch_array($resultE);
											if($dadosE){
												$nome = $dadosE['nome'];
											}
											 
                                            $entrada = $dadosAT['hora_chegada'];
                                            $saida = $dadosAT['hora_saida'];
											$hora_empenho = $dadosAT['hora_empenho'];
                                            $hora1 = explode(":",$entrada);
                                            $hora2 = explode(":",$saida);
                                            $acumulador1 = ($hora1[0] * 3600) + ($hora1[1] * 60) + $hora1[2];
                                            $acumulador2 = ($hora2[0] * 3600) + ($hora2[1] * 60) + $hora2[2];
                                            $resultado = $acumulador2 - $acumulador1;
                                            $hora_ponto = floor($resultado / 3600);
                                            $resultado = $resultado - ($hora_ponto * 3600);
                                            $min_ponto = floor($resultado / 60);
                                            $resultado = $resultado - ($min_ponto * 60);
                                            $secs_ponto = $resultado;
                                            echo $hora_ponto.":".$min_ponto.":".$secs_ponto.'<br>'.$nome.'<br>'; 
                                        }
                                    ?>
                                </td>
                              </tr>
                            </table>
	
               <!--fim while-->
					<? }} ?>

</fieldset>
<?
}
if( $nvaloresencontrados == 0 && $tamanho > 0 ){
?>
<fieldset>
	<legend class="letra">Resultado(s) <B><?echo $nvaloresencontrados;?></B> para o periodo entre <? echo $diai.'-'.$mesi.'-'.$anoi.' à '.$diaf.'-'.$mesf.'-'.$anof;?></legend>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
	<tr>
		<td width="100%" colspan="3" align="center" class="letra">Nenhuma ocorr&ecirc;ncia para o periodo entre <B> <? echo $diai.'-'.$mesi.'-'.$anoi.' à '.$diaf.'-'.$mesf.'-'.$anof;?></B></td>
	</tr>	
</table>
</fieldset>
<?
}
?>


    </td>
  </tr> 
	
</table>
	<!--fim adm-->
	</td>
  </tr>
</table>

</body>
</html>

<?php
	// Fechando as variáveis de conexão
	$obj->closeVar($conexao);
	$obj->closeVar($xBusca);
	$obj->closeVar($tamanho);
	$obj->closeVar($nvaloresencontrados);
	$obj->closeVar($query);
	$obj->closeVar($resultado);
	$obj->closeVar($linha);
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>