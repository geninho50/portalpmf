<?php

    $host = "72.55.168.187";
    $user = "prefeitura";
    $pass = ".,prefeitura@";

    $con = mysql_pconnect($host, $user, $pass) or trigger_error(mysql_error(),E_USER_ERROR); 

    mysql_set_charset('utf8',$con); 

  

    $query = sprintf("SELECT id FROM educacao.aluno
                      limit 1");

    $dados = mysql_query($query, $con) or die(mysql_error());

    $linha = mysql_fetch_assoc($dados);


    echo $linha['id'];

?>