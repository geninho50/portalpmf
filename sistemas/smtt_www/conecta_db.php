<?php

//$con = odbc_connect("sit_be", "", "")or die("Erro na conexão com a base de dados");
//$_con = mysql_connect("localhost", "root", "") or die("Erro na conexão com a base de dados");

$p_Porta_Banco      = 5432;
//$p_Host_Banco       = "pmfdb.pmf.sc.gov.br";
$p_Host_Banco       = "192.168.1.20";
//$p_Host_Banco       = "200.192.64.1";
//$p_Base_de_Dados    = "smtmt";
$p_Base_de_Dados    = "smtmt";
$p_Usuario_Banco    = "smtt_mgr";
$p_Senha_Banco      = "060668";

$_con = pg_connect("host=$p_Host_Banco dbname=$p_Base_de_Dados port=$p_Porta_Banco user=$p_Usuario_Banco password=$p_Senha_Banco");
//Selecionando o banco de dados
//$_db = mysql_select_db("sit_be", $_con);

?>