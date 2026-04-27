<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataString.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	$objS = new trataString;
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$result = $obj->executaQuery($sql);
	$linhaS = mysql_fetch_array($result);
	if( $linhaS )
	{
		$login = $linhaS["login"];
		$matricula = $linhaS["matricula"];
	}
	$chefeoperacoes = 'Joseney';
	//Pega a data atual
   $data_atual = date("Y-m-d");
		
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<head>
<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
    
    	<fieldset>
	<legend class="cabecalho">FOLGAS</legend>

    <table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
        <tr>
            <td width="88%" align="left" class="branco"><B>Descricao da Folga</B></td>
            <td width="7%" align="center" class="branco">Pendente</td>
            <td width="5%" align="center" class="branco">Solicitar</td>				
        </tr> 
	</table>

<?php 
	$chavet = true;
	$queryR = "SELECT * FROM folga where guarda='$login' order by id desc";
	$resultR = $obj->executaQuery($queryR);
	
	while( $linhaR = mysql_fetch_array($resultR) )
	{
		$descricao = $linhaR['descricao'];
		$qtade = $linhaR['qtade'];
		$qtadeatual = $linhaR['qtadeatual'];
		if($qtade > $qtadeatual){
		
			$resultado = $qtade - $qtadeatual;
?>

        <table width="100%" border="0" cellspacing="1" cellpadding="1">
            <tr bgColor="<?PHP if($chavet)
                                {
                                    echo '#cccccc';
                                }
                                else{ 
                                    echo '#ffffff';
                                } 
                                $chavet=!$chavet;
                            ?>">
                <td width="88%" align="left" class="negrito"><? echo $descricao; ?></td>
                <td width="7%" align="center" class="negrito"><?PHP echo $resultado; ?></td>
                <td width="5%" class="letra" align="center"><a href="cadastro_pedido_folga.php?idfolga=<? echo $linhaR['id']; ?>&login=<? echo $login;?>"><IMG SRC="imagens/editor_texto.png" WIDTH="19" HEIGHT="19" BORDER="0" ALT="Pedido"></A></td>
            </tr>
        </table>
<?php
		}
	}
?>

</fieldset>


<fieldset>
	<legend class="cabecalho">RESULTADO DA SOLICITAÇÃO</legend>

    <table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
        <tr>
            <td width="5%" align="center" class="branco"><strong>N</strong></td>	
            <td width="20%" align="center" class="branco"><B>Data da Folga</B></td>
            <td width="32%" align="left" class="branco"><B>Motivo:</B></td>
            <td width="37%" align="left" class="branco"><B>Motivo Negado</B></td>
            <td width="3%" align="center" class="branco">&nbsp;</td>				
            <td width="3%" align="center" class="branco"><B>&nbsp;</B></td>						
        </tr> 
	</table>

<?php 
	$chavet = true;
	$queryE = "SELECT id, DAY(datainicio) as diainicio,MONTH(datainicio) as mesinicio,YEAR(datainicio) as anoinicio,DAY(datafim) as diafim,MONTH(datafim) as mesfim,YEAR(datafim) as anofim,datainicio,datafim, motivofolga, motivostatus, status FROM pedidofolga where gmsolicitante='$login' order by id desc";
	$resultE = $obj->executaQuery($queryE);
	
	while( $linhaE = mysql_fetch_array($resultE) )
	{
		$status = $linhaE['status'];
		$diainicio = $linhaE['diainicio'];
		$mesinicio = $linhaE['mesinicio'];
		$anoinicio = $linhaE['anoinicio'];
		$diafim = $linhaE['diafim'];
		$mesfim = $linhaE['mesfim'];
		$anofim = $linhaE['anofim'];
		$datafim = $linhaE['datafim'];
		$dataincio = $linhaE['datainicio'];		
		
		$data1=''; // coloque a data vinda do banco de dados
		$data1= explode("-",$dataincio); 
		$data2=''; // coloque a data vinda do banco de dados
		$data2= explode("-",$datafim); 
		
		$datatemp1 = mktime(0,0,0,$data1[1],$data1[2],$data1[0]);
		$datatemp2 = mktime(0,0,0,$data2[1],$data2[2],$data2[0]);
		$dias = ($datatemp2 - $datatemp1)/86400;
		$dias = ceil($dias)+1;
		
		
			$ano =  substr("$dataincio", 0, 4);
			$mes =  substr("$dataincio", 5, -3);
			$dia =  substr("$dataincio", 8, 9);
		
			$diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );
		
			switch($diasemana) {
				case"0": $diasemana = "Domingo";       break;
				case"1": $diasemana = "Segunda-Feira"; break;
				case"2": $diasemana = "Terça-Feira";   break;
				case"3": $diasemana = "Quarta-Feira";  break;
				case"4": $diasemana = "Quinta-Feira";  break;
				case"5": $diasemana = "Sexta-Feira";   break;
				case"6": $diasemana = "Sábado";        break;
			}
?>

    <table width="100%" border="0" cellspacing="1" cellpadding="1"><? if($status == 1){ ?>   <? }?>
        <tr>
            <td 
               <? 
                if($status == 1){?>
                bgcolor="#AFF5C1"
                <? }else{ if($status == 2){ ?> 
                bgcolor="#FF0000"
                <? }else{ ?>
                bgcolor="#cccccc"
                <? 
                }}
                ?> 
            width="5%" align="center" class="negrito"><? echo $linhaE['id']; ?></td>
            <td 
                <? if($status == 1){ ?>
                bgcolor="#AFF5C1"
                <? }else{ if($status == 2){ ?> 
                bgcolor="#FF0000"
                <? }else{ ?>
                bgcolor="#cccccc"
                <? 
                }}
                ?> 
            width="20%" align="center" class="negrito"><?PHP echo $diainicio.' / '.$mesinicio.' / '.$anoinicio.' - '.$diasemana; ?></td>
            <td	
                <? if($status == 1){ ?>
                bgcolor="#AFF5C1"
                <? }else{ if($status == 2){ ?> 
                bgcolor="#FF0000"
                <? }else{ ?>
                bgcolor="#cccccc"
                <? 
                }}
                ?> 
            width="32%" align="left" class="negrito"><? echo $linhaE['motivofolga']; ?></td>
            <td 
                <? if($status == 1){ ?>
                bgcolor="#AFF5C1"
                <? }else{ if($status == 2){ ?> 
                bgcolor="#FF0000"
                <? }else{ ?>
                bgcolor="#cccccc"
                <? 
                }}
                ?> 
            width="37%" align="left" class="negrito"><? echo $linhaE['motivostatus']; ?></td>		
            <td width="3%" class="letra" align="center">
                <?
                 if($status == 1){
                 ?>
                    <IMG SRC="imagens/true.png" TITLE="PEDIDO ALTORIZADO" width="19" height="19"BORDER="0">
                <? }else{
                 if($status == 2){
                ?> 
                    <IMG SRC="imagens/negado.png" TITLE="PEDIDO NEGADO" width="19" height="19"BORDER="0">
                <? }else{
                 ?>
                    <IMG SRC="imagens/editor_texto.png" TITLE="PEDIDO DE FOLGA EM AVALIAÇÃO" width="19" height="19"BORDER="0">
                <? 
                    }}
                ?>
</td>
            <td width="3%" align="center" class="quote">
            
            <?
             if($status != 1 && $status != 2){
             ?>
                <a onClick="Excluir('../classes/controleCancelarFolga.php?idtemp=<? echo $linhaE['id']; ?>')" href="#">	   
                 <IMG SRC="imagens/excluir.png" WIDTH="19" HEIGHT="19" BORDER="0" ALT="Excluir"></A>
            <? }?>
            
            </td>
        </tr>
    </table>
<?php
	}
?>

</fieldset>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="14%" class="letra"><img src="imagens/true.png" width="19" height="19" /> Pedido Aprovado </td>
    <td width="13%" class="letra"><img src="imagens/negado.png" width="19" height="19" /> Pedido Negado </td>
    <td width="15%" class="letra"><img src="imagens/editor_texto.png" width="19" height="19" /> Pedido em Avalia&ccedil;&atilde;o </td>
    <td width="13%" class="letra"><img src="imagens/excluir.png" width="19" height="19" /> Excluir Solicita&ccedil;&atilde;o </td>
    <td width="45%" class="letra"><img src="imagens/editor_texto.png" width="19" height="19" />Solicitar Pedido de Folga </td>
  </tr>
</table>
    
    
    </td>
  </tr>
</table>

<p>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30">&nbsp;</td>
    <td width="810">
		<!-- ini agenda -->
			<?php include("pedidoFolga.php"); ?>
			<!-- fim agenda  -->
	</td>
    <td width="30">&nbsp;</td>
  </tr>
</table>
	<!--fim adm-->
</body>
</html>

