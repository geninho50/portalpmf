<?php

$p_Porta_Banco      = "5432";
//$p_Host_Banco       = "pmfdb.pmf.sc.gov.br";
$p_Host_Banco       = "192.168.1.20";
$p_Base_de_Dados    = "smtmt";
$p_Usuario_Banco    = "smtt_mgr";
$p_Senha_Banco      = "060668";

$_con = pg_connect("host=$p_Host_Banco dbname=$p_Base_de_Dados port=$p_Porta_Banco user=$p_Usuario_Banco password=$p_Senha_Banco");

$stat = pg_connection_status($_con);
if ($stat === 0) {
	echo 'Conexão OK';	
} else {
	echo 'Conexão sem sucesso';
}
echo "<table align='center' border=3 bordercolor='#9ACD32'>";
$resultado = pg_query($_con,"Select empresa, nome_empresa, emp from empresas ORDER BY emp");
$linhas=pg_num_rows($resultado);
echo "No de Empresas ==> ";
echo $linhas;

for ($i=0; $i<$linhas; $i++)
{
	$nomeempresa=pg_result($resultado,$i,"nome_empresa");
	$nomeemp=pg_result($resultado,$i,"emp");
	echo "<tr><td align='center'><font face='verdana' size='1'>$nomeempresa</td>";
	echo "<td align='center'><font face='verdana' size='1'>$nomeemp</td>";
	echo "</tr>";
}
echo "</table>";
?>