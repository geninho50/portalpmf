<?php
	ini_set('default_charset','UTF-8');

	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include("incValidaSessao.php");
	$matricula = $_GET['matricula'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataArquivo.php");
	require ("../classes/trataString.php");
	$conexao = new DB_mysql ;
	$objT = new trataArquivo;
	$objS = new trataString;
	
	include("head/incHead.php");

?>

<table width="100%" bordercolor="#CCCCCC"  border="1" cellspacing="1" cellpadding="1" style="border-collapse: collapse" >
<?
		$conexao->conectarConf();
		$query = "SELECT * FROM usuario order by login asc";
		$resultado = $conexao->executaQuery($query);
		while($linha = mysql_fetch_array($resultado))
		{
			$id = $linha["id"];
			$login = $linha["login"];
			$diretoria = $linha["diretoria"];
			$central = $linha["central"];
			$administrativo = $linha["administrativo"];
			$educacao = $linha["educacao"];
			$logistica = $linha["logistica"];
			$sentinela = $linha["sentinela"];
			$digitacao = $linha["digitacao"];
			$matutino = $linha["matutino"];
			$vespertino = $linha["vespertino"];
			$alfa = $linha["alfa"];
			$bravo = $linha["bravo"];
			$zonaazul = $linha["zonaazul"];
			$obras = $linha["obras"];
			$rondaescolar = $linha["rondaescolar"];
			$canil = $linha["canil"];
?>
 <tr>
    <td width="10%" align="center" class="letra"><? echo $login;?></td>
    <td width="6%" class="online" align="center">
<?
	if($diretoria=='S'){?>
   	 <a href="../classes/controlePermissao.php?campo=diretoria&status=N&login=<? echo $login;?>"><img src="imagens/true.png" width="14" height="14" border="0" /></a>
<?		
	}else{
?>	
	 <a href="../classes/controlePermissao.php?campo=diretoria&status=S&login=<? echo $login;?>"><img src="imagens/linha.png" width="14" height="14" border="0" /></a>
<?		
	}
?>  
    </td>
    <td width="6%" class="online" align="center">
    <?
	if($central=='S'){?>
   	 <a href="../classes/controlePermissao.php?campo=central&status=N&login=<? echo $login;?>"><img src="imagens/true.png" width="14" height="14" border="0" /></a>
<?		
	}else{
?>	
	 <a href="../classes/controlePermissao.php?campo=central&status=S&login=<? echo $login;?>"><img src="imagens/linha.png" width="14" height="14" border="0" /></a>
<?		
	}
?>  
    </td>
    <td width="9%" class="online" align="center">
    <?
	if($administrativo=='S'){?>
   	 <a href="../classes/controlePermissao.php?campo=administrativo&status=N&login=<? echo $login;?>"><img src="imagens/true.png" width="14" height="14" border="0" /></a>
<?		
	}else{
?>	
	 <a href="../classes/controlePermissao.php?campo=administrativo&status=S&login=<? echo $login;?>"><img src="imagens/linha.png" width="14" height="14" border="0" /></a>
<?		
	}
?>  
    </td>
    <td width="6%" class="online" align="center">
    <?
	if($educacao=='S'){?>   	 
    <a href="../classes/controlePermissao.php?campo=educacao&status=N&login=<? echo $login;?>"><img src="imagens/true.png" width="14" height="14" border="0" /></a>
<?		
	}else{
?>	
	 <a href="../classes/controlePermissao.php?campo=educacao&status=S&login=<? echo $login;?>"><img src="imagens/linha.png" width="14" height="14" border="0" /></a>
<?		
	}
?>  
    </td>
    <td width="6%" class="online" align="center">
    <?
	if($logistica=='S'){?>   	 
    <a href="../classes/controlePermissao.php?campo=logistica&status=N&login=<? echo $login;?>"><img src="imagens/true.png" width="14" height="14" border="0" /></a>
<?		
	}else{
?>	
	 <a href="../classes/controlePermissao.php?campo=logistica&status=S&login=<? echo $login;?>"><img src="imagens/linha.png" width="14" height="14" border="0" /></a>
<?		
	}
?>  
    </td>
    <td width="6%" class="online" align="center">
    <?
	if($sentinela=='S'){?>   	 
    <a href="../classes/controlePermissao.php?campo=sentinela&status=N&login=<? echo $login;?>"><img src="imagens/true.png" width="14" height="14" border="0" /></a>
<?		
	}else{
?>	
	 <a href="../classes/controlePermissao.php?campo=sentinela&status=S&login=<? echo $login;?>"><img src="imagens/linha.png" width="14" height="14" border="0" /></a>
<?		
	}
?>  
    </td>
    <td width="5%" class="online" align="center">
    <?
	if($digitacao=='S'){?>   	 
    <a href="../classes/controlePermissao.php?campo=digitacao&status=N&login=<? echo $login;?>"><img src="imagens/true.png" width="14" height="14" border="0" /></a>
<?		
	}else{
?>	
	 <a href="../classes/controlePermissao.php?campo=digitacao&status=S&login=<? echo $login;?>"><img src="imagens/linha.png" width="14" height="14" border="0" /></a>
<?		
	}
?>  
    </td>
    <td width="6%" class="online" align="center">
    <?
	if($matutino=='S'){?>   	 
    <a href="../classes/controlePermissao.php?campo=matutino&status=N&login=<? echo $login;?>"><img src="imagens/true.png" width="14" height="14" border="0" /></a>
<?		
	}else{
?>	
	 <a href="../classes/controlePermissao.php?campo=matutino&status=S&login=<? echo $login;?>"><img src="imagens/linha.png" width="14" height="14" border="0" /></a>
<?		
	}
?>  
    </td>
    <td width="7%" class="online" align="center">
    <?
	if($vespertino=='S'){?>   	 
    <a href="../classes/controlePermissao.php?campo=vespertino&status=N&login=<? echo $login;?>"><img src="imagens/true.png" width="14" height="14" border="0" /></a>
<?		
	}else{
?>	
	 <a href="../classes/controlePermissao.php?campo=vespertino&status=S&login=<? echo $login;?>"><img src="imagens/linha.png" width="14" height="14" border="0" /></a>
<?		
	}
?>  
    </td>
    <td width="4%" class="online" align="center">
    <?
	if($alfa=='S'){?>   	 
    <a href="../classes/controlePermissao.php?campo=alfa&status=N&login=<? echo $login;?>"><img src="imagens/true.png" width="14" height="14" border="0" /></a>
<?		
	}else{
?>	
	 <a href="../classes/controlePermissao.php?campo=alfa&status=S&login=<? echo $login;?>"><img src="imagens/linha.png" width="14" height="14" border="0" /></a>
<?		
	}
?>  
    </td>
    <td width="4%" class="online" align="center">
    <?
	if($bravo=='S'){?>   	 
    <a href="../classes/controlePermissao.php?campo=bravo&status=N&login=<? echo $login;?>"><img src="imagens/true.png" width="14" height="14" border="0" /></a>
<?		
	}else{
?>	
	 <a href="../classes/controlePermissao.php?campo=bravo&status=S&login=<? echo $login;?>"><img src="imagens/linha.png" width="14" height="14" border="0" /></a>
<?		
	}
?>  
    </td>
    <td width="6%" class="online" align="center">
    <?
	if($zonaazul=='S'){?>   	 
    <a href="../classes/controlePermissao.php?campo=zonaazul&status=N&login=<? echo $login;?>"><img src="imagens/true.png" width="14" height="14" border="0" /></a>
<?		
	}else{
?>	
	 <a href="../classes/controlePermissao.php?campo=zonaazul&status=S&login=<? echo $login;?>"><img src="imagens/linha.png" width="14" height="14" border="0" /></a>
<?		
	}
?>  
    </td>
    <td width="4%" class="online" align="center">
    <?
	if($obras=='S'){?>   	 
    <a href="../classes/controlePermissao.php?campo=obras&status=N&login=<? echo $login;?>"><img src="imagens/true.png" width="14" height="14" border="0" /></a>
<?		
	}else{
?>	
	 <a href="../classes/controlePermissao.php?campo=obras&status=S&login=<? echo $login;?>"><img src="imagens/linha.png" width="14" height="14" border="0" /></a>
<?		
	}
?>  
    </td>
    <td width="6%" class="online" align="center">
    <?
	if($rondaescolar=='S'){?>   	 
    <a href="../classes/controlePermissao.php?campo=rondaescolar&status=N&login=<? echo $login;?>"><img src="imagens/true.png" width="14" height="14" border="0" /></a>
<?		
	}else{
?>	
	 <a href="../classes/controlePermissao.php?campo=rondaescolar&status=S&login=<? echo $login;?>"><img src="imagens/linha.png" width="14" height="14" border="0" /></a>
<?		
	}
?>  
    </td>
    <td width="4%" class="online" align="center">
    <?
	if($canil=='S'){?>   	 
    <a href="../classes/controlePermissao.php?campo=canil&status=N&login=<? echo $login;?>"><img src="imagens/true.png" width="14" height="14" border="0" /></a>
<?		
	}else{
?>	
	 <a href="../classes/controlePermissao.php?campo=canil&status=S&login=<? echo $login;?>"><img src="imagens/linha.png" width="14" height="14" border="0" /></a>
<?		
	}
?>  
    </td>
    <td width="5%" class="online" align="center">
    <?
	if($detran=='S'){?>
   	 <a href="../classes/controlePermissao.php?campo=detran&status=N&login=<? echo $login;?>"><img src="imagens/true.png" width="14" height="14" border="0" /></a>
<?		
	}else{
?>	
	 <a href="../classes/controlePermissao.php?campo=detran&status=S&login=<? echo $login;?>"><img src="imagens/linha.png" width="14" height="14" border="0" /></a>
<?		
	}
?>  
    </td>
 </tr>
<?
		}
?>
</table>
