<?php
//Conecta na Bass de dados CCS
        $p_Porta_Banco      = 5432;
        $p_Host_Banco       = "192.168.1.20";
        $p_Base_de_Dados    = "smtmt";
        $p_Usuario_Banco    = "smtt_mgr";
        $p_Senha_Banco      = "060668";
        $conexao            = pg_connect("host=$p_Host_Banco dbname=$p_Base_de_Dados port=$p_Porta_Banco user=$p_Usuario_Banco password=$p_Senha_Banco");
        //Verifica se está conectado
                if($conexao){
                echo "Conexão Feita no Banco CCS!<br>";
                }else{
                        echo "Conexão não Feita!";
                }
?>
